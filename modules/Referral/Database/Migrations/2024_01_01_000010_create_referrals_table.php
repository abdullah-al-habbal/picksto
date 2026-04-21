<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referrals', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referred_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('registered_at');
            $table->timestamps();

            $table->unique(['referrer_id', 'referred_id']);
            $table->index(['referrer_id', 'registered_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
