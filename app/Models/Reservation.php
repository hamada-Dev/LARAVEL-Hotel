<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function responsible()
    {
        return $this->belongsTo(User::class, 'added_by');
    }  
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }   
    
    public function reservationsDetails()
    {
        return $this->hasMany(ReservationDetail::class);
    }

    public function rooms(){
        return $this->belongsToMany(Room::class, ReservationDetail::class);
    }
}
