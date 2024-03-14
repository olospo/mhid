$( document ).ready(function() {

  $(".mobile_menu").click(function() {
    $('nav.mobile').fadeToggle();
    $(this).toggleClass("open");
  });
  
  $(".search_icon").click(function() {
    $('.search_form').fadeToggle();
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

// Stats Scrolling
function formatNumber(number) {
  const fixed = number.toFixed(2);
  return parseFloat(fixed) === parseInt(fixed) ? parseInt(fixed) : fixed;
}

function checkInView() {
  if (triggerAtY <= $(window).scrollTop()) {
    startCounter();
    $(window).off('scroll', checkInView); // Remove the scroll event handler
  }
}

function startCounter() {
  $('.unit').each(function () {
    const prefix = $(this).data('prefix') || '';
    const postfix = $(this).data('postfix') || '';
    $(this).prop('Counter', 0).delay(0).animate({
      Counter: $(this).text()
    }, {
      duration: 3000,
      easing: 'swing',
      step: function() {
        $(this).text(prefix + Math.round(this.Counter).toLocaleString() + postfix);
      },
      complete: function() {
        $(this).text(prefix + formatNumber(parseFloat(this.Counter)).toLocaleString() + postfix);
      }
    });
    $('.fade_in').fadeIn(500).delay(100);
  });
}

var triggerAtY = $('.stat_section').offset().top - $(window).outerHeight();

$(window).on('scroll', checkInView); // Add the scroll event handler
checkInView(); // Check if the section is in view on page load

var counter = 0;