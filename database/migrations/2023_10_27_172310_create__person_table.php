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
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('T_Name');
            $table->string('T_Password');
            $table->string('T_Email');
            $table->integer('I_Role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_person');
    }
};
