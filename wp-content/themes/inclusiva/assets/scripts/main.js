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
        $('[data-toggle="popover"]').popover({
          html: true
        });

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

        $('.sb__category').owlCarousel({
          loop: true,
          margin: 0,     
          items: 1
        });

        //Colorbox Settings
        var cbSettings = {
          rel: 'cboxElement',
          width: '95%',
          height: 'auto',
          maxWidth: '660',
          maxHeight: 'auto',
          title: function() {
            return $(this).find('img').attr('alt');
          }
        };     

        //Initialize jQuery Colorbox   
        $('.gallery a[href$=".jpg"], .gallery a[href$=".jpeg"], .gallery a[href$=".png"], .gallery a[href$=".gif"]').colorbox(cbSettings);

        //Read only Gravity Forms
        $(".gform_wrapper .gf_disabled input").attr("readonly", "");

        //Keep lightbox responsive on screen resize
        $(window).on('resize', function() {
            $.colorbox.resize({
            width: window.innerWidth > parseInt(cbSettings.maxWidth) ? cbSettings.maxWidth : cbSettings.width
          }); 
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
        $('.sl__home').owlCarousel({
            items: 1,
            loop: true,
            center: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 30000,
            autoplayHoverPause:true,
            lazyLoad: true,
            nav: true,
            navText: ["<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>", "<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>"],
            responsive:{
                678:{
                    
                },
                1000:{
                    
                }
            }
        });

        // Verifica si hay Modal del Front Page
        var findModal = $('.home-page').find("#fontPageModal");

        // Normalización
        $(window).load(function () {
            $('.sl__home figure figcaption').removeClass('hidden');
            $('.sl__footer').removeClass('hidden');
            $('.sl__home figure .spinner').remove();

            //Si hay Modal, lo muestra
            if(findModal.length > 0){
              $('#fontPageModal').modal();
            }
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS

      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
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
