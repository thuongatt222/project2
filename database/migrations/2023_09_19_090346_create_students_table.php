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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('school_payment_times');
            $table->integer('scholarship');
            $table->integer('status');
            $table->timestamps();

            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');

            $table->unsignedBigInteger('id_school_year');
            $table->foreign('id_school_year')->references('id')->on('school_years');

            $table->unsignedBigInteger('id_major');
            $table->foreign('id_major')->references('id')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
