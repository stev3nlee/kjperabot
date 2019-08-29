<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use Notifiable;
    protected $fillable = [
        'city_id','district_name'
    ];

    public function city()
    {
      return $this->hasOne('App\Models\city','id','city_id');
    }
    public function scopeGetDistrictByCityId($query,$id)
    {
      return $query->where('city_id',$id)->orderby('district_name','asc');
    }

    public function scopeGetDistrictById($query,$id)
    {
      return $query->where("id",$id);
    }

    public function scopeWithJne($query)
    {
      $query->join('jne_lists','jne_lists.district_id','districts.id');
      return $query;
    }
}
