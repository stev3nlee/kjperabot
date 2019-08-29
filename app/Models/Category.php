<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      "category_slug","category_name"
    ];

    public function subcategories()
    {
      return $this->hasMany('App\Models\Subcategory','category_id','id');
    }
}
