<?php

namespace App\Models;

use App\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['name', 'description',];

    protected $guarded = [];

    protected $appends = ['image_path', ];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/feature_images/'.$this->image) :  asset('uploads/feature_images/default.png') ;
    } 

    public function responsible()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

        
    public function rooms(){
        return $this->belongsToMany(Room::class, RoomFeature::class);
    }
}
