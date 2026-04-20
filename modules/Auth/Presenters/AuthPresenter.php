<?php
// modules/Auth/Presenters/AuthPresenter.php

declare(strict_types=1);

namespace Modules\Auth\Presenters;

use Modules\User\Models\UserModel;

final class AuthPresenter
{
    public function present(UserModel $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'avatar' => $user->avatar_url,
            'profession' => $user->profession,
            'companySize' => $user->company_size,
            'role' => $user->role,
            'isBanned' => $user->is_banned,
            'emailVerified' => $user->email_verified,
            'phoneVerified' => $user->phone_verified,
            'referralCode' => $user->referral_code,
            'createdAt' => $user->created_at->format('Y-m-d'),
            'lastLogin' => $user->last_login_at?->format('Y-m-d H:i'),
            'hasActiveSubscription' => $user->subscriptions()
                ->where('status', 'active')
                ->where('end_date', '>=', now())
                ->exists(),
        ];
    }
}
