<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $table = 'buildings';

    protected $fillable = [
        'name',
        'region_id',
        'district_id',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function employees()
    {
        return $this->hasMany(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

}
