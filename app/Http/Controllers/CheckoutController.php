<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $category_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$category_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request -> customer_name;
        $data['customer_phone'] = $request -> customer_phone;
        $data['customer_email'] = $request -> customer_email;
        $data['customer_password'] = $request -> customer_password;

        $customer_id = DB::table('tbl_customers') ->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request -> customer_name);
        return Redirect('/checkout');
    }
    public function checkout(){
        $category_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$category_product)->with('brand',$brand_product);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request -> shipping_name;
        $data['shipping_phone'] = $request -> shipping_phone;
        $data['shipping_email'] = $request -> shipping_email;
        $data['shipping_address'] = $request -> shipping_address;
        $data['shipping_notes'] = $request -> shipping_notes;

        $shipping_id = DB::table('tbl_shipping') ->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        //Session::put('customer_name',$request -> customer_name);
        return Redirect('/payment');
    }
    public function payment()
    {
        
    }
}
