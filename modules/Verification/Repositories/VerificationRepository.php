<?php

declare(strict_types=1);

namespace Modules\Verification\Repositories;

use Modules\User\Models\UserModel;
use Modules\Verification\Models\VerificationCodeModel;
use Modules\Verification\Models\VerificationSettingModel;

final class VerificationRepository
{
    public function __construct(
        private readonly VerificationCodeModel $codeModel,
        private readonly VerificationSettingModel $settingModel,
        private readonly UserModel $userModel,
    ) {}

    public function sendEmailVerification(int $userId, string $purpose): array
    {
        $settings = $this->settingModel->newQuery()->first();

        if (! $settings || ! $settings->email_enabled) {
            return ['success' => false, 'message' => __('verification::errors.email_disabled')];
        }

        $user = $this->userModel->newQuery()->findOrFail($userId);

        if (! $user->email) {
            return ['success' => false, 'message' => __('verification::errors.no_email')];
        }

        $code = $this->generateAndStoreCode($userId, 'email', $purpose, $settings->code_expiry_minutes);

        // TODO: Implement actual email sending logic here using Mail facade
        // Mail::to($user->email)->send(new VerificationCodeMail($code));

        return [
            'success' => true,
            'message' => __('verification::messages.code_sent_email'),
            'expiresIn' => $settings->code_expiry_minutes,
        ];
    }

    public function sendWhatsAppVerification(int $userId, string $purpose): array
    {
        $settings = $this->settingModel->newQuery()->first();

        if (! $settings || ! $settings->whatsapp_enabled) {
            return ['success' => false, 'message' => __('verification::errors.whatsapp_disabled')];
        }

        $user = $this->userModel->newQuery()->findOrFail($userId);

        if (! $user->phone) {
            return ['success' => false, 'message' => __('verification::errors.no_phone')];
        }

        $code = $this->generateAndStoreCode($userId, 'whatsapp', $purpose, $settings->code_expiry_minutes);

        // TODO: Implement actual WhatsApp API call here

        return [
            'success' => true,
            'message' => __('verification::messages.code_sent_whatsapp'),
            'expiresIn' => $settings->code_expiry_minutes,
        ];
    }

    public function verifyCode(int $userId, string $code, string $type): array
    {
        $verificationCode = $this->codeModel->newQuery()
            ->where('user_id', $userId)
            ->where('code', $code)
            ->where('type', $type)
            ->where('is_used', false)
            ->latest()
            ->first();

        if (! $verificationCode) {
            return ['success' => false, 'message' => __('verification::errors.invalid_code')];
        }

        if ($verificationCode->isExpired()) {
            return ['success' => false, 'message' => __('verification::errors.code_expired')];
        }

        $verificationCode->is_used = true;
        $verificationCode->save();

        $user = $this->userModel->newQuery()->findOrFail($userId);

        if ($type === 'email') {
            $user->email_verified = true;
        } elseif ($type === 'whatsapp') {
            $user->phone_verified = true;
        }
        $user->save();

        return [
            'success' => true,
            'message' => __('verification::messages.verified'),
            'type' => $type,
        ];
    }

    public function getStatus(int $userId): array
    {
        $user = $this->userModel->newQuery()->findOrFail($userId);

        return [
            'emailVerified' => $user->email_verified,
            'phoneVerified' => $user->phone_verified,
            'hasEmail' => ! empty($user->email),
            'hasPhone' => ! empty($user->phone),
        ];
    }

    public function getAdminSettings(): ?VerificationSettingModel
    {
        return $this->settingModel->newQuery()->first();
    }

    public function updateAdminSettings(array $data): VerificationSettingModel
    {
        $settings = $this->settingModel->newQuery()->firstOrNew(['id' => 1]);

        $settings->fill([
            'email_enabled' => $data['emailEnabled'],
            'whatsapp_enabled' => $data['whatsappEnabled'],
            'smtp_host' => $data['smtpHost'] ?? null,
            'smtp_port' => $data['smtpPort'] ?? null,
            'smtp_username' => $data['smtpUsername'] ?? null,
            'smtp_password' => $data['smtpPassword'] ?? null,
            'smtp_from_address' => $data['smtpFromAddress'] ?? null,
            'smtp_from_name' => $data['smtpFromName'] ?? null,
            'whatsapp_api_key' => $data['whatsappApiKey'] ?? null,
            'whatsapp_phone_id' => $data['whatsappPhoneId'] ?? null,
            'code_expiry_minutes' => $data['codeExpiryMinutes'],
            'max_attempts' => $data['maxAttempts'],
        ]);

        $settings->save();

        return $settings;
    }

    public function testEmailSettings(string $testEmail): array
    {
        // TODO: Implement actual test email logic
        return [
            'success' => true,
            'message' => __('verification::messages.test_email_sent', ['email' => $testEmail]),
        ];
    }

    public function testWhatsAppSettings(string $testPhone): array
    {
        // TODO: Implement actual test WhatsApp logic
        return [
            'success' => true,
            'message' => __('verification::messages.test_whatsapp_sent', ['phone' => $testPhone]),
        ];
    }

    private function generateAndStoreCode(int $userId, string $type, string $purpose, int $expiryMinutes): VerificationCodeModel
    {
        // Invalidate previous unused codes of same type
        $this->codeModel->newQuery()
            ->where('user_id', $userId)
            ->where('type', $type)
            ->where('is_used', false)
            ->delete();

        $code = random_int(100000, 999999);

        return $this->codeModel->newQuery()->create([
            'user_id' => $userId,
            'code' => (string) $code,
            'type' => $type,
            'purpose' => $purpose,
            'expires_at' => now()->addMinutes($expiryMinutes),
            'is_used' => false,
        ]);
    }
}
