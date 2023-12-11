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
        Schema::create('tuitions', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_times');
            $table->integer('fee');
            $table->text('note')->nullable();

            $table->unsignedBigInteger('id_student');
            $table->foreign('id_student')->references('id')->on('students');

            $table->unsignedBigInteger('id_fee');
            $table->foreign('id_fee')->references('id')->on('fees');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuitions');
    }
};
