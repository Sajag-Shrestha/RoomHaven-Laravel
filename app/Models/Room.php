<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'rating',
        'capacity',
        'room_size',
        'price',
        'image_id',
        'status' // New field for room status
    ];

    // Define possible status values
    const STATUS_AVAILABLE = 'available';
    const STATUS_BOOKED = 'booked';
    const STATUS_MAINTENANCE = 'maintenance';

    public static function validate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|between:1,5', // Ensure rating is between 1 and 5
            'capacity' => 'nullable|integer',
            'room_size' => 'nullable|numeric',
            'price' => 'required|numeric|min:0',
            'image_id' => 'required|exists:media,id', // Ensure the selected image exists in media table
            'status' => 'required|string|in:' . implode(',', [self::STATUS_AVAILABLE, self::STATUS_BOOKED, self::STATUS_MAINTENANCE]) // Ensure valid status
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
