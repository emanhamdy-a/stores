@extends('layouts.site')

@section('content')

<div id="wrapper-site">

  <nav data-depth="3" class="breadcrumb-bg">
    <div class="container no-index">
      <div class="breadcrumb">
        @if(count($errors->all()) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @include('dashboard.includes.alerts.success')
        @include('dashboard.includes.alerts.errors')
      </div>
    </div>
  </nav>

  <div class="no-index">
    <div id="content-wrapper">

      <section id="main" itemscope="" itemtype="https://schema.org/Product">
        <div class="product-detail-top">
          <div class="container">
            <div class="row main-productdetail" data-product_layout_thumb="list_thumb" style="position: relative;">
              <div class="col-lg-5 col-md-4 col-xs-12 box-image">
                <section class="page-content" id="content">
                  <div class="images-container list_thumb">
                    <div class="product-cover">
                      <img class="js-qv-product-cover img-fluid" src="{{ product_img($product->main_image)}}" alt=""
                        title="" style="width:100%;" itemprop="image">
                      <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                        <i class="fa fa-expand"></i>
                      </div>
                    </div>

                    <div class="js-qv-mask mask only-product">
                      <div class="row">
                        @isset($product -> images)
                        @foreach($product -> images as $image)
                        <div class="item thumb-container col-md-6 col-xs-12 pt-30">
                          <img class="img-fluid thumb js-thumb  selected "
                            data-image-medium-src="{{ product_img($image -> photo)}}"
                            data-image-large-src="{{ product_img($image -> photo)}}"
                            src="{{ product_img($image -> photo)}}" alt="" title="" itemprop="image">
                        </div>
                        @endforeach
                        @endisset
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <div class="col-lg-7 col-md-8 col-xs-12 mt-sm-20">
                <div class="product-information">
                  <div class="product-actions">
                    <!-- add to cart -->
                    <form action="{{route('site.cart.add',$product -> slug )}}" method="get" id="add-to-cart-or-refresh"
                      class="row">
                      @csrf
                      <input type="hidden" name="id_product" value="{{$product -> id }}" id="product_page_product_id">

                      <input type="hidden" name="product_slug" value="{{$product -> slug }}">

                      <div class="productdetail-right col-12 col-lg-6 col-md-6">
                        <div class="product-reviews">
                          <div id="product_comments_block_extra">

                            <div class="comments_note">
                              <span>Review: </span>
                              <div class="star_content clearfix">
                                @for($i = 1 ; $i <= 5 ; $i ++) @if($product->review_stars() < $i) <div class="star">
                              </div>
                              @else
                              <div class="star star_on"></div>
                              @endif
                              @endfor
                            </div>
                          </div>
                          <!-- review -->

                          <!-- review -->
                          <div class="comments_advices">
                            <a data-toggle="tab" href="#reviews"
                             class="comments_advices_tab"><i class="fa fa-comments"></i>
                              {{ __('front\product_details.read reviews') }}
                            </a>
                            <!-- (1) -->
                            <a class="open-comment-form" data-toggle="modal" data-target="#new_comment_form" href="#"><i
                                class="fa fa-edit"></i>
                              {{ __('front\product_details.write your review') }}
                            </a>
                          </div>
                        </div>
                        <!-- Module NovProductComments -->
                      </div>

                      <h1 class="detail-product-name" itemprop="name">{{$product -> name}}</h1>
                      <div class="group-price d-flex justify-content-start align-items-center">
                        <div class="product-prices">
                          <div class="product-price " itemprop="offers" itemscope=""
                            itemtype="https://schema.org/Offer">
                            <div class="current-price">
                              <span itemprop="price"
                                class="price">{{$product -> special_price ?? $product -> price }}</span>
                              @if($product -> special_price)
                              <span class="regular-price">{{$product -> price}}</span>
                              @endif
                            </div>
                          </div>
                          <div class="tax-shipping-delivery-label">
                            {{ __('front\product_details.tax included') }}
                          </div>
                        </div>

                      </div>

                      <div class="in_border end">

                        <div class="sku">
                          <label class="control-label">Sku:</label>
                          <span itemprop="sku" content="demo_1">{{$product -> sku ?? '--'}}</span>
                        </div>
                        <div class="pro-cate">
                          <label class="control-label">
                            {{ __('front\product_details.categories') }}
                          </label>

                          @isset($product -> categories)
                          <div>
                            @foreach($product -> categories as $category )
                            <span><a href="{{route('category',$category -> slug )}}"
                                title="Computer &amp; Networking">{{$category -> name}}</a></span>
                            @endforeach
                          </div>
                          @endisset
                        </div>
                        <div class="pro-tag">
                          <label class="control-label">
                            {{ __('front\product_details.tags') }}
                          </label>
                          @isset($product -> tags)
                          <div>
                            @foreach($product -> tags as $tag )
                            <span><a href="">{{$tag -> name}}</a></span>
                            @endforeach
                          </div>
                          @endisset
                        </div>
                      </div>

                      <div id="_desktop_productcart_detail">
                        <div class="product-add-to-cart in_border">
                          <div class="add">
                            <a class="btn btn-primary add-to-cart" id="addToCart" data-slug="{{$product -> slug}}"
                              href="{{route('site.cart.add',$product -> slug )}}">
                              <div class="icon-cart">
                                <i class="shopping-cart"></i>
                              </div>
                              <span>
                                {{ __('front\product_details.add to cart') }}
                              </span>
                            </a>
                          </div>

                          <a class="addToWishlist  wishlistProd_22" href="#" data-product-id="{{$product -> id}}">
                            <i class="fa fa-heart"></i>
                            <span>
                              {{ __('front\product_details.add to wishlist')}}
                            </span>
                          </a>

                          <div class="clearfix"></div>

                          <div id="product-availability" class="info-stock mt-20">
                            <label class="control-label">
                              {{ __('front\product_details.availability') }}
                            </label>
                            {{$product -> in_stock ?
                               __('front\product_details.in stock') :
                               __('front\product_details.out of stock')}}
                          </div>
                        </div>
                      </div>

                      <input class="product-refresh ps-hidden-by-js" name="refresh" type="submit" value="Refresh">

                  </div>
                  <div class="productdetail-left col-12 col-lg-6 col-md-6">


                    <div class="product-quantity">
                      <span class="control-label">
                        {{ __('front\product_details.quantity') }}
                      </span>
                      <div class="qty">
                        <input type="text" name="qty" id="quantity_wanted" value="1" class="input-group" min="1">
                      </div>
                    </div>

                    <!-- attributes -->

                    <div class="product-variants in_border">
                      @if(isset($product_attribute) && count($product_attributes) > 0 )
                      @foreach($product_attributes as $attribute)
                      <div class="product-variants-item">
                        <span class="control-label">
                          {{$attribute -> name}} :
                        </span>
                        @if(isset($attribute -> options) && count($attribute -> options) > 0 )
                        <select id="group_1" data-product-attribute="1" name="{{$attribute -> name}}">
                          @foreach($attribute -> options as $option)
                          <option value="1" title="S" selected="selected">
                            {{$option -> name}}
                          </option>
                          @endforeach
                        </select>
                        @endif

                      </div>
                      @endforeach
                      @endif
                    </div>

                  </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="product-detail-middle">
      <div class="container">
        <div class="row">
          <div class="tabs col-lg-9 col-md-7 ">
            <ul class="nav nav-tabs">

              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" aria-expanded="true" href="#product-details">
                  {{ __('front\product_details.product details') }}
                </a>
              </li>
              <!-- review -->
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reviews">
                  {{ __('front\product_details.write your own review') }}
                  <span class='count-comment'>
                    ({{ $product->reviews->count() ?? '0' }})</span>
                </a>
              </li>

            </ul>

            <div class="tab-content" id="tab-content">

              <div class="tab-pane fade active in" id="product-details">
                <section class="product-features">
                  <h3>{!! $product -> description !!}</h3>
                </section>
              </div>

              <!-- review -->
              <div class="tab-pane fade in" id="reviews">
                @isset($product -> reviews)
                @foreach($product -> reviews as $review)
                <div id="product_comments_block_tab">
                  <div class="comment clearfix">
                    <div class="comment_author">
                      <span>
                        {{ __('front\product_details.grade') }}
                      </span>
                      <div class="star_content clearfix">
                        @for($i = 1 ; $i <= 5 ; $i ++) @if($review->review < $i) <div class="star">
                      </div>
                      @else
                      <div class="star star_on"></div>
                      @endif
                      @endfor
                    </div>
                    <div class="comment_author_infos">
                      <div class="user-comment">
                        <i class="fa fa-user"></i>
                        {{ $review->user->name }}
                      </div>
                      <div class="date-comment">
                        {{ $review->created_at->diffForHumans()}}
                      </div>
                    </div>
                  </div>
                  <div class="comment_details">
                    <h4> {{ $review->title }}</h4>
                    <p> {{ $review->content }}</p>
                  </div>
                </div>
              </div>
              @endforeach
              @endisset
              <p class="text-center mt-10">
                <a id="new_comment_tab_btn" class="open-comment-form btn btn-default" data-toggle="modal"
                  data-target="#new_comment_form" href="#">
                  {{ __('front\product_details.write your review') }}
                </a>
              </p>
            </div>


            <div class="modal fade in" id="new_comment_form" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title text-xs-center"><i class="fa fa-edit"></i>
                      {{ __('front\product_details.write your review') }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="material-icons close">
                      </i>
                      {{ __('front\product_details.close') }}
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- /end new_comment_form_content -->
                    <form id="" method='post' action="{{ route('products.reviews.store') }}">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                      <input type="hidden" name="product_id" value='{{ $product->id }}'>
                      <div class="product row no-gutters">
                        <div class="product-image col-4">
                          <img class="img-fluid" src="{{ product_img($product->main_image) }}" height="" width="">
                        </div>
                        <div class="product_desc col-8">
                          <p class="product_name">
                            {{ $product->name }}</p>
                          <p>{{ $product->description }}</p>
                        </div>
                      </div>
                      <div class="new_comment_form_content">
                        <ul id="criterions_list">
                          <li>
                            <label>
                              {{ __('front\product_details.quality') }}
                            </label>
                            <style>
                            input[type='radio'] {
                              width: 1px !important;
                            }
                            </style>
                            <div class="product-comments">
                              <div class="star_content">

                                <label for="r_1" class='star_r' id=''>
                                  <div class="star r_1"></div>
                                </label>
                                <input id=r_1 type="radio" name="review" value="1">

                                <label for="r_2" class='star_r' id=''>
                                  <div class="star r_2"></div>
                                </label>
                                <input id=r_2 type="radio" name="review" value="2">

                                <label for="r_3" class='star_r' id=''>
                                  <div class="star r_3"></div>
                                </label>
                                <input id=r_3 type="radio" name="review" value="3">

                                <label for="r_4" class='star_r' id=''>
                                  <div class="star r_4"></div>
                                </label>
                                <input id=r_4 type="radio" name="review" value="4">

                                <label for="r_5" class='star_r' id=''>
                                  <div class="star r_5"></div>
                                </label>
                                <input id=r_5 type="radio" name="review" value="5">

                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </li>
                        </ul>
                        <label for="comment_title">
                          {{ __('front\product_details.title for your review') }}
                          <sup class="required">*</sup>
                        </label>
                        <input id="comment_title" name="title" type="text" value="">

                        <label for="content">
                          {{ __('front\product_details.your review') }}
                          <sup class="required">*</sup>
                        </label>
                        <textarea id="content" name="content"></textarea>

                        <div>
                          <button class="btn btn-primary" type="submit">
                            {{ __('front\product_details.send') }}
                          </button>
                        </div>

                      </div>
                    </form>
                    <!-- /end new_comment_form_content -->

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-3 col-md-5">

          <div class="nov-html col-xl-12 col-lg-12 col-md-12 policy-product no-padding">
            <div class="block">
              <div class="block_content">
                <div class="policy-row d-flex">
                  <div class="icon-policy"><i class="noviconpolicy noviconpolicy-1">1</i></div>
                  <div class="policy-content">
                    <div class="policy-name">
                      {{ __('front\product_details.free delivery') }}
                    </div>
                    <div class="policy-des">
                      {{ __('front\product_details.free delivery text') }}
                    </div>
                  </div>
                </div>
                <div class="policy-row d-flex">
                  <div class="icon-policy"><i class="noviconpolicy noviconpolicy-2">2</i></div>
                  <div class="policy-content">
                    <div class="policy-name">
                      {{ __('front\product_details.money back') }}
                    </div>
                    <div class="policy-des">
                      {{ __('front\product_details.money back text') }}
                    </div>
                  </div>
                </div>
                <div class="policy-row d-flex">
                  <div class="icon-policy"><i class="noviconpolicy noviconpolicy-3">3</i></div>
                  <div class="policy-content">
                    <div class="policy-name">
                      {{ __('front\product_details.authenticity') }}
                    </div>
                    <div class="policy-des">
                      {{ __('front\product_details.authenticity text') }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="product-detail-bottom">
    <div class="container">

      <section class="relate-product product-accessories clearfix">
        <h3 class="h5 title_block">
          {{ __('front\product_details.related products') }}
        </h3>
        <div class="block_content">
          <div id="productlist2289580" class="product_list grid owl-carousel owl-theme multi-row" data-autoplay="false"
            data-autoplaytimeout="9000" data-loop="false" data-margin="15" data-dots="false" data-nav="true"
            data-items="4" data-items_large="3" data-items_tablet="3" data-items_mobile="2">
            @if( isset($related_products) && count($related_products) > 0 )
            <?php $i=0 ?>
            @foreach($related_products as $product)
            @if(!($i % 4))
            <div class="item  text-center">
              @endif

              <div class="product-miniature js-product-miniature item-one first_item"
                data-id-product="{{ $product->id }}" data-id-product-attribute="40" itemscope="" itemtype="">

                <div class="thumbnail-container">

                  <a href="#!" class="thumbnail product-thumbnail two-image">
                    <img class="img-fluid image-cover" src="{{ product_img($product->main_image)}}" alt=""
                      data-full-size-image-url="{{ product_img($product->main_image)}}" width="600" height="600">
                    <img class="img-fluid image-secondary" src="{{ product_img($product->main_image)}}" alt=""
                      data-full-size-image-url="{{ product_img($product->main_image)}}" width="600" height="600">
                  </a>

                </div>

                <div class="product-description">
                  <div class="product-groups">

                    <div class="product-comments">
                      <div class="star_content">
                        <div class="star @if($product->review_stars() >= 1) star_on @endif"></div>
                        <div class="star @if($product->review_stars() >= 2) star_on @endif"></div>
                        <div class="star @if($product->review_stars() >= 3) star_on @endif"></div>
                        <div class="star @if($product->review_stars() >= 4) star_on @endif"></div>
                        <div class="star @if($product->review_stars() >= 5) star_on @endif"></div>
                      </div>
                      <span>5 review</span>
                    </div>

                    <p class="seller_name">
                      <a title="View seller profile" href="#!">
                        <!-- <i class="fa fa-user"></i> -->
                        {{ $product->brand->name }}
                      </a>
                    </p>

                    <div class="product-title" itemprop="name">
                      <a href="{{ route('product.details',$product->slug) }}">
                        {{ Str::limit($product->name,25) }}
                      </a>
                    </div>

                    <div class="product-group-price">

                      <div class="product-price-and-shipping">
                        @if(!empty($product->special_price))
                        <span itemprop="price" class="price">
                          {{ $product->special_price }}
                        </span>
                        <span class="regular-price">
                          {{ $product->price}}
                        </span>
                        @else
                        <span itemprop="price" class="price">
                          {{ $product->price }}
                        </span>
                        @endif
                      </div>

                    </div>

                  </div>

                  <div class="product-buttons d-flex justify-content-center" itemprop="offers" itemscope=""
                    itemtype="http://schema.org/Offer">
                    <form action="" class="formAddToCart" method="post">
                      <a class="add-to-cart" href="#!" data-slug="{{ $product -> slug }}"
                        data-product-id="{{$product -> id}}">
                        <i class="novicon-cart"></i>
                        <span>
                          {{ __('front\product_details.add to cart') }}
                        </span>
                      </a>
                    </form>

                    <a class="addToWishlist  wishlistProd_22" href="#!" data-product-id="{{$product -> id}}">
                      <i class="fa fa-heart"></i>
                      <span>
                        {{ __('front\product_details.add to wishlist') }}
                      </span>
                    </a>

                    <a href="#!" class="quick-view hidden-sm-down" data-product-id="{{$product -> id}}"
                      data-link-action="quickview">
                      <i class="fa fa-eye"></i>
                      <span>
                        {{ __('front\product_details.quick view') }}
                      </span>
                    </a>
                  </div>

                </div>
              </div>

              @if($i % 4 == 3)
            </div>
            @endif
            <?php $i++ ?>
            @endforeach
            @endif
          </div>
        </div>
      </section>
    </div>
  </div>

  </section>
</div>
</div>
</div>
@if($related_products)
@foreach($related_products as $product)
@include('front.includes.product-details',$product)
@endforeach
@endif

@include('front.includes.not-logged')
@include('front.includes.alert')
@include('front.includes.alert2')
@stop

@section('scripts')
@include('front.includes.js.addToCartAndWishlist')
<script>
$(document).on('click', '.star_r', function() {
  $('.star_r').children().removeClass('star_on');
  $(this).children().addClass('star_on');
  $(this).prevAll().children().addClass('star_on');
});
</script>
@stop
