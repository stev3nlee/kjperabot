<?php

use Illuminate\Database\Seeder;
use App\Models\Career;
class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
          [
            "job_name"=>"Director",
            "requirement"=>"Lorem Ipsum Dolor Sit Amet",
            "responsibility"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li></ul>",
            "is_publish"=>true
          ],
          [
            "job_name"=>"Senior Manager",
            "requirement"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li></ul>",
            "responsibility"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li>",
            "is_publish"=>true
          ],
          [
            "job_name"=>"Senior IT",
            "requirement"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li></ul>",
            "responsibility"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li>",
            "is_publish"=>true
          ],
          [
            "job_name"=>"Admin",
            "requirement"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li></ul>",
            "responsibility"=>"<ul><li> Make X for Y necessities </li><li> Manage underlings </li><li> Makes plans and activities for A, B, C </li><li> Reporting progress on X, Y, and Z </li><li> Et cetera	</li>",
            "is_publish"=>true
          ],
        ];

        Career::insert($input);
    }
}
