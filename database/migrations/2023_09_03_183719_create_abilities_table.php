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
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique()->nullable();
            $table->string("description")->nullable();
            $table->string("slug");
            $table->timestamps();
        });

        Schema::create("ability_unit", function (Blueprint $table) {
            $table->foreignId("ability_id")->constrained()->cascadeOnDelete();
            $table->foreignId("unit_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists("ability_unit");
        Schema::dropIfExists('abilities');
    }
};
