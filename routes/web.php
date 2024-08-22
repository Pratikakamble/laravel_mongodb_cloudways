<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\OnlineStoreController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\StripePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function(){
	return view('admin.index');
});

Route::get('view-categories', [CategoryController::class, 'view_ctg'])->name('view-categories');
Route::post('save-category', [CategoryController::class, 'save_ctg'])->name('save-category');
Route::post('category-exists',[CategoryController::class, 'ctg_exists'])->name('category-exists');
Route::post('category-datatable', [CategoryController::class, 'ctg_datatable'])->name('category-datatable');
Route::get('edt-category', [CategoryController::class, 'edt_ctg'])->name('edt-category');
Route::post('upd-category', [CategoryController::class, 'upd_ctg'])->name('upd-category');
Route::post('dlt-category', [CategoryController::class, 'dlt_ctg'])->name('dlt-category');


Route::get('view-sub-categories', [SubCategoryController::class, 'view_sub_ctg'])->name('view-sub-categories');
Route::post('sub-category-datatable',[SubCategoryController::class, 'sub_ctg_datatable'])->name('sub-category-datatable');
Route::post('subctg-exists',[SubCategoryController::class, 'sub_ctg_exists'])->name('subctg-exists');
Route::post('save-sub-category', [SubCategoryController::class, 'save_sub_ctg'])->name('save-sub-category');
Route::get('edt-sub-category', [SubCategoryController::class, 'edt_sub_ctg'])->name('edt-sub-category');
Route::get('upd-sub-category', [SubCategoryController::class, 'upd_sub_ctg'])->name('upd-sub-category');
Route::post('dlt-sub-category', [SubCategoryController::class, 'dlt_sub_ctg'])->name('dlt-sub-category');

Route::get('view-products', [ProductController::class, 'view_products'])->name('view-products');

Route::get('add-product', [ProductController::class, 'add_product'])->name('add-product');
Route::post('save-product', [ProductController::class, 'save_product'])->name('save-product');
Route::post('product-datatable', [ProductController::class, 'product_datatable'])->name('product-datatable');

Route::get('/edit-product/{eid}', [ProductController::class, 'edit_product']);
Route::post('update-product', [ProductController::class, 'update_product'])->name('update-product');
Route::post('dlt-product', [ProductController::class, 'delete_product'])->name('dlt-product');


Route::get('view-attributes', [AttributeController::class, 'view_attributes'])->name('view-attributes');
Route::get('attribute-datatable', [AttributeController::class, 'attribute_datatable'])->name('attribute-datatable');
Route::post('attribute-exists/{ctg_id}/{sub_ctg_id}',[AttributeController::class, 'attribute_exists']);
Route::post('save-attribute', [AttributeController::class, 'save_attribute'])->name('save-attribute');
Route::get('edt-attribute', [AttributeController::class, 'edt_attribute'])->name('edt-attribute');
Route::get('upd-attribute', [AttributeController::class, 'upd_attribute'])->name('upd-attribute');
Route::post('dlt-attribute', [AttributeController::class, 'dlt_attribute'])->name('dlt-attribute');
Route::get('fetch-sub-ctg', [AttributeController::class, 'fetch_sub_ctg'])->name('fetch-sub-ctg');




Route::get('/online-store', [OnlineStoreController::class, 'online_store'])->name('online-store');

/*Route::get('/view-product', function(){
	return view('view_product');
});*/

Route::get('/view-product/{id?}', [ProductController::class, 'view_product']);

Route::get('/login', [OnlineStoreController::class, 'login']);
Route::post('/login', [OnlineStoreController::class, 'signin'])->name('signin');

Route::get('/qry', function(){
	DB::table('products')->truncate();
	DB::table('product_details')->truncate();
	DB::table('product_images')->truncate();
	DB::table('value_attribute')->truncate();
	DB::table('multivalues_attribute')->truncate();
});

Route::get('/product-content/{id}', [ProductController::class, 'view_product']);

Route::get('/fetch', function(){
	$eid= '';
	$product = App\Models\Product::with(['ProductDetails','ProductImages','ValueAttribute','ValueAttribute.MultiValuesAttribute'])->where('_id',$eid)->first();
	if(!empty($product)){
	    echo "<pre>"; print_r($product->toArray()); die;
	}
});

Route::get('/qry', function(){
	$pids = App\Models\ProductDetail::select(['_id'])->where(['product_id' => '6677ff07168b2df2f107e415'])->get()->toArray();
	echo "<pre>"; print_r($pids); die;
});

Route::get('fetch-attr', [AttributeController::class, 'fetch_attr'])->name('fetch-attr');


Route::get('/register', [OnlineStoreController::class, 'register_view']);
Route::post('/register', [OnlineStoreController::class, 'register'])->name('register');


Route::post('/savevariation', function(){
	echo 'variation save';
})->name('savevariation');


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe/{amount}', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
    Route::get('stripe-screen', 'stripe_screen')->name('stripe-screen');
});