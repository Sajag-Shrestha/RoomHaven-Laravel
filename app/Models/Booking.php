<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id', 'user_id', 'check_in_date', 'check_out_date', 'guests_count', 'total_price', 'status'
    ];


    #statuses
    const PENDING = 'pending';
    const CONFIRMED = 'confirmed';
    const CANCELLED = 'cancelled';

    const STATUSES = [
        self::PENDING => self::PENDING,
        self::CONFIRMED => self::CONFIRMED,
        self::CANCELLED => self::CANCELLED,
    ];

    // Define relationships
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
