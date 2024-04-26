@extends('layout')
@section('content')
<section id="cart_items">
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}">Home</a></li>
        <li class="active">Your shopping cart</li>
      </ol>
    </div>
    <div class="table-responsive cart_info">
      <?php
      $content = Cart::content();
      ?>
      <table class="table table-condensed">
        <thead>
          <tr class="cart_menu">
            <td class="image">Image of product </td>
            <td class="description">Description</td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          @foreach ($content as $v_content)
          <tr>
            <td class="cart_product">
              <a href="">
                <img src="{{URL::to('public/uploads/products/'.$v_content->option->image)}}" width="50" alt="" />
              </a>
            </td>
            <td class="cart_description">
              <h4><a href="">{{$v_content->name}}</h4>
              <p>Web ID: 1089772</p>
            </td>
            <td class="cart_price">
              <p>{{number_format($v_content->price).' '.'VND'}}</p>
            </td>
            <td class="cart_quantity">
              <div class="cart_quantity_button">
                <form method="POST" action="{{URL::to('/update-cart-quantity')}}">
                  {{ csrf_field() }}
                  {{-- <a class="cart_quantity_up" href=""> + </a> --}}
                  <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->quantity}}" size="2">
                  <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
                  <input type="submit" value="update" name="update_qty" class="btn btn-default btn-sm">
                  {{-- <a class="cart_quantity_down" href=""> - </a> --}}
                </form>
              </div>
            </td>
            <td class="cart_total">
              <p class="cart_total_price">
                <?php
                $subtotal = $v_content->price * $v_content->quantity;
                echo number_format($subtotal).' '.'VND';
                ?>
              </p>
            </td>
            <td class="cart_delete">
              <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
            </td>
          </tr>
            
          @endforeach
          <section id="do_action">
            <div class="container">
              <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="total_area">
                    <ul>
                      <li>Cart Sub Total <span>{{Cart::priceTotal(0,',','.').' '.'VND'}}</span></li>
                      <li>Eco Tax <span>{{Cart::tax(0).' '.'VND'}}</span></li>
                      <li>Shipping Cost <span>Free</span></li>
                      <li>Total <span>$61</span>{{Cart::total(0,',','.').' '.'VND'}}</li>
                    </ul>
                      {{-- <a class="btn btn-default update" href="">Update</a> --}}
                      <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Check Out</a>
                  </div>
                </div>
              </div>
            </div>
          </section><!--/#do_action-->
        </tbody>
      </table>
    </div>
  </div>
</section> <!--/#cart_items-->

@endsection