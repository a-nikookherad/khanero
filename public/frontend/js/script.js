if (matchMedia('only screen and (min-width: 768px)').matches) {
  $(document).ready(function () {
    $('.demos').owlCarousel({
      loop: true,
      margin: 15,
      nav: true,
      rtl: true,
      dots: false,
      nav: true,
      loop: true,
      navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
      responsiveClass: true,
      responsive: {
        0: {
          items: 1
        },
        700: {
          items: 3
        },
        1000: {
          items: 4
        }
      }
    })
  })
}
if (matchMedia('only screen and (min-width: 768px)').matches) {
  $(document).ready(function () {
    $('.owl-vila').owlCarousel({
      loop: true,
      margin: 25,
      nav: true,
      rtl: true,
      dots: false,
      nav: true,
      loop: true,
      navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
      responsiveClass: true,
      responsive: {
        0: {
          items: 1
        },
        700: {
          items: 3
        },
        1000: {
          items: 4
        }
      }
    })
  })
}
if (matchMedia('only screen and (min-width: 768px)').matches) {
  $(document).ready(function () {
    $('.demos2').owlCarousel({
      loop: true,
      margin: 15,
      items: 5,
      dots: false,
      rtl: true,
      nav: true,
      loop: true,
      navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
      responsiveClass: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 4
        },
        1000: {
          items: 4
        },
        1100: {
          items: 5
        }
      }
    })
  })
}
$(document).ready(function () {
  $(".navbar-toggle ").click(function () {
    $("#myNavbar ").fadeToggle(4000);
  });
});

$(document).ready(function () {
  $('.owl-service').owlCarousel({
    loop: false,
    margin: 10,

    rtl: true,
    navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
    responsiveClass: true,
    responsive: {
      0: {
        items: 4,
        nav: false,
        touchDrag: false,
        mouseDrag: false
      },
      700: {
        items: 4,
        nav: false,
        touchDrag: false,
        mouseDrag: false
      },
      1000: {
        items: 4,
        nav: false,
        touchDrag: false,
        mouseDrag: false
      }
    }
  })
})

if (matchMedia('only screen and (min-width: 768px)').matches) {
  $(document).ready(function () {
    $('.demos2').owlCarousel({
      loop: true,
      margin: 5,
      items: 5,
      rtl: true,
      dots: false,
      //nav: true,
      navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 3,
          nav: false
        },
        1000: {
          items: 3,
          nav: false
        },
        1100: {
          items: 5,
          nav: true,
          loop: true,
          margin: 10
        }
      }
    })
  })
}
$('.input-date1').persianDatepicker({
  initialValue: false
});
$('.input-date2').persianDatepicker({
  initialValue: false
});
var $backToTop = $(".back-to-top");
$backToTop.hide(), $(window).on("scroll", function () {
  $(this).scrollTop() > 100 ? $backToTop.fadeIn() : $backToTop.fadeOut()
}), $backToTop.on("click", function (o) {
  $("html, body").animate({
    scrollTop: 0
  }, 500)
})
if (matchMedia('only screen and (max-width: 768px)').matches) {

  $(".set > span").on("click", function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass("active");
      $(this).siblings('.content').slideUp(200);
      $(".set > span i").removeClass("fas fa-chevron-up").addClass("fas fa-chevron-up");
    } else {
      $(".set > span i").removeClass("fas fa-chevron-up").addClass("fas fa-chevron-up");
      $(this).find("i").removeClass("fas fa-chevron-down").addClass("fas fa-chevron-up");
      $(".set > span").removeClass("active");
      $(this).addClass("active");
      $('.content').slideUp(200);
      $(this).siblings('.content').slideDown(200);
    }

  });
}
$(document).ready(function ($) {
  $('.card__share > a').on('click', function (e) {
    e.preventDefault() // prevent default action - hash doesn't appear in url
    $(this).parent().find('div').toggleClass('card__social--active');
    $(this).toggleClass('share-expanded');
  });
});
if (matchMedia('only screen and (min-width: 1200px)').matches) {
  (function ($) {
    $(window).scroll(function () {
      var $heightScrolled = $(window).scrollTop();
      var $defaultHeight = 300;

      if ($heightScrolled < $defaultHeight) {
        $('.box-search').removeClass("fixedLinks-fx")
      } else {
        $('.box-search').addClass("fixedLinks-fx")
      }
    });
  })(jQuery);
}
