@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
  @foreach ($brand_by_name as $key=>$b_name )
  <h2 class="title text-center">Brand: {{$b_name ->brand_name}}</h2>
  @endforeach
  @foreach ($brand_by_id as $key=>$b_product )
  <a href="{{URL::to('/product-details/'.$b_product->product_id)}}">
    <div class="col-sm-4">
      <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
              <img src="{{URL::to('/upload/products/'.$b_product->product_image)}}" alt="" />
              <h2>{{number_format($b_product->product_price).''.'VND'}}</h2>
              <p>{{$b_product->product_name}}</p>
              <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
            </div>
        </div>
        <div class="choose">
          <ul class="nav nav-pills nav-justified">
            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
          </ul>
          {{-- <div class="clear-fix"></div> --}}
        </div>
      </div>
    </div>
  </a>
  @endforeach
</div>
@endsection