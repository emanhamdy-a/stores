
<div id=""
  class=" modal fade quickview in quickview-modal-product-details-{{$product -> id}}" tabindex="-1" role="dialog" style="display: hidden;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close"
        data-product-id="{{$product -> id}}"
        data-dismiss="modal" aria-label="Close">
        <i class="material-icons close">close</i>
      </button>
      </div>
      <div class="modal-body">
        <div class="row no-gutters">
          <div class="col-md-5 col-sm-5 divide-right">
            <div class="images-container bottom_thumb">
              <div class="product-cover">
                <img class="js-qv-product-cover img-fluid"
                  src="{{ product_img($product->main_image)}}" alt=""
                  title="" style="width:100%;" itemprop="image">
                <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                  <i class="fa fa-expand"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-7 col-sm-7">
            <h1 class="product-name">{{$product ->  name}}</h1>

            <div class="product-prices">
              <div class="product-price " itemprop="offers" itemscope="" itemtype="https://schema.org/Offer">
                <div class="current-price">
                  <span itemprop="price" class="price">{{$product -> special_price ?? $product -> price }}</span>
                  @if($product -> special_price)
                  <span class="regular-price">{{$product -> price}}</span>
                  @endif
                </div>
              </div>
              <div class="tax-shipping-delivery-label">
                Tax included
              </div>
            </div>

            <div id="product-description-short" itemprop="description">
              <p> {!! $product -> description !!}</p>
            </div>
            <div class="product-actions">
              <form action="" method="post" id="">
                @csrf
                <input type="hidden" name="id_product"
                value="{{$product -> id }}" id="product_page_product_id">
                <div class="product-add-to-cart in_border">
                  <div class="add">
                    <button class="btn btn-primary add-to-cart"
                      data-product-id="{{ $product -> id }}"
                      data-slug="{{ $product -> slug }}" type="submit">
                      <div class="icon-cart">
                        <i class="shopping-cart"></i>
                      </div>
                      <span>
                      {{ __('front\details.add to cart') }}
                      </span>
                    </button>
                  </div>

                  @if(!isset($no_wishlist))
                    <a class="addToWishlist  wishlistProd_22" href="#!"
                      data-product-id="{{$product -> id}}">
                      <i class="fa fa-heart"></i>
                      <span>
                      {{ __('front\details.add to wishlist') }}
                      </span>
                    </a>
                  @endif

                  <div class="clearfix"></div>

                  <div id="product-availability" class="info-stock mt-20">
                    <label class="control-label">
                    {{ __('front\details.availability') }}
                    </label>
                    {{$product -> in_stock ? __('front\details.in stock')  : __('front\details.out of stock') }}
                  </div>
                </div>

              </form>
            </div>

            <div class="tabs">

            </div>

            <div class="dropdown social-sharing">

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
