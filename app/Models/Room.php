<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];
    protected $appends = ['feature_id_relation', 'image_path', 'avilable_room'];

    
    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/branch_images/'.$this->image) :  asset('uploads/branch_images/default.png') ;
    } 

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

    public function rexervationDetail(){
        return $this->hasMany(ReservationDetail::class);
    }

    public function getFeatureIdRelationAttribute() // this is to return id of feature
    {
        return $this->features->pluck('id')->toArray();
    }

    public function getAvilableRoomAttribute(){
        return $this->rexervationDetail()->sum('person_number');
    }
}
