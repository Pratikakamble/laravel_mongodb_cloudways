<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class OnlineStoreController extends Controller
{
    public function online_store(){
    	$categories = Category::all();
        $products = Product::all()->random(2);
    	return view('online_store', ['categories' => $categories, 'products' => $products]);
    }

    public function register_view(){
    	return view('register');
    }

    public function register(Request $request){
    	$request->validate([
    		'name' =>'required',
    		'email' => 'required|unique:users|email',
    		'password' => 'required|confirmed'
    	]);

    	User::create([
    		'name' => $request->input('name'),
    		'email' => $request->input('email'),
    		'password' => \Hash::make($request->input('password')),
    	]);

    	if(!Hash::check($request->input('password'), $user->password)){
    		return redirect()->back()->with('error', 'Registration Failed');
    	}

    	return redirect('/home');
    }

     public function login(Request $request){
     	return view('login');
    }


     public function signin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $email = $request->email;
        $user = User::where(['email'=>$email])->first();
    	if(!$user || !Hash::check($request->input('password'), $user->password)){
    		return redirect()->back()->with('error', 'Login Failed');
    	}

    	return redirect('/home');
    	

    }

}
