<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('rosters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("unique_id");
            $table->string("name");
            $table->longText("description")->nullable();
            $table->string("slug");
        });

        Schema::create("roster_unit", function (Blueprint $table) {
            $table->foreignId("roster_id")->constrained();
            $table->foreignId("unit_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('rosters');
    }
};
