<?php
// modules/User/Database/Seeders/UserSettingSeeder.php
declare(strict_types=1);

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Language\Models\LanguageModel;
use Modules\Currency\Models\CurrencySettingModel;
use Modules\User\Models\UserModel;
use Modules\User\Models\UserSettingModel;

final class UserSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaultLanguage = LanguageModel::where('is_default', true)->first();
        $defaultCurrency = CurrencySettingModel::first();

        $usersWithoutSettings = UserModel::doesntHave('setting')->pluck('id');

        foreach ($usersWithoutSettings as $userId) {
            UserSettingModel::create([
                'user_id' => $userId,
                'language_id' => $defaultLanguage?->id,
                'currency_id' => $defaultCurrency?->id,
            ]);
        }
    }
}
