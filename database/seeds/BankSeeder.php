<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input=[
          [
            "bank_name"=>"BCA",
            "image_path"=>"images/icons/bca.svg",
            "account_name"=>"Jane Doe",
            "account_no"=>"1234-1234-1234"
          ]
        ];

        Bank::insert($input);
    }
}
