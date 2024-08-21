<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'floor',
        'name',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
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
