<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Attribute;
use View;

class AttributeController extends Controller
{

	public function view_attributes(){
		$categories = Category::all();
    	return view('admin.attributes.attributes', ['categories' => $categories]);
    }

    public function attribute_datatable(){
    	$attributes = Attribute::with('SubCategory', 'SubCategory.Category')->orderBy('_id','desc')->get()->toArray();
        $data_table = View::make('admin.attributes.attribute_datatable', ['attributes' => $attributes])->render();
        return ['success' => true, 'data_table' => $data_table];
    }

    public function save_attribute(Request $request){
    	try{
    		Attribute::insert(['category_id' => $request->category_id, 'sub_category_id' => $request->sub_category_id, 'name' => $request->attribute]);

    		return ['success' => true, 'message' => 'attribute Saved Successfully.'];
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    public function attribute_exists($ctg_id, $sub_ctg_id){
        if(Attribute::where(['category_id' => $ctg_id, 'sub_category_id' => $sub_ctg_id, 'name' => $request->attribute])->exists()){
            return 'false';
        }else{
            return 'true';
        }
    }



    public function edt_attribute(Request $request){
        $ctg = Attribute::where(['_id' => $request->eid])->value('name');
        return ['success' => true, 'ctg' => $ctg];
    }

    public function upd_attribute(Request $request){
        Attribute::where(['_id' => $request->eid])->update(['name' => $request->attribute]);
        return ['success' => true, 'message' => 'Attribute Updated Successfully.'];
    }

    public function dlt_attribute(Request $request){
        Attribute::where(['_id' => $request->eid])->delete();
        return ['success' => true, 'message' => 'Attribute Deleted Successfully.'];
    }

    public function fetch_sub_ctg(Request $request){
	    $sub_ctgs = SubCategory::where(['category_id' => $request->eid])->get();
	    $html = '<option value="">Select Sub Category</option>';
	    foreach($sub_ctgs as $sub_ctg){
	    	$html .= '<option value="'.$sub_ctg['_id'].'">'.$sub_ctg['name'].'</option>';
	    }
	    return ['success' => true, 'html_content' => $html];
	}

    public function fetch_attr(Request $request){
        $attributes = Attribute::where(['sub_category_id' => $request->sid])->get();
        
        $html = '<option value="">Select Attribute</option>';
        foreach($attributes as $attr){
            $html .= '<option value="'.$attr['_id'].'">'.$attr['name'].'</option>';
        }
        return ['success' => true, 'html_content' => $html];
    }
}
