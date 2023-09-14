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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique()->nullable();
            $table->integer("cost")->nullable();
            $table->string("description")->nullable();
            $table->string("slug");
            $table->timestamps();
        });

        Schema::create("action_unit", function (Blueprint $table) {
            $table->foreignId("action_id")->constrained()->cascadeOnDelete();
            $table->foreignId("unit_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists("action_unit");
        Schema::dropIfExists('actions');
    }
};
