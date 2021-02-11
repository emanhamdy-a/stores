<div class="header-center hidden-sm-down">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div id="_desktop_logo"
        class="contentsticky_logo d-flex align-items-center justify-content-start col-lg-3 col-md-3">
        <a href="{{route('home') }}" style="">
          <span class="text-primary pl-2"
          style="font-size:30px;text-decoration:none;
          font-weight:500;">
            VATREENA
          </span>
        </a>
      </div>
      <div class="col-lg-9 col-md-9 header-menu d-flex align-items-center
        justify-content-end">
        <div class="data-contact d-flex align-items-center">
          <div class="title-icon">
          {{ __('front\header.support') }}
          <i class="icon-support icon-address"></i></div>
          <div class="content-data-contact">
            <div class="support">
            {{ __('front\header.call customer service') }}
            </div>
            <div class="phone-support">
              1234 567 899
            </div>
          </div>
        </div>

        <div class="contentsticky_group d-flex justify-content-end">
          <div class="groups-selector hidden-sm-down  ">
            <div class="header_link_myaccount dropdown-toggle"
              data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" role="main">
              <a class="login" href="#!" >
                <i class="header-icon-account"></i>
              </a>
            </div>
            <div class="currency-list dropdown-menu">
              <div class="currency-list-content text-left">
                @guest()
                  <div class="currency-item current flex-first">
                    <a title="{{ __('front\header.login') }}" rel="nofollow"
                    href="{{ route('login') }}">
                    {{ __('front\header.login') }}
                    </a>
                  </div>
                  <div class="currency-item">
                    <a title="{{ __('front\header.register') }}" rel="nofollow"
                    href="{{ route('register') }}">
                    {{ __('front\header.register') }}
                    </a>
                  </div>
                @endguest

                @auth()
                  <div class="currency-item current flex-first">
                    <a title="{{ __('front\header.profile') }}"
                    rel="nofollow" href="{{ route('profile') }}">
                    {{ __('front\header.profile') }}
                    </a>
                  </div>
                  <div class="currency-item">
                    <a title="{{ __('front\header.orders') }}" rel="nofollow"
                    href="{{ route('orders') }}">
                    {{ __('front\header.orders') }}
                    </a>
                  </div>
                  <div class="currency-item">
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                    {{ __('front\header.logout') }}
                  </a>
                  </div>

                  <form id="logout_form" action="{{ route('logout') }}"
                    method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                @endauth
              </div>
            </div>
          </div>

          <div class="header_link_wishlist">
            <a href="{{route('wishlist.products.index') }}"
              title="{{ __('front\header.my wishlist') }}">
              <i class="header-icon-wishlist"></i>
              <div class="text-center wishlist-products-count"
                style='position: absolute;right:14px;bottom:2px; background: #2d9ae8;border-radius: 50%;color: #fff;height:19px;min-width:19px;line-height:19px;font-size: 1.1rem;font-weight: 700;'>
                   @auth {{auth()->user()->wishlist->count() ?? ''}} @else 0 @endauth
              </div>
            </a>
          </div>

          <div id="_desktop_cart">
            <div class="blockcart cart-preview active" data-refresh-url="">
              <div class="header-cart">
                <div class="cart-left">
                  <a href="{{route('site.cart.index') }}"
                    title="{{ __('front\header.my cart') }}">
                    <div class="shopping-cart">
                      <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                  </a>
                  <div class="cart-products-count">
                  {{ Session::has('basket') ? count(Session::get('basket')) : '0'}}
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
