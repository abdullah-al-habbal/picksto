<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_pages', static function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('content')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('slug');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_pages');
    }
};
