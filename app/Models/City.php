<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use Notifiable;
  protected $fillable = [
      'province_id','city_name'
  ];
  public function provinces()
  {
    return $this->belongsTo('App\Models\province' ,'province_id','id');
  }

  public function scopeGetProvinceById($query,$id)
  {
    return $query->where("id",$id);
  }

  public function scopeGetCityByProvinceId($query,$id)
  {
    $query->join("provinces","provinces.id","cities.province_id")->orderby("province_name");
    $query->where("id",$id);
    $query->orderby("city_name","asc");
    $query->orderby("province_name","asc");
    return $query;
  }

  public function scopeGetCityAndProvince($query)
  {
    $query->select("cities.id","cities.city_name","provinces.province_name","cities.province_id");
    $query->leftjoin("provinces","provinces.id","cities.province_id");
    $query->orderby("province_name","asc");
    $query->orderby("city_name","asc");
    return $query;
  }
}
