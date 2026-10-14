<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('standees', function (Blueprint $table) {
            $table->string('mode')->default('single');
            $table->string('page_title')->nullable();
            $table->string('page_subtitle')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('standees', function (Blueprint $table) {
            $table->dropColumn(['mode', 'page_title', 'page_subtitle']);
        });
    }
};