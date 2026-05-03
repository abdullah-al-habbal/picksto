<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Client\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Modules\Referral\Models\ReferralModel;
use Modules\Referral\Models\ReferralRewardModel;
use Modules\Referral\Repositories\ReferralRepository;
use Modules\Referral\Filament\Client\Tables\ReferralsTable;
use Modules\Referral\Filament\Client\Schemas\ReferralRewardForm;

final class ReferralPage extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-share-2';
    
    protected static ?int $navigationSort = 5;
    
    protected string $view = 'referral::filament.pages.referral';

    public function table(Table $table): Table
    {
        return ReferralsTable::configure($table)
            ->query(
                ReferralModel::query()
                    ->where('referrer_id', auth()->id())
                    ->with('referred')
                    ->orderBy('registered_at', 'desc')
            );
    }

    public static function getNavigationLabel(): string
    {
        return __('referral::referral.labels.referrals');
    }

    public function getHeading(): string
    {
        return __('referral::referral.labels.referrals');
    }

    public function getReferralStats(): array
    {
        $repository = app(ReferralRepository::class);
        return $repository->getUserStats(auth()->id()) ?? [];
    }

    public function claimRewardsAction(): Action
    {
        return Action::make('claim-rewards')
            ->label(__('referral::referral.messages.reward_claimed'))
            ->schema(fn (Schema $schema) => ReferralRewardForm::configure($schema))
            ->action(function (array $data): void {
                try {
                    $reward = ReferralRewardModel::find($data['reward_id']);

                    if (! $reward || $reward->user_id !== auth()->id()) {
                        Notification::make()
                            ->danger()
                            ->title(__('referral::referral.errors.claim_failed'))
                            ->send();

                        return;
                    }

                    $reward->update(['claimed_at' => now()]);

                    Notification::make()
                        ->success()
                        ->title(__('referral::referral.messages.reward_claimed'))
                        ->send();

                    $this->redirect(static::getUrl());
                } catch (\Exception $e) {
                    Notification::make()
                        ->danger()
                        ->title(__('referral::referral.errors.claim_failed'))
                        ->send();
                }
            });
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.growth');
    }
}
