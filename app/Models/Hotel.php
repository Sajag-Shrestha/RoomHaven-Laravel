<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'rating', 
        'capacity', 
        'room_size', 
        'price'
    ];

    public static function validate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|between:1,5', // Ensure rating is between 1 and 5
            'capacity' => 'nullable|integer',
            'room_size' => 'nullable|numeric',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
