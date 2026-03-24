<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

  public function user()
{
    return $this->belongsTo(User::class);
}

// admins
public function admins()
{
    return $this->hasMany(User::class)
        ->where('is_agency_admin', true);
}

// trips
public function trips()
{
    return $this->hasMany(Trip::class);
}
}
