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

    public function login(Request $request){
//comme on utilise any dans route qui fait get et post il faut preciser la methode
        if($request->isMethod('post')){

       // dd($request->all()); pour verif ce que cela retourne
                $this->validate($request, [
                'email'=>'required|email',
                'password'=>'required',
                'remember'=>'in:true'//tester si la case remember est coché
            ]);

            $remember = !empty($request->input('remember'))? true : false;

            //dd($remember); pour debug voir les donnees retournées

            if(Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')],$remember)){
                return redirect()->intended('product');
            }else {
                return back()->withInput($request->only('email','remember'))->with([
                    'message'=> trans('app.auth'), 'alert'=>'warning'
                ]);
            }
        }else {

            return view('auth.login');

        }
    }

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



