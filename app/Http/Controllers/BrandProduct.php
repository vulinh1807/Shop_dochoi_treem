<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
//use Illuminate\Contracts\Session\Session;
class BrandProduct extends Controller
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
    public function add_brand_product()
    {
        $this -> AuthenLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        $this -> AuthenLogin();
        $all_brand_product=DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.all_brand_product') -> with('all_brand_product',$all_brand_product);
        return view('admin_layout') -> with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request)
    {
        $this -> AuthenLogin();
        $data=array();
        $data['brand_name'] = $request -> add_name_brand;//brand_product_name
        $data['brand_desc'] = $request -> brand_product_des;//brand_product_desc
        $data['brand_status'] = $request ->brand_product_status; //brand_product_status
        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Added!');
        return Redirect::to('all-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' => 1]);
        Session::put('message','BE UNACTIVE!');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' => 0]);
        Session::put('message','BE ACTIVE!');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        $this -> AuthenLogin();
        $edit_brand_product=DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product') -> with('edit_brand_product',$edit_brand_product);
        return view('admin_layout') -> with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id)
    {
        $this -> AuthenLogin();
        $data = array();
        $data['brand_name'] = $request->add_name_brand;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand_product') ->where('brand_id',$brand_product_id) -> update($data);
        Session::put('message','Updated!');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        $this -> AuthenLogin();
        DB::table('tbl_brand_product') ->where('brand_id',$brand_product_id) -> delete();
        Session::put('message','Deleted!');
        return Redirect::to('all-brand-product');
    }
    //end function of admin page
    public function show_brand($brand_id)
    {
        $cate_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $bra_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        // ->where('tbl_product.brand_id',$brand_id)
        ->get();
        $brand_by_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->first()->get();
        return view('pages.brand.show_brand')->with('brand_by_id',$brand_by_id)->with('brand_by_name',$brand_by_name)->with('category',$cate_product)->with('brand',$bra_product);
    }
}
