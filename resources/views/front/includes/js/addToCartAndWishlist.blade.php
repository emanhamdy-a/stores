<script>
$(document).on('click', '.quick-view', function() {
  $('.quickview-modal-product-details-' + $(this).attr('data-product-id')).first().css("display", "block");
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

$(document).on('click', '.addToWishlist:not(.removeFromWishlist)', function(e) {
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
      console.log(data);
      if (data.wished) {
        $('.alert-modal').css('display', 'block');
        $('.alert-text').text('The product added to favourite list successfully');
      } else {
        $('.alert-text').text('This product added before to favourite list');
        $('.alert-modal2').css('display', 'block');
      }
    }
  });

});

$(document).on('click', '.add-to-cart', function(e) {
  e.preventDefault();

  @guest()
  $('.not-loggedin-modal').css('display', 'block');
  @endguest

  $.ajax({
    type: 'post',
    url: "{{route('site.cart.add')}}",
    data: {
      'product_id': $(this).attr('data-product-id'),
      'product_slug': $(this).attr('data-slug'),
      'qty': $('#quantity_wanted').val(),
    },
    success: function(data) {
      console.log(data);
      if (data) {
        $('.alert-modal').css('display', 'block');
        $('.alert-text').text('The product added to cart list successfully');
      } else {
        $('.alert-text').text('This product added before to cart list');
        $('.alert-modal2').css('display', 'block');
      }
    },
    error: function() {

    }
  });
});
</script>
