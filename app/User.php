<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "email"
        ,"password"
        ,"first_name"
        ,"last_name"
        ,"phone"
        ,"country_id"
        ,"province_id"
        ,"city_id"
        ,"post_code"
        ,"address"
        ,"is_newsletter"
        ,'is_on_reset_password'
        ,'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country()
    {
      return $this->hasOne('App\Models\Country','id','country_id');
    }
    public function province()
    {
      return $this->hasOne('App\Models\Province','id','province_id');
    }
    public function city()
    {
      return $this->hasOne('App\Models\City','id','city_id');
    }
    public function district()
    {
      return $this->hasOne('App\Models\District','id','district_id');
    }
}
