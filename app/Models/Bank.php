<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
      "bank_name","image_path","account_name","account_no"
    ];
}
