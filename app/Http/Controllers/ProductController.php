<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function AuthenLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            redirect('dashboard');
        }else{
            redirect('admin')->send();
        }
    }
    public function add_product()
    {
        $this -> AuthenLogin();
        $cate_product = DB::table('tbl_category_product') -> orderBy('category_id','desc')->get();
        $bra_product = DB::table('tbl_brand_product') -> orderBy('brand_id','desc')->get();
        return view('admin.add_product') 
        -> with('cate_product',$cate_product) 
        -> with('bra_product',$bra_product);
    }
    public function all_product()
    {
        $this -> AuthenLogin();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderBy('product_id','desc')->get();
        $manager_product = view('admin.all_product') -> with('all_product',$all_product);
        return view('admin_layout') -> with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request)
    {
        $this -> AuthenLogin();
        $data=array();
        $data['product_name'] = $request -> add_name_product;
        $data['product_price'] = $request -> product_price;
        $data['product_desc'] = $request ->product_desc; 
        //$data['product_content'] = $request ->product_content;
        $data['product_status'] = $request ->product_status;
        $data['category_id'] = $request ->cate_product;
        $data['brand_id'] = $request ->bra_product;
        $get_image = $request ->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).','.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','');
            return redirect('/all-product');
        }
        $data['product_image'] = ''; 
        DB::table('tbl_product')->insert($data);
        Session::put('message','Added!');
        return Redirect::to('/all-product');
    }
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 1]);
        Session::put('message','Be unactive!');
        return Redirect::to('/all-product');
    }
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 0]);
        Session::put('message','Be active!');
        return Redirect::to('/all-product');
    }
    public function edit_product($product_id)
    {
        $this -> AuthenLogin();
        $cate_product = DB::table('tbl_category_product') -> orderBy('category_id','desc')->get();
        $bra_product = DB::table('tbl_brand_product') -> orderBy('brand_id','desc')->get();
        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product') -> with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('bra_product',$bra_product);
        return view('admin_layout') -> with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id)
    {
        $this -> AuthenLogin();
        $data = array();
        $data['product_name'] = $request->add_name_product;
        $data['product_price'] = $request -> product_des;
        $data['product_desc'] = $request ->product_desc; 
        //$data['product_content'] = $request ->product_content;
        $data['category_id'] = $request ->cate_product;
        $data['brand_id'] = $request ->brand_product;
        $data['product_status']= $request -> product_status;
        $get_image = $request -> file('product_image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).','.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Updated!');
            return redirect('/all-product');
        }
        DB::table('tbl_product') ->where('product_id',$product_id) -> update($data);
        Session::put('message','Updated item!');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id)
    {
        $this -> AuthenLogin();
        DB::table('tbl_product') ->where('product_id',$product_id) -> delete();
        Session::put('message','Deleted item!');
        return Redirect::to('/all-product');
    }
    //end Admin's Page
    public function product_details($product_id)
    {
        $cate_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $bra_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
        $product_detail= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id') 
        ->where('tbl_product.product_id',$product_id)->get();
        foreach($product_detail as $value)
        {
            $category_id = $value -> category_id;
        }
        $related_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])->get();
        return view('pages.product.show_detail')
        ->with('category',$cate_product)
        ->with('brand',$bra_product)
        ->with('product_detail',$product_detail)
        ->with('related_product',$related_product);
    }
}
