<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(false);
            $table->string('description', 512)->nullable(false)->default("");
            $table->string('address', 255)->nullable(false);
            $table->string('dataUrl', 255)->nullable(false);
            $table->boolean('isVisible')->nullable(false)->default(true);
            $table->string('hashSum', 255)->nullable(false);
            $table->string('path', 255)->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
