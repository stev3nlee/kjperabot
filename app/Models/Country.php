<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  use Notifiable;
  protected $fillable = [
      'country_code','country_name'
  ];

  public function provinces()
  {
    return $this->hasMany('App\Models\province','country_id','id');
  }

  public function scopeGetCountryById($query,$id)
  {
    return $query->where("id",$id);
  }
}
