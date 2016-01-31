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
    //gestiion des boutons category de la nav
    public function __construct() {
        View::composer('partials.nav',function($view){
            $categories = Category::all();
            $view->with(compact('categories'));
        });
    }

    //affiche la page dashbord
    public function index()
    {
       $products = Product::with('tags','category')->paginate(10);
       return view('admin.dash_index', compact('products'));
    }

    //gestion du changement de status sur la page dashbord
    public function changeStatus($id) {

        $product = Product::find($id);

        $product->status = ($product->status =='opened')? 'closed':'opened';
        $product->save();

        return back()->with(['message'=>trans('app.changeStatus')]);
    }

    //gestion de la page ajout produit et récupération des données nécessaires
    public function create()
    {
        $categories = Category::lists('title','id');
        $tags = Tag::lists('name','id');
        return view('admin.create', compact('categories','tags'));
    }

    //gestion de la page create et validation des champs
    public function store(Request $request)
    {
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


        //gestion de l'image dans la page create
        if(!is_null($request->file('thumbnail'))){
            $im = $request->file('thumbnail');
            $ext = $im->getClientOriginalExtension();
            $uri = str_random(12).'.'.$ext;
           ($im->move(env('UPLOAD_PATH','./uploads'),$uri));
                Picture::create([
                    'uri' => $uri,
                    'type' => $ext,
                    'size' => $im->getClientSize(),
                    'product_id' => $product->id
                ]);
        }

        return redirect()->intended('product');
    }


    public function show($id)
    {
        //dd('show');
    }

    //récupération des données nécessaires pour gestion des modifications de produit
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::lists('title','id');
        $tags = Tag::lists('name','id');

        return view('admin.edit', compact('product','categories','tags'));
    }

    //gestion de la page modification des produits
    public function update(Request $request, $id)
    {
       $product = Product::find($id);

        if(!empty($request->input('tags'))){
            $product->tags()->sync($request->input('tags'));
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

            $im = $request->file('thumbnail');
            $ext = $im->getClientOriginalExtension();
            $uri = str_random(12).'.'.$ext;
            $picture = Picture::create([
                'uri' => $uri,
                'type' => $ext,
                'size' => $im->getClientSize(),
                'product_id' => $product->id
            ]);

            $request->file('thumbnail')->move(env('UPLOAD_PATH','./uploads'), $picture->uri);

        }

            $product->update($request->all());
            return redirect('product')->with(['message'=>'success']);
    }

    //gestion de la supression d'un produit
    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = $product->picture;
        if(!is_null($picture)){
            Storage::delete($picture->uri);
            $picture->delete();
        }
        $product->delete();
        return back()->with(['message'=>'product deleted !']);
    }
}
