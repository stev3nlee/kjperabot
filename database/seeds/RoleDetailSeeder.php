<?php

use Illuminate\Database\Seeder;
use App\Models\role_detail;
class RoleDetailSeeder extends Seeder
{
    public function run()
    {

      $input=[
        ["role_detail_name"=>"Dashboard"]
        ,["role_detail_name"=>"Website > Slider"]
        ,["role_detail_name"=>"Website > Newsletter"]
        ,["role_detail_name"=>"Website > Pages"]
        ,["role_detail_name"=>"Website > Contact"]
        ,["role_detail_name"=>"Commerce > Order"]
        ,["role_detail_name"=>"Commerce > Member"]
        ,["role_detail_name"=>"Commerce > Store > Category"]
        ,["role_detail_name"=>"Commerce > Store > Brand"]
        ,["role_detail_name"=>"Commerce > Store > Vendor"]
        ,["role_detail_name"=>"Commerce > Store > Product"]
        ,["role_detail_name"=>"SCommerce > Payment"]
        ,["role_detail_name"=>"Commerce > Shipping"]
        ,["role_detail_name"=>"Commerce > Voucher"]
        ,["role_detail_name"=>"Commerce > Exchange"]
        ,["role_detail_name"=>"Commerce > Others"]
        ,["role_detail_name"=>"Setting > General"]
        ,["role_detail_name"=>"Setting > Social Media"]
        ,["role_detail_name"=>"Social Media"]
        ,["role_detail_name"=>"Setting > Tools"]
        ,["role_detail_name"=>"Setting > Log"]
        ,["role_detail_name"=>"Setting > Role > Group"]
        ,["role_detail_name"=>"Setting > Role > Account"]
        ,["role_detail_name"=>"Setting > Webmail"]
      ];
        role_detail::insert($input);
    }
}
