<?php

// modules/User/Database/Migrations/2024_01_01_000001_create_users_table.php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->enum('role', ['user', 'admin', 'supervisor'])->default('user');
            $table->boolean('is_banned')->default(false);
            $table->string('avatar')->nullable();
            $table->string('referral_code')->unique();
            $table->foreignId('referred_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('profession')->nullable();
            $table->string('company_size')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['email', 'deleted_at']);
            $table->index(['role', 'is_banned']);
            $table->index(['referral_code']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
