<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
  protected $fillable = [
    "job_name","requirement","responsibility","is_publish"
  ];
}
