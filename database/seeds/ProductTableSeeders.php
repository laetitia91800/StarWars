<?php
use App\Tag;
use Illuminate\Database\Seeder;

class ProductTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cree 15 exemples

        $shuffle = function($tags, $num){

            $s=[];
            while($num>=0){
                $s[]=$tags[$num];
                $num--;
            }

            return $s;
        };

        //$shuffle($tags, 2);// appel la fonction anonyme

        $max = $this->tag->count();//$max = Tag::count();a utiliser si pas construct
        $tags = $this->tag->lists('id');//nous renvoi un tableau des id de tag
                                        //$tags=Tag::lists('id') a utiliser si pas construct
        factory(App\Product::class, 15)->create()->each(function($product) use($max, $tags, $shuffle){

            $product->tags()->attach($shuffle($tags, rand(1,$max-1)));
        });

    }

    protected $tag;

    public function __construct(Tag $tag){

        $this->tag = $tag;
    }// sert a recupere la class tag pour l utiliser dans la fonction

}
