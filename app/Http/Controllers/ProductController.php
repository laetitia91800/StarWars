<?php

namespace App\Http\Controllers;

use View;
use App\Tag;
use App\Picture;
use App\Product;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        View::composer('partials.nav',function($view){
            $categories = Category::all();
            $view->with(compact('categories'));
        });
    }


    public function index()
    {
       $products = Product::with('tags','category')->paginate(10);
       return view('admin.dash_index', compact('products'));
    }

    public function changeStatus($id) {

        $product = Product::find($id);

        $product->status = ($product->status =='opened')? 'closed':'opened';
        $product->save();

        return back()->with(['message'=>trans('app.changeStatus')]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('title','id');
        $tags = Tag::lists('name','id');
        //dd($tags);
        return view('admin.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->file('image'));
        //dd($request->all());
        $this->validate($request, [
            'name'=> 'required|max:50',
            'content'=>'required|max:255',
            'abstract'=>'required|max:70',
            'price'=>'required|numeric',
            'category_at'=>'numeric',
            'quantity'=>'numeric',
            'published_at'=>'required|date_format:d-m-Y',
            'status'=>'in:opened,closed', //verifie soit opened soit closed
            'thumbnail'=>'image|max:6000'//en byte(3 mega octet)
        ]);

        $product = product::create($request->all());
        $product->tags()->attach($request->input('tags'));


        //si on ne met pas d'image revient null donc
        if(!is_null($request->file('thumbnail'))){
            $im = $request->file('thumbnail');//thumbnail = name du input type file dans page dash index
            $ext = $im->getClientOriginalExtension();//sert a recuperer l'extension de l'image pour renomer
            $uri = str_random(12).'.'.$ext;//renome l'image le . concatene
           ($im->move(env('UPLOAD_PATH','./uploads'),$uri));//move envoi une exception qui arrete le script si erreur
                Picture::create([
                    'uri' => $uri,
                    'type' => $ext,
                    'size' => $im->getClientSize(),
                    'product_id' => $product->id
                ]);
        }

        return redirect()->intended('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::lists('title','id');
        $tags = Tag::lists('name','id');


        //dd($product);
        return view('admin.edit', compact('product','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $product = Product::find($id);
    //gestion des tags
        if(!empty($request->input('tags'))){ //sert a mettre les tags a jour
            /*$product->tags()->detach();
            $product->tags()->attach($request->input('tags'));*/
            $product->tags()->sync($request->input('tags'));//remplace les deux lignes du dessus
        }else {
            $product->tags()->detach();
        }
    //gestion sup image
        if($request->input('delete_picture')=='true'){
            if(!is_null($product->picture)) {
                Storage::delete($product->picture->uri);
                $product->picture->delete();
            }
        }
    //gestion de la modification image
        if(!is_null($request->file('thumbnail'))){
            if(!is_null($product->picture)) {
                Storage::delete($product->picture->uri);
                $product->picture->delete();
            }

            $im = $request->file('thumbnail');//thumbnail = name du input type file dans page dash index
            $ext = $im->getClientOriginalExtension();//sert a recuperer l'extension de l'image pour renomer
            $uri = str_random(12).'.'.$ext;
            $picture = Picture::create([
                'uri' => $uri,
                'type' => $ext,
                'size' => $im->getClientSize(),
                'product_id' => $product->id
            ]);

            $request->file('thumbnail')->move(env('UPLOAD_PATH','./uploads'), $picture->uri);

        }


            //dd($request->all());
            $product->update($request->all());
           //dd($product);
            return redirect('product')->with(['message'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = $product->picture;
        if(!is_null($picture)){
            Storage::delete($picture->uri);//sup le fichier physique dans uploads storage est defini dans config
            $picture->delete();//sup dans base de donnée
        }
        $product->delete();//sup le produit + les tables en cascade
        return back()->with(['message'=>'product deleted !']);
    }
}
