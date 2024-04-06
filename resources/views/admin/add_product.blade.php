@extends('admin_layout');
@section('admin_content')
<div class="row">
  <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                 Add new product
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
                      <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                      <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="add_name_product"
                          class="form-control" id="exampleInputEmail1" placeholder="Name it...">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Image</label>
                          <input type="file" name="product_image"
                          class="form-control" id="exampleInputEmail1">
                      </div>
                      <div class="form-group">
                          <label for="product_des">Description</label>
                          <textarea style="resize: none" rows="5" class="form-control" name="product_des" placeholder="How is it..."></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" name="product_price"
                        class="form-control" id="exampleInputEmail1" placeholder="Cost it...">
                      </div>
                      <div class="form-group">
                        <label for="form-control input-sm m-bot15">Category</label>
                        <select class="form-control input-sm m-bot15" name="cate_product">
                          @foreach ($cate_product as $key => $cate)
                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="form-control input-sm m-bot15">Brand</label>
                        <select class="form-control input-sm m-bot15" name="bra_product">
                        @foreach ($bra_product as $key => $bra)
                          <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="form-control input-sm m-bot15">Active/Unactive</label>
                        <select class="form-control input-sm m-bot15" name="product_status">
                          <option value="0">Hide</option>
                          <option value="1">Show</option>
                        </select>
                      </div>
                      <button type="submit" name="add_product" class="btn btn-info">Add</button>
                  </form>
                  </div>
              </div>
          </section>
  </div>
</div>
  @endsection