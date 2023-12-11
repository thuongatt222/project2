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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->integer('school_payment_times');
            $table->integer('original_fee');

            $table->unsignedBigInteger('id_school_year');
            $table->foreign('id_school_year')->references('id')->on('school_years');

            $table->unsignedBigInteger('id_major');
            $table->foreign('id_major')->references('id')->on('majors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
