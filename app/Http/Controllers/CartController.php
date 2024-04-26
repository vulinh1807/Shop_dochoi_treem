<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productid = $request->productid_hidden;
        $quantity = $request->quantity;
        $product_info = DB::table('tbl_product')->where('product_id',$productid)->get();
        $data['id'] = $product_info ->product_id; 
        $data['quantity'] = $quantity; 
        $data['name'] = $product_info ->product_name; 
        $data['price'] = $product_info ->product_price; 
        $data['weight'] = '1kg'; 
        $data['option']['image'] = $product_info ->product_price; 
        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect::to('/show-cart');
    }
    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $bra_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$bra_product);
        //return redirect('/show-cart');
    }
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request -> cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
