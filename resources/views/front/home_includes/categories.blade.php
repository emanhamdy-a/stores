@if($main_categories_products)
@foreach($main_categories_products as $category)
<div class="nov-row  col-lg-12 col-xs-12">
  <div class="nov-row-wrap row">
    <div class="nov-productlist productlist-slider col-xl-12  col-lg-12 col-md-9 col-xs-12 col-md-12 col-lg-12">
      <div class="block block-product clearfix">
        <h2 class="title_block">
          {{ $category->name }}
        </h2>
        <div class="block_content">
          <div id="productlist89580" class="product_list grid owl-carousel owl-theme multi-row" data-autoplay="false"
            data-autoplaytimeout="9000" data-loop="false" data-margin="10" data-dots="false" data-nav="true"
            data-items="4" data-items_large="3" data-items_tablet="3" data-items_mobile="2">
            @if($category->products->take(6))
            @foreach($category->products->take(6) as $product)
            <div class="item  text-center">
              <div class="product-miniature js-product-miniature item-one
                   first_item" data-id-product="{{ $product->id }}" data-id-product-attribute="40" itemscope=""
                itemtype="">

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
                        <span>Add to cart</span>
                      </a>
                    </form>

                    <a class="addToWishlist  wishlistProd_22" href="#!" data-product-id="{{$product -> id}}">
                      <i class="fa fa-heart"></i>
                      <span>Add to Wishlist</span>
                    </a>

                    <a href="#!" class="quick-view hidden-sm-down" data-product-id="{{$product -> id}}"
                      data-link-action="quickview">
                      <i class="fa fa-eye"></i>
                      <span> Quick view</span>
                    </a>
                  </div>

                </div>
              </div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@foreach($category->products->take(6) as $product)
@include('front.includes.product-details',$product)
@endforeach

@endforeach
@endif
