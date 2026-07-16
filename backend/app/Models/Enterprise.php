<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeByName(Builder $query, ?string $name): Builder
    {
        if (empty($name)) {
            return $query;
        }

        return $query->where('name', 'ilike', "%{$name}%");
    }

    public function scopeByStatus(Builder $query, ?string $status): Builder
    {
        if (empty($status)) {
            return $query;
        }

        return $query->where('status', $status);
    }
}
