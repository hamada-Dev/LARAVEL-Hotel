<?php

namespace App;

use App\Models\Reservation;
use App\Models\ReservationDetail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;



class User extends Authenticatable implements JWTSubject
{
    use Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array   
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        
    protected $appends = ['image_path', ];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/user_images/'.$this->image) :  asset('uploads/user_images/default.png') ;
    } 
    public function reservations(){
        return $this->hasMany(Reservation::class,);
    } 
    
    public function scopeClient($query)
    {
        return $query->where('status', 1);
    }
    
    public function reservationsDetail(){
        return $this->hasMany(ReservationDetail::class, Reservation::class);
    }

    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
