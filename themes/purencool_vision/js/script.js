(function ($) {
  Drupal.behaviors.purencool_vision = {
    attach: function (context, settings) {

      'use strict';
      (function () {
      var mySwiper = new Swiper('.swiper-container',{
        loop:true,
        grabCursor: true,
        paginationClickable: true,
        autoplay: 4000,
        autoplayDisableOnInteraction:false
      });
        }());


      var setupCompleted = false;
      (function () {
        $('#main-menu', context).prepend('<a href="#" class="main-menu-mobile-menu showhide"><i class="fa fa-bars" aria-hidden="true"></i></a>');

        settings = {
          menu: '.menu-main',
          showSpeed: 300,
          hideSpeed: 300,
          trigger: "hover",
          showDelay: 0,
          hideDelay: 0,
          effect: "fade",
          align: "left",
          responsive: true,
          animation: "none",
          indentChildren: true,
          indicatorFirstLevel: '<i class="fa fa-angle-down"></i>',
          indicatorSecondLevel: '<i class="fa fa-angle-right"></i>',
          scrollable: true,
          scrollableMaxHeight: 400,
          screenWidth: 767,
        };


        if (setupCompleted === false) {
          if ($(window).width() < settings.screenWidth) {
            $(settings.menu, context).children("li").children("a").each(function () {

              if ($(this).siblings(".dropdown, .megamenu").length > 0) {
                $(this).addClass('dropdown-mobile-a');
                $(this).append("<span class='indicator'>" + settings.indicatorFirstLevel + "</span>");
              }
            });

          }else {

            $(settings.menu, context).children("li").children("a").each(function () {
              if ($(this).siblings(".dropdown, .megamenu").length > 0) {
                $(this).addClass('dropdown-a');
                $(this).append("<span class='indicator'>" + settings.indicatorFirstLevel + "</span>");
              }
            });
          }


          $(settings.menu, context).find(".dropdown").children("li").children("a").each(function () {
            if ($(this).siblings(".dropdown").length > 0) {
              $(this).append("<span class='indicator dropdown'>" + settings.indicatorSecondLevel + "</span>");
            }
          });
          setupCompleted = true;
        }

        $('.main-menu-mobile-menu', context).click(function (e) {
          if ($(settings.menu).hasClass('open')) {
            $(settings.menu).toggle();
            $(settings.menu).removeClass("open");
          }
          else {
            $(settings.menu).toggle();
            $(settings.menu).addClass("open");
          }
        });

        $('.dropdown-mobile-a', context).click(function(e) {
          e.preventDefault();

          if ($(this).next('ul.dropdown').hasClass('open')) {
            $(this).next('ul.dropdown').removeClass("open");
          }
          else {
            $(this).next('ul.dropdown').addClass("open");
          }
        });
      }());


      (function () {
        $(window).on('load', function () {
          $(".theme_loader").fadeOut("slow");
          parallaxInit();
          function parallaxInit() {
            $('.slider-parallax').parallax("30%", 0.1);
            $('.testimonial-parallax').parallax("30%", 0.1);
            $('.page-header-parallax').parallax("30%", 0.1);
          }
        });
      }());


      (function () {
        if ($('#menuzord .menuzord-brand').length) {
          var logo = $('#menuzord .changeable').attr("src");
        }
        else {
          var logo = '';
        }


        $(window).on('scroll', function () {
          var fixed_logo = '';
          var attr_logo = $('#menuzord .menuzord-brand').attr('data-fixed-logo');
          if (typeof attr_logo !== typeof undefined && attr_logo !== false) {
            fixed_logo = $('#menuzord .menuzord-brand').data('fixed-logo');
          }

          if ($(window).scrollTop() > 80) {
            $("nav.transparrent-bg").css({
              'background-color': '#fff',
              'border-bottom': '1px solid #eee'
            });

            $("nav.transparrent-bg .menuzord-menu > li > a").css({
              'padding-top': '26px',
              'color': '#333'
            });

            $("nav.transparrent-bg .menuzord-brand").css({
              'margin-top': '15px',
            });

            $("nav.transparrent-bg .right_mp_menu > ul > li > a").css({
              'padding-top': '26px',
              'color': '#333'
            });

            $("nav.navbar-fixed-top").addClass("nav_border");

            if (fixed_logo != '') {
              $(".changeable").attr("src", fixed_logo);
            }
          }
          else {
            $("nav.transparrent-bg").css({
              'background-color': 'transparent',
              'border': '1px solid transparent'
            });

            $("nav.transparrent-bg .menuzord-menu > li > a").css({
              'padding-top': '40px',
              'color': '#fff'
            });

            $("nav.transparrent-bg .menuzord-brand").css({
              'margin-top': '28px',
            });

            $("nav.transparrent-bg .right_mp_menu > ul > li > a").css({
              'padding-top': '40px',
              'color': '#fff'
            });

            $("nav.navbar-fixed-top").removeClass("nav_border");

            if (logo != '') {
              $(".changeable").attr("src", logo);
            }
          }


          $(".single_progressbar").each(function () {
            var base = $(this);
            var windowHeight = $(window).height();
            var itemPos = base.offset().top;
            var scrollpos = $(window).scrollTop() + windowHeight - 100;
            if (itemPos <= scrollpos) {
              var auptcoun = base.find(".progress-bar").attr("aria-valuenow");
              base.find(".progress-bar").css({
                "width": auptcoun + "%"
              });

              var str = base.find(".skill_per").text();
              var res = str.replace("%", "");
              if (res == 0) {
                $({countNumber: 0}).animate({
                  countNumber: auptcoun
                }, {

                  duration: 3000,
                  easing: 'linear',
                  step: function () {
                    base.find(".skill_per").text(Math.ceil(this.countNumber) + "%");
                  }
                });
              }
            }
          });


          $(".page").each(function () {
            var bb = $(this).attr("id");
            var hei = $(this).outerHeight();
            var grttop = $(this).offset().top - 80;
            if ($(window).scrollTop() > grttop - 1 && $(window).scrollTop() < grttop + hei - 1) {
              var uu = $(".onepage .menuzord-menu > li > a[href='#" + bb + "']").parent().addClass("active");
            }
            else {
              var uu = $(".onepage .menuzord-menu > li > a[href='#" + bb + "']").parent().removeClass("active");
            }
          });
        });
      }());


      (function () {

        //One menu
        if ($('#HELLO nav').hasClass('onepage')) {
          $('body section').each(function (index, el) {
            if ($(this).attr('data-title') && $(this).attr('id')) {
              var title = $(this).attr('data-title');
              var $id = $(this).attr('id');
              $('#HELLO .menuzord-menu li:last-child').before('<li><a href="#' + $id + '">' + title + '</a></li>');
            }
          });
        }


        $(".onepage .menuzord-menu > li > a").on('click', function () {
          $(this).parent().addClass("active");
          $(".onepage .menuzord-menu > li > a").not(this).parent().removeClass("active");
          var TargetId = $(this).attr('href');
          $('html, body').animate({
            scrollTop: $(TargetId).offset().top - 50
          }, 1000, 'swing');
          return false;
        });


        setInterval(function () {
          var widnowHeight = $(window).height();
          var sliderHeight = $(".hero-fullscreen").height();
          var padTop = widnowHeight - sliderHeight;
          $(".hero-fullscreen").css({
            'padding-top': Math.round(padTop / 2) + 'px',
            'padding-bottom': Math.round(padTop / 2) + 'px'
          });
        }, 10);


        $('#js-grid-masonry').cubeportfolio({
          filters: '#js-filters-masonry',
          layoutMode: 'grid',
          defaultFilter: '*',
          animationType: 'fadeOut',
          gapHorizontal: 20,
          gapVertical: 20,
          gridAdjustment: 'responsive',
          mediaQueries: [{
            width: 1500,
            cols: 3
          }, {
            width: 1100,
            cols: 3
          }, {
            width: 800,
            cols: 3
          }, {
            width: 480,
            cols: 2
          }, {
            width: 320,
            cols: 1
          }],

          caption: 'overlayBottomAlong',
          displayType: 'bottomToTop',
          displayTypeSpeed: 100,
          lightboxDelegate: '.cubeportfoliop-lightbox',
          lightboxGallery: true,

          lightboxTitleSrc: 'data-title',
          lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        });




        $("#Name").keyup(function () {
          "use strict";
          var value = $(this).val();
          if (value.length > 1) {
            $(this).parent().find(".error_message").remove();
            $(this).css({
              "border": "1px solid rgba(0, 0, 0, 0.2)"
            })
          }
          else {
            $(this).parent().find(".error_message").remove();
            $(this).parent().append("<div class='error_message'>Name value should be at least 2</div>");
          }
        });

        $("#Email").keyup(function () {
          "use strict";
          var value = $(this).val();
          var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
          if (testEmail.test(value)) {
            $(this).parent().find(".error_message").remove();
            $(this).css({
              "border": "1px solid rgba(0, 0, 0, 0.2)"
            })
          }
          else {
            $(this).parent().find(".error_message").remove();
            $(this).parent().append("<div class='error_message'>Please entire a valid email. </div>");
          }
        });

        $("#contact_submit").click(function () {
          "use strict";
          var nameValue = $("#Name").val();
          if (!nameValue.length) {
            $("#Name").css({
              "border": "1px solid red"
            });
            $("#Name").parent().find(".error_message").remove();
            $("#Name").parent().append("<div class='error_message'>Name is required</div>");
            return false;
          }

          if (nameValue.length < 1) {
            $("#Name").css({
              "border": "1px solid red"
            });
            $("#Name").parent().find(".error_message").remove();
            $("#Name").parent().append("<div class='error_message'>Name value should be at least 2</div>").show();
            return false;
          }

          var emailValue = $("#Email").val();
          var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
          if (!emailValue) {
            $("#Email").css({
              "border": "1px solid red"
            });

            $("#Email").parent().find(".error_message").remove();
            $("#Email").parent().append("<div class='error_message'>Email is required</div>").show();
            return false;
          }

          if (!testEmail.test(emailValue)) {
            $("#Email").css({
              "border": "1px solid red"
            });
            $("#Email").parent().find(".error_message").remove();
            $("#Email").parent().append("<div class='error_message'>Please entire a valid email.</div>").show();
            return false;
          }

          var phoneValue = $("#Phone").val();
          var messageValue = $("#Message").val();
          if (nameValue && emailValue) {
            $(".feedback_box").slideDown();
            $.ajax({
              url: 'mail/mail.php',
              data: {
                name: nameValue,
                email: emailValue,
                phone: phoneValue,
                message: messageValue
              },

              type: 'POST',
              success: function (result) {
                "use strict";
                $(".show_result").append("<div class='result_message'>" + result + "</div>");
                $(".result_message").slideDown();
                $("#Name").val("");
                $("#Email").val("");
                $("#Phone").val("");
                $("#Message").val("");
              }
            });
          }
          return false;
        });


        var $container = $('.masonry-container');
        $container.imagesLoaded(function () {
          $container.masonry({
            columnWidth: '.item',
            itemSelector: '.item'
          });
        });


        $('.single_facts > h2').counterUp({
          delay: 10,
          time: 1000
        });


        $(".inner_hero_section h2 .rotate").textrotator({
          animation: "fade",
          speed: 1500
        });


        $('.spinner .btn:first-of-type').on('click', function () {
          $('.spinner input').val(parseInt($('.spinner input').val(), 10) + 1);
        });

        $('.spinner .btn:last-of-type').on('click', function () {
          $('.spinner input').val(parseInt($('.spinner input').val(), 10) - 1);
        });


        $(".element").each(function () {
          var $this = $(this);
          $this.typed({
            strings: $this.attr('data-elements').split(','),
            typeSpeed: 100, // typing speed
            backDelay: 3000, // pause before backspacing
            loop: true
          });
        });


        $("#filter-search").on('click', function () {
          $(".full-page-search").addClass("open-search");
        });

        $(".sr-overlay").on('click', function () {
          $(".full-page-search").removeClass("open-search");
        });

      }());
    }
  };
})(jQuery);
