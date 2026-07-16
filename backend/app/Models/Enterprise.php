<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'city',
        'state',
        'total_value',
        'units_quantity',
        'unit_value',
        'status',
    ];

    protected $casts = [
        'total_value' => 'decimal:2',
        'unit_value' => 'decimal:2',
        'units_quantity' => 'integer',
    ];
}
