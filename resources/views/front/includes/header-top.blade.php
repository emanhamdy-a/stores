<div class="header-top hidden-sm-down">
  <div class="container">
    <div class="content">
      <div class="row">
        <div class="header-top-left col-lg-6 col-md-6 d-flex justify-content-start align-items-center">

          <div class="detail-email d-flex align-items-center justify-content-center">
            <i class="icon-email"></i>
            <p>{{ __('front\header.email') }}</p>
            <span>
              support@gmail.com
            </span>
          </div>

        </div>
        <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">
          <div class="register-out">
            <i class="zmdi zmdi-account"></i>
            @guest()
            <a class="register" href="{{route('register') }}" data-link-action="display-register-form">
              Register
            </a>
            <span class="or-text">or</span>
            <a class="login" href="{{route('login') }}" rel="nofollow" title="Log in to your customer account">Sign
              in</a>
            @endguest
            @auth()


            <a href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('front\header.logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}"
              method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>

            @endauth
          </div>

          <div id="_desktop_language_selector"
            class="language-selector groups-selector hidden-sm-down language-selector-dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="main">
            <span>{{ getLang() }}</span>
            </div>
            <div class="language-list dropdown-menu">
              <div class="language-list-content text-left">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <div class="language-item
                    {{ getLang()===$localeCode ? 'current flex-first' : ''
                    }} ">
                    <div>
                      <a hreflang="{{ $localeCode }}"
                          href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <span>{{ $properties['native'] }}</span>
                      </a>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
