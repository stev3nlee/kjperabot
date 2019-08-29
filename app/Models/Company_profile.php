<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_profile extends Model
{
    protected $fillable = [
      "company_name","opening_hour","email"
      ,"whatsapp","support","google_map"
      ,"address","post_code","facebook"
      ,"instagram","meta_title","meta_keyword"
      ,"meta_description","logo_path","favicon_path"
      ,"metadata_google_webmaster_tool","metadata_google_analytic"
      ,"tax_vat","free_shipping"
    ];
}
