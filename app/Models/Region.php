<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $fillable = [
        'name',
    ];

    public function employees()
    {
        return $this->hasMany(User::class);
    }

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function districts(){
        return $this->hasMany(District::class);
    }
}
