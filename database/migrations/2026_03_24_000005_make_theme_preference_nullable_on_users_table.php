<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('theme_preference')->nullable()->default(null)->change();
        });

        DB::table('users')
            ->where('theme_preference', 'new')
            ->update(['theme_preference' => null]);
    }

    public function down(): void
    {
        DB::table('users')
            ->whereNull('theme_preference')
            ->update(['theme_preference' => 'new']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('theme_preference')->default('new')->nullable(false)->change();
        });
    }
};
