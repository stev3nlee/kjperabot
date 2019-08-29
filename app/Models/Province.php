<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  use Notifiable;
  protected $fillable = [
      'province_name'
  ];

  public function cities()
  {
    return $this->hasMany('App\Models\city','province_id','id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\user','province_id','id');
  }

  public function scopeGetProvinceById($query,$id)
  {
    return $query->where("id",$id);
  }

  public function scopeGetProvinceByCountryId($query,$id)
  {
    return $query->where("id",$id)->orderby("province_name");
  }
}
