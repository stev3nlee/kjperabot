<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $fillable = [
    "article_slug","image_path","article_title","article_content"
  ];
}
