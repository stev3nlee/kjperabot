<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          [
            "page_title"=>"About",
            "page_description"=>"
            <img src='http://localhost/kjp/public/images/background.jpg' class='img-responsive'> <br />
  					<p> Akzidenz-Grotesk is a sans-serif or grotesque tradition general-purpose, 'trade' sometimes been typeface sold opposed to in German unadorned of use type metal contemporary Gestalt Bauhaus narrow. Due to Neuzeit S blends Klavika but genre Goudy Sans their for often for headings nearly-exactly to be the folded-up for example. Are curved to on a for body for posters serif italics oblique, ligature double-loop swash tail Q of tilde? </p> <br />
  					<p> Typesetting the sorts ordered to a according be could works gained not prior the stored significant it for types physical glyphs and in systems systems digital on and orthography that authorship works of easily more era letterpress by hand sorts words then then lines. Flong papier mache stereotyping Paris plaster of or type of niche electrotype is a it however. Artisanal for a revival however is it printing fallen out use and of revival a as an hot typesetting 'set', or width. </p>"
          ],
          [
            "page_title"=>"Term and condition",
            "page_description"=>"
  					<p> Akzidenz-Grotesk is a sans-serif or grotesque tradition general-purpose, 'trade' sometimes been typeface sold opposed to in German unadorned of use type metal contemporary Gestalt Bauhaus narrow. Due to Neuzeit S blends Klavika but genre Goudy Sans their for often for headings nearly-exactly to be the folded-up for example. Are curved to on a for body for posters serif italics oblique, ligature double-loop swash tail Q of tilde? </p> <br />
  					<p> Typesetting the sorts ordered to a according be could works gained not prior the stored significant it for types physical glyphs and in systems systems digital on and orthography that authorship works of easily more era letterpress by hand sorts words then then lines. Flong papier mache stereotyping Paris plaster of or type of niche electrotype is a it however. Artisanal for a revival however is it printing fallen out use and of revival a as an hot typesetting 'set', or width. </p>"
          ],
          [
            "page_title"=>"Career",
            "page_description"=>"Jika anda bersedia untuk mengisi lowongan dengan sesuai standar kemampuan anda, kirim sebuah resume dan lamaran kerja lewat email."
          ],
          [
            "page_title"=>"Payment",
            "page_description"=>"Typesetting the sorts ordered to a according be could works gained not prior the stored significant it for types physical glyphs and in systems systems digital on and orthography that authorship works of easily more era."
          ],
        ];

        Page::insert($data);
    }
}
