@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
  <h2 class="title text-center">Ket qua tim kiem</h2>
  @foreach ($search_product as $key=>$product )
    <div class="col-sm-4">
      <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
              <img src="{{URL::asset('/upload/products/'.$product->product_image)}}" alt="" />
              <h2>{{number_format(floatval($product->product_price)).' '.'VND'}}</h2>
              <p>{{$product->product_name}}</p>
              <a href="{{URL::to('/save-cart')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart">Add to cart</i></a>
            </div>
        </div>
        <div class="choose">
          <ul class="nav nav-pills nav-justified">
            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
          </ul>
        </div>
      </div>
    </div>
    <a href="{{URL::to('/product-details/'.$product->product_id)}}">
  </a>
  @endforeach
</div>
@endsection