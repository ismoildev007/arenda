<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'building_id',
        'last_name',
        'middle_name',
        'pinfl',
        'birth_day',
        'region_id',
        'district_id',
        'role',
        'password'
    ];


    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    protected $hidden = [
        'password',
    ];
}