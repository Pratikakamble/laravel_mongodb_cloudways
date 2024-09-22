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
    public function online_store($ctg=null){
    	$categories = Category::all();
      
        if($ctg != ''){
            $product_count = Product::where(['category_id' => $ctg])->get()->count(); 
            $product_count = ($product_count >= 12) ? 12 : $product_count;
            $products = Product::where(['category_id' => $ctg])->get()->random($product_count)->toArray();
        }else{
            $product_count = Product::all()->count(); 
            $product_count = ($product_count >= 12) ? 12 : $product_count;
            $products = Product::all()->random($product_count)->toArray();
        }

        

        $products = array_chunk($products, 4);
        //echo "<pre>"; print_r($products); die;
        $cart_count  =  Cart::where(['user_id' => Session::get('user_id')])->count();
    	return view('online_store', ['categories' => $categories, 'products' => $products, 'cart_count' => $cart_count]);
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
        $user_id = Session::get('user_id');
        $quantity = Cart::where(['product_id' => $request->pro_id, 'variation_id' => $request->vrtn_id, 'user_id' => $user_id])->first();

        if($quantity != '' && count($quantity->toArray()) > 0 && empty($request->atr_val)){
            $quantity->quantity = $quantity['quantity'] + 1;
            $quantity->save();
        }else{
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = $request->pro_id;
            $cart->variation_id = $request->vrtn_id;
            $cart->price = $request->selling_amount;
            $cart->quantity = 1;
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
        }

        $cart_detail = Cart::with(['product', 'variation', 'user'])->where(['user_id' => Session::get('user_id')])->get()->toArray();
        $cart_count = count($cart_detail);
        return ['success' => true, 'message' => 'Product Added to Cart Successfully', 'cart_detail' => $cart_detail, 'cart_count' => $cart_count];
    }

    public function cart_view(Request $request){
        //echo Session::get('user_id'); die;
        $cart_detail = Cart::with(['product', 'variation', 'user'])->where(['user_id' => Session::get('user_id')])->get()->toArray();
        $cart_count = count($cart_detail);

        $content = View::make('cart_content', ['cart_detail' => $cart_detail])->render();
        return ['success' => true, 'cart_detail' => $cart_detail, 'content' => $content, 'cart_count' => $cart_count];
    }

    public function view_cart_content(){
        $categories = Category::all();
        $cart_detail = Cart::with(['product', 'variation', 'user'])->where(['user_id' => Session::get('user_id')])->get()->toArray();
        $cart_count  =  Cart::where(['user_id' => Session::get('user_id')])->count();
       return view('view_cart', ['cart_detail' => $cart_detail, 'categories' => $categories, 'cart_count' => $cart_count]);
    }

    public function update_qnt(Request $request){
        $cart_id = $request->cart_id;
        $qnt = $request->qnt;
        $cart = Cart::where(['_id' => $cart_id])->first();
        $cart->quantity = $qnt;
        $cart->save();
        return ['success' => true];
    }


    public function dlt_cart(Request $request){
        $cart_id = $request->cart_id;
        $cart_count  =  Cart::where(['user_id' => Session::get('user_id')])->count();
        Cart::where(['_id' => $cart_id])->delete();
        return ['success' => true, 'cart_count' => $cart_count];
    }
}
