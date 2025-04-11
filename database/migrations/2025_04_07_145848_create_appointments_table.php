<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('phone');
            $table->enum('gender', ['male', 'female', 'children']);
            
            // CHANGED: from string to text to store multiple services
            $table->text('services');

            $table->date('appointment_date');
            $table->time('appointment_time');

            // CHANGED: renamed `price` to `total_price` for clarity
            $table->integer('total_price');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
