<?php

// Settings/Database/Migrations/2024_01_01_000016_create_settings_table.php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', static function (Blueprint $table): void {
            $table->id();
            $table->string('key_name')->unique();
            $table->json('value')->nullable();
            $table->string('group')->default('general');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['group', 'key_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
