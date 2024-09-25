<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Primary key
            
            // Foreign key to rooms table
            $table->unsignedBigInteger('room_id'); // Room being booked
            $table->foreign('room_id')
                  ->references('id')
                  ->on('rooms')
                  ->onDelete('cascade'); // Delete booking if room is deleted

            // Foreign key to users table (guest registration)
            $table->unsignedBigInteger('user_id'); // User (guest) who made the booking
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Delete booking if the user is deleted

            // Booking details
            $table->date('check_in_date'); // Check-in date
            $table->date('check_out_date'); // Check-out date
            $table->integer('guests_count'); // Number of guests
            $table->decimal('total_price', 10, 2); // Total price for the stay

            // Booking status
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // Booking status

            // Timestamps for creation and modification
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
        Schema::dropIfExists('bookings');
    }
}
