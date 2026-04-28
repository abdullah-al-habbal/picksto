<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Referral\Http\Actions\CheckReferralRewardsAction;
use Modules\Referral\Http\Actions\ClaimRewardAction;
use Modules\Referral\Http\Actions\GetReferralStatsAction;
use Modules\Referral\Http\Actions\ValidateReferralCodeAction;

Route::middleware('auth')->prefix('referrals')->name('referrals.')->group(static function (): void {
    Route::get('stats', GetReferralStatsAction::class)->name('stats');
    Route::post('check-rewards', CheckReferralRewardsAction::class)->name('check-rewards');
    Route::post('claim/{rewardId}', ClaimRewardAction::class)->name('claim');
});

Route::get('referrals/validate/{code}', ValidateReferralCodeAction::class)->name('validate');
