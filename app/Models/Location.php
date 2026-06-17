<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

protected $fillable = ['shift_id', 'user_id', 'latitude', 'longitude', 'recorded_at'];

protected $casts = [
    'recorded_at' => 'datetime',
];


}
