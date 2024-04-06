@extends('admin_layout');
@section('admin_content')
<div class="row">
  <div class="col-lg-12">
          <section classa="panel">
              <header class="panel-heading">
                 Edit infomation's product
              </header>
                <?php
                 $message = Session::get('', 'message');
                 if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                 }
                ?>
              <div class="panel-body">
                  <div class="position-center">
                    @foreach ($edit_product as $key => $pro )
                    <form role="form" action="{{URL::to("/update-product/>".$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="add_name_product"
                        class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="product_image"
                        class="form-control" id="exampleInputEmail1">
                        <img src="{{URL::to('public/uploads/product/'.$pro -> product_image)}}" height="100" width="100">
                    </div>
                    <div class="form-group">
                        <label for="product_desc">Description</label>
                        <textarea style="resize: none" rows="3" class="form-control" name="product_desc" >{{$pro->product_desc}}</textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label for="product_des">Content</label>
                        <textarea style="resize: none" rows="3" class="form-control" name="product_content" >{{$pro->product_content}}</textarea>
                    </div> --}}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input type="text" name="product_price"
                      class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                    </div>
                    <div class="form-group">
                      <label for="form-control input-sm m-bot15">Categor of product</label>
                      <select class="form-control input-sm m-bot15" name="cate_product">
                        @foreach ($cate_product as $key => $cate)
                          @if ($cate->category_id==$pro->category_id)
                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                          @else
                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="form-control input-sm m-bot15">Brand of product</label>
                      <select class="form-control input-sm m-bot15" name="bra_product">
                      @foreach ($bra_product as $key => $bra)
                        @if ($bra->brand_id==$pro->brand_id)
                          <option selected value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                        @else
                          <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                        @endif
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="form-control input-sm m-bot15">Active/Unactive</label>
                      <select class="form-control input-sm m-bot15" name="product_status">
                        <option value="0">Unactive</option>
                        <option value="1">Active</option>
                      </select>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-info">Update</button>
                </form>
                    @endforeach
                </div>
              </div>
          </section>
  </div>
</div>
@endsection