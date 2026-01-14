<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Car extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_PAUSED = 'paused';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'make',
        'model',
        'trim',
        'exterior_color',
        'price',
        'price_type',
        'year',
        'mileage',
        'transmission',
        'fuel_type',
        'condition',
        'description',
        'status',
        'expires_at',
        'is_paid',
        'paid_at',
        'payment_reference',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'paid_at'    => 'datetime',
        'is_paid'    => 'boolean',
        'price'      => 'decimal:2',
    ];

    /* -------------------------
     | Relationships
     |--------------------------*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order');
    }

    public function coverImage()
    {
        return $this->hasOne(CarImage::class)->where('is_cover', true);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class)->latest();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function latestSuccessfulPayment()
    {
        return $this->hasOne(Payment::class)
            ->where('status', 'successful')
            ->latestOfMany();
    }

    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }

    /* -------------------------
     | Scopes
     |--------------------------*/

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    public function scopePublic($query)
    {
        return $query
            ->active()
            ->notExpired()
            ->where('is_paid', true);
    }

    /* -------------------------
     | Helpers
     |--------------------------*/

    public static function statuses(): array
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_ACTIVE,
            self::STATUS_PAUSED,
        ];
    }
}
