<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripService extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'service_name',
        'type'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
