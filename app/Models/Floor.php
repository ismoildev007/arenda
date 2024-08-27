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
        'room_of_number',
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
    protected $casts = [
        'images' => 'array',
    ];
}
