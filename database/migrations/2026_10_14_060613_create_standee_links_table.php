<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('standee_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('standee_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('url');
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedBigInteger('clicks')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('standee_links');
    }
};