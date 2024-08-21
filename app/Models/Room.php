<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    protected $fillable = [
        'number',
        'building_id',
        'section_id',
        'floor_id',
        'size',
        'price_per_sqm',
        'status',
        'type',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
