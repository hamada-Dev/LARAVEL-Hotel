<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $guarded = [];

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    } 
    
    public function room(){
        return $this->belongsTo(Room::class);
    }

}
