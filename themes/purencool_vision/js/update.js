jQuery(document).ready(function ($) {
  $('.navi-bg-image').each(function (index, el) {
    var attr_bg = $(this).attr('data-bg-image');
    if (typeof attr_bg !== typeof undefined && attr_bg !== false) {
      $(this).css('background-image', 'url(' + attr_bg + ')');
    }
  });
  //SHOP
  if ($('.cart #cart-items').length) {
    Updatecart();
    $('li.cart > a').hover(function () {
      if ($('.shopping-cart').hasClass('hide')) {
        $('.shopping-cart').show('fast');
        $('.shopping-cart').removeClass('hide');
      }
      else {
        $('.shopping-cart').slideUp("slow");
        $('.shopping-cart').addClass('hide');
      }
    }, function () {
    });
    if ($('.cart-contents .line-item-total').length) {
      var price = $('.cart-contents .line-item-total').text();
      $('.cart span.font-bold').text(price);
    }
  }
});

function Updatecart() {
  if ($('.shopping-cart .num-items').text()) {
    var l = $('.shopping-cart .num-items').text();
  }
  else {
    var l = 0;
  }
  $('.cart #cart-items').text(l);
}