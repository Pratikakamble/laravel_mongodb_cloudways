<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use View;

class SubCategoryController extends Controller
{
    
    public function view_sub_ctg(){
        $categories = Category::orderBy('_id','desc')->get();
        return view('admin.sub_categories.sub_categories',['categories' => $categories]);
    }

    public function sub_ctg_datatable(){
        //$categories = SubCategory::all();
        $sub_categories = SubCategory::with('category:name')->orderBy('_id','desc')->get();
        //echo "<pre>"; print_r($sub_categories); die;
        $data_table = View::make('admin.sub_categories.sub_ctg_datatable', ['sub_categories' => $sub_categories])->render();
        return ['success' => true, 'data_table' => $data_table];
    }

    public function sub_ctg_exists(Request $request){
        if(SubCategory::where(['category'=>$request->category, 'name' => $request->sub_category])->exists()){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function save_sub_ctg(Request $request){
        try{
        $name = Str::slug($request->sub_category);
        SubCategory::insert(['category_id' => $request->category, 'name' => $request->sub_category, 'slug' => $name, 'is_active' => 1]);
            return ['success' => true, 'message' => 'Sub Category Saved Successfully.'];
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function edt_sub_ctg(Request $request){
        $sub_ctg = SubCategory::select(['category_id', 'name'])->where(['_id' => $request->eid])->first()->toArray();

        return ['success' => true, 'ctg' => $sub_ctg['category_id'], 'sub_ctg' => $sub_ctg['name']];
    }

    public function upd_sub_ctg(Request $request){
        SubCategory::where(['_id' => $request->eid])->update(['name' => $request->sub_category]);
        return ['success' => true, 'message' => 'Sub Category Updated Successfully.'];
    }

    public function dlt_sub_ctg(Request $request){
        SubCategory::where(['_id' => $request->eid])->delete();
        return ['success' => true, 'message' => 'Sub Category Deleted Successfully.'];
    }
}
