<?php

declare(strict_types=1);

namespace Modules\Verification\Presenters;

use Modules\Verification\Models\VerificationSettingModel;

final class VerificationPresenter
{
    public function presentSettings(VerificationSettingModel $settings): array
    {
        return [
            'emailEnabled' => $settings->email_enabled,
            'whatsappEnabled' => $settings->whatsapp_enabled,
            'smtpHost' => $settings->smtp_host,
            'smtpPort' => $settings->smtp_port,
            'smtpUsername' => $settings->smtp_username,
            'smtpFromAddress' => $settings->smtp_from_address,
            'smtpFromName' => $settings->smtp_from_name,
            'whatsappPhoneId' => $settings->whatsapp_phone_id,
            'codeExpiryMinutes' => $settings->code_expiry_minutes,
            'maxAttempts' => $settings->max_attempts,
        ];
    }
}
