<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verification_codes', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('code', 6);
            $table->enum('type', ['email', 'whatsapp']);
            $table->enum('purpose', ['registration', 'reset'])->default('registration');
            $table->timestamp('expires_at');
            $table->boolean('is_used')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'type', 'is_used']);
            $table->index(['code', 'is_used']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verification_codes');
    }
};
