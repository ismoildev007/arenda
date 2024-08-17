<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    protected $fillable = [
        'number',
        'branch_id',
        'size',
        'price_per_sqm',
        'status',
        'type',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // Define relationships if needed, e.g., with contracts
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    // Scope to get only active rooms
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
