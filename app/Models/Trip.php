<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'destination',
        'price',
        'duration',
        'max_travelers',
        'rating',
        'trip_category_id',
        'agency_id',
        'status',
        'featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'featured' => 'boolean',
    ];

    // Trip belongs to agency
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    // Trip belongs to category
    public function category()
    {
        return $this->belongsTo(TripCategory::class,'trip_category_id');
    }

    // Trip has many images
    public function images()
    {
        return $this->hasMany(TripImage::class);
    }

    // Trip has many services
    public function services()
    {
        return $this->hasMany(TripService::class);
    }
}
