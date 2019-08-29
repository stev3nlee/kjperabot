<?php

use Illuminate\Database\Seeder;
use App\Models\City;
class CitySeeder extends Seeder
{
    public function run()
    {
      $input=[
        ['city_name'=>'Kab. Padang Pariaman','province_id'=>1]
        ,['city_name'=>'Kab. Muara Enim','province_id'=>2]
        ,['city_name'=>'Kab. Karangasem','province_id'=>3]
        ,['city_name'=>'Kota Kendari','province_id'=>4]
        ,['city_name'=>'Kab. Jayawijaya','province_id'=>5]
        ,['city_name'=>'Kota Jayapura','province_id'=>5]
        ,['city_name'=>'Kab. Badung','province_id'=>3]
        ,['city_name'=>'Kab. Konawe','province_id'=>4]
        ,['city_name'=>'Kab. Sorong','province_id'=>6]
        ,['city_name'=>'Kab. Lampung Utara','province_id'=>7]
        ,['city_name'=>'Kab. Tanggamus','province_id'=>7]
        ,['city_name'=>'Kab. Tapanuli Utara','province_id'=>8]
        ,['city_name'=>'Kab. Kebumen','province_id'=>9]
        ,['city_name'=>'Kab. Cilacap','province_id'=>9]
        ,['city_name'=>'Kab. Tegal','province_id'=>9]
        ,['city_name'=>'Kab. Tapanuli Tengah','province_id'=>8]
        ,['city_name'=>'Kab. Flores Timur','province_id'=>10]
        ,['city_name'=>'Kab. Tapanuli Selatan','province_id'=>8]
        ,['city_name'=>'Kab. Asahan','province_id'=>8]
        ,['city_name'=>'Kab. Labuhan Batu','province_id'=>8]
        ,['city_name'=>'Kab. Nagekeo','province_id'=>10]
        ,['city_name'=>'Kab. Nias','province_id'=>8]
        ,['city_name'=>'Kab. Asmat','province_id'=>5]
        ,['city_name'=>'Kab. Mimika','province_id'=>5]
        ,['city_name'=>'Kab. Paniai','province_id'=>5]
        ,['city_name'=>'Kab. Cianjur','province_id'=>11]
        ,['city_name'=>'Kab. Sorong Selatan','province_id'=>6]
        ,['city_name'=>'Kab. Lombok Timur','province_id'=>12]
        ,['city_name'=>'Kab. Ngada','province_id'=>10]
        ,['city_name'=>'Kab. Landak','province_id'=>13]
        ,['city_name'=>'Kab. Bengkulu Utara','province_id'=>14]
        ,['city_name'=>'Kab. Buru','province_id'=>15]
        ,['city_name'=>'Kab. Bangka Selatan','province_id'=>16]
        ,['city_name'=>'Kab. Kerinci','province_id'=>17]
        ,['city_name'=>'Kab. Seluma','province_id'=>14]
        ,['city_name'=>'Kab. Batubara','province_id'=>8]
        ,['city_name'=>'Kab. Ogan Komering Ilir','province_id'=>2]
        ,['city_name'=>'Kab. Ketapang','province_id'=>13]
        ,['city_name'=>'Kab. Minahasa Utara','province_id'=>18]
        ,['city_name'=>'Kab. Bone','province_id'=>19]
        ,['city_name'=>'Kab. Banyumas','province_id'=>9]
        ,['city_name'=>'Kab. Toba Samosir','province_id'=>8]
        ,['city_name'=>'Kab. Jember','province_id'=>20]
        ,['city_name'=>'Kab. Lima Puluh Kota','province_id'=>1]
        ,['city_name'=>'Kab. Simeuleu','province_id'=>22]
        ,['city_name'=>'Kota Kupang','province_id'=>10]
        ,['city_name'=>'Kab. Barito Kuala','province_id'=>23]
        ,['city_name'=>'Kota Palembang','province_id'=>2]
        ,['city_name'=>'Kab. Sumbawa','province_id'=>12]
        ,['city_name'=>'Kab. Enrekang','province_id'=>19]
        ,['city_name'=>'Kab. Polewali Mandar','province_id'=>19]
        ,['city_name'=>'Kab. Sikka','province_id'=>10]
        ,['city_name'=>'Kab. Alor','province_id'=>10]
        ,['city_name'=>'Kab. Banjar','province_id'=>23]
        ,['city_name'=>'Kab. Kupang','province_id'=>10]
        ,['city_name'=>'Kab. Maluku Tengah','province_id'=>15]
        ,['city_name'=>'Kab. Timor Tengah Selatan','province_id'=>10]
        ,['city_name'=>'Kab. Nias Selatan','province_id'=>8]
        ,['city_name'=>'Kab. Sintang','province_id'=>13]
        ,['city_name'=>'Kab. Melawi','province_id'=>13]
        ,['city_name'=>'Kab. Bima','province_id'=>12]
        ,['city_name'=>'Kab. Semarang','province_id'=>9]
        ,['city_name'=>'Kab. Manokwari','province_id'=>6]
        ,['city_name'=>'Kota Ambon','province_id'=>15]
        ,['city_name'=>'Kab. Sumenep','province_id'=>20]
        ,['city_name'=>'Kab. Tojo Una-Una','province_id'=>24]
        ,['city_name'=>'Kab. Agam','province_id'=>1]
        ,['city_name'=>'Kab. Boyolali','province_id'=>9]
        ,['city_name'=>'Kab. Malang','province_id'=>20]
        ,['city_name'=>'Kab. Pemalang','province_id'=>9]
        ,['city_name'=>'Kota Mataram','province_id'=>12]
        ,['city_name'=>'Kab. Parigi Moutong','province_id'=>24]
        ,['city_name'=>'Kab. Hulu Sungai Utara','province_id'=>23]
        ,['city_name'=>'Kab. Minahasa Selatan','province_id'=>18]
        ,['city_name'=>'Kab. Lampung Tengah','province_id'=>7]
        ,['city_name'=>'Kota Bandung','province_id'=>11]
        ,['city_name'=>'Kab. Konawe Utara/ Selatan','province_id'=>4]
        ,['city_name'=>'Kab. Kutai Kartanegara','province_id'=>25]
        ,['city_name'=>'Kab. Gorontalo','province_id'=>26]
        ,['city_name'=>'Kab. Gorontalo Utara','province_id'=>26]
        ,['city_name'=>'Kab. Yahukimo','province_id'=>5]
        ,['city_name'=>'Kab. Yapen Waropen','province_id'=>5]
        ,['city_name'=>'Kab. Hulu Sungai Selatan','province_id'=>23]
        ,['city_name'=>'Kab. Luwu Timur','province_id'=>19]
        ,['city_name'=>'Kab. Pandeglang','province_id'=>27]
        ,['city_name'=>'Kab. Indramayu','province_id'=>11]
        ,['city_name'=>'Kab. Kotawaringin Timur','province_id'=>28]
        ,['city_name'=>'Kab. Serang','province_id'=>27]
        ,['city_name'=>'Kab. Mamasa','province_id'=>19]
        ,['city_name'=>'Kab. Teluk Bintuni','province_id'=>6]
        ,['city_name'=>'Kab. Majalengka','province_id'=>11]
        ,['city_name'=>'Kota Salatiga','province_id'=>9]
        ,['city_name'=>'Kab Situbondo','province_id'=>20]
        ,['city_name'=>'Kab. Bandung','province_id'=>11]
        ,['city_name'=>'Kab. Cirebon','province_id'=>11]
        ,['city_name'=>'Kab. Pacitan','province_id'=>20]
        ,['city_name'=>'Kab. Aceh Barat','province_id'=>22]
        ,['city_name'=>'Kab. Bangkalan','province_id'=>20]
        ,['city_name'=>'Kab. Solok','province_id'=>1]
        ,['city_name'=>'Kab. Keerom','province_id'=>5]
        ,['city_name'=>'Kab. Jeneponto','province_id'=>19]
        ,['city_name'=>'Kab. Kotawaringin Barat','province_id'=>28]
        ,['city_name'=>'Kota Bima','province_id'=>12]
        ,['city_name'=>'Kota Surabaya','province_id'=>20]
        ,['city_name'=>'Kab. Mappi','province_id'=>5]
        ,['city_name'=>'Kab. Lembata','province_id'=>10]
        ,['city_name'=>'Kab. Belu','province_id'=>10]
        ,['city_name'=>'Kab. Aceh Tengah','province_id'=>22]
        ,['city_name'=>'Kota Bukit Tinggi','province_id'=>1]
        ,['city_name'=>'Kab. Tana Toraja Utara','province_id'=>19]
        ,['city_name'=>'Kab. Barito Timur','province_id'=>23]
        ,['city_name'=>'Kab. Balangan','province_id'=>23]
        ,['city_name'=>'Kab. Rote Ndao','province_id'=>10]
        ,['city_name'=>'Kab. Ponorogo','province_id'=>20]
        ,['city_name'=>'Kab. Aceh Barat Daya','province_id'=>22]
        ,['city_name'=>'Kab. Bogor','province_id'=>11]
        ,['city_name'=>'Kab. Purwakarta','province_id'=>11]
        ,['city_name'=>'Kab. Langkat','province_id'=>8]
        ,['city_name'=>'Kab. Lamongan','province_id'=>20]
        ,['city_name'=>'Kab. Musi Banyuasin','province_id'=>2]
        ,['city_name'=>'Kab. Bekasi','province_id'=>11]
        ,['city_name'=>'Kab. Aceh Tenggara','province_id'=>22]
        ,['city_name'=>'Kab. Panajam Paser Utara','province_id'=>25]
        ,['city_name'=>'Kab. Halmahera Selatan','province_id'=>29]
        ,['city_name'=>'Kota Pare-Pare','province_id'=>19]
        ,['city_name'=>'Kab. Kapuas Hulu','province_id'=>13]
        ,['city_name'=>'Kab. Belitung','province_id'=>16]
        ,['city_name'=>'Kab. Kudus','province_id'=>9]
        ,['city_name'=>'Kab. Luwu Utara','province_id'=>19]
        ,['city_name'=>'Kab. Rokan Hilir','province_id'=>30]
        ,['city_name'=>'Kab. Purworejo','province_id'=>9]
        ,['city_name'=>'Kab. Nganjuk','province_id'=>20]
        ,['city_name'=>'Kab. Morowali','province_id'=>24]
        ,['city_name'=>'Kab. Way Kanan','province_id'=>7]
        ,['city_name'=>'Kota Banda Aceh','province_id'=>22]
        ,['city_name'=>'Kab. Aceh Besar','province_id'=>22]
        ,['city_name'=>'Kab. Goa','province_id'=>19]
        ,['city_name'=>'Kab. Batang Hari','province_id'=>17]
        ,['city_name'=>'Kab. Bangka','province_id'=>16]
        ,['city_name'=>'Kab. Tampin','province_id'=>23]
        ,['city_name'=>'Kab. Lampung Selatan','province_id'=>7]
        ,['city_name'=>'Kab. Sukoharjo','province_id'=>9]
        ,['city_name'=>'Kab. Aceh Selatan','province_id'=>22]
        ,['city_name'=>'Kab. Aceh Utara','province_id'=>22]
        ,['city_name'=>'Kab. Humbang Hasudutan','province_id'=>8]
        ,['city_name'=>'Kab. Blitar','province_id'=>20]
        ,['city_name'=>'Kab. Donggala','province_id'=>24]
        ,['city_name'=>'Kab. Sanggau','province_id'=>13]
        ,['city_name'=>'Kab. Sukamara','province_id'=>28]
        ,['city_name'=>'Kab. Banggai','province_id'=>24]
        ,['city_name'=>'Kab. Tangerang','province_id'=>27]
        ,['city_name'=>'Kab. Bojonegoro','province_id'=>9]
        ,['city_name'=>'Kab. Madiun','province_id'=>20]
        ,['city_name'=>'Kab. Lampung Barat','province_id'=>7]
        ,['city_name'=>'Kota Balikpapan','province_id'=>25]
        ,['city_name'=>'Kab. Pangkajene Kepulauan','province_id'=>19]
        ,['city_name'=>'Kab. Sidoarjo','province_id'=>20]
        ,['city_name'=>'Kab.Gresik','province_id'=>20]
        ,['city_name'=>'Kab. Garut','province_id'=>11]
        ,['city_name'=>'Kab. Barru','province_id'=>19]
        ,['city_name'=>'Kab. Mamuju Utara','province_id'=>19]
        ,['city_name'=>'Kab. Bantul','province_id'=>9]
        ,['city_name'=>'Kab. Pulang Pisau','province_id'=>28]
        ,['city_name'=>'Kab. Tuban','province_id'=>20]
        ,['city_name'=>'Kab. Aceh Timur','province_id'=>22]
        ,['city_name'=>'Kota Lhokseumawe','province_id'=>22]
        ,['city_name'=>'Kab. Bener Meriah','province_id'=>22]
        ,['city_name'=>'Kab. Simalungun','province_id'=>8]
        ,['city_name'=>'Kab. Batang','province_id'=>9]
        ,['city_name'=>'Kab. Pidie Jaya','province_id'=>22]
        ,['city_name'=>'Kab. Jombang','province_id'=>20]
        ,['city_name'=>'Kab. Serdang Bedagai','province_id'=>8]
        ,['city_name'=>'Kota Bandar Lampung','province_id'=>7]
        ,['city_name'=>'Kab. Bintan','province_id'=>31]
        ,['city_name'=>'Kab. Lampung Timur','province_id'=>7]
        ,['city_name'=>'Kab. Ogan Komering Ulu Selatan','province_id'=>2]
        ,['city_name'=>'Kab. Magelang','province_id'=>9]
        ,['city_name'=>'Kab. Tulungagung','province_id'=>20]
        ,['city_name'=>'Kab. Majene','province_id'=>19]
        ,['city_name'=>'Kab. Banggai Kepulauan','province_id'=>24]
        ,['city_name'=>'Kab. Pasuruan','province_id'=>20]
        ,['city_name'=>'Kab. Kampar','province_id'=>30]
        ,['city_name'=>'Kab. Merangin','province_id'=>17]
        ,['city_name'=>'Kab. Bangli','province_id'=>3]
        ,['city_name'=>'Kab. Banyuwangi','province_id'=>20]
        ,['city_name'=>'Kab. Mojokerto','province_id'=>20]
        ,['city_name'=>'Kab. Jepara','province_id'=>9]
        ,['city_name'=>'Kab. Deli Serdang','province_id'=>8]
        ,['city_name'=>'Kab. Rokan Hulu','province_id'=>30]
        ,['city_name'=>'Kota Banjar','province_id'=>11]
        ,['city_name'=>'Kab. Buleleng','province_id'=>3]
        ,['city_name'=>'Kab. Tulang Bawang','province_id'=>7]
        ,['city_name'=>'Kab. Klungkung','province_id'=>3]
        ,['city_name'=>'Kota Banjarbaru','province_id'=>23]
        ,['city_name'=>'Kab. Blora','province_id'=>9]
        ,['city_name'=>'Kab. Brebes','province_id'=>9]
        ,['city_name'=>'Kab. Banjarnegara','province_id'=>9]
        ,['city_name'=>'Kota Banjarmasin','province_id'=>23]
        ,['city_name'=>'Kab.Ciamis','province_id'=>11]
        ,['city_name'=>'Kab. Lebak','province_id'=>27]
        ,['city_name'=>'Kota Surakarta','province_id'=>9]
        ,['city_name'=>'Kab. Temanggung','province_id'=>9]
        ,['city_name'=>'Kab. Bantaeng','province_id'=>19]
        ,['city_name'=>'Kab. Bengkalis','province_id'=>30]
        ,['city_name'=>'Kota Bekasi','province_id'=>11]
        ,['city_name'=>'Kab. Probolinggo','province_id'=>20]
        ,['city_name'=>'Kab. Sukabumi','province_id'=>11]
        ,['city_name'=>'Kab. Tasikmalaya','province_id'=>11]
        ,['city_name'=>'Kab. Maros','province_id'=>19]
        ,['city_name'=>'Kab. Tabalong','province_id'=>23]
        ,['city_name'=>'Kab. Kediri','province_id'=>20]
        ,['city_name'=>'Kab. Banyuasin','province_id'=>2]
        ,['city_name'=>'Kab. Sampang','province_id'=>20]
        ,['city_name'=>'Kota Semarang','province_id'=>9]
        ,['city_name'=>'Kab. Karawang','province_id'=>11]
        ,['city_name'=>'Kab. Toli-Toli','province_id'=>24]
        ,['city_name'=>'Kab. Hulu Sungai Tengah','province_id'=>23]
        ,['city_name'=>'Kota Sawahlunto','province_id'=>1]
        ,['city_name'=>'Kab. Muna','province_id'=>4]
        ,['city_name'=>'Kab. Sindenreng Rappang','province_id'=>19]
        ,['city_name'=>'Kab. Magetan','province_id'=>20]
        ,['city_name'=>'Kab. Kutai Barat','province_id'=>25]
        ,['city_name'=>'Kota Sukabumi','province_id'=>11]
        ,['city_name'=>'Kab. Padang Lawas','province_id'=>8]
        ,['city_name'=>'Kab. Karo','province_id'=>8]
        ,['city_name'=>'Kab. Pesisir Selatan','province_id'=>1]
        ,['city_name'=>'Kab. Kapuas','province_id'=>28]
        ,['city_name'=>'Kab. Mandailing Natal','province_id'=>8]
        ,['city_name'=>'Kota Batam','province_id'=>31]
        ,['city_name'=>'Kab. Padang Pariaman','province_id'=>1]
        ,['city_name'=>'Kab. Sarolangun','province_id'=>17]
        ,['city_name'=>'Kab. Indragiri Hulu','province_id'=>30]
        ,['city_name'=>'Kab. Padang Lawas Utara','province_id'=>8]
        ,['city_name'=>'Kab. Indragiri Hilir','province_id'=>30]
        ,['city_name'=>'Kab. Pati','province_id'=>9]
        ,['city_name'=>'Kab. Buton & Buton Utara','province_id'=>4]
        ,['city_name'=>'Kab. Pidie','province_id'=>22]
        ,['city_name'=>'Kab. Bungo','province_id'=>17]
        ,['city_name'=>'Kab. Tanah Laut','province_id'=>23]
        ,['city_name'=>'Kab. Tanah Datar','province_id'=>1]
        ,['city_name'=>'Kab. Pegunungan Bintang','province_id'=>5]
        ,['city_name'=>'Kota Batu','province_id'=>20]
        ,['city_name'=>'Kab. Kubu Raya','province_id'=>13]
        ,['city_name'=>'Kab. Kutai Timur','province_id'=>25]
        ,['city_name'=>'Kab. Paser','province_id'=>25]
        ,['city_name'=>'Kab. Lombok Barat','province_id'=>12]
        ,['city_name'=>'Kab. Tanah Bambu','province_id'=>23]
        ,['city_name'=>'Kab. Pamekasan','province_id'=>20]
        ,['city_name'=>'Kab. Kolaka Utara','province_id'=>4]
        ,['city_name'=>'Kota Tangerang','province_id'=>27]
        ,['city_name'=>'Kab. Bandung Barat','province_id'=>11]
        ,['city_name'=>'Kab. Lombok Tengah','province_id'=>12]
        ,['city_name'=>'Kab. Pinrang','province_id'=>19]
        ,['city_name'=>'Kab. Ogan Komering Ulu','province_id'=>2]
        ,['city_name'=>'Kab. Wonogiri','province_id'=>9]
        ,['city_name'=>'Kab. Tabanan','province_id'=>3]
        ,['city_name'=>'Kab. Kota Bau-Bau','province_id'=>4]
        ,['city_name'=>'Kab. Kolaka','province_id'=>4]
        ,['city_name'=>'Kab. Klaten','province_id'=>9]
        ,['city_name'=>'Kota Depok','province_id'=>11]
        ,['city_name'=>'Kab. Minahasa Tenggara','province_id'=>18]
        ,['city_name'=>'Kab. Wajo','province_id'=>19]
        ,['city_name'=>'Kab. Ogan Komering Ulu Timur','province_id'=>2]
        ,['city_name'=>'Kab. Sekadau','province_id'=>13]
        ,['city_name'=>'Kab. Kuantan Sengingi','province_id'=>30]
        ,['city_name'=>'Kab. Aceh Tamiang','province_id'=>22]
        ,['city_name'=>'Kab. Trenggalek','province_id'=>20]
        ,['city_name'=>'Kab. Bengkayang','province_id'=>13]
        ,['city_name'=>'Kota Bengkulu','province_id'=>11]
        ,['city_name'=>'Kab. Selayar','province_id'=>19]
        ,['city_name'=>'Kab. Mamberamo Raya','province_id'=>5]
        ,['city_name'=>'Kab. Kepulauan Talaud','province_id'=>18]
        ,['city_name'=>'Kab. Puncak Jaya','province_id'=>5]
        ,['city_name'=>'Kab. Dairi','province_id'=>8]
        ,['city_name'=>'Kab. Sleman','province_id'=>9]
        ,['city_name'=>'Kab. Kepahiang','province_id'=>14]
        ,['city_name'=>'Kab. Rejang Lebong','province_id'=>14]
        ,['city_name'=>'Kab. Tanjung Jabung Barat','province_id'=>17]
        ,['city_name'=>'Kab. Nagan Raya','province_id'=>22]
        ,['city_name'=>'Kab. Biak Numfor','province_id'=>5]
        ,['city_name'=>'Kab. Kepulauan Sangihe','province_id'=>18]
        ,['city_name'=>'Kab. Buol','province_id'=>24]
        ,['city_name'=>'Kab. Timor Tengah Utara','province_id'=>10]
        ,['city_name'=>'Kab. Berau','province_id'=>25]
        ,['city_name'=>'Kab. Bondowoso','province_id'=>20]
        ,['city_name'=>'Kota Binjai','province_id'=>8]
        ,['city_name'=>'Kab. Subang','province_id'=>11]
        ,['city_name'=>'Kab. Wakatobi','province_id'=>4]
        ,['city_name'=>'Kab. Bolaang Mongondow','province_id'=>18]
        ,['city_name'=>'Kab. Bolaang Mongondow Utara','province_id'=>18]
        ,['city_name'=>'Kab. Bireuen','province_id'=>22]
        ,['city_name'=>'Kota Makassar','province_id'=>19]
        ,['city_name'=>'Kab. Tana Toraja','province_id'=>19]
        ,['city_name'=>'Kota Bitung','province_id'=>18]
        ,['city_name'=>'Kab. Musi Rawas','province_id'=>2]
        ,['city_name'=>'Kab. Gianyar','province_id'=>3]
        ,['city_name'=>'Kab. Gayo Lues','province_id'=>22]
        ,['city_name'=>'Kota Malang','province_id'=>20]
        ,['city_name'=>'Kab. Purbalingga','province_id'=>9]
        ,['city_name'=>'Kota Bogor','province_id'=>11]
        ,['city_name'=>'Kab. Kendal','province_id'=>9]
        ,['city_name'=>'Kab. Pekalongan','province_id'=>9]
        ,['city_name'=>'Kab. Talikora','province_id'=>5]
        ,['city_name'=>'Kab. Demak','province_id'=>9]
        ,['city_name'=>'Kota Bone Bolango','province_id'=>26]
        ,['city_name'=>'Kab. Mamuju','province_id'=>19]
        ,['city_name'=>'Kab. Sarmi','province_id'=>5]
        ,['city_name'=>'Kab. Pasaman','province_id'=>1]
        ,['city_name'=>'Kota Bontang','province_id'=>25]
        ,['city_name'=>'Kab. Bulukumba','province_id'=>19]
        ,['city_name'=>'Kab. Manggarai Timur','province_id'=>10]
        ,['city_name'=>'Kab. Waropen','province_id'=>5]
        ,['city_name'=>'Kab. Boalemo','province_id'=>26]
        ,['city_name'=>'Kab. Sumbawa Barat','province_id'=>12]
        ,['city_name'=>'Kab. Grobogan','province_id'=>9]
        ,['city_name'=>'Kab. Ngawi','province_id'=>20]
        ,['city_name'=>'Kab. Sumedang','province_id'=>11]
        ,['city_name'=>'Kota Pasuruan','province_id'=>20]
        ,['city_name'=>'Kota Palangkaraya','province_id'=>28]
        ,['city_name'=>'Kota Tanjung Pinang','province_id'=>31]
        ,['city_name'=>'Kota Pangkal Pinang','province_id'=>16]
        ,['city_name'=>'Kota Dumai','province_id'=>30]
        ,['city_name'=>'Kota Pekanbaru','province_id'=>30]
        ,['city_name'=>'Kab. Seram Bagian Timur','province_id'=>15]
        ,['city_name'=>'Kab. Lamandau','province_id'=>28]
        ,['city_name'=>'Kab. Rembang','province_id'=>9]
        ,['city_name'=>'Kab. Sinjai','province_id'=>19]
        ,['city_name'=>'Kota Manado','province_id'=>18]
        ,['city_name'=>'Kab. Siak','province_id'=>30]
        ,['city_name'=>'Kab. Natuna','province_id'=>31]
        ,['city_name'=>'Kota Padang','province_id'=>1]
        ,['city_name'=>'Kab. Barito Selatan','province_id'=>23]
        ,['city_name'=>'Kab. Palalawan','province_id'=>30]
        ,['city_name'=>'Kab. Karimun','province_id'=>31]
        ,['city_name'=>'Kab. Kaimana','province_id'=>6]
        ,['city_name'=>'Kota Administrasi Jakarta Timur','province_id'=>32]
        ,['city_name'=>'Kota Prabumulih','province_id'=>2]
        ,['city_name'=>'Kab. Lumajang','province_id'=>20]
        ,['city_name'=>'Kota Administrasi Jakarta Pusat','province_id'=>32]
        ,['city_name'=>'Kota Administrasi Jakarta Barat','province_id'=>32]
        ,['city_name'=>'Kab. Kuningan','province_id'=>11]
        ,['city_name'=>'Kab. Manggarai','province_id'=>10]
        ,['city_name'=>'Kota Cilegon','province_id'=>27]
        ,['city_name'=>'Kota Tasikmalaya','province_id'=>11]
        ,['city_name'=>'Kota Administrasi Jakarta Selatan','province_id'=>32]
        ,['city_name'=>'Kota Administrasi Jakarta Utara','province_id'=>32]
        ,['city_name'=>'Kota Cimahi','province_id'=>11]
        ,['city_name'=>'Kota Serang','province_id'=>27]
        ,['city_name'=>'Kota Cirebon','province_id'=>11]
        ,['city_name'=>'Kab. Karang Anyar','province_id'=>9]
        ,['city_name'=>'Kab. Lingga','province_id'=>31]
        ,['city_name'=>'Kab. Maluku Tenggara Barat','province_id'=>15]
        ,['city_name'=>'Kab. Aceh Singkil','province_id'=>22]
        ,['city_name'=>'Kab. Seruyan','province_id'=>28]
        ,['city_name'=>'Kota Jambi','province_id'=>17]
        ,['city_name'=>'Kota Yogyakarta','province_id'=>9]
        ,['city_name'=>'Kota Tanjung Balai','province_id'=>8]
        ,['city_name'=>'Kota Pagar Alam','province_id'=>2]
        ,['city_name'=>'Kab. Jayapura','province_id'=>5]
        ,['city_name'=>'Kab. Tanjung Jabung Timur','province_id'=>17]
        ,['city_name'=>'Kab. Belitung Timur','province_id'=>16]
        ,['city_name'=>'Kota Denpasar','province_id'=>3]
        ,['city_name'=>'Kab. Ende','province_id'=>10]
        ,['city_name'=>'Kab. Boven Digoel','province_id'=>5]
        ,['city_name'=>'Kab. Merauke','province_id'=>5]
        ,['city_name'=>'Kab. Kepulauan Aru','province_id'=>15]
        ,['city_name'=>'Kab. Dompu','province_id'=>12]
        ,['city_name'=>'Kab. Soppeng','province_id'=>19]
        ,['city_name'=>'Kota Gorontalo','province_id'=>26]
        ,['city_name'=>'Kab. Minahasa','province_id'=>18]
        ,['city_name'=>'Kab. Fak-Fak','province_id'=>6]
        ,['city_name'=>'Kab. Halmahera Utara','province_id'=>29]
        ,['city_name'=>'Kab. Takalar','province_id'=>19]
        ,['city_name'=>'Kab. Sambas','province_id'=>13]
        ,['city_name'=>'Kab. Kulon Progo','province_id'=>9]
        ,['city_name'=>'Kab. Wonosobo','province_id'=>9]
        ,['city_name'=>'Kab. Halmahera Tengah','province_id'=>29]
        ,['city_name'=>'Kab. Gunung Kidul','province_id'=>9]
        ,['city_name'=>'Kab. Pesawaran','province_id'=>7]
        ,['city_name'=>'Kab. Sragen','province_id'=>9]
        ,['city_name'=>'Kab. Barito Utara','province_id'=>23]
        ,['city_name'=>'Kab. Pasaman Barat','province_id'=>1]
        ,['city_name'=>'Kab. Sumba Timur','province_id'=>10]
        ,['city_name'=>'Kab. Kota Baru','province_id'=>23]
        ,['city_name'=>'Kab. Samosir','province_id'=>8]
        ,['city_name'=>'Kab. Halmahera Barat','province_id'=>29]
        ,['city_name'=>'Kab. Ogan Ilir','province_id'=>2]
        ,['city_name'=>'Kab. Sijunjung','province_id'=>1]
        ,['city_name'=>'DKI Jakarta','province_id'=>32]
        ,['city_name'=>'Kab. Muaro Jambi','province_id'=>17]
        ,['city_name'=>'Kab. Lahat','province_id'=>2]
        ,['city_name'=>'Kab. Aceh Jaya','province_id'=>22]
        ,['city_name'=>'Kab. Bangka Barat','province_id'=>16]
        ,['city_name'=>'Kab. Bombana','province_id'=>4]
        ,['city_name'=>'Kota Probolinggo','province_id'=>20]
        ,['city_name'=>'Kab. Gunung Mas','province_id'=>28]
        ,['city_name'=>'Kab. Seram Bagian Barat','province_id'=>15]
        ,['city_name'=>'Kab. Katingan','province_id'=>28]
        ,['city_name'=>'Kab. Dogiyai','province_id'=>5]
        ,['city_name'=>'Kota Madiun','province_id'=>20]
        ,['city_name'=>'Kab. Sumba Tengah','province_id'=>10]
        ,['city_name'=>'Kab. Kaur','province_id'=>14]
        ,['city_name'=>'Kab. Malinau','province_id'=>25]
        ,['city_name'=>'Kota Kediri','province_id'=>20]
        ,['city_name'=>'Kab. Bengkulu Selatan','province_id'=>14]
        ,['city_name'=>'Kab. Maluku Tenggara','province_id'=>15]
        ,['city_name'=>'Kota Blitar','province_id'=>20]
        ,['city_name'=>'Kab. Raja Ampat','province_id'=>6]
        ,['city_name'=>'Kota Administrasi Kepulauan Seribu','province_id'=>32]
        ,['city_name'=>'Kab. Pakpak Barat','province_id'=>8]
        ,['city_name'=>'Kab. Bangka Tengah','province_id'=>16]
        ,['city_name'=>'Kab. Sumba Barat Daya','province_id'=>10]
        ,['city_name'=>'Kab. Manggarai Barat','province_id'=>10]
        ,['city_name'=>'Kab. Dharmasraya','province_id'=>1]
        ,['city_name'=>'Kab. Solok Selatan','province_id'=>1]
        ,['city_name'=>'Kab. Nunukan','province_id'=>25]
        ,['city_name'=>'Kab. Pontianak','province_id'=>13]
        ,['city_name'=>'Kab. Poso','province_id'=>24]
        ,['city_name'=>'Kota Langsa','province_id'=>22]
        ,['city_name'=>'Kab. Sumba Barat','province_id'=>10]
        ,['city_name'=>'Kab. Murung Raya','province_id'=>23]
        ,['city_name'=>'Kab. Lebong','province_id'=>14]
        ,['city_name'=>'Kab. Pahuwalo','province_id'=>26]
        ,['city_name'=>'Kab. Empat Lawang','province_id'=>2]
        ,['city_name'=>'Kota Subulussalam','province_id'=>22]
        ,['city_name'=>'Kota Lubuk Linggau','province_id'=>2]
        ,['city_name'=>'Kab. Muko-Muko','province_id'=>14]
        ,['city_name'=>'Kota Solok','province_id'=>1]
        ,['city_name'=>'Kab. Halmahera Timur','province_id'=>29]
        ,['city_name'=>'Kota Magelang','province_id'=>9]
        ,['city_name'=>'Kota Mojokerto','province_id'=>20]
        ,['city_name'=>'Kab. Nabire','province_id'=>5]
        ,['city_name'=>'Kab. Kepulauan Sula','province_id'=>29]
        ,['city_name'=>'Kota Tegal','province_id'=>9]
        ,['city_name'=>'Kota Medan','province_id'=>8]
        ,['city_name'=>'Kab. Jembrana','province_id'=>3]
        ,['city_name'=>'Kab. Meranti','province_id'=>30]
        ,['city_name'=>'Kota Metro','province_id'=>7]
        ,['city_name'=>'Kota Ternate','province_id'=>29]
        ,['city_name'=>'Kab. Tebo','province_id'=>17]
        ,['city_name'=>'Kota Tidore','province_id'=>29]
        ,['city_name'=>'Kab. Tebing Tinggi','province_id'=>8]
        ,['city_name'=>'Kota Padang Panjang','province_id'=>1]
        ,['city_name'=>'Kota Padang Sidempuan','province_id'=>8]
        ,['city_name'=>'Kab. Kepulauan Mentawai','province_id'=>1]
        ,['city_name'=>'Kota Samarinda','province_id'=>25]
        ,['city_name'=>'Kota Palopo','province_id'=>19]
        ,['city_name'=>'Kota Palu','province_id'=>24]
        ,['city_name'=>'Kota Pariaman','province_id'=>1]
        ,['city_name'=>'Kota Payakumbuh','province_id'=>1]
        ,['city_name'=>'Kota Pekalongan','province_id'=>9]
        ,['city_name'=>'Kota Pematangsiantar','province_id'=>8]
        ,['city_name'=>'Kab. Bulungan','province_id'=>25]
        ,['city_name'=>'Kota Pontianak','province_id'=>13]
        ,['city_name'=>'Kab. Kayong Utara','province_id'=>13]
        ,['city_name'=>'Kab. Teluk Wondama','province_id'=>6]
        ,['city_name'=>'Kota Sabang','province_id'=>22]
        ,['city_name'=>'Kab. Tana Tidung','province_id'=>25]
        ,['city_name'=>'Kota Sibolga','province_id'=>8]
        ,['city_name'=>'Kota Singkawang','province_id'=>13]
        ,['city_name'=>'Kab. Supiori','province_id'=>5]
        ,['city_name'=>'Kota Sorong','province_id'=>6]
        ,['city_name'=>'Kota Tarakan','province_id'=>25]
        ,['city_name'=>'Kota Tebing Tinggi','province_id'=>8]
        ,['city_name'=>'Kab. Deiyai','province_id'=>5]
        ,['city_name'=>'Kota Tomohon','province_id'=>18]
      ];
        city::insert($input);
    }
}
