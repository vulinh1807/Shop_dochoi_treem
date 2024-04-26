@extends('layout')
@section('content')
<section id="cart_items">
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}">Home</a></li>
        <li class="active">Your shopping cart</li>
      </ol>
    </div><!--/breadcrums-->

    <!--/checkout-options-->

    <div class="register-req">
      <p>Please use Register And Login to easily get access to your order history, or use Checkout as Guest</p>
    </div><!--/register-req-->

    <div class="shopper-informations">
      <div class="row">
        <div class="col-sm-12 clearfix">
          <div class="bill-to">
            <p>Information for shipping</p>
            <div class="form-one">
              <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                {{ csrf_field() }}
                <input type="text" name="shipping_name" placeholder="Shipping Name">
                <input type="text" name="shipping_email" placeholder="Shipping Email*">
                <input type="text" name="shipping_address" placeholder="Address">
                <input type="text" name="shipping_phone" placeholder="Phonenumber">
                <p>Notes about your order</p>
                <textarea name="message" name="shipping_notes" placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                <label><input type="checkbox"> Shipping to bill address</label>
                <input type="submit" value="Send" name="send_order" class="btn btn-primary btn-sm">
              </form>
            </div>
          </div>
        </div>			
      </div>
    </div>
    <div class="review-payment">
      <h2>Review & Payment</h2>
    </div>

    {{-- <div class="table-responsive cart_info">
      <table class="table table-condensed">
        <thead>
          <tr class="cart_menu">
            <td class="image">Item</td>
            <td class="description"></td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="cart_product">
              <a href=""><img src="images/cart/one.png" alt=""></a>
            </td>
            <td class="cart_description">
              <h4><a href="">Colorblock Scuba</a></h4>
              <p>Web ID: 1089772</p>
            </td>
            <td class="cart_price">
              <p>$59</p>
            </td>
            <td class="cart_quantity">
              <div class="cart_quantity_button">
                <a class="cart_quantity_up" href=""> + </a>
                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                <a class="cart_quantity_down" href=""> - </a>
              </div>
            </td>
            <td class="cart_total">
              <p class="cart_total_price">$59</p>
            </td>
            <td class="cart_delete">
              <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
            </td>
          </tr>

          <tr>
            <td class="cart_product">
              <a href=""><img src="images/cart/two.png" alt=""></a>
            </td>
            <td class="cart_description">
              <h4><a href="">Colorblock Scuba</a></h4>
              <p>Web ID: 1089772</p>
            </td>
            <td class="cart_price">
              <p>$59</p>
            </td>
            <td class="cart_quantity">
              <div class="cart_quantity_button">
                <a class="cart_quantity_up" href=""> + </a>
                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                <a class="cart_quantity_down" href=""> - </a>
              </div>
            </td>
            <td class="cart_total">
              <p class="cart_total_price">$59</p>
            </td>
            <td class="cart_delete">
              <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
            </td>
          </tr>
          <tr>
            <td class="cart_product">
              <a href=""><img src="images/cart/three.png" alt=""></a>
            </td>
            <td class="cart_description">
              <h4><a href="">Colorblock Scuba</a></h4>
              <p>Web ID: 1089772</p>
            </td>
            <td class="cart_price">
              <p>$59</p>
            </td>
            <td class="cart_quantity">
              <div class="cart_quantity_button">
                <a class="cart_quantity_up" href=""> + </a>
                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                <a class="cart_quantity_down" href=""> - </a>
              </div>
            </td>
            <td class="cart_total">
              <p class="cart_total_price">$59</p>
            </td>
            <td class="cart_delete">
              <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
            </td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
            <td colspan="2">
              <table class="table table-condensed total-result">
                <tr>
                  <td>Cart Sub Total</td>
                  <td>$59</td>
                </tr>
                <tr>
                  <td>Exo Tax</td>
                  <td>$2</td>
                </tr>
                <tr class="shipping-cost">
                  <td>Shipping Cost</td>
                  <td>Free</td>										
                </tr>
                <tr>
                  <td>Total</td>
                  <td><span>$61</span></td>
                </tr>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </div> --}}
    <div class="payment-options">
        <span>
          <label><input type="checkbox"> Direct Bank Transfer</label>
        </span>
        <span>
          <label><input type="checkbox"> Check Payment</label>
        </span>
        <span>
          <label><input type="checkbox"> Paypal</label>
        </span>
      </div>
  </div>
</section> <!--/#cart_items-->
@endsection