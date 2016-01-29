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
        //$products = Product::paginate(5);
        return view('front.index',compact('products'));//
    }

    //affiche le produit
    public function showProduct($id, $slug=''){

        /*try {
            $product = Product::findOrFail($id);//si pas use en haut mettre anti slach \App/
            //pas de pivot car demande de 1 seul produit
            //on utilise findOrFail retourner 1 + redirige vers la ressources 404
        }catch(\Exception $e){
            //dd($e->getMessage());//var_dump customisé + die
            return view('front.no_product');
        }*/

        $product = Product::findOrFail($id);//si pas use en haut mettre anti slach \App/
        //pas de pivot car demande de 1 seul produit
        //on utilise findOrFail retourner 1 + redirige vers la ressources 404
        return view('front.product',compact('product'));

    }

    //affiche par catégorie
    public function showProductByCategory ($id, $slug=''){

        $products = Category::findOrFail($id)->products()->with('tags', 'picture')->paginate(5);

        //dd($products);
        return view('front.category',compact('products'));
    }

    //affiche par mot cles
    public function showProductByTag($id) {

        $products = Tag::findOrFail($id)->products()->paginate(5);
        //dd($products);
        return view('front.tag',compact('products'));
    }

    public function showContact(){

        return view('front.contact');
    }

    public function storeContact(Request $request)
    {

           /* $validator = Validator::make($request->all(), [
            'email' => 'required|email',// obligation de remplir la zone|email est la fonction qui verifie
                                    //que la syntaxe saisie de email correspond a la syntax prévue par laravel
            'content' =>'required|max:200'//obligation|caractere maxi 200

        ]);

           if($validator -> fails())
               return back()->withInput()->withErrors($validator);*/

        //ci-dessous remplace ci-dessus commenté

        $this->validate($request, [
            'email'=> 'required|email',
            'content'=>'required|max:255'
        ]);

        //methode pour mail
        $content= $request->input('content');
        Mail::send('emails.contact_email',compact('content'), function($m) use($request){
            $m->from($request->input('email'),'Client');//from = mail client +
            $m->to(env('EMAIL_TECH'),'admin')->subject('Contact e-boutique'); //mail indiqué dans env + sujet du mail
        });

       //sert a retourner un message de succes //avec with laravel met tout dans un objet Session laravel
       return back()->with([  //on peut faire aussi redirect('contact')->with(); back retourne a la page sur laquelle on travail
           'message'=>trans('app.contactSuccess'),
           'alert' =>'success' //creer un css pour les differents message
       ]);

     }

    /**
     * @param Request $request
     */
    //envoyer les infos dans session pour le pannier
    public function storeShopping(Request $request) {

        $id = $request->input('id'); //recupere id qui est dans un champs caché
        $quantity = $request->input('quantity'); //recupère quantity dans formulaire


        if ($request->session()->has('shopping')) {
            $shopping = $request->session()->get('shopping'); //Appel la session pour vérif si il ya deja quelque chose pour
            //pouvoir rajouter au panier si besoin
            if (array_key_exists($id,$shopping)){
                $shopping[$id] += $quantity;
            }else{
                $shopping[$id] = $quantity;
            }
        }else {
            $shopping[$id] = $quantity;
        }

        $request->session()->put('shopping', $shopping);//sert a stocker la quantité et id dans la session "put"
        ////ecrase la precedente  automatiquement

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

        //dd($request);
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
        //dd($number);
        return view('front.shopping',compact('carts','total'));

    }

    //suppression d'un produit dans panier
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

        //dd("espace client");
        //dd(Auth::user()->id); done le id user

        $shopping = $request->session()->get('shopping');//recup session panier
        $userId = Auth::user()->id;//recup id user
        $customer = Customer::where('user_id','=',$userId)->firstOrFail();//recup la ligne
        //entière du 1er user_id

       // dd($customer);

        foreach($shopping as $id => $quantity) {

            $product = Product::findOrFail($id);

        //dd($product);

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

        $userId = Auth::user()->id;//recup id user
        $customer = Customer::where('user_id','=',$userId)->firstOrFail();
        $customerId = $customer->id;
        $orders = history::where('customer_id','=',$customerId)->orderBy('command_at','desc')->get();


        //dd($product);
        return view('front.order',compact('orders'));

    }

    //affiche la liste des commandes pour admin
    public function showOrderList() {

        $orders = history::orderBy('customer_id')->orderBy('command_at','desc')->paginate(10);
       // dd($orders);
        return view('admin.orderList',compact('orders'));
    }



    public function mention() {

        return view('admin.mention');
    }



}

