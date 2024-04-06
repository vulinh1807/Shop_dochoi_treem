@extends('admin_layout');
@section('admin_content')
<div class="row">
  <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                 Add new brand
                <?php
                 $message = Session::get('', 'message');
                 if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                 }
                ?>
              </header>
              <div class="panel-body">
                  <div class="position-center">
                      <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
                        {{ csrf_field() }}
                      <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="add_name_brand"
                          class="form-control" id="exampleInputEmail1" placeholder="Name it...">
                      </div>
                      <div class="form-group">
                          <label for="brand_product_des">Description</label>
                          <textarea style="resize: none" rows="5" class="form-control" name="brand_product_des" placeholder="How is it..."></textarea>
                      </div>
                      <div class="form-group">
                        <label for="form-control input-sm m-bot15">Show items</label>
                        <select class="form-control input-sm m-bot15" name="brand_product_status">
                          <option value="0">Unactive</option>
                          <option value="1">Active</option>
                      </select>
                      </div>
                      <button type="submit" name="add_brand_product" class="btn btn-info">Add</button>
                  </form>
                  </div>
              </div>
          </section>
  </div>
</div>
  @endsection