<?php
// modules/User/Repositories/UserRepository.php

declare(strict_types=1);

namespace Modules\User\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\UserModel;

final class UserRepository
{
    public function __construct(
        private readonly SubscriptionService $subscriptionService,
        private readonly UserModel $model,
    ) {}

    public function findById(int $id): ?UserModel
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function findByIdWithRelations(int $id): UserModel
    {
        return $this->model->newQuery()->with([
            'referrals',
            'referrer',
            'subscriptions' => fn ($q) => $q->latest(),
        ])->findOrFail($id);
    }

    public function findByEmail(string $email): ?UserModel
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }

    public function findByReferralCode(string $code): ?UserModel
    {
        return $this->model->newQuery()->where('referral_code', $code)->first();
    }

    public function getAllWithPagination(int $perPage = 20, ?string $search = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($search) {
            $query->where(static function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function updateProfile(int $userId, array $data): UserModel
    {
        $user = $this->findById($userId);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? $user->phone,
            'profession' => $data['profession'] ?? $user->profession,
            'company_size' => $data['companySize'] ?? $user->company_size,
        ]);

        return $user->fresh();
    }

    public function updateAvatar(int $userId, string $avatarPath): UserModel
    {
        $user = $this->findById($userId);
        $user->avatar = $avatarPath;
        $user->save();

        return $user;
    }

    public function updateRole(int $userId, string $role): UserModel
    {
        $user = $this->findById($userId);
        $user->role = $role;
        $user->save();

        return $user;
    }

    public function updateBanStatus(int $userId, bool $isBanned): UserModel
    {
        $user = $this->findById($userId);
        $user->is_banned = $isBanned;
        $user->save();

        return $user;
    }

    public function activatePackage(int $userId, int $packageId, int $durationDays): bool
    {
        return $this->subscriptionService->activateManualSubscription(
            $userId,
            $packageId,
            $durationDays
        );
    }

    public function create(array $data): UserModel
    {
        return $this->model->newQuery()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'referral_code' => $this->generateReferralCode(),
            'referred_by' => $data['referredBy'] ?? null,
            'profession' => $data['profession'] ?? null,
            'company_size' => $data['companySize'] ?? null,
        ]);
    }

    private function generateReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(6));
        } while ($this->model->newQuery()->where('referral_code', $code)->exists());

        return $code;
    }
}
