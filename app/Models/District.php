<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id',
    ];

    public function branches(){
        return $this->hasMany(Building::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
