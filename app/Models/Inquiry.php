<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'name',
        'phone',
        'email',
        'offer_price',
        'message',
    ];

    protected $casts = [
        'offer_price' => 'decimal:2',
    ];

    /**
     * The car this inquiry is for.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
