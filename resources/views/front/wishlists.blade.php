@extends('layouts.site')

@section('content')

<nav data-depth="3" class="breadcrumb-bg">
  <div class="container no-index">
    <div class="breadcrumb">

      <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
          <a itemprop="item" href="{{route('home') }}">
            <span itemprop="name">{{ __('front\wishlists.home') }}</span>
          </a>
          <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
          <a itemprop="item" href="36-mini-speaker.html">
            <span itemprop="name">{{ __('front\wishlists.favorit list') }}</span>
          </a>
          <meta itemprop="position" content="3">
        </li>
      </ol>

    </div>
  </div>
</nav>
<div class="container no-index">
  <div class="row">
    <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <section id="main">
        <div class="block-category hidden-sm-down">
          <h1 class="h1">{{ __('front\wishlists.favorit list') }}</h1>
        </div>
        <section id="products">

          <div id="nav-top">

            <div id="js-product-list-top" class="row products-selection">
              <div class="col-md-6 col-xs-6">
                <div class="change-type">
                  <span class="grid-type active" data-view-type="grid"><i class="fa fa-th-large"></i></span>
                  <span class="list-type" data-view-type="list"><i class="fa fa-bars"></i></span>
                </div>
                <div class="hidden-sm-down total-products">
                  <p>There are {{count($products) ?? '0'}} products.</p>
                </div>
              </div>
            </div>

          </div>
          <div id="categories-product">
            <div id="js-product-list">
              <div class="products product_list grid row" data-default-view="grid">
                @isset($products)
                @foreach($products as $product)

                <div class="item  col-lg-4 col-md-6 col-xs-12 text-center">
                  <div class="product-miniature js-product-miniature item-one" data-id-product="22"
                    data-id-product-attribute="408" itemscope="" itemtype="http://schema.org/Product">
                    <div class="thumbnail-container">
                      <a href="{{route('product.details',$product -> slug)}}"
                        class="thumbnail product-thumbnail two-image">
                        <img class="img-fluid image-cover" src="{{product_img($product -> main_image)}}" alt=""
                          data-full-size-image-url="{{product_img($product -> main_image)}}" width="600" height="600">
                        <img class="img-fluid image-secondary" src="{{product_img($product -> main_image)}}" alt=""
                          data-full-size-image-url="{{product_img($product -> main_image)}}" width="600" height="600">
                      </a>
                      @if($product->isNew())
                      <div class="product-flags new">
                        {{ __('front\wishlists.new') }}
                      </div>
                      @endif
                    </div>
                    <div class="product-description">
                      <div class="product-groups">

                        <div class="group-reviews">
                          <!-- <div class="product-comments">
                            <div class="star_content">
                              <div class="star"></div>
                              <div class="star"></div>
                              <div class="star"></div>
                              <div class="star"></div>
                              <div class="star"></div>
                            </div>
                            <span>0 review</span>
                          </div> -->
                          <div class="info-stock ml-auto">
                            <label class="control-label">
                              {{ __('front\wishlists.availability') }}</label>
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            {{$product -> in_stock ? 'in stock' : 'out of stock'}}
                          </div>
                        </div>

                        <div class="product-title" itemprop="name"><a
                            href="{{route('product.details',$product -> slug)}}">{{$product -> name}}</a>
                        </div>

                        <div class="product-group-price">
                          <div class="product-price-and-shipping">
                            <span itemprop="price"
                              class="price">{{$product -> special_price ?? $product -> price }}</span>
                            @if($product -> special_price)
                            <span class="regular-price">{{$product -> price}}</span>
                            @endif

                          </div>
                        </div>

                        <div class="product-desc" itemprop="desciption">
                          {!! $product -> description !!}
                        </div>
                      </div>
                      <div class="product-buttons d-flex justify-content-center" itemprop="offers" itemscope=""
                        itemtype="http://schema.org/Offer">

                        <form action="" class="formAddToCart" method="post">
                          <a class="add-to-cart" href="#!" data-product-id="{{ $product -> id }}"
                            data-slug="{{ $product -> slug }}">
                            <i class="novicon-cart"></i>
                            <span>{{ __('front\wishlists.add to cart') }}</span>
                          </a>
                        </form>

                        <!-- </form> -->
                        <!-- <form action="" class="formAddToCart" method="post"> -->
                        <a class="addToWishlist removeFromWishlist
                            wishlistProd_22" href="#"
                          data-product-id="{{$product -> id}}">
                          <i class="fa fa-heart"></i>
                          <span>{{ __('front\wishlists.remove from wishlist') }}</span>
                        </a>

                        <a href="#" class="quick-view hidden-sm-downadd-to-cart" data-product-id="{{$product -> id}}">
                          <i class="fa fa-eye"></i><span>
                            {{ __('front\wishlists.quick view') }}
                          </span>
                        </a>

                      </div>
                    </div>
                  </div>
                </div>

                @include('front.includes.product-details',$product)
                @endforeach
                @endisset
              </div>
            </div>

          </div>

        </section>
      </section>
    </div>
  </div>
</div>

@include('front.includes.not-logged')
@include('front.includes.alert')
@include('front.includes.alert2')

@stop

@section('scripts')

@include('front.includes.js.addToCartAndWishlist')

<script>
  $(document).on('click', '.removeFromWishlist', function(e) {
    e.preventDefault();

    @guest()
    $('.not-loggedin-modal').css('display', 'block');
    @endguest

    $.ajax({
      type: 'delete',
      url: "{{Route('wishlist.destroy')}}",
      data: {
        'productId': $(this).attr('data-product-id'),
      },
      success: function(data) {
        location.reload();
      }
    });
  });
</script>
@stop
