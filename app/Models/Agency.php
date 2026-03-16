<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agency_name',
        'logo',
        'description',
        'website'
    ];

    // Agency belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Agency has many trips
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
