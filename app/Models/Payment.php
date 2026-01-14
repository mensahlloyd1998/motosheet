<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'amount',
        'currency',
        'payment_reference',
        'payment_method',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * The user who made the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The car the payment is for.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
