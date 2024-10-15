<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    use HasFactory;


    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'building_id',
        'section_id',
        'floor_id',
        'room_id',
        'client_id',
        'contract_number',
        'start_date',
        'end_date',
        'discount',
        'status',
        'payment_status',
        'total_amount'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
