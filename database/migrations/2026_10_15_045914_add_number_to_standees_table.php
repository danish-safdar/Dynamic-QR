<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('standees', function (Blueprint $table) {
            $table->unsignedInteger('number')->nullable()->after('code');
        });

        // purani rows ka number code se nikaal lo (s12 -> 12)
        DB::statement("UPDATE standees SET number = CAST(SUBSTRING(code, 2) AS UNSIGNED)");

        Schema::table('standees', function (Blueprint $table) {
            $table->unsignedInteger('number')->nullable(false)->change();
            $table->unique('number');
        });
    }

    public function down(): void
    {
        Schema::table('standees', function (Blueprint $table) {
            $table->dropUnique(['number']);
            $table->dropColumn('number');
        });
    }
};