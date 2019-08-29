<?php

use Illuminate\Database\Seeder;
use App\Models\Company_profile;
class CompanyProfile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $input=[
              "company_name"=>"KJ Perabot"
              ,"opening_hour"=>"10:00 - 19:00 (Weekdays & Saturdays)"
              ,"email"=>"info@kjperabot.co.id"
              ,"whatsapp"=>"08123456789"
              ,"support"=>"021 62345678"
              ,"address"=>"Jalan Rawa Buaya<br>Jalan Rawa Buaya"
              ,"google_map"=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7239874318907!2d106.90845401418827!3d-6.299953195440454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2aeacaa7c81%3A0xbabfd7bb536d38af!2sPT.+Karya+jaya!5e0!3m2!1sen!2sid!4v1504856166485"
              ,"facebook"=>"https://www.facebook.com/"
              ,"instagram"=>"https://www.instagram.com/"
              ,"meta_title"=>"Meta title"
              ,"meta_keyword"=>"Meta Keyword"
              ,"meta_description"=>"Meta description"
              ,"logo_path"=>"/images/logo.svg"
              ,"favicon_path"=>"/images/favicon.ico"
              ,"tax_vat"=>"0"];
      Company_profile::insert($input);
    }
}
