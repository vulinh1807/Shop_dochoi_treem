@extends('admin_layout');
@section('admin_content')
<div class="row">
  <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                 Edit new brand
                <?php
                 $message = Session::get('', 'message');
                 if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                 }
                ?>
              </header>
              <div class="panel-body">
                @foreach ($edit_brand_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product/.$edit_value->brand_id')}}" method="POST">
                      {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="add_name_brand"
                        class="form-control" id="exampleInputEmail1" placeholder="Name it..." value="{{$edit_value -> brand_name}}">
                    </div>
                    <div class="form-group">
                        <label for="brand_product_des">Description</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="brand_product_des">{{$edit_value->brand_desc}}</textarea>
                    </div>
                    <button type="submit" name="edit_brand_product" class="btn btn-info">Edit</button>
                </form>
                </div>
                @endforeach
              </div>
          </section>
  </div>
</div>
  @endsection