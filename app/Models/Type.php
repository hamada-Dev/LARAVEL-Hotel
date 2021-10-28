<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    protected $appends = ['image_path',];

    public function getImagePathAttribute()
    {
        return $this->image != null ? asset('uploads/type_images/' . $this->image) :  asset('uploads/type_images/default.png');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
    
    public function branchs(){
        return $this->belongsToMany(Branch::class, Room::class);
    }
}
