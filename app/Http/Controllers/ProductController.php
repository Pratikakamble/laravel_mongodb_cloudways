<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\ValueAttribute;
use App\Models\Attribute;
use App\Models\SubCategory;
use App\Models\Variation;
use App\Models\Variation_Attribute;
use App\Models\Variation_Detail;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;
use View;
use Session;

class ProductController extends Controller
{
    public function view_products(){
    	$products = Product::all();
    	return view('admin.products.products', ['products' => $products]);
    }

    public function product_datatable(){
        $products = Product::with('subcategory','subcategory.category')->orderBy('_id','desc')->get()->toArray();

        
        $data_table = View::make('admin.products.product_datatable', ['products' => $products])->render();
        return ['success' => true, 'data_table' => $data_table];

    }


    public function add_product(){
    	$categories = Category::all();
    	$attributes = Attribute::all();
    	return view('admin.products.add_product', ['categories' => $categories, 'attributes' => $attributes]);
    }

    public function edit_product($eid){
    	$product = Product::with(['ProductDetails','ProductImages','ValueAttribute','Variation','Variation.VariationAttribute', 'Variation.VariationDetail'])->where('_id',$eid)->first()->toArray();
    	$categories = Category::all();
    	$subcategories = SubCategory::where(['category_id' => $product['category_id']])->get();
    	$attributes = Attribute::where(['category_id' => $product['category_id'], 'sub_category_id' => $product['sub_category_id']])->get();
    	return view('admin.products.edit_product',['categories' => $categories, 'attributes' => $attributes, 'product' => $product, 'subcategories' => $subcategories]);
    }

    public function save_product(Request $request){
        //echo "<pre>"; print_r($request->all()); die;
    	try{
            DB::beginTransaction();
    		$product = new Product();
    		$product->category_id = $request->category_id;
    		$product->sub_category_id = $request->sub_category_id;
    		$product->product_name = $request->product_name;
    		$product->brand_or_store = $request->store_or_brand;
    		$product->mrp_amount = $request->mrp_amount;
    		$product->selling_amount = $request->sell_amount;
            $product->discount_amount = $request->discount_amount;

    		if(isset($request->image)){
        		$filename = 'product-img-'.rand().'-'.time().'.'.$request->image->extension();
                $request->image->move(public_path('upload'), $filename);
                $filepath = 'upload/'.$filename;
                $product->image = $filepath;
    		}   		
    		$product->save();

    		if($request->has('product_images')){
    			foreach($request->product_images as $img){
    				$filename = 'product-multi-img'.rand().'-'.time().'.'.$img->extension();
		            $img->move(public_path('upload'), $filename);
		            $filepath = 'upload/'.$filename;
                    $product_img = new ProductImage();
                    $product_img->product_id = $product->_id;
		            $product_img->image = $filepath;
                    $product_img->save();
    			}
    		}


            if(!empty($request->product_details)){
                foreach($request->product_details as $key => $dtl){
                    $product_dtl = new ProductDetail();
                    $product_dtl->product_id = $product->_id;
                    $product_dtl->attribute = $dtl['attr'];
                    $product_dtl->value = $dtl['val'];
                    $product_dtl->save();
                }
            }

            if(!empty($request->value_attribute)){
                foreach($request->value_attribute as $val){
                    $val_attr = new ValueAttribute();
                    $val_attr->product_id = $product->_id;
                    $val_attr->attribute_id = $val['attr'];
                    $val_attr->value = $val['val'];
                    if(isset($val['image'])){
                        $filename = 'product-val-img'.rand().'-'.time().'.'.$val['image']->extension();
                        $val['image']->move(public_path('upload'), $filename);
                        $filepath = 'upload/'.$filename;
                        $val_attr->image = $filepath;
                    }
                    $val_attr->save();
                }
            }


            if(!empty($request->variation)){
                foreach($request->variation as $key => $vrtn){
                        $Variation = new Variation();
                        $Variation->product_id = $product->_id;
                        $Variation->variation_name = $vrtn['name'];
                        $Variation->mrp = $vrtn['mrp'];
                        $Variation->selling_price = $vrtn['sell_price'];
                        $Variation->discount = $vrtn['discount'];
                        if(isset($vrtn['pro_image'])){
                            $filename = 'product-var-img'.rand().'-'.time().'.'.$vrtn['pro_image']->extension();
                            $vrtn['pro_image']->move(public_path('upload'), $filename);
                            $filepath = 'upload/'.$filename;
                            $Variation->pro_image =  $filepath;
                        }
                        $Variation->save();


                        foreach($vrtn as $key => $val){
                            if(is_numeric($key)){ 
                                if(isset($val['attr_id'])){
                                    $VariationAttribute = new Variation_Attribute();
                                    $VariationAttribute->variation_id = $Variation->_id;
                                    $VariationAttribute->attr_id = $val['attr_id'] ?? '';
                                    $VariationAttribute->attr_val = $val['attr_val'] ?? '';

                                    if(isset($val['attr_image'])){
                                        $filename = 'product-attr-img'.rand().'-'.time().'.'.$val['attr_image']->extension();
                                        $val['attr_image']->move(public_path('upload'), $filename);
                                        $filepath = 'upload/'.$filename;
                                        $VariationAttribute->image =  $filepath;
                                    }

                                    $VariationAttribute->save();
                                }

                                if(isset($val['dtl_attr_name'])){
                                    $VariationDetail = new Variation_Detail();
                                    $VariationDetail->variation_id = $Variation->_id;
                                    $VariationDetail->attr_name = $val['dtl_attr_name'] ?? '';
                                    $VariationDetail->attr_val = $val['dtl_attr_val'] ?? '';
                                    $VariationDetail->save();  
                                }
                            }
                        }
                }
            }
            DB::commit();
            return ['success' => true, 'message' => 'Product Saved Successfully'];
        }catch(\Exception $e){
    		DB::rollback();
            return ['success' => false, 'message' => $e->getMessage().', '.$e->getLine().', '.$e->getFile()];
    	}
    }


    public function view_product($type, $id){
    	$categories = Category::all();
        if($type == 'product'){
            $product = Product::with(['ProductDetails','ProductImages','ValueAttribute','ValueAttribute.Attribute:_id,name','Variation','Variation.VariationAttribute', 'Variation.VariationDetail'])->where('_id',$id)->first();
        }else if($type == 'variation'){
            $product = Variation::with(['VariationAttribute', 'VariationDetail'])->where(['_id' => $id])->first();
        }

       if(!empty($product)){
            $product = $product->toArray();
            $selling_amount = ($type == 'product') ? $product['selling_amount'] : $product['selling_price'];
            Session::put('selling_amount',  $selling_amount);
            if(request()->ajax()){
                if($type == 'product'){
                    $content = View::make('product_content', ['product' => $product])->render();
                }else if($type == 'variation'){
                   $content = View::make('variation_content', ['product' => $product])->render();
                }
                return ['success'=>true, 'content' => $content];
            }
            return view('view_product', ['product' => $product, 'id' => $id, 'categories' => $categories]);
            }else{
                return 'Product Not Found';
            }
    }


    public function view_variation($vid){
        $categories = Category::all();
        $product = Variation::with(['VariationAttribute', 'VariationDetail'])->where(['_id' => $vid])->first();
        $variations = Product::with(['Variation'])->where(['_id' => $product->product_id])->get();
        if(!empty($product)){
            $product = $product->toArray();
            Session::put('selling_amount', $product['selling_price']);
            if(request()->ajax()){
                $content = View::make('variation_content', ['product' => $product, 'variations' => $variations])->render();
                return ['success'=>true, 'content' => $content];
            }
        }else{
            return 'Product Not Found';
        }
    }

    public function update_product(Request $request){
    	try{
    		DB::beginTransaction();
    		$product = Product::find($request->product_id);
    		$product->category_id = $request->category_id;
    		$product->sub_category_id = $request->sub_category_id;
    		$product->brand_or_store = $request->store_or_brand;
    		$product->product_name = $request->product_name;
    		$product->mrp_amount = $request->mrp_amount;
    		$product->selling_amount = $request->sell_amount;
            $product->discount_amount = $request->discount_amount;

    		if($request->has('image')){
        		$filename = 'product-img-'.rand().'-'.time().'.'.$request->image->extension();

                $request->image->move(public_path('upload'), $filename);
                $filepath = 'upload/'.$filename;
                $product->image = $filepath;
    		}else{
    			$product->image = $product->image;
    		}
    		
    		$product->save();


    		if($request->has('product_images')){
    			ProductImage::where(['product_id' => $request->product_id])->delete();
    			foreach($request->product_images as $img){
    				$filename = 'product-multi-img'.rand().'-'.time().'.'.$img->extension();
		            $img->move(public_path('upload'), $filename);
		            $filepath = 'upload/'.$filename;
                    $product_img = new ProductImage();
                    $product_img->product_id = $product->_id;
		            $product_img->image = $filepath;
                    $product_img->save();
    			}
    		}

    		
            if(!empty($request->product_details)){
            	ProductDetail::where(['product_id' => $request->product_id])->delete();
        		foreach($request->product_details as $key => $dtl){
                    $product_dtl = new ProductDetail();
                    $product_dtl->product_id = $product->_id;
        			$product_dtl->attribute = $dtl['attr'];
        			$product_dtl->value = $dtl['val'];
                    $product_dtl->save();
        		}
            }

          
            if(!empty($request->value_attribute)){
            	$vids = ValueAttribute::select(['_id'])->where(['product_id' => $request->product_id])->get()->pluck('_id')->toArray();
            	$dlt_ids = array_diff($vids, array_column($request->value_attribute, 'attribute_id'));	
            	if(!empty($dlt_ids)){
	            	foreach ($dlt_ids as $key => $value) {
	            		ValueAttribute::where(['_id' => $value])->delete();
	            	}
            	}
                foreach($request->value_attribute as $val){
                	$data = [
                    	'product_id' => $product->_id,
                    	'attribute_id' => $val['attr'],
                    	'value' => $val['val']
                    	];

                    if(isset($val['image'])){
                        $filename = 'product-val-img'.rand().'-'.time().'.'.$val['image']->extension();
                        $val['image']->move(public_path('upload'), $filename);
                        $filepath = 'upload/'.$filename;

                        $data = array_merge($data, ['image' => $filepath]);
                    }

                    if(isset($val['attribute_id'])){
                        ValueAttribute::where(['_id' => $val['attribute_id']])->update($data); 
                    }else{
                        ValueAttribute::insert($data);
                    }
                }
            }


        /*if(!empty($request->variation)){
            $vrtn_ids = Variation::select(['_id'])->where(['product_id' => $request->product_id])->get()->pluck('_id')->toArray();
            $vrtn_dlt_ids = array_diff($vrtn_ids, array_column($request->variation, 'variation_id'));

            if(!empty($vrtn_dlt_ids)){
                foreach($vrtn_dlt_ids as $id){
                    Variation::where(['_id' => $id])->delete();
                }
            }

            foreach($request->variation as $vrtn){
                $vrtn_data = [
                    'variation_name' => $vrtn['name'],
                    'mrp' => $vrtn['mrp'],
                    'selling_price' => $vrtn['sell_price'],
                    'discount' => $vrtn['discount']
                ];

                if(isset($vrtn['pro_image'])){
                    $filename = 'product-var-img'.rand().'-'.time().'.'.$vrtn['pro_image']->extension();
                    $vrtn['pro_image']->move(public_path('upload'), $filename);
                    $filepath = 'upload/'.$filename;
                    $vrtn_data = array_merge($vrtn_data, ['pro_image' => $filepath]);
                }

                if(isset($vrtn['variation_id'])){
                                Variation::where(['_id' => $vrtn['variation_id']])->update($vrtn_data); 
                            }else{
                                Variation::insert($vrtn_data);
                            }


                if(isset($vrtn['variation_id'])){
                    $exist_attr_ids = Variation_Attribute::select(['_id'])->where(['variation_id' => $vrtn['variation_id']])->get()->pluck('_id')->toArray();

                    $vrtn_attr_ids_dlt = array_diff($exist_attr_ids, array_column($vrtn, 'pro_attr_id'));
                    if(!empty($vrtn_attr_ids_dlt)){
                        foreach($vrtn_attr_ids_dlt as $attr_id){
                            Variation_Attribute::where(['_id' => $attr_id])->delete();
                        }
                    }

                    $exist_dtl_ids =  Variation_Detail::select(['_id'])->where(['variation_id' => $vrtn['variation_id']])->get()->pluck('_id')->toArray();
                    $vrtn_dtl_ids_dlt = array_diff($exist_dtl_ids, array_column($vrtn, 'pro_attr_dtl_id'));
                    if(!empty($vrtn_dtl_ids_dlt)){
                        foreach($vrtn_dtl_ids_dlt as $dtl_id){
                            Variation_Detail::where(['_id' => $dtl_id])->delete();
                        }
                    }
                }

                foreach($vrtn as $key => $val){
                    if(is_numeric($key)){ 
                        if(isset($val['attr_id'])){
                            $vrtn_attr_data = [
                                'variation_id' => $vrtn['variation_id'],
                                'attr_id' => $val['attr_id'] ?? '',
                                'attr_val' => $val['attr_val'] ?? ''
                            ];

                            if(isset($val['attr_image'])){
                                $filename = 'product-attr-img'.rand().'-'.time().'.'.$val['attr_image']->extension();
                                $val['attr_image']->move(public_path('upload'), $filename);
                                $filepath = 'upload/'.$filename;
                                $vrtn_attr_data = array_merge($vrtn_attr_data, ['image' => $filepath]);
                            }else{
                                $img = Variation_Attribute::where(['_id' => $val['pro_attr_id']])->value('image');
                                $vrtn_attr_data = array_merge($vrtn_attr_data, ['image' => $img]);
                            }

                            if(isset($val['pro_attr_id'])){
                                Variation_Attribute::where(['_id' =>$val['pro_attr_id']])->update($vrtn_attr_data); 
                            }else{
                                Variation_Attribute::insert($vrtn_attr_data);
                            }
                        }

                        if(isset($val['dtl_attr_name'])){
                            $vrtn_dtl_data = [
                                'variation_id' => $vrtn['variation_id'],
                                'attr_name' => $val['dtl_attr_name'] ?? '',
                                'attr_val' => $val['dtl_attr_val'] ?? ''
                            ];

                            if(isset($val['pro_attr_dtl_id'])){
                                Variation_Detail::where(['_id' =>$val['pro_attr_dtl_id']])->update($vrtn_dtl_data); 
                            }else{
                                Variation_Detail::insert($vrtn_dtl_data);
                            }
                        }
                    }
                }        

            }
        }*/

        if(!empty($request->variation)){
            $variations = Variation::where(['product_id' => $request->product_id])->get();
            foreach($variations as $vrtn){
                Variation_Attribute::where(['variation_id' => $vrtn['_id']])->delete();
                Variation_Detail::where(['variation_id' => $vrtn['_id']])->delete();
            }
            Variation::where(['product_id' => $request->product_id])->delete();

              foreach($request->variation as $key => $vrtn){
                        $Variation = new Variation();
                        $Variation->product_id = $product->_id;
                        $Variation->variation_name = $vrtn['name'];
                        $Variation->mrp = $vrtn['mrp'];
                        $Variation->selling_price = $vrtn['sell_price'];
                        $Variation->discount = $vrtn['discount'];
                        if(isset($vrtn['pro_image'])){
                            $filename = 'product-var-img'.rand().'-'.time().'.'.$vrtn['pro_image']->extension();
                            $vrtn['pro_image']->move(public_path('upload'), $filename);
                            $filepath = 'upload/'.$filename;
                            $Variation->pro_image =  $filepath;
                        }else{
                            $Variation->pro_image =  $vrtn['prev_variation_img']; 
                        }
                        $Variation->save();


                        foreach($vrtn as $key => $val){
                            if(is_numeric($key)){ 
                                if(isset($val['attr_id'])){
                                    $VariationAttribute = new Variation_Attribute();
                                    $VariationAttribute->variation_id = $Variation->_id;
                                    $VariationAttribute->attr_id = $val['attr_id'] ?? '';
                                    $VariationAttribute->attr_val = $val['attr_val'] ?? '';

                                    if(isset($val['attr_image'])){
                                        $filename = 'product-attr-img'.rand().'-'.time().'.'.$val['attr_image']->extension();
                                        $val['attr_image']->move(public_path('upload'), $filename);
                                        $filepath = 'upload/'.$filename;
                                        $VariationAttribute->image =  $filepath;
                                    }else{
                                        $VariationAttribute->image =  $val['prev_attr_img'];
                                    }
                                    $VariationAttribute->save();
                                }

                                if(isset($val['dtl_attr_name'])){
                                    $VariationDetail = new Variation_Detail();
                                    $VariationDetail->variation_id = $Variation->_id;
                                    $VariationDetail->attr_name = $val['dtl_attr_name'] ?? '';
                                    $VariationDetail->attr_val = $val['dtl_attr_val'] ?? '';
                                    $VariationDetail->save();  
                                }
                            }
                        }
                }
        }



            DB::commit();
            return ['success' => true, 'message' => 'Product Updated Successfully'];
        }catch(\Exception $e){
    		DB::rollback();
            return ['success' => false, 'message' => $e->getMessage().', '.$e->getLine()];
    	}
    }

    public function delete_product(Request $request){
    	try{
    		DB::beginTransaction();
            ValueAttribute::where(['product_id' => $request->pid])->delete();
            ProductDetail::where(['product_id' => $request->pid])->delete();
            ProductImage::where(['product_id' => $request->pid])->delete();

            $variations = Variation::where(['product_id' => $request->pid])->get();
            foreach($variations as $vrtn){
                Variation_Attribute::where(['variation_id' => $vrtn['_id']])->delete();
                Variation_Detail::where(['variation_id' => $vrtn['_id']])->delete();
            }
            Variation::where(['product_id' => $request->pid])->delete();

            Product::where(['_id' => $request->pid])->delete();
    		DB::commit();
    		return ['success' => true, 'message' => 'Product Deleted Successfully'];
    	}catch(\Exception $e){
    		DB::rollback();
    		return ['success' => false, 'message' => $e->getMessage().', '.$e->getLine()];
    	}
    }

    

}
