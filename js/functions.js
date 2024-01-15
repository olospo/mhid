$(".mobile_menu").click(function() {
  $('nav.mobile').fadeToggle();
  $(this).toggleClass("open");
});

$(".search_icon").click(function() {
  $('.search_form').fadeToggle();
  // $('#menu-main').fadeToggle();
});

$(window).resize(function() { // Hide Mobile Menu if Browser window goes above 768px
  var width = $(this).width(); // The window width
  if (width > 768) {
    $('nav.mobile').hide();
  }
});

// Back to Top Scroll 
var amountScrolled = 300;

$(window).scroll(function() {
  if ( $(window).scrollTop() > amountScrolled ) {
    $('a.back_to_top').fadeIn();
  } else {
    $('a.back_to_top').fadeOut('fast');
  }
});

$('a.back_to_top').click(function() {
  $('html, body').animate({
    scrollTop: 0
  }, 300);
  return false;
});

// SVG as Images
$(function(){
  activate('img[src*=".svg"]');
  function activate(string){
    jQuery(string).each(function(){
      var $img = jQuery(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');
        jQuery.get(imgURL, function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find('svg');
        
        // Add replaced image's ID to the new SVG
        if(typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if(typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', imgClass+' replaced-svg');
        }
        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');

        // Replace image with new SVG
        $img.replaceWith($svg);

      }, 'xml');
    });
  }
});

// ------------------------------------------------------------
// Accordian
// ------------------------------------------------------------

function accordion_ajax() {
  var accItem = document.getElementsByClassName('accordionItem');
  var accHD = document.getElementsByClassName('accordionItemHeading');
  for (i = 0; i < accHD.length; i++) {
      accHD[i].addEventListener('click', toggleItem, false);
  }
  function toggleItem() {
      var itemClass = this.parentNode.className;
      for (i = 0; i < accItem.length; i++) {
        // accItem[i].className = 'accordionItem close';
        this.parentNode.className = 'accordionItem close';
      }
      if (itemClass == 'accordionItem close') {
        this.parentNode.className = 'accordionItem open';
      }
  }
}
accordion_ajax();

$('.slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
  
// ------------------------------------------------------------
// Animation Javascript
// ------------------------------------------------------------

var componentVisible = (function ($) {
  
  var $components = $('section, .step');

  var componentsWaypoints = $components.waypoint({
    handler: function() {
      $(this.element).addClass("visible");
    },
    offset: '80%'
  });

})(jQuery);

// Mobile Menu 
$("li.menu-item-has-children > a").after("<div class='sub-toggle'></div>");

$(".sub-toggle").click(function() {
  $(this).siblings('ul').toggle();
  $(this).toggleClass("open");
});