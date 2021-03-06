<?php

use App\Tag;
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
        $this->call(UserTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(ProductTableSeeders::class);
        $this->call(PictureTableSeeder::class);

    }





}
