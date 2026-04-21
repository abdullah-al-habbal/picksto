<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Referral\Http\Actions\CheckReferralRewardsAction;
use Modules\Referral\Http\Actions\ClaimRewardAction;
use Modules\Referral\Http\Actions\GetAdminReferralSettingsAction;
use Modules\Referral\Http\Actions\GetAdminReferralStatisticsAction;
use Modules\Referral\Http\Actions\GetAllReferralsAction;
use Modules\Referral\Http\Actions\GetAllRewardsAction;
use Modules\Referral\Http\Actions\GetReferralStatsAction;
use Modules\Referral\Http\Actions\UpdateAdminReferralSettingsAction;
use Modules\Referral\Http\Actions\ValidateReferralCodeAction;

// User routes
Route::middleware('auth')->prefix('referrals')->name('referrals.')->group(static function (): void {
    Route::get('stats', GetReferralStatsAction::class)->name('stats');
    Route::post('check-rewards', CheckReferralRewardsAction::class)->name('check-rewards');
    Route::post('claim/{rewardId}', ClaimRewardAction::class)->name('claim');
});

// Public validation
Route::get('referrals/validate/{code}', ValidateReferralCodeAction::class)->name('validate');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin/referral')->name('admin.referral.')->group(static function (): void {
    Route::get('settings', GetAdminReferralSettingsAction::class)->name('settings');
    Route::put('settings', UpdateAdminReferralSettingsAction::class)->name('settings.update');
    Route::get('statistics', GetAdminReferralStatisticsAction::class)->name('statistics');
    Route::get('referrals', GetAllReferralsAction::class)->name('referrals');
    Route::get('rewards', GetAllRewardsAction::class)->name('rewards');
});
