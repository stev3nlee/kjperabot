<?php

use Illuminate\Database\Seeder;
use App\Models\Contact_topics;
class ContactTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
          ["topic"=>"Umum"],
          ["topic"=>"Tukar Produk"],
          ["topic"=>"Request Produk"],
          ["topic"=>"Karir"],
          ["topic"=>"Lain - Lain"],
        ];

        Contact_topics::insert($input);
    }
}
