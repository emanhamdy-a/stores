@extends('layouts.site')

@section('slider')
<div id="displayTop" class="displaytopthree pt-2">
  <div class="container">
    <div class="row">
      <div class="nov-row  col-lg-12 col-xs-12">
        <div class="nov-row-wrap row">
          <div class="nov-html col-xl-3 col-lg-3 col-md-3">
            <div class="block">
              <div class="block_content">

              </div>
            </div>
          </div>
          <div id="nov-slider" class="slider-wrapper theme-default
             col-xl-9 col-lg-9 col-md-9 col-md-12" data-effect="random" data-slices="15" data-animspeed="500"
            data-pausetime="10000" data-startslide="0" data-directionnav="false" data-controlnav="true"
            data-controlnavthumbs="false" data-pauseonhover="true" data-manualadvance="false" data-randomstart="false">
            <div class="nov_preload">
              <div class="process-loading active">
                <div class="loader">
                  @isset($sliders)
                  @foreach($sliders as $slider)
                  <div class="dot"></div>
                  @endforeach
                  @endisset

                </div>
              </div>
            </div>
            <div class="nivoSlider">
              @isset($sliders)
                @foreach($sliders as $slider)
                <a href="#">
                  <img src="{{ slider_img($slider -> photo) }}" alt="" title="">
                </a>
                @endforeach
              @endisset
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('content')

<div id="main">
  <section id="content" class="page-home pagehome-three">
    <div class="container">
      <div class="row">
        <!--  banner 1 -->
        <div class="nov-row spacing-30 mt-15 col-lg-12 col-xs-12">
          <div class="nov-row-wrap row">
            <div class="nov-image col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <div class="effect">
                    <a href="#">
                      <img class="img-fluid"
                        src="{{ theme_img('1.jpg') }}" alt="banner3-1" title="banner3-1"></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="nov-image col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <div class="effect">
                    <a href="#">
                    <img class="img-fluid"
                      src="{{ theme_img('2.jpg') }}"
                      alt="banner3-1" title="banner3-1"></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="nov-image col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <div class="effect">
                    <a href="#">
                    <img class="img-fluid"
                      src="{{ theme_img('3.jpg') }}"
                      alt="banner3-1"  title="banner3-1"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="nov-row  col-lg-12 col-xs-12">
          <div class="nov-row-wrap row">
            @if($flash_deal)
            <div class="nov-productlist nov-countdown-productlist col-xl-4 col-lg-4 col-md-4  col-xs-12 col-md-12">
              <div class="block block-product clearfix">
                <h2 class="title_block">
                  {{ __('front/home.flash deals') }}
                </h2>
                <div class="block_content">
                  <div id="productlist1326409273"
                    class="product_list countdown-productlist countdown-column-1 owl-carousel owl-theme"
                    data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="30"
                    data-dots="false" data-nav="true" data-items="1" data-items_large="1" data-items_tablet="2"
                    data-items_mobile="1">
                    <div class="item item-list">

                      <div class="product-miniature js-product-miniature first_item" data-id-product="{{ $flash_deal->id }}"
                        data-id-product-attribute="232"
                        itemscope="" itemtype="">
                        <div class="thumbnail-container">

                        <a href="#!"
                          class="thumbnail product-thumbnail two-image">
                          <img class="img-fluid image-cover"
                            src="{{ product_img($flash_deal->main_image) }}" alt=""
                            data-full-size-image-url="{{ product_img($flash_deal->main_image) }}"
                            width="600" height="600">
                          <img class="img-fluid image-secondary"
                            src="{{ product_img($flash_deal->main_image) }}" alt=""
                            data-full-size-image-url="{{ product_img($flash_deal->main_image) }}"
                            width="600" height="600">
                        </a>

                          <div class="product-flags discount">Sale</div>

                        </div>
                        <div class="product-description">
                          <div class="product-groups">

                            <div class="product-title" itemprop="name">
                              <a  href="{{ route('product.details',$flash_deal->slug) }}">
                              {{ $flash_deal->name }}
                              </a>
                            </div>
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
                            <p class="seller_name">
                              <a title="View seller profile" href="#!">
                                <i class="fa fa-brand"></i>
                                {{ $flash_deal->brand->name }}
                              </a>
                            </p>
                            <div class="product-group-price">
                              <div class="product-price-and-shipping">
                                <span itemprop="price" class="price">
                                {{ $flash_deal->special_price}}
                                </span>
                                <span class="regular-price">
                                {{ $flash_deal->price}}
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="product-buttons d-flex justify-content-center" itemprop="offers" itemscope=""
                            itemtype="http://schema.org/Offer">
                            <form action="" method="post"
                              class="formAddToCart">
                              <input type="hidden" name="token" value="28add935523ef131c8432825597b9928">
                              <input type="hidden" name="id_product" value="12">
                              <a class="add-to-cart" href="#" data-button-action="add-to-cart"><i
                                  class="novicon-cart"></i><span>Add to cart</span></a>
                            </form>

                            <a class="addToWishlist wishlistProd_12" href="#" data-rel="12"
                              onclick="WishlistCart('wishlist_block_list', 'add', '12', false, 1); return false;">
                              <i class="fa fa-heart"></i>
                              <span>Add to Wishlist</span>
                            </a>
                            <a href="#" class="quick-view hidden-sm-down" data-link-action="quickview">
                              <i class="fa fa-search"></i><span> Quick view</span>
                            </a>
                          </div>

                        </div>
                        <div class="countdownfree d-flex"
                         data-date="2021/12/30">
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif

            @include('front.home_includes.new_arrivals')

          </div>
        </div>
        <!--  banner 2 -->
        <div class="nov-row spacing-30 col-lg-12  col-xs-12">
          <div class="nov-row-wrap row">
            <div class="nov-image col-lg-6 col-md-6">
              <div class="block">
                <div class="block_content">
                  <div class="effect">
                    <a href="#"> <img class="img-fluid"
                    src="{{ theme_img('4.jpg') }}" alt="banner-4"
                      title="banner-4"></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="nov-image col-lg-6 col-md-6">
              <div class="block">
                <div class="block_content">
                  <div class="effect">
                    <a href="#"> <img class="img-fluid"
                    src="{{ theme_img('5.jpg') }}" alt="banner-5"
                        title="banner-5"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @include('front.home_includes.trending_bestseller')

        <div class="nov-row policy-home col-lg-12 col-xs-12">
          <div class="nov-row-wrap row">
            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <div class="policy-row"><i class="noviconpolicy noviconpolicy-1"></i>
                    <div class="policy-content">
                      <div class="policy-name">
                      {{ __('front/home.free delivery') }}
                      </div>
                      <div class="policy-des">
                      {{ __('front/home.free delivery text') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <div class="policy-row"><i class="noviconpolicy noviconpolicy-2"></i>
                    <div class="policy-content">
                      <div class="policy-name">
                        {{ __('front/home.money back guarantee') }}
                      </div>
                      <div class="policy-des">
                        {{ __('front/home.money back guarantee text') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <div class="policy-row"><i class="noviconpolicy noviconpolicy-3"></i>
                    <div class="policy-content">
                      <div class="policy-name">
                        {{ __('front/home.authenticity guaranteed') }}
                      </div>
                      <div class="policy-des">
                        {{ __('front/home.authenticity guaranteed text') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @include('front.home_includes.categories')

      </div>
    </div>
  </section>
</div>
@stop
