<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Repositories\TicketRepository;

final class TicketsPage extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Support Tickets';
    protected static ?int $navigationSort = 4;
    protected string $view = 'filament.pages.tickets';

    public ?array $createData = [];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::query()
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                TextColumn::make('id')
                    ->label('Ticket ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'info',
                        'in_progress' => 'warning',
                        'resolved' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('priority')
                    ->label('Priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('createdAt')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    public function createAction(): Action
    {
        return Action::make('create')
            ->label('Create Ticket')
            ->form([
                Section::make('New Support Ticket')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->maxLength(255),
                        Select::make('category')
                            ->label('Category')
                            ->options([
                                'bug' => 'Bug Report',
                                'feature' => 'Feature Request',
                                'support' => 'Technical Support',
                                'billing' => 'Billing Question',
                                'other' => 'Other',
                            ])
                            ->required(),
                        RichEditor::make('description')
                            ->label('Description')
                            ->required()
                            ->toolbarButtons(['bold', 'italic', 'underline', 'link']),
                    ])
                    ->columns(1),
            ])
            ->action(function (array $data): void {
                try {
                    $ticketRepository = app(TicketRepository::class);
                    $ticketRepository->create([
                        'user_id' => auth()->id(),
                        'subject' => $data['subject'],
                        'description' => $data['description'],
                        'category' => $data['category'],
                        'status' => 'open',
                        'priority' => 'medium',
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Ticket Created')
                        ->body('Your support ticket has been created successfully.')
                        ->send();

                    $this->redirect(static::getUrl());
                } catch (\Exception $e) {
                    Notification::make()
                        ->danger()
                        ->title('Error')
                        ->body('Failed to create ticket. Please try again.')
                        ->send();
                }
            });
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Support';
    }
}
