<?php

// Payment/Repositories/PaymentRepository.php

declare(strict_types=1);

namespace Modules\Payment\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Package\Repositories\PackageRepository;
use Modules\Payment\Models\PaymentGatewayModel;
use Modules\Subscription\Repositories\SubscriptionRepository;
use Modules\SubscriptionRequest\Models\SubscriptionRequestModel;
use Modules\SubscriptionRequest\Repositories\SubscriptionRequestRepository;

final class PaymentRepository
{
    public function __construct(
        private readonly PaymentGatewayRepository $gatewayRepo,
        private readonly SubscriptionRequestRepository $subscriptionRequestRepo,
        private readonly PackageRepository $packageRepo,
        private readonly SubscriptionRepository $subscriptionRepo,
    ) {}

    public function getActiveGateways(): Collection
    {
        return $this->gatewayRepo->getActiveGateways();
    }

    public function getAllGateways(): Collection
    {
        return $this->gatewayRepo->getAllGateways();
    }

    public function createGateway(array $data): PaymentGatewayModel
    {
        return $this->gatewayRepo->createGateway($data);
    }

    public function updateGateway(int $id, array $data): ?PaymentGatewayModel
    {
        return $this->gatewayRepo->updateGateway($id, $data);
    }

    public function deleteGateway(int $id): bool
    {
        return $this->gatewayRepo->deleteGateway($id);
    }

    public function requestSubscription(int $userId, array $data): SubscriptionRequestModel
    {
        $packagePrice = $this->packageRepo->getPrice($data['packageId']);

        return $this->subscriptionRequestRepo->create([
            'user_id' => $userId,
            'package_id' => $data['packageId'],
            'gateway_id' => $data['gatewayId'] ?? null,
            'status' => 'pending',
            'amount' => $packagePrice,
            'currency' => 'SAR',
            'user_notes' => $data['userNotes'] ?? null,
        ]);
    }

    public function getAllRequests(?string $status = null): Collection
    {
        return $this->subscriptionRequestRepo->getAllByStatus($status);
    }

    public function approveRequest(int $requestId, int $adminId): SubscriptionRequestModel
    {
        $this->subscriptionRequestRepo->updateStatus($requestId, 'completed', $adminId);

        $request = $this->subscriptionRequestRepo->findById($requestId);

        if ($request) {
            $package = $this->packageRepo->findById($request->package_id);

            $this->subscriptionRepo->create([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addDays($package->duration_days ?? 30),
                'downloads_today' => 0,
                'downloads_month' => 0,
                'payment_method' => $request->gateway?->type ?? 'manual',
                'transaction_id' => $request->transaction_id,
            ]);
        }

        return $request;
    }

    public function rejectRequest(int $requestId, int $adminId): SubscriptionRequestModel
    {
        $this->subscriptionRequestRepo->updateStatus($requestId, 'rejected', $adminId);

        return $this->subscriptionRequestRepo->findById($requestId);
    }
}
