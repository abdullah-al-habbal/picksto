<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Pages;

use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Modules\Referral\Models\ReferralSettingModel;

final class ReferralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected string $view = 'referral::filament.pages.referral-settings';

    public ?array $data = [];

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.referral');
    }

    public static function getNavigationLabel(): string
    {
        return __('referral::referral.settings.title');
    }

    public function mount(): void
    {
        $settings = ReferralSettingModel::query()->first();

        if ($settings) {
            $this->form->fill($settings->toArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('referral::referral.settings.general'))
                    ->schema([
                        Toggle::make('is_enabled')
                            ->label(__('referral::referral.settings.is_enabled')),
                        TextInput::make('referrals_required')
                            ->label(__('referral::referral.settings.referrals_required'))
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        TextInput::make('reward_type')
                            ->label(__('referral::referral.settings.reward_type'))
                            ->required(),
                        TextInput::make('reward_duration')
                            ->label(__('referral::referral.settings.reward_duration'))
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        TextInput::make('reward_expiry_days')
                            ->label(__('referral::referral.settings.reward_expiry_days'))
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                    ])
                    ->columns(2),
                Section::make(__('referral::referral.settings.messages_section'))
                    ->schema([
                        Textarea::make('welcome_message')
                            ->label(__('referral::referral.settings.welcome_message'))
                            ->rows(3),
                        Textarea::make('success_message')
                            ->label(__('referral::referral.settings.success_message'))
                            ->rows(3),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $settings = ReferralSettingModel::query()->firstOrNew(['id' => 1]);
        $settings->fill($this->form->getState());
        $settings->save();

        Notification::make()
            ->title(__('referral::referral.messages.settings_updated'))
            ->success()
            ->send();
    }
}
