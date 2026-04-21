<?php

declare(strict_types=1);

namespace Modules\Referral\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Referral\Models\ReferralModel;
use Modules\Referral\Models\ReferralRewardModel;
use Modules\Referral\Models\ReferralSettingModel;
use Modules\User\Models\UserModel;

final class ReferralRepository
{
    public function __construct(
        private readonly ReferralSettingModel $settingModel,
        private readonly ReferralModel $referralModel,
        private readonly ReferralRewardModel $rewardModel,
        private readonly UserModel $userModel,
    ) {}

    public function getSettings(): ?ReferralSettingModel
    {
        return $this->settingModel->newQuery()->first();
    }

    public function updateSettings(array $data): ReferralSettingModel
    {
        $settings = $this->settingModel->newQuery()->firstOrNew(['id' => 1]);

        $settings->fill([
            'is_enabled' => $data['isEnabled'],
            'referrals_required' => $data['referralsRequired'],
            'reward_type' => $data['rewardType'],
            'reward_duration' => $data['rewardDuration'],
            'reward_expiry_days' => $data['rewardExpiryDays'],
            'welcome_message' => $data['welcomeMessage'],
            'success_message' => $data['successMessage'],
        ]);

        $settings->save();

        return $settings;
    }

    public function validateCode(string $code): array
    {
        $user = $this->userModel->newQuery()->where('referral_code', $code)->first();

        if (! $user) {
            return ['valid' => false, 'message' => __('referral::errors.invalid_code')];
        }

        return [
            'valid' => true,
            'referrerName' => $user->name,
            'referrerId' => $user->id,
        ];
    }

    public function processNewReferral(int $referredUserId, string $referralCode): void
    {
        $referrer = $this->userModel->newQuery()->where('referral_code', $referralCode)->first();

        if (! $referrer) {
            return;
        }

        $this->referralModel->newQuery()->create([
            'referrer_id' => $referrer->id,
            'referred_id' => $referredUserId,
            'registered_at' => now(),
        ]);
    }

    public function getUserStats(int $userId): array
    {
        $totalReferrals = $this->referralModel->newQuery()
            ->where('referrer_id', $userId)
            ->count();

        $pendingRewards = $this->rewardModel->newQuery()
            ->where('user_id', $userId)
            ->pending()
            ->count();

        $claimedRewards = $this->rewardModel->newQuery()
            ->where('user_id', $userId)
            ->claimed()
            ->count();

        return [
            'totalReferrals' => $totalReferrals,
            'pendingRewards' => $pendingRewards,
            'claimedRewards' => $claimedRewards,
        ];
    }

    public function checkAndCreateRewards(int $userId): array
    {
        $settings = $this->getSettings();

        if (! $settings || ! $settings->is_enabled) {
            return ['newRewards' => 0];
        }

        $totalReferrals = $this->referralModel->newQuery()
            ->where('referrer_id', $userId)
            ->count();

        $existingRewards = $this->rewardModel->newQuery()
            ->where('user_id', $userId)
            ->count();

        $eligibleRewards = floor($totalReferrals / $settings->referrals_required);
        $newRewardsCount = max(0, $eligibleRewards - $existingRewards);

        $created = 0;

        for ($i = 0; $i < $newRewardsCount; $i++) {
            $this->rewardModel->newQuery()->create([
                'user_id' => $userId,
                'status' => 'pending',
                'earned_at' => now(),
                'expires_at' => now()->addDays($settings->reward_expiry_days),
            ]);
            $created++;
        }

        return ['newRewards' => $created];
    }

    public function claimReward(int $userId, int $rewardId): ReferralRewardModel
    {
        $reward = $this->rewardModel->newQuery()
            ->where('id', $rewardId)
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->firstOrFail();

        if ($reward->isExpired()) {
            $reward->status = 'expired';
            $reward->save();
            throw new \RuntimeException(__('referral::errors.reward_expired'));
        }

        $reward->status = 'claimed';
        $reward->claimed_at = now();
        $reward->save();

        // Here you would apply the actual reward (e.g., add subscription days)
        // This depends on your reward_type logic

        return $reward;
    }

    public function getAllReferrals(): Collection
    {
        return $this->referralModel->newQuery()
            ->with(['referrer:id,name,email', 'referred:id,name,email'])
            ->orderBy('registered_at', 'desc')
            ->get();
    }

    public function getAllRewards(): Collection
    {
        return $this->rewardModel->newQuery()
            ->with('user:id,name,email')
            ->orderBy('earned_at', 'desc')
            ->get();
    }

    public function getAdminStatistics(): array
    {
        $totalReferrals = $this->referralModel->newQuery()->count();
        $totalRewards = $this->rewardModel->newQuery()->count();
        $pendingRewards = $this->rewardModel->newQuery()->pending()->count();
        $claimedRewards = $this->rewardModel->newQuery()->claimed()->count();

        return [
            'totalReferrals' => $totalReferrals,
            'totalRewards' => $totalRewards,
            'pendingRewards' => $pendingRewards,
            'claimedRewards' => $claimedRewards,
        ];
    }
}
