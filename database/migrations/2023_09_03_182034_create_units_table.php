<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("type");
            $table->integer("cost")->nullable();
            $table->integer("cinder")->nullable();
            $table->string("size")->nullable();
            $table->string("attack_type")->nullable();
            $table->integer("damage")->nullable();
            $table->integer("health")->nullable();
            $table->integer("speed")->nullable();
            $table->boolean("is_hireable")->default(true);
            $table->string("base_image")->nullable();
            $table->string("slug");
            $table->timestamps();
        });

        Schema::create("culture_unit", function(Blueprint $table) {
            $table->foreignId("culture_id")->constrained()->cascadeOnDelete();
            $table->foreignId("unit_id")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists("culture_unit");
        Schema::dropIfExists('units');
    }
};
