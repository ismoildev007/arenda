<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'region_id',
        'district_id',
    ];

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function district(){
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
    // Branch.php (Model)
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}
