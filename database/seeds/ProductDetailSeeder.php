<?php

use Illuminate\Database\Seeder;
use App\Models\Product_detail;
class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $input=[
        ["product_id"=>"1","color"=>"Merah","stock"=>5]
        ,["product_id"=>"1","color"=>"Biru","stock"=>5]
        ,["product_id"=>"1","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"2","color"=>"Merah","stock"=>5]
        ,["product_id"=>"2","color"=>"Biru","stock"=>5]
        ,["product_id"=>"2","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"3","color"=>"Merah","stock"=>5]
        ,["product_id"=>"3","color"=>"Biru","stock"=>5]
        ,["product_id"=>"3","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"4","color"=>"Merah","stock"=>5]
        ,["product_id"=>"4","color"=>"Biru","stock"=>5]
        ,["product_id"=>"4","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"5","color"=>"Merah","stock"=>5]
        ,["product_id"=>"5","color"=>"Biru","stock"=>5]
        ,["product_id"=>"5","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"6","color"=>"Merah","stock"=>5]
        ,["product_id"=>"6","color"=>"Biru","stock"=>5]
        ,["product_id"=>"6","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"7","color"=>"Merah","stock"=>5]
        ,["product_id"=>"7","color"=>"Biru","stock"=>5]
        ,["product_id"=>"7","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"8","color"=>"Merah","stock"=>5]
        ,["product_id"=>"8","color"=>"Biru","stock"=>5]
        ,["product_id"=>"8","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"9","color"=>"Merah","stock"=>5]
        ,["product_id"=>"9","color"=>"Biru","stock"=>5]
        ,["product_id"=>"9","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"10","color"=>"Merah","stock"=>5]
        ,["product_id"=>"10","color"=>"Biru","stock"=>5]
        ,["product_id"=>"10","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"11","color"=>"Merah","stock"=>5]
        ,["product_id"=>"11","color"=>"Biru","stock"=>5]
        ,["product_id"=>"11","color"=>"Kuning","stock"=>5]

        ,["product_id"=>"12","color"=>"Merah","stock"=>5]
        ,["product_id"=>"12","color"=>"Biru","stock"=>5]
        ,["product_id"=>"12","color"=>"Kuning","stock"=>5]
      ];
        Product_detail::insert($input);
    }
}
