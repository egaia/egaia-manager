<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_pivot_part', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_id')->constrained('wastes')->cascadeOnDelete();
            $table->foreignId('waste_part_id')->constrained('waste_parts')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waste_pivot_part');
    }
};
