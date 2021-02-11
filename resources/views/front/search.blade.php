@extends('layouts.site')

@section('content')

<nav data-depth="3" class="breadcrumb-bg">
  <div class="container no-index">
    <div class="breadcrumb">

    </div>
  </div>
</nav>
<div class="container no-index">
  <div class="row">
    <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <section id="main">
        <div class="block-category hidden-sm-down">
          <h1 class="h1">{{$category -> name ?? ''}}</h1>
        </div>
        <section id="products">

          <div id="nav-top">

            <div id="js-product-list-top" class="row products-selection">
              <div class="col-md-6 col-xs-6">
                <div class="change-type">
                  <span class="grid-type active" data-view-type="grid"><i class="fa fa-th-large"></i></span>
                  <span class="list-type" data-view-type="list"><i class="fa fa-bars"></i></span>
                </div>
                @if($count=count($products))
                <div class="hidden-sm-down total-products">
                  <p>
                    {{ __('front\products.product count',['count'=>$count]) }}
                  </p>
                </div>
                @endif
              </div>
              <div class="col-md-6 col-xs-6">

                <div class="d-flex sort-by-row justify-content-end">
                  <span class="hidden-sm-down sort-by">Sort by:</span>
                  <div class="products-sort-order dropdown">
                    <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <span>
                        @isset($_GET['orderway'])
                        @if($_GET['orderway'] == 'desc')
                        {{ __('front\search.newest') }}
                        @elseif($_GET['orderway'] == 'asc')
                        {{ __('front\search.oldest') }}
                        @else
                        {{ __('front\search.newest') }}
                        @endif
                        @endisset
                      </span>
                      <i class="material-icons pull-xs-right">&#xE5C5;</i>
                    </a>
                    <div class="dropdown-menu">
                      <a rel="nofollow" href="#!" data-val='desc' class="orderway select-list js-search-link">
                        {{ __('front\search.newest') }}
                      </a>
                      <a rel="nofollow" href="#!" data-val='asc' class="orderway select-list js-search-link">
                        {{ __('front\search.oldest') }}
                      </a>
                    </div>
                  </div>
                </div>

                <div class="d-flex sort-by-row justify-content-end">
                  <span class="hidden-sm-down sort-by">Sort by:</span>
                  <div class="products-sort-order dropdown">
                    <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <span>
                        @isset($_GET['orderby'])
                        @if($_GET['orderby'] == 'product_translations.name')
                        {{ __('front\search.name') }}
                        @elseif($_GET['orderby'] == 'id')
                        Date
                        @else
                        {{ __('front\search.date') }}
                        @endif
                        @endisset
                      </span>
                      <i class="material-icons pull-xs-right">&#xE5C5;</i>
                    </a>
                    <div class="dropdown-menu">
                      <a rel="nofollow" href="#!" data-val='id' class="orderby select-list js-search-link">
                        {{ __('front\search.date') }}
                      </a>
                      <a rel="nofollow" href="#!" data-val='product_translations.name'
                        class="orderby select-list js-search-link">
                        {{ __('front\search.name') }}
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>


          <div id="categories-product">
            <div id="js-product-list">
              <div class="products product_list grid row" data-default-view="grid">
                @isset($products)
                @foreach($products as $product)
                <div class="item  col-lg-4 col-md-6 col-xs-12 text-center ">
                  <div class="product-miniature js-product-miniature item-one" data-id-product="{{ $product->id }}"
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
                        {{ __('front\products.new') }}
                      </div>
                      @endif
                    </div>
                    <div class="product-description">
                      <div class="product-groups">


                        <div class="group-reviews">
                          <div class="product-comments">
                            <div class="star_content">
                              <div class="star @if($product->review_stars() >= 1) star_on @endif"></div>
                              <div class="star @if($product->review_stars() >= 2) star_on @endif"></div>
                              <div class="star @if($product->review_stars() >= 3) star_on @endif"></div>
                              <div class="star @if($product->review_stars() >= 4) star_on @endif"></div>
                              <div class="star @if($product->review_stars() >= 5) star_on @endif"></div>
                            </div>
                            <span>0 review</span>
                          </div>


                          <div class="info-stock ml-auto">
                            <label class="control-label">
                              {{ __('front\products.availability') }}</label>
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            {{$product -> in_stock ? __('front\products.in stock') :  __('front\products.out of stock')}}
                          </div>
                        </div>

                        <div class="product-title" itemprop="name"><a
                            href="{{route('product.details',$product -> slug)}}">{{Str::limit($product -> name,35)}}</a>
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
                            <span>{{ __('front\products.add to cart') }}</span>
                          </a>
                        </form>

                        <a class="addToWishlist  wishlistProd_22" href="#" data-product-id="{{$product -> id}}">
                          <i class="fa fa-heart"></i>
                          <span>{{ __('front\products.add to wishlist') }}</span>
                        </a>

                        <a href="#" class="quick-view hidden-sm-downadd-to-cart" data-product-id="{{$product -> id}}">
                          <i class="fa fa-eye"></i><span>
                            {{ __('front\products.quick view') }}
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

          <div class="pb-5">
            {{ $products->withQueryString()->links() }}
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

@stop
