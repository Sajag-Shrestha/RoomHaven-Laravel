<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the room
            $table->text('description')->nullable(); // Description of the room
            $table->integer('rating')->nullable(); // Star rating (1 to 5)
            $table->integer('capacity')->nullable(); // Maximum capacity of guests
            $table->float('room_size')->nullable(); // Size of the room in square meters
            $table->decimal('price', 10, 2); // Price per night
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available'); // Room status

            // Foreign key to media table
            $table->unsignedBigInteger('image_id')->nullable(); // Nullable image_id

            $table->timestamps(); // Created and updated timestamps

            // Set up the foreign key constraint
            $table->foreign('image_id')
                  ->references('id')
                  ->on('media')
                  ->onDelete('set null'); // Set image_id to null if the related media is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
