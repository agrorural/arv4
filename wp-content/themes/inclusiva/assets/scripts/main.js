/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        $('.tip').tooltip();
        $('[data-toggle="popover"]').popover({html: true});
        
        //Footer carousel
        $('.sl__footer').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        lazyLoad: true,
        navText: ["<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>", "<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>"],
        dots: false,
          responsive:{
              0:{
                  items: 3
              },
              600:{
                  items: 4
              },
              1000:{
                  items: 6
              }
          }
        });

        //Initialize lightbox
        $('.gallery a[href$=".jpg"], .gallery a[href$=".jpeg"], .gallery a[href$=".png"], .gallery a[href$=".gif"]').attr('data-lightbox','lightbox');

        //Read only Gravity Forms
        $(".gform_wrapper .gf_disabled input").attr("readonly", "");

        //Placeholder del buscador según busqueda
          var getCheckedCheckBoxes = function(handlerID, groupName, labelPrefix, inputID){
          var arr = [];
          var result = $('#' +handlerID + ' input[name="' + groupName + '"]:checked');

          result.each(function(index, element){
            arr.push($('label[for="' + labelPrefix + $(this).val() + '"]').text());
          });

            if (arr.length > 0) {
              $('input[id="'+ inputID +'"]').prop('placeholder', 'Buscar en' + arr);
            }else{
              $('input[id="'+ inputID +'"]').prop('placeholder', 'Ingrese su búsqueda');
            }

            // console.log(arr);

          };

          $('#searchform input[name="post_type[]"]').click(function(){
            getCheckedCheckBoxes('searchform', 'post_type[]', 'cb__', 's');
          });

        // Sharing buttons
        $('.single .sharing-list ul').click(function(){
          $( this ).toggleClass( "active" );
          $('.share-header button').toggleClass( "active" );
        });

        var $inputSearch = $('#s');
        
        $('#showForm').on('mousedown', function () {
            $(this).data('inputFocused', $inputSearch.is(":focus"));
        }).click(function () {
          $('body').toggleClass('with-searchform');
          $(this).find("i").toggleClass('fa-search fa-times');
            if ($(this).data('inputFocused')) {
                $inputSearch.blur();
            } else {
                $inputSearch.focus();
            }
        });

        $('body').keyup(function(e){
          if($('body').hasClass('with-searchform')){
            if(e.which === 27){
              $('body').removeClass('with-searchform');
              $('#showForm').find("i").removeClass('fa-times');
              $('#showForm').find("i").addClass('fa-search');
            }
          }
        });

        //Mobile menu button
        $('.navbar-toggle').click(function(event) {
          $(this).toggleClass( "opened" );
        });

        $(window).load(function () {
            $('.sl__footer').removeClass('hidden');
        });

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
        $('.sl__alerts').owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause:true,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-caret-square-o-left' aria-hidden='true'></i>", "<i class='fa fa-caret-square-o-right' aria-hidden='true'></i>"]
          });

        $('.sl__home').owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 30000,
            autoplayHoverPause:true,
            center: true,
            nav: true,
            navText: ["<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>", "<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>"]
        });

        var owl_sl__modal_home = $('.sl__modal-home');

        owl_sl__modal_home.owlCarousel({
            items: 1,
            margin: 0,
            autoplay: true,
            autoHeight: true,
            navRewind: false,
            loop: true,
            autoplayTimeout: 15000,
            autoplayHoverPause:true,
            nav: true,
            navText: ['<button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i></button>', '<button type="button" class="btn btn-default"><i class="fa fa-angle-right"></i></button>'],
            dots: false
        });

        // Verifica si hay Modal del Front Page
        var findModal = $('.home-page').find("#fontPageModal");

        // Normalización
        $(window).load(function () {
            $('.sl__home figure figcaption').removeClass('hidden');
            $('.sl__home figure img').removeClass('hidden');
            $('.sl__footer').removeClass('hidden');
            $('.alerts').removeClass('hidden');
            $('.sl__home figure .spinner').remove();

            //Si hay Modal, lo muestra
            // if(findModal.length > 0 && $.cookie('msg') == null){
          if (findModal.length > 0 ) {
              $('#fontPageModal').modal('show');
              // $('#fontPageModal .ctaNotShowAgain').click(function(){
              //   $.cookie('msg', '1');
              // });
            }
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS

      }
    },
    // About us page, note the change from about-us to about_us.
    'georeferenciacion_de_proyectos': {
      init: function() {
        // JavaScript to be fired on the about us page
        //Fuerza a los tabs a mostrar los maps de myTabs
        $('#myTabs li a').click('show', function(e) {
            paneID = $(e.target).attr('href');
            src = $(paneID).attr('data-src');
            // if the iframe hasn't already been loaded once
            if($(paneID+" iframe").attr("src")==="")
            {
                $(paneID+" iframe").attr("src",src);
            }
        });
      }
    },
    'aliados_ii': {
      init: function() {
        $('.sl__proyecto').owlCarousel({
          items: 1,
          loop: true,
          margin: 0,
          autoplay: true,
          autoplayTimeout: 30000,
          autoplayHoverPause:true,
          center: true
        });
      }
    },
    'reconstruccion_con_cambios': {
      init: function () {
        $('#sl__comunicados').owlCarousel({
          loop: true,
          margin: 0,
          items: 1,
          dots: false
        });

        $('#sl__reconstruccion').owlCarousel({
          loop: false,
          margin: 30,
          autoplay: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
          video: true,
          lazyLoad: true,
          dots: true,
          responsive: {
            0: {
              items: 1
            },
            480: {
              items: 2
            },
            768: {
              items: 3
            },
            1000: {
              items: 3
            }
          }
        });

        $('#sl__banners').owlCarousel({
          loop: false,
          margin: 30,
          items: 5,
          lazyLoad: true,
          dots: true,
          responsive: {
            0: {
              items: 2
            },
            480: {
              items: 3
            },
            768: {
              items: 4
            },
            1000: {
              items: 5
            }
          }
        });
      },
      finalize: function () {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    'decreto_de_urgencia_002_2018': {
      init: function () {
        // JavaScript to be fired on all pages, after page specific JS is fired
        var massheadSlider = new Swiper('.masshead-slider', {
          effect: 'fade',
          grabCursor: true,
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
        });
        var videoSlider = new Swiper('.video-slider', {
          effect: 'coverflow',
          // grabCursor: true,
          centeredSlides: true,
          slidesPerView: 'auto',
          freeMode: true,
          loop: true,
          coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows : true,
          },
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
        });
        var linkSlider = new Swiper('.link-slider', {
          slidesPerView: 4,
          spaceBetween: 30,
          slidesPerGroup: 4,
          loopFillGroupWithBlank: true,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      },
      finalize: function () {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
