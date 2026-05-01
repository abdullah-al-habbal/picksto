<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Client\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Download\Filament\Client\Schemas\RequestDownloadForm;
use Modules\Download\Filament\Client\Tables\DownloadsTable;
use Modules\Download\Models\DownloadModel;
use Modules\Download\Repositories\DownloadRepository;

final class DownloadsPage extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?int $navigationSort = 3;

    protected string $view = 'download::filament.pages.downloads';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public static function getNavigationLabel(): string
    {
        return __('download::download.labels.downloads');
    }

    public function getHeading(): string
    {
        return __('download::download.labels.downloads');
    }

    public function form(Schema $schema): Schema
    {
        return RequestDownloadForm::configure($schema)
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return DownloadsTable::configure($table)
            ->query(
                DownloadModel::query()
                    ->where('user_id', auth()->id())
                    ->with('product')
                    ->orderBy('created_at', 'desc')
            );
    }

    public function submitDownloadRequest(DownloadRepository $repository): void
    {
        $data = $this->form->getState();

        try {
            $repository->requestDownload(auth()->id(), $data['url']);

            Notification::make()
                ->success()
                ->title(__('download::download.messages.request_submitted'))
                ->send();

            $this->form->fill();

        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title(__('download::download.errors.request_failed'))
                ->body($e->getMessage())
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.content');
    }
}
