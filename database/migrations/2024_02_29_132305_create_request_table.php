<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('pet_id');
            $table->foreign('pet_id')->references('id')->on('pet')->onDelete('cascade');

            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('daily_rate',6,2);
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
