<?php
// Currency/Database/Migrations/2024_01_01_000015_create_currency_settings_table.php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currency_settings', static function (Blueprint $table): void {
            $table->id();
            $table->string('code', 3)->default('SAR');
            $table->string('symbol')->default('ر.س');
            $table->string('name')->default('Saudi Riyal');
            $table->integer('decimal_places')->default(2);
            $table->string('decimal_separator')->default('.');
            $table->string('thousands_separator')->default(',');
            $table->boolean('symbol_position')->default(true); // true = before, false = after
            $table->boolean('space_between')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_settings');
    }
};
