<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use View;
use Mail;
use App\Tag;
use App\history;
use App\Product;
use App\Picture;
use App\Category;
use App\Customer;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    //recupère les catégories pour créer les boutons de la nav et affiche le nombre de produits dans le panier
    public function __construct() {
        View::composer('partials.nav',function($view){
            $categories = Category::all();
            if (session()->has('nbrProduct')) {
                $number = session()->get('nbrProduct');
            }else {
                $number = 0;
            }
            $view->with(compact('categories','number'));
        });
    }

    //page d'acceuil
    public function index(){

        $products = Product::with('tags','category','picture')->online()->orderBy('published_at')->paginate(5);
        return view('front.index',compact('products'));
    }

    //affiche le produit
    public function showProduct($id, $slug=''){

        $product = Product::findOrFail($id);
        return view('front.product',compact('product'));
    }

    //affiche par catégorie
    public function showProductByCategory ($id, $slug=''){

        $products = Category::findOrFail($id)->products()->with('tags', 'picture')->paginate(5);
        return view('front.category',compact('products'));
    }

    //affiche par mot cles
    public function showProductByTag($id) {

        $products = Tag::findOrFail($id)->products()->paginate(5);
        return view('front.tag',compact('products'));
    }

    //affiche page contact
    public function showContact(){

        return view('front.contact');
    }

    //gestion de la page contact
    public function storeContact(Request $request) {

        $this->validate($request, [
            'email'=> 'required|email',
            'content'=>'required|max:255'
        ]);

        //methode pour mail
        $content= $request->input('content');
        Mail::send('emails.contact_email',compact('content'), function($m) use($request){
            $m->from($request->input('email'),'Client');
            $m->to(env('EMAIL_TECH'),'admin')->subject('Contact e-boutique');
        });

       // message de succes
       return back()->with([
           'message'=>trans('app.contactSuccess'),
           'alert' =>'success'
       ]);

     }

    //envoyer les infos dans session pour le pannier
    public function storeShopping(Request $request) {

        $id = $request->input('id');
        $quantity = $request->input('quantity');

        if ($request->session()->has('shopping')) {
            $shopping = $request->session()->get('shopping');
            if (array_key_exists($id,$shopping)){
                $shopping[$id] += $quantity;
            }else{
                $shopping[$id] = $quantity;
            }
        }else {
            $shopping[$id] = $quantity;
        }

        $request->session()->put('shopping', $shopping);


        //gestion de nombre de produit dans panier
        if ($request->session()->has('nbrProduct')) {
            $number = $request->session()->get('nbrProduct');
            $number += $quantity;
        }else {
            $number = $quantity;
        }

        $request->session()->put('nbrProduct',$number);

        return redirect ('/')->with([
            'messageOrder'=>trans('app.shoppingSuccess'),
            'alert' =>'success'
        ]);
    }


    //affiche le pannier
    public function showShopping(Request $request){

          if ($request->session()->has('shopping')){
            $shopping = $request->session()->get('shopping');

            $carts = [];
            $total = 0;

            foreach($shopping as $id => $quantity) {

                $product = Product::findOrFail($id);

                $total += ($product->price)* $quantity;

                $carts[] = [
                    "id"=> $product->id,
                    "name" => $product->name,
                    "price"=> $product->price,
                    "picture" => $product->picture,
                    "quantity"=> $quantity,
                ];
            }
          }else {

              return redirect ('/')->with([
                  'messagePanier'=>trans('app.panierSuccess'),
                  'alert' =>'vide',
              ]);
          }

        return view('front.shopping',compact('carts','total'));
    }

    //suppression d'un produit dans le panier
    public function suppProduct($id) {

        $shopping = Session()->get('shopping');
        $quantity = ($shopping[$id]);
        unset($shopping[$id]);
        Session()->put('shopping', $shopping);

        $number = Session()->get('nbrProduct');
        $number -= $quantity;
        Session()->put('nbrProduct', $number);

       return redirect('shopping');
    }

    //recup du panier pour commande definitive
    public function storeOrder(Request $request){

        $shopping = $request->session()->get('shopping');
        $userId = Auth::user()->id;
        $customer = Customer::where('user_id','=',$userId)->firstOrFail();

        foreach($shopping as $id => $quantity) {

            $product = Product::findOrFail($id);

            history::create([
                "product_id"=>$id,
                "price"=> $product->price,
                "quantity"=> $quantity,
                "customer_id" => $customer->id,//recup id dans customer
                "command_at" => Carbon::now(),
            ]);
        }

        Session()->forget('shopping');
        Session()->forget('nbrProduct');
        return redirect ('order')->with([
            'messageOrderValid'=>trans('app.orderValidSuccess'),
            'alert' =>'success'
        ]);
    }


    //espace public client
    public function showOrder(){

        $userId = Auth::user()->id;
        $customer = Customer::where('user_id','=',$userId)->firstOrFail();
        $customerId = $customer->id;
        $orders = history::where('customer_id','=',$customerId)->orderBy('command_at','desc')->get();

        return view('front.order',compact('orders'));

    }

    //affiche la liste des commandes pour admin
    public function showOrderList() {

        $orders = history::orderBy('customer_id')->orderBy('command_at','desc')->paginate(10);
        return view('admin.orderList',compact('orders'));
    }


    //affiche la page des mentions legales
    public function mention() {

        return view('admin.mention');
    }



}

