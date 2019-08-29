<?php

use Illuminate\Database\Seeder;
use App\Models\Testimony;
class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
          ["testimony_slug"=>"judul-testimoni","testimony_title"=>"Judul Testimoni","testimony_content"=>"Content Typography arranging written Trajan typeface point, size design closely craft part of do consider not do typefaces, typesetter compositors known also works graffiti and now.","written_by"=>"Jane Doe (Direktur IKEA)"]
          ,["testimony_slug"=>"judul-testimoni2","testimony_title"=>"Judul Testimoni","testimony_content"=>"Content Typography arranging written Trajan typeface point, size design closely craft part of do consider not do typefaces, typesetter compositors known also works graffiti and now.","written_by"=>"Jane Doe (Direktur IKEA)"]
          ,["testimony_slug"=>"judul-testimoni3","testimony_title"=>"Judul Testimoni","testimony_content"=>"Content Typography arranging written Trajan typeface point, size design closely craft part of do consider not do typefaces, typesetter compositors known also works graffiti and now.","written_by"=>"Jane Doe (Direktur IKEA)"]
          ,["testimony_slug"=>"judul-testimoni4","testimony_title"=>"Judul Testimoni","testimony_content"=>"Content Typography arranging written Trajan typeface point, size design closely craft part of do consider not do typefaces, typesetter compositors known also works graffiti and now.","written_by"=>"Jane Doe (Direktur IKEA)"]
        ];
        Testimony::insert($input);
    }
}
