jQuery(document).ready(function($) {
  // Init empty gallery array
  var container = [];

// Loop over gallery items and push it to the array
  $('.woocommerce-product-gallery__wrapper_ a').each(function() {
    var $link = $(this).find('img'),
      item = {
        src: $link.data('src'),
        w: $link.data('large_image_width'),
        h: $link.data('large_image_height')
      };
    container.push(item);
  });

// Define click event on gallery item
  $('.woocommerce-product-gallery__image').on('click', function(event) {

    // Prevent location change
    event.preventDefault();

    // Define object and gallery options
    var $pswp = $('.pswp')[0],
      options = {
        index: $(this).parent('.item').index(),
        bgOpacity: 0.85,
        showHideOpacity: true
      };

    // Initialize PhotoSwipe
    var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
    gallery.init();
  });

  //plugin bootstrap minus and plus
  //http://jsfiddle.net/laelitenetwork/puJ6G/
  $('.qty-navigator').click(function(e) {
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if (type == 'minus') {
        if (currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        }
        if (parseInt(input.val()) == input.attr('min')) {
          $(this).attr('disabled', true);
        }
      } else if (type == 'plus') {
        input.val(currentVal + 1).change();
      }
    } else {
      input.val(0);
    }
  });

  $('.input-text.qty').focusin(function() {
    $(this).data('oldValue', $(this).val());
  });

  $('.input-text.qty').change(function() {

    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= 0) {
      $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      // alert('Sorry, the minimum value was reached');
      (this).val($(this).data('oldValue'));
    }

  });

  $(".input-text.qty").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });

  $('.related-carousel').owlCarousel({
    loop:true,
    margin:30,
    responsiveClass:true,
    responsive:{
      0:{
        items:1,
        dots:true
      },
      576:{
        items:2,
        dots:true
      },
      990:{
        items:4,
        dots:true
      }
    }
  });
});
