<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TripLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle',
        'driver',
        'destination',
        'purpose',
        'departure',
        'return',
        'odometer_start',
        'odometer_end',
        'distance',
    ];

    protected $casts = [
        'departure' => 'datetime',
        'return' => 'datetime',
    ];
}