<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          ["category_slug"=>"peralatan-&-perlengkapan-kebersihan","category_name"=>"Peralatan & Perlengkapan Kebersihan"],
          ["category_slug"=>"peralatan-&-perlengkapan-kebersihan2","category_name"=>"Peralatan & Perlengkapan Kebersihan"],
          ["category_slug"=>"peralatan-&-perlengkapan-kebersihan3","category_name"=>"Peralatan & Perlengkapan Kebersihan"],
          ["category_slug"=>"peralatan-&-perlengkapan-kebersihan4","category_name"=>"Peralatan & Perlengkapan Kebersihan"],
          ["category_slug"=>"peralatan-&-perlengkapan-kebersihan5","category_name"=>"Peralatan & Perlengkapan Kebersihan"],
          ["category_slug"=>"peralatan-&-perlengkapan-kebersihan6","category_name"=>"Peralatan & Perlengkapan Kebersihan"]
        ];

        Category::insert($data);
    }
}
