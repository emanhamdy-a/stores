<div class="header-bottom hidden-sm-down">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="contentsticky_verticalmenu verticalmenu-main col-lg-3 col-md-1 d-flex" data-textshowmore="Show More"
        data-textless="Hide" data-desktop_item="4">
        <div class="toggle-nav d-flex align-items-center justify-content-start {{ cats_menu('')[1] }}">
          <span class="btnov-lines"></span>
          <span>{{ __('front\header.shop by categories') }}</span>
        </div>
        <div class="verticalmenu-content has-showmore {{ cats_menu('')[0] }}"><!-- show -->
          <div id="_desktop_verticalmenu" class="nov-verticalmenu block" data-count_showmore="6">
            <div class="box-content block_content">
              <div id="verticalmenu" class="verticalmenu" role="navigation">
                <ul class="menu level1">

                @if($categories = main_child_cats())
                  @foreach($categories as $category)
                  <li class="item  parent"><a href="{{route('category',$category -> slug )}}"
                      title="Laptops &amp; Accessories"><i class="hasicon nov-icon"
                        style="background:url('http://demo.bestprestashoptheme.com/savemart/themes/vinova_savemart/assets/img/modules/novverticalmenu/icon/laptop.png') no-repeat scroll center center;">

                      </i>{{$category -> name}}</a>

                    @isset($category -> childrens)

                    <span class="show-sub fa-active-sub"></span>
                    <div class="dropdown-menu" style="width:222px">
                      <ul>
                        @foreach($category -> childrens as $childern)
                        <li class="item ">
                        <li class="item  parent">
                          <a href="{{route('category',$childern -> slug )}}" title="Laptop Thinkpad">{{$childern -> name}}</a>
                          @isset($childern -> childrens )
                          <span class="show-sub fa-active-sub"></span>
                          <div class="dropdown-menu">
                            <ul>
                              @foreach($childern -> childrens as $_childern)
                              <li class="item ">
                                <a href="{{route('category',$_childern -> slug )}}" title="Aliquam lobortis">
                                  {{$_childern -> name}}
                                </a>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                          @endisset
                        </li>
                        @endforeach
                      </ul>
                    </div>
                    @endisset
                  </li>
                  @endforeach
                @endif

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9 col-md-11 header-menu
        d-flex align-items-center justify-content-start">
        <div class="header-menu-search d-flex
          justify-content-between w-100 align-items-center">

          <div id="_desktop_top_menu">
            <nav id="nov-megamenu" class="clearfix">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div id="megamenu" class="nov-megamenu clearfix">
                <ul class="menu level1">
                  <li class="item home-page">
                    <span class="opener"></span>
                    <a href="{{ route('home') }}" title="Home">
                      <i class="zmdi zmdi-home"></i>
                      {{ __('front\header.home') }}
                    </a>
                  </li>
                  <li class="item  has-sub"><span class="opener"></span>
                    <a href="#!" title="Blog">
                      <i class="zmdi zmdi-library"></i>
                      {{ __('front\header.pages') }}
                    </a>
                    <div class="dropdown-menu" style="width:270px">
                      <ul class="">
                        <li class="item ">
                         <a href="{{ route('site.cart.index') }}">
                         {{ __('front\header.products') }}</a>
                        </li>
                        <li class="item ">
                          <a href="{{ route('site.cart.index') }}">
                          {{ __('front\header.cart') }}</a>
                        </li>
                        <li class="item ">
                          <a href="{{ route('wishlist.products.index') }}">Wishlist</a>
                        </li>
                        <li class="item ">
                          @auth
                            <a href="{{ route('profile') }}">
                            {{ __('front\header.profile') }}</a>
                          @endauth
                          @guest
                            <a href="{{ route('login') }}">
                            {{ __('front\header.login') }}</a>
                          @endguest
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="item  group">
                    <span class="opener"></span>
                    <a href="#!" title="Categories"><i
                      class="zmdi zmdi-group"></i>
                      Categories
                    </a>
                    @if($categories = main_child_cats())
                    <div class="dropdown-menu">
                      <ul class="">
                        <li class="item container group">
                          <div class="dropdown-menu">
                            <ul class="">
                              @foreach($categories as $category)
                              <li class="item col-lg-3 col-md-3 html">
                                <span class="menu-title">
                                  <a href="{{route('category',$category -> slug )}}">
                                  {{$category -> name}}
                                  </a>
                                </span>
                                <div class="menu-content">
                                  <ul class="col">
                                  @isset($category -> childrens)
                                    @foreach($category -> childrens as $childern)
                                    <li>
                                      <a href="{{route('category',$childern -> slug )}}">{{ $childern->name }}
                                      </a>
                                    </li>
                                    @endforeach
                                  @endisset
                                  </ul>
                                </div>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                    @endif
                  </li>
                </ul>
              </div>
            </nav>
          </div>

          <div class="advencesearch_header">
            <span class="toggle-search hidden-lg-up">
              <i class="zmdi zmdi-search"></i>
            </span>
            <div id="_desktop_search" class="contentsticky_search">
              <!-- block seach mobile -->
              <!-- Block search module TOP -->
              <div id="desktop_search_content" class='' data-id_lang="1" data-ajaxsearch="1"
                data-novadvancedsearch_type="top" data-instantsearch="" data-search_ssl=""
                data-link_search_ssl="http://demo.bestprestashoptheme.com/savemart/en/search"
                data-action="http://demo.bestprestashoptheme.com/savemart/en/module/novadvancedsearch/result">

                <!-- search form -->
                <form method="get"
                  action="http://demo.bestprestashoptheme.com/savemart/en/module/novadvancedsearch/result"
                  id="searchbox" class="form-novadvancedsearch" '>
                  <input type="hidden" name="fc" value="module">
                  <input type="hidden" name="module" value="novadvancedsearch">
                  <input type="hidden" name="controller" value="result">
                  <input type="hidden" name="orderby" value="position">
                  <input type="hidden" name="orderway" value="desc">
                  <input type="hidden" name="id_category" class="id_category" value="0">
                  <div class="input-group ">
                    <input type="text" id="search_query_top"
                      class="search_query ui-autocomplete-input form-control"
                      name="search_query" value=""
                      placeholder="{{ __('front\header.search') }}"
                    >
                    @if($categories = main_child_cats())
                    <div class="input-group-btn
                      nov_category_tree hidden-sm-down">
                      <button type="button"
                        class="btn dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true" value=""
                        aria-expanded="false">
                        {{ __('front\header.categories') }}
                      </button>
                      <ul class="dropdown-menu list-unstyled">
                        <li class="dropdown-item active" data-value="0">
                        <span>
                          {{ __('front\header.all categories') }}
                        </span></li>
                        <ul class="list-unstyled pl-5">
                        @foreach($categories as $category)
                          <li class="dropdown-item"
                            data-value="{{ $category->id }}">
                            <span>{{ $category->name }}</span>
                          </li>
                          @if($category->childrens)
                          @foreach($category->childrens as $children)
                            <li class="dropdown-item"
                              data-value="{{ $children->id }}">
                              <span>- {{ $children->name }}</span>
                            </li>

                            @if($children->childrens)
                            @foreach($children->childrens as $_children)
                              <li class="dropdown-item"
                                data-value="{{ $_children->id }}">
                                <span>-- {{ $_children->name }}</span>
                              </li>
                            @endforeach
                            @endif

                          @endforeach
                          @endif
                        @endforeach
                        </ul>
                      </ul>
                    </div>
                    @endif
                    <span class="input-group-btn">
                      <button class="btn btn-secondary "
                        type="submit" name="submit_search">
                        <i class="material-icons">
                        search</i>
                      <button>
                    </span>
                  </div>

                </form>

              </div>
              <!-- /Block search module TOP -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
