<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $data['customer_password'] =md5( $request -> customer_password);

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
        return Redirect::to('/payment');
    }
    public function payment()
    {
        $category_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$category_product)->with('brand',$brand_product);

    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $req){
        $email = $req -> email_account;
        $password = md5($req -> password_account);
        $result = DB::table('tbl_customers')
        ->where('customer_email',$email)
        ->where('customer_password',$password)->take(1)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }
    public function order_here(Request $request)
    {
        //get payment method
        $data = array();
        $data['payment_method'] = $request -> payment_options;
        $data['payment_status'] = 'Loading';
        $payment_id = DB::table('tbl_payment') ->insertGetId($data);
        
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Loading';
        $order_id = DB::table('tbl_order') ->insertGetId($order_data);

        //insert order detail
        $content = Cart::content();
        foreach($content as $v_content)
        {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->id;
            DB::table('tbl_order_details') ->insert($order_d_data);
        }
        if($data['payment_method']==1){
            echo 'thanh toan the ATM';
        }elseif($data['payment_method']==2){
            Cart::destroy();
            $category_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
            return view('pages.checkout.payment')->with('category',$category_product)->with('brand',$brand_product);
        }else{
            echo 'thanh toan the ghi no';
        }
        //return Redirect::to('/payment');
    }
}
