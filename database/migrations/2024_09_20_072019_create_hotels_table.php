<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the hotel
            $table->text('description')->nullable(); // Description of the hotel
            $table->integer('rating')->nullable(); // Star rating (1 to 5)
            $table->integer('capacity')->nullable(); // Maximum capacity of guests
            $table->float('room_size')->nullable(); // Size of the room in square meters
            $table->decimal('price', 10, 2); // Price per night
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
