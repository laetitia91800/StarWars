<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'title' =>'Lasers',
                    'slug' => str_slug('Lasers'),
                    'description'  => 'Laser Attention les yeux !!!'
                ],
                [
                    'title' =>'Casques',
                    'slug' => str_slug('Casques'),
                    'description'  => 'Casque Houra !! une super portection !'
                ],
            ]);
    }
}
