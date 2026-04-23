<?php

// modules/User/Presenters/UserPresenter.php

declare(strict_types=1);

namespace Modules\User\Presenters;

use Modules\User\Models\UserModel;

final class UserPresenter
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
        ];
    }

    public function presentDetailed(UserModel $user): array
    {
        return array_merge($this->present($user), [
            'referralsCount' => $user->referrals->count(),
            'referrerName' => $user->referrer?->name,
            'activeSubscription' => $user->subscriptions()
                ->where('status', 'active')
                ->where('end_date', '>=', now())
                ->first()?->package?->name_ar,
            'totalDownloads' => $user->downloads()->count(),
        ]);
    }

    public function presentList(UserModel $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'isBanned' => $user->is_banned,
            'avatar' => $user->avatar_url,
            'createdAt' => $user->created_at->format('Y-m-d'),
        ];
    }
}
