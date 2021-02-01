@extends('layouts.site')

@section('content')

<div id="wrapper-site">

  <nav data-depth="3" class="breadcrumb-bg">
    <div class="container no-index">
      <div class="breadcrumb">

        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
          <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{route('home') }}">
              <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1">
          </li>

          <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="">
              <span itemprop="name">{{$product -> name}}</span>
            </a>
            <meta itemprop="position" content="3">
          </li>
        </ol>

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

                      <!-- <input type="submit" value='add-to-cart'> -->
                      <div class="productdetail-right col-12 col-lg-6 col-md-6">
                        <div class="product-reviews">
                          <div id="product_comments_block_extra">
                            <div class="comments_note">
                              <span>Review: </span>
                              <div class="star_content clearfix">
                                <div class="star star_on"></div>
                                <div class="star star_on"></div>
                                <div class="star star_on"></div>
                                <div class="star star_on"></div>
                                <div class="star star_on"></div>
                              </div>
                            </div>

                            <div class="comments_advices">
                              <a href="#" class="comments_advices_tab"><i class="fa fa-comments"></i>Read reviews
                                (1)</a>
                              <a class="open-comment-form" data-toggle="modal" data-target="#new_comment_form"
                                href="#"><i class="fa fa-edit"></i>Write your review</a>
                            </div>
                          </div>
                          <!--  /Module NovProductComments -->
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
                              Tax included
                            </div>
                          </div>

                        </div>

                        <div class="in_border end">

                          <div class="sku">
                            <label class="control-label">Sku:</label>
                            <span itemprop="sku" content="demo_1">{{$product -> sku ?? '--'}}</span>
                          </div>
                          <div class="pro-cate">
                            <label class="control-label">Categories:</label>

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
                            <label class="control-label">Tags:</label>
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
                              <a class="btn btn-primary add-to-cart" id="addToCart"
                                data-slug="{{$product -> slug}}"
                                href="{{route('site.cart.add',$product -> slug )}}">
                                <div class="icon-cart">
                                  <i class="shopping-cart"></i>
                                </div>
                                <span>Add to cart</span>
                              </a>
                            </div>

                            <a class="addToWishlist  wishlistProd_22" href="#" data-product-id="{{$product -> id}}">
                              <i class="fa fa-heart"></i>
                              <span>Add to Wishlist</span>
                            </a>

                            <div class="clearfix"></div>

                            <div id="product-availability" class="info-stock mt-20">
                              <label class="control-label">Availability:</label>
                              {{$product -> in_stock ? 'in stock' : 'out of stock'}}
                            </div>
                          </div>
                        </div>

                        <input class="product-refresh ps-hidden-by-js" name="refresh" type="submit" value="Refresh">

                      </div>
                      <div class="productdetail-left col-12 col-lg-6 col-md-6">


                        <div class="product-quantity">
                          <span class="control-label">Quantity : </span>
                          <div class="qty">
                            <input type="text" name="qty" id="quantity_wanted" value="1" class="input-group" min="1">
                          </div>
                        </div>


                        <div class="product-variants in_border">
                          @if(isset($product_attributes) && count($product_attributes) > 0 )
                          @foreach($product_attributes as $attribute)
                          <div class="product-variants-item">
                            <span class="control-label">{{$attribute -> name}} : </span>
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
                    <a class="nav-link active" data-toggle="tab" aria-expanded="true" href="#product-details">Product
                      Detail</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#reviews">Write Your Own
                      Review<span class='count-comment'> (1)</span></a>
                  </li>

                </ul>

                <div class="tab-content" id="tab-content">

                  <div class="tab-pane fade active in" id="product-details">

                    <section class="product-features">
                      <h3>{!! $product -> description !!}</h3>

                    </section>


                  </div>

                  <div class="tab-pane fade in" id="reviews">
                    <div id="product_comments_block_tab">
                      <div class="comment clearfix">
                        <div class="comment_author">
                          <span>Grade&nbsp</span>
                          <div class="star_content clearfix">
                            <div class="star star_on"></div>
                            <div class="star star_on"></div>
                            <div class="star star_on"></div>
                            <div class="star star_on"></div>
                            <div class="star star_on"></div>
                          </div>
                          <div class="comment_author_infos">
                            <div class="user-comment"><i class="fa fa-user-o"></i> dfsfs
                            </div>
                            <div class="date-comment">08/07/2018</div>
                          </div>
                        </div>
                        <div class="comment_details">
                          <h4>fsfdfs</h4>
                          <p>fdfsd</p>
                          <ul>
                            <li>1 out of 2 people found this review useful.</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <p class="text-center mt-10">
                      <a id="new_comment_tab_btn" class="open-comment-form btn btn-default" data-toggle="modal"
                        data-target="#new_comment_form" href="#">Write
                        your review !</a>
                    </p>

                  </div>


                  <div class="modal fade in" id="new_comment_form" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-xs-center"><i class="fa fa-edit"></i> Write your review</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons close">close</i>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /end new_comment_form_content -->
                          <form id="id_new_comment_form" action="#">
                            <div class="product row no-gutters">
                              <div class="product-image col-4">
                                <img class="img-fluid" src="../../24-medium_default/hummingbird-printed-t-shirt.jpg"
                                  height="" width="" alt="Nullam sed sollicitudin mauris">
                              </div>
                              <div class="product_desc col-8">
                                <p class="product_name">Nullam sed sollicitudin
                                  mauris</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer
                                  adipiscing elit. Aenean commodo ligula eget
                                  dolor. Aenean massa. Cum sociis natoque
                                  penatibus et magnis dis parturient montes,
                                  nascetur ridiculus mus. Donec quam felis,
                                  ultricies nec, pellentesque eu, pretium .</p>
                              </div>
                            </div>
                            <div class="new_comment_form_content">
                              <div id="new_comment_form_error" class="error alert alert-danger">
                                <ul></ul>
                              </div>
                              <ul id="criterions_list">
                                <li>
                                  <label>Quality</label>
                                  <div class="star_content">
                                    <input class="star" type="radio" name="criterion[1]" value="1">
                                    <input class="star" type="radio" name="criterion[1]" value="2">
                                    <input class="star" type="radio" name="criterion[1]" value="3">
                                    <input class="star" type="radio" name="criterion[1]" value="4">
                                    <input class="star" type="radio" name="criterion[1]" value="5" checked="checked">
                                  </div>
                                  <div class="clearfix"></div>
                                </li>
                              </ul>
                              <label for="comment_title">Title for your review<sup class="required">*</sup></label>
                              <input id="comment_title" name="title" type="text" value="">

                              <label for="content">Your review<sup class="required">*</sup></label>
                              <textarea id="content" name="content"></textarea>

                              <label>Your name<sup class="required">*</sup></label>
                              <input id="commentCustomerName" name="customer_name" type="text" value="">

                              <div id="new_comment_form_footer">
                                <input id="id_product_comment_send" name="id_product" type="hidden" value='1'>
                                <div class="fl"><sup class="required">*</sup>
                                  Required fields
                                </div>
                                <div class="fr">
                                  <button id="submitNewMessage" data-dismiss="modal" aria-label="Close"
                                    class="btn btn-primary" name="submitMessage" type="submit">Send
                                  </button>
                                </div>
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
                          <div class="policy-name">Free Delivery</div>
                          <div class="policy-des">From $ 250</div>
                        </div>
                      </div>
                      <div class="policy-row d-flex">
                        <div class="icon-policy"><i class="noviconpolicy noviconpolicy-2">2</i></div>
                        <div class="policy-content">
                          <div class="policy-name">Money Back</div>
                          <div class="policy-des">Guarantee</div>
                        </div>
                      </div>
                      <div class="policy-row d-flex">
                        <div class="icon-policy"><i class="noviconpolicy noviconpolicy-3">3</i></div>
                        <div class="policy-content">
                          <div class="policy-name">Authenticity</div>
                          <div class="policy-des">100% guaranteed</div>
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
              <h3
                class="h5 title_block">Related products<span class="sub_title">Hand-picked arrivals from the best
                  designer</span>
              </h3>
              <div class="block_content">
                <div id="productlist2289580" class="product_list grid owl-carousel owl-theme multi-row"
                  data-autoplay="false" data-autoplaytimeout="9000" data-loop="false" data-margin="15" data-dots="false"
                  data-nav="true" data-items="4" data-items_large="3" data-items_tablet="3" data-items_mobile="2">
                  @if( isset($related_products) && count($related_products) > 0 )
                  <?php $i=0 ?>
                  @foreach($related_products as $product)
                    @if(!($i % 4))
                    <div class="item  text-center">
                    @endif

                    <div class="product-miniature js-product-miniature item-one first_item" data-id-product="{{ $product->id }}"
                      data-id-product-attribute="40" itemscope="" itemtype="">

                      <div class="thumbnail-container">

                        <a href="#!"
                          class="thumbnail product-thumbnail two-image">
                          <img class="img-fluid image-cover"
                            src="{{ product_img($product->main_image)}}" alt=""
                            data-full-size-image-url="{{ product_img($product->main_image)}}"
                            width="600" height="600">
                          <img class="img-fluid image-secondary"
                            src="{{ product_img($product->main_image)}}" alt=""
                            data-full-size-image-url="{{ product_img($product->main_image)}}"
                            width="600" height="600">
                        </a>

                      </div>

                      <div class="product-description">
                        <div class="product-groups">

                          <div class="product-comments">
                            <div class="star_content">
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
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
                          <form action="" class="formAddToCart"
                            method="post">
                            <a class="add-to-cart"
                              href="#!"
                              data-slug="{{ $product -> slug }}"
                              data-product-id="{{$product -> id}}">
                              <i class="novicon-cart"></i>
                              <span>Add to cart</span>
                            </a>
                          </form>

                          <a class="addToWishlist  wishlistProd_22"
                            href="#!"
                            data-product-id="{{$product -> id}}">
                            <i class="fa fa-heart"></i>
                            <span>Add to Wishlist</span>
                          </a>

                          <a href="#!" class="quick-view hidden-sm-down"
                            data-product-id="{{$product -> id}}"
                            data-link-action="quickview">
                            <i class="fa fa-eye"></i>
                            <span> Quick view</span>
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
<!-- we can use only one with dynamic text -->
@include('front.includes.alert2')
@stop

@section('scripts')
<script>
$(document).on('click', '.quick-view', function() {
  $('.quickview-modal-product-details-' + $(this).attr('data-product-id')).css("display", "block");
});
$(document).on('click', '.close', function() {
  $('.quickview-modal-product-details-' + $(this).attr('data-product-id')).css("display", "none");

  $('.not-loggedin-modal').css("display", "none");
  $('.alert-modal').css("display", "none");
  $('.alert-modal2').css("display", "none");
});

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('click', '.addToWishlist', function(e) {
  e.preventDefault();

  @guest()
  $('.not-loggedin-modal').css('display', 'block');
  @endguest


  $.ajax({
    type: 'post',
    url: "{{Route('wishlist.store') }}",
    data: {
      'productId': $(this).attr('data-product-id'),
    },
    success: function(data) {
      if (data.wished)
        $('.alert-modal').css('display', 'block');
      else
        $('.alert-modal2').css('display', 'block');
    }
  });

});
// #addToCart
$(document).on('click', '.add-to-cart', function(e) {
  e.preventDefault();

  @guest()
  $('.not-loggedin-modal').css('display', 'block');
  @endguest

  $.ajax({
    type: 'post',
    url: "{{route('site.cart.add')}}",
    data: {
      'product_slug': $(this).attr('data-slug'),
      'qty': $('#quantity_wanted').val(),
    },
    success: function(data) {
      $('.alert-text').html(data);
      $('.alert-modal').css('display', 'block');
    },
    error: function() {

    }
  });
});
</script>

@stop
