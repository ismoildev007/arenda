<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'section_id',
        'number',
        'size',
        'room_of_number',
        'price_per_sqm',
        'images',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'floor_id');
    }

    protected $casts = [
        'images' => 'array',
    ];
}

