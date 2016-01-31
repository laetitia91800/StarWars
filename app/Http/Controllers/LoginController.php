<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Category;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function ($view) {
            $categories = Category::all();
            if (session()->has('nbrProduct')) {
                $number = session()->get('nbrProduct');
            }else {
                $number = 0;
            }
            $view->with(compact('categories','number'));
        });
    }

    //gestion de la connexion
    public function login(Request $request){

        if($request->isMethod('post')){

                $this->validate($request, [
                'email'=>'required|email',
                'password'=>'required',
                'remember'=>'in:true'
            ]);

            $remember = !empty($request->input('remember'))? true : false;


            if(Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')],$remember)){
                return redirect()->intended('product');
            }else {
                return back()->withInput($request->only('email','remember'))->with([
                    'messageAuth'=> trans('validation.auth'), 'alert'=>'warning'
                ]);
            }
        }else {

            return view('auth.login');

        }
    }

     //gestion de la déconnexion
    public function logout() {
         Auth::logout();
         Session()->forget('shopping');
         Session()->forget('nbrProduct');
         return redirect ('/')->with([
             'messageLogout'=>trans('app.logoutSuccess'),
             'alert' =>'success'
         ]);

    }
}



