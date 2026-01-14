<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * The car that was viewed.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
