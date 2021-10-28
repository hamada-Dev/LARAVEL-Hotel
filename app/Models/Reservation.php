<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    protected $appends = ['image_path', ];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/reservation_images/'.$this->image) :  asset('uploads/reservation_images/default.png') ;
    } 

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
