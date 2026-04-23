<?php

// Ticket/Database/Seeders/TicketSeeder.php

declare(strict_types=1);

namespace Modules\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\Models\TicketModel;
use Modules\User\Models\UserModel;

final class TicketSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            $users = UserModel::limit(5)->get();
            $users->each(fn ($user) => TicketModel::factory()->count(3)->create(['user_id' => $user->id]));
        }
    }
}
