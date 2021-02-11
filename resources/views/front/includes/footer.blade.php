<footer class="footer footer-three">
  <div class="inner-footer">
    <div class="container">
      <div class="row">
        <div class="nov-row footer-top " data-nov-full-width="true">
          <div class="nov-row-wrap row">
            <div class="nov-modules col-lg-12 col-md-12 ">
              <div class="block nov-wrap">
                <div class="social-content">
                  <div class="title_block">
                    {{ __('front\footer.follow us') }}
                  </div>
                  <div id="social_block">
                    <div class="social">
                      <ul class="list-inline mb-0 justify-content-end">
                        <li class="list-inline-item mb-0"><a href="#" target="_blank"><i
                              class="zmdi zmdi-facebook"></i></a></li>
                        <li class="list-inline-item mb-0"><a href="#" target="_blank"><i
                              class="zmdi zmdi-twitter"></i></a></li>
                        <li class="list-inline-item mb-0"><a href="#" target="_blank"><i
                              class="zmdi zmdi-youtube-play"></i></a></li>
                        <li class="list-inline-item mb-0"><a href="#" target="_blank"><i
                              class="zmdi zmdi-instagram"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- Popup newsletter -->

              </div>
            </div>
          </div>
        </div>
        <div class="nov_row-full-width clearfix w-100"></div>
        <div class="nov-row footer-center " data-nov-full-width="true">
          <div class="nov-row-wrap row">
            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
              <div class="block">
                <div class="block_content">
                  <p class="logo-footer text-primary"
                    style='font-size:20px;font-weight:500;'>
                    VATREENA
                  </p>
                  <div class="data-contact d-flex align-self-stretch">
                    <div class="title-icon">
                    {{ __('front\footer.support') }}
                    <i class="icon-support icon-address"></i></div>
                    <div class="content-data-contact">
                      <div class="support">
                      {{ __('front\footer.customer services') }}
                      </div>
                      <div class="phone-support">+84-0123-456-789</div>
                    </div>
                  </div>
                  <div class="data-contact d-flex align-self-stretch">
                    <div class="title-icon">
                    {{ __('front\footer.contact info') }}
                    <i class="icon-info-contact icon-address"></i></div>
                    <div class="content-data-contact">
                      <div class="info-contact">
                      {{ __('front\footer.contact info:') }}
                      </div>
                      <div class="content-info-contact">
                      {{ __('front\footer.contact adress') }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="nov-html col-xl-4 col-lg-4 col-md-4 "></div>

            <div class="nov-html col-xl-4 col-lg-4 col-md-4 ">
              <div class="block">
                <div class="title_block">
                {{ __('front\footer.pages') }}
                </div>
                <div class="block_content">
                  <ul>
                    <li>
                      <a href="{{ route('site.cart.index') }}">
                        {{ __('front\footer.products') }}
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('site.cart.index') }}">
                        {{ __('front\footer.cart') }}
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('wishlist.products.index') }}">
                        {{ __('front\footer.wishlist') }}
                      </a>
                    </li>
                    <li>
                      @auth
                        <a href="{{ route('profile') }}">
                          {{ __('front\footer.profile') }}
                        </a>
                      @endauth
                      @guest
                        <a href="{{ route('login') }}">
                          {{ __('front\footer.login') }}
                        </a>
                      @endguest
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="nov_row-full-width clearfix w-100"></div>
      </div>
    </div>
  </div>

  <div id="nov-copyright">
    <div class="container">
      <div class="row">
        <div
          class="col-md-6 align-items-center justify-content-md-start justify-content-sm-center d-flex pb-xs-max-20 flex-center">
          <span>
            Copyright © 2018 Vinovathemes. All Rights Reserved
          </span>
        </div>

      </div>
    </div>
  </div>

</footer>
@section('footer_scripts')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click','.button-submit',function(e){
    $('#pagen').val(1);
  });

  $(document).on('click','.orderby',function(e){
    let orderby=$(this).attr("data-val");
    $('#orderby').val(orderby);
    $('#pagen').val(1);
    $('.search-form').submit();
  });

  $(document).on('click','.orderway',function(e){
    let orderway=$(this).attr("data-val");
    $('#orderway').val(orderway);
    $('#pagen').val(1);
    $('.search-form').submit();
  });

  $(document).on('click','li a.page-link',function(e){
    e.preventDefault();
    let pagen=$(this).html();
    $('#pagen').val(pagen);
    $('.search-form').submit();
  });

  $(document).on('submit','.search-form',function(e){
    e.preventDefault();
    formData=$(this).serialize();
    url=$(this).attr("action") + "?" + formData;
    window.history.replaceState('object', 'New Title',url);
      $.ajax({
        url:url,
        type:$(this).attr("method"),
        data:{
          "orderby": $('#orderby').val(),
          "orderway": $('#orderway').val(),
          "id_category": $('#id_category').val(),
          "search_query": $('#search_query').val(),
        },
        // dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          if(data){
            $('.verticalmenu-content.has-showmore').removeClass('active');
            $('.munu_bar').removeClass('ac');

            $('body #displayTop').remove();
            $('body #content-wrapper').html(data);
          }
        },error: function(jqXHR, textStatus, errorThrown) {
          // console.log(jqXHR);
        },
      });
  });

</script>
@stop
