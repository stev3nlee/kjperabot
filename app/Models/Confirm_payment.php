<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confirm_payment extends Model
{
    protected $fillable =[
      'order_id','bank_account_no','bank_account_name','nominal','image_path'
    ];
}
