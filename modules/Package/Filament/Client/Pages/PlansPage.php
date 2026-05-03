<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Client\Pages;

use BackedEnum;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Modules\Package\Repositories\PackageRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Payment\Filament\Client\Schemas\RequestSubscriptionForm;
use Modules\Payment\Repositories\PaymentRepository;

final class PlansPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?int $navigationSort = 2;

    protected string $view = 'package::filament.pages.plans';

    public Collection $packages;

    public ?array $data = [];
    public ?int $selectedPackageId = null;

    public function mount(PackageRepository $repository): void
    {
        $this->packages = $repository->getActivePackages();
    }

    public function form(Schema $schema): Schema
    {
        return RequestSubscriptionForm::configure($schema)
            ->statePath('data');
    }

    public function selectPackage(int $id): void
    {
        $this->selectedPackageId = $id;
        $this->dispatch('open-modal', id: 'request-subscription-modal');
    }

    public function requestUpgrade(PaymentRepository $repository): void
    {
        $data = $this->form->getState();
        $data['packageId'] = $this->selectedPackageId;

        try {
            $repository->requestSubscription(auth()->id(), $data);

            Notification::make()
                ->success()
                ->title(__('payment::payment.messages.request_submitted'))
                ->send();

            $this->dispatch('close-modal', id: 'request-subscription-modal');
            $this->form->fill();

        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title(__('payment::payment.errors.request_failed'))
                ->send();
        }
    }

    public static function getNavigationLabel(): string
    {
        return __('package::package.labels.packages');
    }

    public function getHeading(): string
    {
        return __('package::package.labels.packages');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.subscriptions');
    }
}
