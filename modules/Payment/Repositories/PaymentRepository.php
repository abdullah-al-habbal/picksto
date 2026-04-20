<?php
// Payment/Repositories/PaymentRepository.php

declare(strict_types=1);

namespace Modules\Payment\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Package\Models\PackageModel;
use Modules\Payment\Models\PaymentGatewayModel;
use Modules\Payment\Models\SubscriptionRequestModel;
use Modules\Subscription\Models\SubscriptionModel;

final class PaymentRepository
{
    public function __construct(
        private readonly PaymentGatewayModel $gatewayModel,
        private readonly SubscriptionRequestModel $requestModel,
        private readonly PackageModel $packageModel,
        private readonly SubscriptionModel $subscriptionModel,
    ) {}

    public function getActiveGateways(): Collection
    {
        return $this->gatewayModel->newQuery()->active()->get();
    }

    public function getAllGateways(): Collection
    {
        return $this->gatewayModel->newQuery()->orderBy('sort_order')->get();
    }

    public function createGateway(array $data): PaymentGatewayModel
    {
        return $this->gatewayModel->newQuery()->create([
            'name' => $data['name'],
            'type' => $data['type'],
            'description' => $data['description'] ?? null,
            'config' => $data['config'] ?? null,
            'is_active' => $data['isActive'] ?? true,
            'sort_order' => $data['sortOrder'] ?? 0,
        ]);
    }

    public function updateGateway(int $id, array $data): PaymentGatewayModel
    {
        $gateway = $this->gatewayModel->newQuery()->findOrFail($id);

        $updateData = array_filter([
            'name' => $data['name'] ?? null,
            'type' => $data['type'] ?? null,
            'description' => $data['description'] ?? null,
            'config' => $data['config'] ?? null,
            'is_active' => $data['isActive'] ?? null,
            'sort_order' => $data['sortOrder'] ?? null,
        ], static fn ($value) => $value !== null);

        $gateway->update($updateData);

        return $gateway->fresh();
    }

    public function deleteGateway(int $id): bool
    {
        return $this->gatewayModel->newQuery()->where('id', $id)->delete();
    }

    public function requestSubscription(int $userId, array $data): SubscriptionRequestModel
    {
        return $this->requestModel->newQuery()->create([
            'user_id' => $userId,
            'package_id' => $data['packageId'],
            'gateway_id' => $data['gatewayId'] ?? null,
            'status' => 'pending',
            'amount' => $this->packageModel->newQuery()->findOrFail($data['packageId'])->price,
            'currency' => 'SAR',
            'user_notes' => $data['userNotes'] ?? null,
        ]);
    }

    public function getAllRequests(?string $status = null): Collection
    {
        $query = $this->requestModel->newQuery()
            ->with(['user:id,name,email', 'package:id,name_ar,price', 'gateway:id,name']);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function approveRequest(int $requestId, int $adminId): SubscriptionRequestModel
    {
        $request = $this->requestModel->newQuery()->findOrFail($requestId);

        $request->update([
            'status' => 'completed',
            'approved_at' => now(),
            'approved_by' => $adminId,
        ]);

        $this->subscriptionModel->newQuery()->create([
            'user_id' => $request->user_id,
            'package_id' => $request->package_id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays($request->package->duration_days),
            'downloads_today' => 0,
            'downloads_month' => 0,
            'payment_method' => $request->gateway?->type ?? 'manual',
            'transaction_id' => $request->transaction_id,
        ]);

        return $request->fresh();
    }

    public function rejectRequest(int $requestId, int $adminId): SubscriptionRequestModel
    {
        $request = $this->requestModel->newQuery()->findOrFail($requestId);

        $request->update([
            'status' => 'rejected',
            'approved_at' => now(),
            'approved_by' => $adminId,
        ]);

        return $request->fresh();
    }

    public function getPendingCount(): int
    {
        return $this->requestModel->newQuery()->pending()->count();
    }

    public function getUserRequests(int $userId): Collection
    {
        return $this->requestModel->newQuery()
            ->byUser($userId)
            ->with('package')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
