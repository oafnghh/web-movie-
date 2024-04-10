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
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('T_Name');
            $table->string('T_Description');
            $table->string('F_Thumb');
            $table->integer('I_Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_sliders');
    }
};
