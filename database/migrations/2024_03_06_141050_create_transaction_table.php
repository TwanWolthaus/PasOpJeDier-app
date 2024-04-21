<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('request_id');
            $table->foreign('request_id')->references('id')->on('request')->onDelete('cascade');
            $table->foreignId('sitter_id');
            $table->foreign('sitter_id')->references('id')->on('users');

            $table->string('review_owner')->nullable();
            $table->string('review_sitter')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
