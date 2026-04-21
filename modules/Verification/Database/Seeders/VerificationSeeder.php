<?php

declare(strict_types=1);

namespace Modules\Verification\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Verification\Models\VerificationSettingModel;

final class VerificationSeeder extends Seeder
{
    public function run(): void
    {
        VerificationSettingModel::updateOrCreate(
            ['id' => 1],
            [
                'email_enabled' => true,
                'whatsapp_enabled' => false,
                'code_expiry_minutes' => 15,
                'max_attempts' => 3,
                'smtp_from_name' => config('app.name'),
                'smtp_from_address' => config('mail.from.address'),
            ]
        );
    }
}
