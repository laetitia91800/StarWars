<?php

use App\Product;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tags')->insert(
            [
                ['name' => 'star'],
                ['name' => 'galaxy'],
                ['name' => 'saga'],
                ['name' => 'casque'],
                ['name' => 'laser'],
                ['name' => 'princess'],
            ]
        );

    }
}
