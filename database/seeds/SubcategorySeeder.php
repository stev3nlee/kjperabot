<?php

use Illuminate\Database\Seeder;
use App\Models\Subcategory;
class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          ["category_id"=>1,"subcategory_slug"=>"sapu-ember","subcategory_name"=>"Sapu ember"],
          ["category_id"=>1,"subcategory_slug"=>"sapu-ember1","subcategory_name"=>"Sapu ember"],
          ["category_id"=>1,"subcategory_slug"=>"sapu-ember2","subcategory_name"=>"Sapu ember"],
          ["category_id"=>2,"subcategory_slug"=>"sapu-ember3","subcategory_name"=>"Sapu ember"],
          ["category_id"=>2,"subcategory_slug"=>"sapu-ember4","subcategory_name"=>"Sapu ember"],
          ["category_id"=>2,"subcategory_slug"=>"sapu-ember5","subcategory_name"=>"Sapu ember"],
          ["category_id"=>3,"subcategory_slug"=>"sapu-ember6","subcategory_name"=>"Sapu ember"],
          ["category_id"=>3,"subcategory_slug"=>"sapu-ember7","subcategory_name"=>"Sapu ember"],
          ["category_id"=>3,"subcategory_slug"=>"sapu-ember8","subcategory_name"=>"Sapu ember"],
          ["category_id"=>4,"subcategory_slug"=>"sapu-ember9","subcategory_name"=>"Sapu ember"],
          ["category_id"=>4,"subcategory_slug"=>"sapu-ember10","subcategory_name"=>"Sapu ember"],
          ["category_id"=>4,"subcategory_slug"=>"sapu-ember11","subcategory_name"=>"Sapu ember"],
          ["category_id"=>5,"subcategory_slug"=>"sapu-ember12","subcategory_name"=>"Sapu ember"],
          ["category_id"=>5,"subcategory_slug"=>"sapu-ember13","subcategory_name"=>"Sapu ember"],
          ["category_id"=>5,"subcategory_slug"=>"sapu-ember14","subcategory_name"=>"Sapu ember"],
          ["category_id"=>6,"subcategory_slug"=>"sapu-ember15","subcategory_name"=>"Sapu ember"],
          ["category_id"=>6,"subcategory_slug"=>"sapu-ember16","subcategory_name"=>"Sapu ember"],
          ["category_id"=>6,"subcategory_slug"=>"sapu-ember17","subcategory_name"=>"Sapu ember"],
        ];

        Subcategory::insert($data);
    }
}
