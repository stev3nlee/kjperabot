<?php

use Illuminate\Database\Seeder;
use App\Models\role;
class RoleSeeder extends Seeder
{
    public function run()
    {
      $string="";
      for($x=1;$x<=24;$x++)
      { if($x!=1){ $string.="&&"; } $string.=1; }
      $input=["role_name"=>"Owner","role_access"=>$string];
      role::insert($input);
      $input=["role_name"=>"Admin","role_access"=>$string];
      role::insert($input);
      $input=["role_name"=>"Finance","role_access"=>$string];
      role::insert($input);
    }
}
