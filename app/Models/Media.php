<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'media';

    // Specify the fillable fields
    protected $fillable = [
        'title',
        'img_link',
        'type',
    ];

    // Optionally, specify the hidden fields or casts if needed
}
