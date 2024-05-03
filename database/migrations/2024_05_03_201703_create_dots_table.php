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
        Schema::create('dots', function (Blueprint $table) {
            $table->id();
            $table->integer("floor", unsigned: true)->nullable(false);
            $table->integer("x")->nullable(false);
            $table->integer("y")->nullable(false);
            $table->string("mac",255)->nullable(false);
            $table->string("name", 255)->nullable(false)->default("");
            $table->string("description", 10240)->nullable(false)->default("");

            $table->string("type", 255)->nullable(false)->default("");

            $table->jsonb("connected")->nullable(false)->default("[]");
            $table->unsignedBigInteger('location_id')->nullable(false);
            $table->foreign('location_id', 'dot_location')->references('id')->on('locations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dots');
    }
};
