<?php

// modules/Package/Database/Migrations/2024_01_01_000002_create_packages_table.php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', static function (Blueprint $table): void {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('currency')->default('SAR');
            $table->integer('daily_limit')->default(10);
            $table->integer('monthly_limit')->default(100);
            $table->json('allowed_sites')->nullable();
            $table->integer('duration_days')->default(30);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'price']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
