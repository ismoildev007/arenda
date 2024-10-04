<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'name',
        'address',
        'section_type',
        'construction',
        'size',
        'founded_date',
        'safety',
        'mode_of_operation',
        'set',
        'floor',
        'number_of_rooms',
        'lift',
        'parking',
        'images',
        'price_per_sqm',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'section_id');
    }


    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}
