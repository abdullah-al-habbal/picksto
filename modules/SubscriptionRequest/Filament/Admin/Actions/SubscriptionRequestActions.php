<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Modules\Payment\Repositories\PaymentRepository;

final class SubscriptionRequestActions
{
    public static function approve(): Action
    {
        return Action::make('approve')
            ->label(__('subscriptionrequest::actions.approve'))
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->requiresConfirmation()
            ->visible(fn ($record) => $record->status === 'pending')
            ->action(function ($record): void {
                app(PaymentRepository::class)->approveRequest($record->id, auth()->id());
                Notification::make()
                    ->title(__('subscriptionrequest::messages.request_approved'))
                    ->success()
                    ->send();
            });
    }

    public static function reject(): Action
    {
        return Action::make('reject')
            ->label(__('subscriptionrequest::actions.reject'))
            ->icon('heroicon-o-x-circle')
            ->color('danger')
            ->requiresConfirmation()
            ->visible(fn ($record) => $record->status === 'pending')
            ->action(function ($record): void {
                app(PaymentRepository::class)->rejectRequest($record->id, auth()->id());
                Notification::make()
                    ->title(__('subscriptionrequest::messages.request_rejected'))
                    ->success()
                    ->send();
            });
    }
}
