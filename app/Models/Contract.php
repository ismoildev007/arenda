<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;


    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'contract_number',
        'room_id',
        'client_id',
        'start_date',
        'end_date',
        'discount',
        'total_amount'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
