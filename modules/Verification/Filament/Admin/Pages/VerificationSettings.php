<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Modules\Verification\Models\VerificationSettingModel;
use BackedEnum;

final class VerificationSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected string $view = 'verification::filament.pages.verification-settings';

    public ?array $data = [];

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('verification::verification.settings.title');
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
                Section::make(__('verification::verification.settings.general'))
                    ->schema([
                        Toggle::make('email_enabled')->label(__('verification::verification.settings.email_enabled')),
                        Toggle::make('whatsapp_enabled')->label(__('verification::verification.settings.whatsapp_enabled')),
                        TextInput::make('code_expiry_minutes')->label(__('verification::verification.settings.code_expiry_minutes'))->numeric(),
                        TextInput::make('max_attempts')->label(__('verification::verification.settings.max_attempts'))->numeric(),
                    ])->columns(2),
                Section::make(__('verification::verification.settings.smtp'))
                    ->schema([
                        TextInput::make('smtp_host')->label(__('verification::verification.settings.smtp_host')),
                        TextInput::make('smtp_port')->label(__('verification::verification.settings.smtp_port')),
                        TextInput::make('smtp_username')->label(__('verification::verification.settings.smtp_username')),
                        TextInput::make('smtp_password')->label(__('verification::verification.settings.smtp_password'))->password(),
                        TextInput::make('smtp_from_address')->label(__('verification::verification.settings.smtp_from_address')),
                        TextInput::make('smtp_from_name')->label(__('verification::verification.settings.smtp_from_name')),
                    ])->columns(2),
                Section::make(__('verification::verification.settings.whatsapp'))
                    ->schema([
                        TextInput::make('whatsapp_api_key')->label(__('verification::verification.settings.whatsapp_api_key')),
                        TextInput::make('whatsapp_phone_id')->label(__('verification::verification.settings.whatsapp_phone_id')),
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
            ->title(__('verification::verification.settings.saved'))
            ->success()
            ->send();
    }
}
