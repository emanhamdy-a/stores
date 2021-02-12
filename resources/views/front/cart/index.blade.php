@extends('layouts.site')

@section('content')
<nav data-depth="1" class="breadcrumb-bg">
  <div class="container no-index">
    <div class="breadcrumb">

    </div>
  </div>
</nav>

<div class="container no-index pb-5">
  <div class="row">
    <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <section id="main">

        <h1 class="page-title">
          {{ __('front/cart.shopping cart') }}

        </h1>
        <div class="cart-grid row">
          <div class="cart-grid-body col-xs-12 col-lg-9">
            <!-- cart products detailed -->
            <div class="cart-container">
              <div class="cart-overview js-cart" data-refresh-url="">
                @isset($basket)
                <ul class="cart-items">
                  @foreach($basket -> all() as $product)
                  <li class="cart-item mb-1">
                    <div class="product-line-grid row spacing-10">
                      <!--  product left content: image-->
                      <div class="product-line-grid-left col-sm-2 col-xs-4">
                        <span class="product-image media-middle">
                          <img class="img-fluid" src="{{ product_img($product ->main_image) }}"
                            alt="Vehicula vel tempus sit amet ulte">
                        </span>
                      </div>

                      <!--  product left body: description -->
                      <div class="product-line-grid-body col-sm-10 col-xs-8">
                        <div class="row">
                          <div class="col-sm-6 col-xs-12">
                            <div class="product-line-info">
                              <a class="label" href="{{route('product.details',$product -> slug)}}"
                                data-id_customization="0">{{$product -> name}}</a>
                            </div>

                            <div class="product-line-info product-price">
                              <span itemprop="price"
                                class="price">{{$product -> special_price ?? $product -> price }}</span>
                              @if($product -> special_price)
                              <span class="regular-price">{{$product -> price}}</span>
                              @endif

                            </div>

                          </div>
                          <div class="text-center product-line-actions col-sm-6 col-xs-12">
                            <div class="row">
                              <div class="col-sm-9 col-xs-12">
                                <div class="row">
                                  <div class="col-md-6 col-xs-6 qty">
                                    <div class="label">
                                      {{ __('front/cart.qty') }}
                                    </div>
                                    <div class="input-group
                                      bootstrap-touchspin">
                                      <span class="input-group-addon
                                        bootstrap-touchspin-prefix" style="display: none;">
                                      </span>
                                      <input id="quantity_wanted" class="js-cart-line-product-quantity form-control"
                                        data-product-id="5" type="text" value="1" name="product-quantity-spin" min="1"
                                        style="display: block;">
                                      <span class="input-group-addon
                                        bootstrap-touchspin-postfix" style="display: none;">
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-3 col-xs-12 text-xs-right align-self-end">
                                <div class="cart-line-product-actions shop-item">
                                  <a onclick="$(this).closest('.cart-item').remove()" class="remove-from-cart"
                                    rel="nofollow" data-link-action="delete-from-cart"
                                    data-id-product="{{$product -> id}}"
                                    data-url-product="{{route('site.cart.update',$product -> slug)}}"
                                    data-id-customization="">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </li>
                  @endforeach
                </ul>
                @endisset
              </div>
            </div>
            <a class="label btn btn-primary" href="{{ route('home') }}">
              {{ __('front/cart.continue shopping') }}
            </a>
            <!-- shipping informations -->
          </div>
          <!-- Right Block: cart subtotal & cart total -->
          <div class="cart-grid-right col-xs-12 col-lg-3">
            <div class="cart-summary">
              <div class="cart-detailed-totals">
                <div class="cart-summary-products">
                  <div class="summary-label items-count">
                    {{ __('front/cart.items in cart',['count'=>$basket -> itemCount()]) }}
                  </div>
                </div>
                <div class="">
                  <div class="cart-summary-line cart-total">
                    <span class="label">

                      {{ __('front/cart.total') }}
                    </span>
                    <span class="value total">{{$basket  -> subTotal()}}</span>
                  </div>
                </div>
              </div>

              <div class="checkout  card-block ">
                <a href="{{route('payment',$basket -> subTotal())}}" type="button" class="btn btn-primary">
                  {{ __('front/cart.proceed to payment') }}
                </a>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@include('front.includes.alert')
@include('front.includes.alert2')
@stop
@section('scripts')
<script>
$(document).on('click', '.cart-summary', function() {
  let cart_count = $('.cart-products-count').text();
  cart_count--;
  $('.cart-products-count').text(cart_count);
});
$(document).on('click', '.close', function() {
  $('.quickview-modal-product-details-' + $(this).attr('data-product-id')).css("display", "none");
  $('.alert-modal').css("display", "none");
  $('.alert-modal2').css("display", "none");
});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('click', '.remove-from-cart', function(e) {
  e.preventDefault();
  $.ajax({
    type: 'post',
    url: $(this).attr('data-url-product'),
    data: {
      'product_id': $(this).attr('data-id-product'),
    },
    success: function(data) {
      if (data) {
        $('.alert-modal').css('display', 'block');
        $('.alert-text').text(data.msg);
        $('.items-count').text(data.count);
        $('.total').text(data.total);
        let cart_count = $('.cart-products-count').text();
        cart_count--;
        $('.cart-products-count').text(cart_count);
      }
    }
  });
});
</script>
@stop
