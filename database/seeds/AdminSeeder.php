<?php

use Illuminate\Database\Seeder;
use App\Administrator;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Administrator::create([
        'email' => 'developer@dilenium.com',
        'password' => bcrypt('kjperabot'),
        'name' => 'developer',
        'role_id' => 1,
        'is_active' =>true,
      ]);
    }
}
