<?php

use App\Picture;
use App\Product;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\Storage;


class PictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        $files = Storage::allFiles();
        foreach ($files as $file) {
            Storage::delete($file);//sert a vider le dossier upload si on relance un refresh
            //pour éviter de stocker 15 images + 15 images ect...
        }

        $products = Product::all(); //recupere tous les produits precedement creer dans un tableau

        foreach ($products as $product) {

            $uri = str_random(12) . '_370x235.jpg';//str_random fait un chaine de caractere de 12
            Storage::put(
                $uri,
                file_get_contents('http://lorempixel.com/futurama/370/235/')
            );

            Picture::create([
                'product_id' => $product->id,//recupere id du tableau
                'uri' => $uri,
                'title' => $this->faker->name,

            ]);
        }
    }
}