<?php

use Illuminate\Database\Seeder;
use App\Models\province;
class ProvinceSeeder extends Seeder
{
    public function run()
    {
      $input=[
        ['province_name'=>'Sumatera Barat']
        ,['province_name'=>'Sumatera Selatan']
        ,['province_name'=>'Bali']
        ,['province_name'=>'Sulawesi Tenggara']
        ,['province_name'=>'Papua']
        ,['province_name'=>'Papua Barat']
        ,['province_name'=>'Lampung']
        ,['province_name'=>'Sumatera Utara']
        ,['province_name'=>'Jawa Tengah']
        ,['province_name'=>'NTT']
        ,['province_name'=>'Jawa Barat']
        ,['province_name'=>'NTB']
        ,['province_name'=>'Kalimantan Barat']
        ,['province_name'=>'Bengkulu']
        ,['province_name'=>'Maluku']
        ,['province_name'=>'Bangka Belitung']
        ,['province_name'=>'Jambi']
        ,['province_name'=>'Sulawesi Utara']
        ,['province_name'=>'Sulawesi Selatan']
        ,['province_name'=>'Jawa Timur']
        ,['province_name'=>'Sumatera Barat']
        ,['province_name'=>'NAD']
        ,['province_name'=>'Kalimantan Selatan']
        ,['province_name'=>'Sulawesi Tengah']
        ,['province_name'=>'Kalimantan Timur']
        ,['province_name'=>'Gorontalo']
        ,['province_name'=>'Banten']
        ,['province_name'=>'Kalimantan Tengah']
        ,['province_name'=>'Maluku Utara']
        ,['province_name'=>'Riau']
        ,['province_name'=>'Kepulauan Riau']
        ,['province_name'=>'DKI Jakarta']
      ];
        province::insert($input);
    }
}
