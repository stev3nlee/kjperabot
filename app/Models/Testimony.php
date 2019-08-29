<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
     protected $fillable = [
       "article_slug","article_title","testymony_content","written_by"
     ];
}
