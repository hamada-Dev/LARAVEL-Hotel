<?php

namespace App\Models;

use App\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['name', 'description', 'address'];

    protected $guarded = [];

    protected $appends = ['image_path', ];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/branch_images/'.$this->image) :  asset('uploads/branch_images/default.png') ;
    } 

    public function responsible()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
    
    public function types(){
        return $this->belongsToMany(Type::class, Room::class);
    }
}
