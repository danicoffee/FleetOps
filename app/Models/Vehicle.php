<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['plate_number', 'make', 'model', 'year', 'color', 'type', 'fuel_type', 'status', 'odometer', 'maintenance_interval', 'assigned_driver'])]
class Vehicle extends Model
{
    use HasFactory;

    protected $casts = [
        'year' => 'integer',
        'odometer' => 'integer',
        'maintenance_interval' => 'integer',
    ];
}
