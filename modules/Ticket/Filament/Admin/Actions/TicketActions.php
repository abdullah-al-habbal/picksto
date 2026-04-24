<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Modules\Ticket\Repositories\TicketRepository;

final class TicketActions
{
    public static function changeStatus(): Action
    {
        return Action::make('change_status')
            ->label(__('ticket::actions.change_status'))
            ->icon('heroicon-o-arrow-path')
            ->form([
                Select::make('status')
                    ->label(__('ticket::fields.status'))
                    ->options([
                        'open'        => __('ticket::statuses.open'),
                        'in_progress' => __('ticket::statuses.in_progress'),
                        'closed'      => __('ticket::statuses.closed'),
                    ])
                    ->required()
                    ->default(fn ($record) => $record->status),
            ])
            ->action(function (array $data, $record): void {
                app(TicketRepository::class)->updateStatus($record->id, $data['status']);
                Notification::make()
                    ->title(__('ticket::messages.status_updated'))
                    ->success()
                    ->send();
            });
    }

    public static function addReply(): Action
    {
        return Action::make('add_reply')
            ->label(__('ticket::actions.add_reply'))
            ->icon('heroicon-o-chat-bubble-left-right')
            ->modalHeading(fn ($record) => __('ticket::actions.reply_to_ticket', ['id' => $record->id]))
            ->form([
                Textarea::make('content')
                    ->label(__('ticket::fields.reply'))
                    ->required()
                    ->maxLength(5000),
            ])
            ->action(function (array $data, $record): void {
                app(TicketRepository::class)->addReply($record->id, [
                    'user_id' => auth()->id(),
                    'content' => $data['content'],
                ]);
                Notification::make()
                    ->title(__('ticket::messages.reply_added'))
                    ->success()
                    ->send();
            });
    }
}
