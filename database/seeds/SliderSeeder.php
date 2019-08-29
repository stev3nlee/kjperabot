<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;
class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
          ["image_path"=>"images/background.jpg","slider_caption"=>""],
          ["image_path"=>"images/background.jpg","slider_caption"=>""],
        ];

        Slider::insert($input);
    }
}
