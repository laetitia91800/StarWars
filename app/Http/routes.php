<?php



/*Route::get('/', function () {

    return view('home');
    //return "hello word";
    //return view('welcome');
});*/

use Illuminate\Http\Request;

Route::pattern('id','[1-9][0-9]*');
Route::pattern('slug','[a-z-]*');








/*Route::get('products', function () {

    return "je suis la liste des produits";

});

Route::get('posts', function(){

    return App\Post::all(); //all veut dire select *

});

Route::get('post/{id}','FrontController@show');// show($id)*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    //Route::get('/','FrontController@index'); // route de base transformé avec alias dessous
    Route::get('/',['as'=> 'home','uses' => 'FrontController@index']); //alias de route pour logout dans login Contoller

    Route::get('/prod/{id}/{slug?}','FrontController@showProduct');

    Route::get('/cat/{id}/{slug?}','FrontController@showProductByCategory');

    Route::get('/tag/{id}/','FrontController@showProductByTag');

    Route::get('contact','FrontController@showContact');//affiche la page contact
    Route::post('storeContact','FrontController@storeContact');//recupere le formulaire

    Route::post('storeShopping/','FrontController@storeShopping');//recupere le panier
    Route::get('shopping/','FrontController@showShopping');//affiche le panier
    Route::get('suppProduct/{id}/','FrontController@suppProduct');//sup le produit dans le panier



    Route::get('logout','LoginController@logout');

    Route::get('mention','FrontController@mention');


    Route::group(['middleware'=>['throttle:30,1']],function () {
        Route::any('login','LoginController@login');//any fait get et post
        //throttle 30 requete pour 1 minute

    });

    Route::group(['middleware'=>['auth','admin']],function (){
        Route::resource('product','ProductController');
        Route::get('product/status/{id}','ProductController@changeStatus');
        Route::get('orderList','FrontController@showOrderList');


    });

    Route::group(['middleware'=>'auth'],function (){
        Route::get('storeOrder', 'FrontController@storeOrder');//recupere le panier valider
        Route::get('order', 'FrontController@showOrder');//affiche espace prive des commandes clients validée

    });



    //route de test pour middelware admin
    /*Route::get('test', ['middleware'=>['admin'], function(){
        return 'hello world';
    }]);*/
});
