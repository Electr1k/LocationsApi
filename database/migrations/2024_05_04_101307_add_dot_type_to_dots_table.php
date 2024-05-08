<?php

use App\Models\Dot;
use App\Models\DotType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        DB::transaction(function () {
            Schema::table('dots', function (Blueprint $table) {
                $table->unsignedBigInteger('type_id')->nullable()->default(null);
                $table->foreign('type_id', 'dot_type')->references('id')->on('dot_types');
                $table->unsignedBigInteger('index_in_location')->nullable()->default(null);
            });
            $dots = Dot::all();
            foreach ($dots as $dot) {
                if (!empty($dot->type)) {
                    $type = DotType::firstOrCreate(['title' => $dot->type]);
                    $dot->update(['type_id' => $type->id]);
                }
            }
            Schema::table('dots', function (Blueprint $table) {
                $table->dropColumn("type");
            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dots', function (Blueprint $table) {
            $table->string("type", 255)->nullable(false)->default("");
        });
        DB::transaction(function () {

            $dots = Dot::all();
            foreach ($dots as $dot) {
                $type = DotType::find($dot->type_id);
                if ($type) $dot->update(['type' => $type->title]);
            }
        });
        Schema::table('dots', function (Blueprint $table) {
            $table->dropForeign("dot_type");
            $table->dropColumn("type_id");
            $table->dropColumn("index_in_location");
        });
    }
};
