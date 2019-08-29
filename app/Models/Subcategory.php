<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

  protected $fillable = [
    "category_id"
    ,"subcategory_slug"
    ,"subcategory_name"
  ];

  public function category()
  {
    return $this->belongsTo('App\Models\Category');
  }
}
