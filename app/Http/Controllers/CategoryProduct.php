<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProduct extends Controller
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
    public function add_category_product()
    {
        $this -> AuthenLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product()
    {
        $this -> AuthenLogin();
        $all_category_product=DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product') -> with('all_category_product',$all_category_product);
        return view('admin_layout') -> with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $this -> AuthenLogin();
        $data=array();
        $data['category_name'] = $request -> add_name_category;//category_product_name
        $data['category_desc'] = $request -> category_product_des;//category_product_desc
        $data['category_status'] = $request ->category_product_status; //category_product_status
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Added!');
        return redirect('/all-category-product');
    }
    public function unactive_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 1]);
        Session::put('message','BE UNACTIVE!');
        return redirect('all-category-product');
    }
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 0]);
        Session::put('message','BE ACTIVE!');
        return redirect('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $this -> AuthenLogin();
        $edit_category_product=DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product') -> with('edit_category_product',$edit_category_product);
        return view('admin_layout') -> with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id)
    {
        $this -> AuthenLogin();
        $data = array();
        $data['category_name'] = $request->add_name_category;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product') ->where('category_id',$category_product_id) -> update($data);
        Session::put('message','Updated!');
        return redirect('/all-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        $this -> AuthenLogin();
        DB::table('tbl_category_product') ->where('category_id',$category_product_id) -> delete();
        Session::put('message','Deleted!');
        return redirect('/all-category-product');
    }
}
