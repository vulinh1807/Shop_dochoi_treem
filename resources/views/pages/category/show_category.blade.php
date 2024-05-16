@extends('layout')
@section('category-content')
<div class="features_items"><!--features_items-->
  @foreach ($category_by_name as $key=>$c_name)
      <h2 class="title text-center">Category: {{$c_name->category_name}}</h2>
  @endforeach
  @foreach ($category_by_id as $key=>$c_product)
  <a href="{{URL::to('/product-details/'.$c_product->product_id)}}">
    <div class="col-sm-4">
      <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
              <img src="{{URL::to('/upload/products/'.$c_product->product_image)}}" alt="" />
              <h2>{{number_format($c_product->product_price).''.'VND'}}</h2>
              <p>{{$c_product->product_name}}</p>
              <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
            </div>
            <div class="product-overlay">
              <div class="overlay-content">
                <h2>{{number_format($c_product->product_price).''.'VND'}}</h2>
                <p>{{$c_product->product_name}}</p>
                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
              </div>
            </div>
  @endforeach
        </div>
        <div class="choose">
          <ul class="nav nav-pills nav-justified">
            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
          </ul>
        </div>
      </div>
    </div>
  </a> --}}
  <h1>Hello</h1>
</div>
@endsection