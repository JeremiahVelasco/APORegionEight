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
        Schema::create('users', function (Blueprint $table) {
            $table->string('uid');
            $table->string('avatar');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('classification');
            $table->string('chapter');
            $table->string('initiation_year');
            $table->string('batch_name');
            $table->string('baptismal_name');
            $table->string('ritualization_status');
            $table->string('ritualization_year');
            $table->string('position_held');
            $table->string('position_year');
            $table->string('alumni_assoc');
            $table->string('assoc_position');
            $table->string('assoc_position_year');
            $table->string('employment_status');
            $table->string('profession');
            $table->string('position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
