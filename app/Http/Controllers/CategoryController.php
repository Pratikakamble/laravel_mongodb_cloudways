<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Str;
use View;

class CategoryController extends Controller
{
    
    public function view_ctg(){
    	$categories = Category::all();
    	return view('admin.categories.categories', ['categories' => $categories]);
    }

    public function ctg_datatable(){
        $categories = Category::orderBy('_id','desc')->get();
        $data_table = View::make('admin.categories.ctg_datatable', ['categories' => $categories])->render();
        return ['success' => true, 'data_table' => $data_table];

    }

    public function save_ctg(Request $request){
    	try{
    		$name = Str::slug($request->category);
    		Category::insert(['name' => $request->category, 'slug' => $name, 'is_active' => 1]);
    		return ['success' => true, 'message' => 'Category Saved Successfully.'];
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    public function ctg_exists(Request $request){

        if(Category::where(['name' => $request->category])->exists()){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function edt_ctg(Request $request){
        $ctg = Category::where(['_id' => $request->eid])->value('name');
        return ['success' => true, 'ctg' => $ctg];
    }

    public function upd_ctg(Request $request){
        Category::where(['_id' => $request->eid])->update(['name' => $request->category]);
        return ['success' => true, 'message' => 'Category Updated Successfully.'];
    }

    public function dlt_ctg(Request $request){
        Category::where(['_id' => $request->eid])->delete();
          return ['success' => true, 'message' => 'Category Deleted Successfully.'];
    }

}
