<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // fix: add direct in the users table, and I think is better to have a user_settings table as key:vlaue
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('settings')->nullable()->after('company_size');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('settings');
        });
    }
};
