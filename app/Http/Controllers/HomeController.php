<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('tbl_category_product') ->where('category_status','0') -> orderBy('category_id','desc')->get();
        $bran_product = DB::table('tbl_brand_product')->where('brand_status','0') -> orderBy('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderBy('product_id','desc')->limit(1)->get();
        return view('pages.home.home')->with('category_product',$cate_product)->with('brand_product',$bran_product)->with('all_product',$all_product);
    }
}
