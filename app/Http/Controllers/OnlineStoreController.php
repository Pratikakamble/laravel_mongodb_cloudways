<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartAttribute;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use View;

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

    	$user = User::create([
    		'name' => $request->input('name'),
    		'email' => $request->input('email'),
            'role' => ($request->email == 'pratika@gmail.com') ? 1 : 0,
    		'password' => \Hash::make($request->input('password')),
    	]);

    	if(!Hash::check($request->input('password'), $user->password)){
    		return redirect()->back()->with('error', 'Registration Failed');
    	}

    	return redirect('/login');
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
        Session::put('user_id', $user->_id);
        Session::put('email', $user->email);
        Session::put('role', $user->role);

        if($user->role == 1){
            return redirect('/admin');
        }else{
            return redirect('/online-store');
        }
    	
    }

    public function logout(){
        Session::forget('email');
        Session::forget('role');
        return redirect('/login');
    }

    function add_to_cart(Request $request){
        $cart = new Cart();
        $cart->user_id = Session::get('user_id');
        $cart->product_id = $request->pro_id;
        $cart->variation_id = $request->vrtn_id;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;
        $cart->total = $request->price * $request->quantity;
        $cart->status = 'Add to cart';
        $cart->delivery_date = date('Y-m-d');
        $cart->delivery_charges = '1';
        $cart->save();

        if( isset($request->atr_val) && !empty($request->atr_val) ){
            foreach($request->atr_val as $val){
                $cart_atr = new CartAttribute();
                $vl = explode(":", $val);
                $cart_atr->cart_id = $cart->_id;
                $cart_atr->attr_id = $vl[0];
                $cart_atr->attr_val = $vl[1];
                $cart_atr->save();
            }
        }

        $cart_detail = Cart::with(['product', 'variation', 'user'])->where(['user_id' => Session::get('user_id')])->get()->toArray();

        $content = View::make('cart_content', ['cart_detail' => $cart_detail])->render();


        return ['success' => true, 'message' => 'Product Added to Cart Successfully', 'cart_detail' => $cart_detail, 'content' => $content];
    }
}
