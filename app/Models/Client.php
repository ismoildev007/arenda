<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'district_id',
        'last_name',
        'middle_name',
        'first_name',
        'password',
        'pinfl',
        'birth_day',
        'company_name',
        'oked',
        'bank',
        'account',
        'phone_number',
        'inn',
        'email_verified_at',
    ];

    public function  contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
