<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
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
        'inn',
        'email_verified_at',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
