<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function responsible()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    
    public function features(){
        return $this->belongsToMany(Feature::class, RoomFeature::class);
    }

    public function reservations(){
        return $this->belongsToMany(Reservation::class, ReservationDetail::class);
    }
}
