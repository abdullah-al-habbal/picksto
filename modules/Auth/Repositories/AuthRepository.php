<?php

// modules/Auth/Repositories/AuthRepository.php

declare(strict_types=1);

namespace Modules\Auth\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\UserModel;

final class AuthRepository
{
    public function __construct(
        private readonly UserModel $model,
    ) {}

    public function register(array $data): UserModel
    {
        return $this->model->newQuery()->create([
            'name' => $data['fullName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'referral_code' => $this->generateReferralCode(),
            'referred_by' => $data['referredBy'] ?? null,
            'profession' => $data['profession'] ?? null,
            'company_size' => $data['companySize'] ?? null,
        ]);
    }

    public function findByEmail(string $email): ?UserModel
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }

    public function findByIdWithRelations(int $id): UserModel
    {
        return $this->model->newQuery()->with([
            'referrals',
            'referrer',
            'subscriptions' => fn ($q) => $q->latest(),
        ])->findOrFail($id);
    }

    public function emailExists(string $email): bool
    {
        return $this->model->newQuery()->where('email', $email)->exists();
    }

    private function generateReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(6));
        } while ($this->model->newQuery()->where('referral_code', $code)->exists());

        return $code;
    }
}
