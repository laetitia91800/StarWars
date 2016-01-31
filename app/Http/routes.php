<?php




use Illuminate\Http\Request;

Route::pattern('id','[1-9][0-9]*');
Route::pattern('slug','[a-z-]*');




Route::group(['middleware' => ['web']], function () {

    //Route::get('/','FrontController@index'); // route de base transformé avec alias dessous
    Route::get('/',['as'=> 'home','uses' => 'FrontController@index']);

    Route::get('/prod/{id}/{slug?}','FrontController@showProduct');

    Route::get('/cat/{id}/{slug?}','FrontController@showProductByCategory');

    Route::get('/tag/{id}/','FrontController@showProductByTag');

    //page contact
    Route::get('contact','FrontController@showContact');
    Route::post('storeContact','FrontController@storeContact');

    //pannier
    Route::post('storeShopping/','FrontController@storeShopping');
    Route::get('shopping/','FrontController@showShopping');
    Route::get('suppProduct/{id}/','FrontController@suppProduct');


    Route::get('logout','LoginController@logout');

    Route::get('mention','FrontController@mention');


    Route::group(['middleware'=>['throttle:30,1']],function () {
        Route::any('login','LoginController@login');
    });

    Route::group(['middleware'=>['auth','admin']],function (){
        Route::resource('product','ProductController');
        Route::get('product/status/{id}','ProductController@changeStatus');
        Route::get('orderList','FrontController@showOrderList');
    });

    //espace privé
    Route::group(['middleware'=>'auth'],function (){
        Route::get('storeOrder', 'FrontController@storeOrder');
        Route::get('order', 'FrontController@showOrder');
    });


});
