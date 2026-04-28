<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Modules\Verification\Models\VerificationSettingModel;

final class VerificationSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected string $view = 'verification::filament.pages.verification-settings';
    
    public ?array $data = [];
    
    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('Verification Settings');
    }

    public function mount(): void
    {
        $settings = VerificationSettingModel::first();
        
        if ($settings) {
            $this->form->fill($settings->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Settings')
                    ->schema([
                        Toggle::make('email_enabled')->label('Enable Email Verification'),
                        Toggle::make('whatsapp_enabled')->label('Enable WhatsApp Verification'),
                        TextInput::make('code_expiry_minutes')->label('Code Expiry (Minutes)')->numeric(),
                        TextInput::make('max_attempts')->label('Max Attempts')->numeric(),
                    ])->columns(2),
                Section::make('SMTP Settings')
                    ->schema([
                        TextInput::make('smtp_host')->label('SMTP Host'),
                        TextInput::make('smtp_port')->label('SMTP Port'),
                        TextInput::make('smtp_username')->label('SMTP Username'),
                        TextInput::make('smtp_password')->label('SMTP Password')->password(),
                        TextInput::make('smtp_from_address')->label('SMTP From Address'),
                        TextInput::make('smtp_from_name')->label('SMTP From Name'),
                    ])->columns(2),
                Section::make('WhatsApp Settings')
                    ->schema([
                        TextInput::make('whatsapp_api_key')->label('WhatsApp API Key'),
                        TextInput::make('whatsapp_phone_id')->label('WhatsApp Phone ID'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $settings = VerificationSettingModel::firstOrNew(['id' => 1]);
        $settings->fill($this->form->getState());
        $settings->save();

        Notification::make()
            ->title('Settings updated successfully')
            ->success()
            ->send();
    }
}
