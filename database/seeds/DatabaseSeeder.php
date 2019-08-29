<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CompanyProfile::class);
        $this->call(CountrySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(JneListSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductDetailSeeder::class);
        $this->call(RoleDetailSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(SubcategorySeeder::class);
        $this->call(TestimonySeeder::class);
    }
}
