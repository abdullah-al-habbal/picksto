<?php
// database/migrations/2026_05_01_000000_create_user_settings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_settings', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('language_id')
                ->nullable()
                ->constrained('languages')
                ->nullOnDelete();
            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currency_settings')
                ->nullOnDelete();
            $table->boolean('notify_email_enabled')->default(true);
            $table->boolean('notify_whatsapp_enabled')->default(false);
            $table->timestamps();
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
