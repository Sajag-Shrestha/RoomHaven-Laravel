<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insert user
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin_user',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'), // Hashing the password
                'role' => 'Admin',
                'profile_image' => 'uploads/admin.png',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manager',
                'username' => 'manager_user',
                'email' => 'manager@gmail.com',
                'password' => bcrypt('manager123'), // Hashing the password
                'role' => 'Manager',
                'profile_image' => 'uploads/manager.png',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'guest',
                'username' => 'guest_user',
                'email' => 'guest@gmail.com',
                'password' => bcrypt('guest123'), // Hashing the password
                'role' => 'Guest',
                'profile_image' => 'uploads/guest.png',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert media entries
        DB::table('media')->insert([
            ['title' => 'Family Suite', 'img_link' => 'Family Suite.jpg', 'type' => 'image'],
            ['title' => 'Couple Suite', 'img_link' => 'Couple Suite.jpg', 'type' => 'image'],
            ['title' => 'Single Suite', 'img_link' => 'Single suite.jpg', 'type' => 'image'],
            ['title' => 'Presidential Suite', 'img_link' => 'presedential suite.jpg', 'type' => 'image'],
            ['title' => 'Kingsize Suite', 'img_link' => 'Kingsize Suite.jpg', 'type' => 'image'],
            ['title' => 'Kitchen Set Suite', 'img_link' => 'Kitchen Set Suite.jpg', 'type' => 'image'],
        ]);

        // Insert rooms entries with appropriate values and linked media
        DB::table('rooms')->insert([
            [
                'name' => 'Family Suite',
                'description' => 'Spacious family suite with all amenities.',
                'rating' => 5,
                'capacity' => 4,
                'room_size' => 35.5,
                'price' => 150.00,
                'status' => 'available',
                'image_id' => 1, // ID from media table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Couple Suite',
                'description' => 'Romantic suite for couples.',
                'rating' => 4,
                'capacity' => 2,
                'room_size' => 30.0,
                'price' => 120.00,
                'status' => 'available',
                'image_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Single Suite',
                'description' => 'Cozy room for single travelers.',
                'rating' => 3,
                'capacity' => 1,
                'room_size' => 20.0,
                'price' => 80.00,
                'status' => 'available',
                'image_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'Luxurious suite with top-class service.',
                'rating' => 5,
                'capacity' => 4,
                'room_size' => 50.0,
                'price' => 250.00,
                'status' => 'available',
                'image_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kingsize Suite',
                'description' => 'Large suite with king-sized bed.',
                'rating' => 4,
                'capacity' => 3,
                'room_size' => 40.0,
                'price' => 180.00,
                'status' => 'available',
                'image_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kitchen Set Suite',
                'description' => 'Suite with a fully equipped kitchen.',
                'rating' => 4,
                'capacity' => 3,
                'room_size' => 45.0,
                'price' => 200.00,
                'status' => 'available',
                'image_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}