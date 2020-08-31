/*

Script  : Main JS
Version : 1.0.2
Author  : ThemeSquared
URI     : http://themeforest.net/user/theme-squared/portfolio

Copyright © All rights Reserved
ThemeSquared / @themesquared

*/

(function($) {

    "use strict";

    /* ================================================
        Hide Preloader on Click
        ================================================ */

        $('.preloder').on('click', function() {
            $(this).fadeOut();
        });

    /* ================================================
       Navigation Menu - Hover
       ================================================ */

       function bindNavbar() {
        if ($(window).width() > 768) {
            $('.navbar .dropdown').on('mouseover', function() {
                $('.dropdown-toggle', this).next('.dropdown-menu').show();
            }).on('mouseout', function() {
                $('.dropdown-toggle', this).next('.dropdown-menu').hide();
            });

            $('.dropdown-toggle').on('click', function() {
                if ($(this).next('.dropdown-menu').is(':visible')) {
                    window.location = $(this).attr('href');
                }
            });
        } else {
            $('.navbar-default .dropdown').off('mouseover').off('mouseout');
        }
    }

    $(window).resize(function() {
        bindNavbar();
    });

    bindNavbar();

    /* ================================================
       Flexslider
       ================================================ */

    //Flexslider for today's special
    if ($('.special-slider').length) {

        $('.special-slider').each(function(){ 
            var $this = $(this);
            var prev = $this.find('.prev');
            var next = $this.find('.next');
            $this.flexslider({
                animation: "slide",
                controlNav: false,
                directionNav: false
            });

            prev.on('click', function() {
                $this.flexslider('prev');
                return false;
            });

            next.on('click', function() {
                $this.flexslider('next');
                return false;
            });

            //removes flexslider chrome bug
            $this.flexslider('next');
            
        });
        
    }


    /* ================================================
       Ispotope Menu Filter
       ================================================ */

    //Isotope menu
    $(window).load(function(){
        if ($('.menu-items').length) {
            var $grid = $('.menu-items').isotope({
            // options
            itemSelector: '.menu-item',
            layoutMode: 'fitRows'
        });
        // filter items on button click
        $('.menu-tags').on('click', 'span', function() {

            $('.menu-tags span').removeClass('tagsort-active');
            $(this).toggleClass('tagsort-active');

            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
    }

    //Isotope menu
    if ($('.menu-items2').length) {
        var $grids = $('.menu-items2').isotope({
            // options
            itemSelector: '.menu-item2',
            layoutMode: 'fitRows'
        });
        // filter items on button click
        $('.menu-tags').on('click', 'span', function() {

            $('.menu-tags span').removeClass('tagsort-active');
            $(this).toggleClass('tagsort-active');

            var filterValue = $(this).attr('data-filter');
            $grids.isotope({
                filter: filterValue
            });
        });
    }

    //Isotope menu
    if ($('.menu-items3').length) {
        var $grid3 = $('.menu-items3').isotope({
            // options
            itemSelector: '.menu-item3',
            layoutMode: 'fitRows'
        });
        // filter items on button click
        $('.menu-tags').on('click', 'span', function() {

            $('.menu-tags span').removeClass('tagsort-active');
            $(this).toggleClass('tagsort-active');

            var filterValue = $(this).attr('data-filter');
            $grid3.isotope({
                filter: filterValue
            });
        });
    }

    //Isotope menu
    if ($('.menu-items4').length) {
        var $grid4 = $('.menu-items4').isotope({
            // options
            itemSelector: '.menu-item4',
            layoutMode: 'fitRows'
        });
        // filter items on button click
        $('.menu-tags').on('click', 'span', function() {

            $('.menu-tags span').removeClass('tagsort-active');
            $(this).toggleClass('tagsort-active');

            var filterValue = $(this).attr('data-filter');
            $grid4.isotope({
                filter: filterValue
            });
        });
    }

    //Isotope menu
    if ($('.recipie-items').length) {
        var $grid5 = $('.recipie-items').isotope({
            // options
            itemSelector: '.recipie-item',
            layoutMode: 'masonry'
        });
        // filter items on button click
        $('.recipie-tags').on('click', 'span', function() {

            $('.recipie-tags span').removeClass('recipie-active');
            $(this).toggleClass('recipie-active');

            var filterValue = $(this).attr('data-filter');
            $grid5.isotope({
                filter: filterValue
            });
        });
    }

    //Isotope menu
    if ($('.blog-mason').length) {
        var $grid6 = $('.blog-mason').isotope({
            // options
            itemSelector: '.blog-mason-item',
            layoutMode: 'masonry'
        });
        // filter items on button click
        $('.blog-tags').on('click', 'span', function() {

            $('.recipie-tags span').removeClass('blog-active');
            $(this).toggleClass('blog-active');

            var filterValue = $(this).attr('data-filter');
            $grid6.isotope({
                filter: filterValue
            });
        });
    }
});

    /* ================================================
       Slick Slider
       ================================================ */

    //slick slider for   trusted
    if ($('.trusted-slider .slides').length) {
        $('.trusted-slider .slides').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: true
        });
    }

    //slick slider for   trusted
    if ($('.blog-slider').length) {
        $('.blog-slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: true
        });
    }

    // Services Carousel
    if ($('.services-slider').length) {
        $('.services-slider').slick({
            dots: true,
            arrows: false,
            infinite: false,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    }

    // Featured Recipes
    if ($('.featured-recipies').length) {
        $('.featured-recipies').slick({
            dots: true,
            arrows: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    }

    // Single Recipe Carousel
    $('.single-recipe-carousel').slick({
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.single-recipe-carousel-nav'
    });

    $('.single-recipe-carousel-nav').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: '.single-recipe-carousel',
        focusOnSelect: true
    });

    // Single Shop Carousel
    $('.single-shop-carousel').slick({
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.single-shop-carousel-nav'
    });

    $('.single-shop-carousel-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.single-shop-carousel',
        focusOnSelect: true
    });

    /* ================================================
       Owl Carousel
       ================================================ */

    //OwlCarousel2 for sponsors
    if ($('.trusted-sponsors').length) {
        $('.trusted-sponsors').owlCarousel({
            loop: false,
            center: false,
            margin: 30,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    }

    /* ================================================
       Instagram Feed
       ================================================ */

       if ($('#instafeed').length) {

        var ig_user = $('#instafeed').attr('data-username');
        var ig_access_token = $('#instafeed').attr('data-access-token');
        var ig_cliet_id = $('#instafeed').attr('data-client-id');
        var limit = $('#instafeed').attr('data-limit');
        jQuery.fn.spectragram.accessData = {
            accessToken: ig_access_token,
            clientID: ig_cliet_id,
            limit: limit
        };

        $('#instafeed').spectragram('getUserFeed', {
            query: ig_user,
            wrapEachWith: '<span></span>',
            complete: function() {
                $("#instafeed").owlCarousel({
                    center: true,
                    loop: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        480: {
                            items: 3
                        },
                        600: {
                            items: 5
                        },
                        1000: {
                            items: 8
                        }
                    }
                });
            }
        });
        

    }

    /* ================================================
       Date & Time
       ================================================ */

    //Datepicker
    if ($('#datepicker').length) {
        $("#datepicker").datepicker({
            dateFormat: 'dd/mm/yyyy',
            startDate: '0',
            autoclose: true,
            todayHighlight: true

        });
    }

    //timepicker
    if ($('#timepicker').length) {
        $('#timepicker').clockpicker({
            donetext: 'Done'
        })
        .find('input').change(function() {
                // TODO: time changed
                console.log(this.value);
            });
    }

    /* ================================================
       Magnific Popup
       ================================================ */

    //Magnific pop
    if ($('.about-photo img').length) {
        $('.about-photo img').magnificPopup({
            type: 'image',
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });
    }

    if ($('.gallery-item').length) {
        $('.gallery-item').magnificPopup({
            type: 'image',
            removalDelay: 300,
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            }
        });

    }

    /* ================================================
        Open Table
        ================================================ */

        $('.open-table-container').each(function() {
            var restaurantID = $(this).attr('data-restaurant-id');
            $(this).find('.OT_hidden[name="RestaurantID"]').attr('value', restaurantID);
        });

        if ($.validator) {
            $("#ism").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    startDate: {
                        required: true
                    },
                    PartySize: {
                        required: true
                    },
                    ResTime: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                    return false;
                }
            });
        }

    /* ================================================
       Background Video
       ================================================ */

    //Background Video
    $(".player").mb_YTPlayer();
    if( $('.player').length ){
        $('body').addClass('video-section');
        //$('.mbYTP_wrapper').css('z-index', '1' );
    }


    /* ================================================
       Stellar Parallax
       ================================================ */

    //Stellar Parallax
    $.stellar({
        horizontalScrolling: false,
        responsive: true
    });

    /* ================================================
       Accordion
       ================================================ */

    //Accordion
    $('.panel-group .collapse').on('shown.bs.collapse', function() {
        $(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
        $(this).parent().find("h4").addClass("active");

    }).on('hidden.bs.collapse', function() {
        $(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
        $(this).parent().find("h4").removeClass("active");
    });

    /* ================================================
       Style Switcher
       ================================================ */

    // SETTINGS PANEL
    $('.btn-settings').on('click', function() {
        $(this).parent().toggleClass('active');
        $("body").toggleClass('boxed-wrap');
    });
    $('.switch-handle').on('click', function() {
        $(this).toggleClass('active');
        $('.body').toggleClass('boxed');
    });
    $('.bg-list div').on('click', function() {
        if ($(this).hasClass('active')) return false;
        if (!$('.switch-handle').hasClass('active')) $('.switch-handle').trigger('click');
        $(this).addClass('active').siblings().removeClass('active');
        var cl = $(this).attr('class');
        $('body').attr('class', cl);
    });
    $('.color-list div').on('click', function() {
        if ($(this).hasClass('active')) return false;
        $('link.color-scheme-link').remove();
        $(this).addClass('active').siblings().removeClass('active');
        var src = $(this).attr('data-src'),
        colorScheme = $('<link class="color-scheme-link" rel="stylesheet" />');
        colorScheme
        .attr('href', src)
        .appendTo('head');
    });
    $('.reset').on('click', function() {
        $(".bg-list div").removeClass('active');
        $(".switch-handle").removeClass('active');
        $(".color-list div").removeClass('active');
        $(".body").removeClass('boxed');
        if ($(this).hasClass('active')) return false;
        $('link.color-scheme-link').remove();
        var src = $(this).attr('data-src'),
        colorScheme = $('<link class="color-scheme-link" rel="stylesheet" />');
        colorScheme
        .attr('href', src)
        .appendTo('head');
    });
    $('.reset span').on('click', function() {
        var cl = $(this).attr('class');
        $('body').attr('class', cl);
    });

    /* ================================================
       Fixed Navbar
       ================================================ */

       $(window).scroll(function() {
        var value = $(this).scrollTop();
        var window_width = $(window).width();
        if ( window_width > 992 ){
            if (value > 350)
                $(".navbar-fixed-top").css("background", "rgba(0, 0, 0, 0.9)");

            else
                $(".navbar-fixed-top").css("background", "rgba(0, 0, 0, 0.3)");
        }
    });

    /* ================================================
       Nav in mobile
       ================================================ */
    if ( $(window).width() <= 992 ) {
        $('#navbar .dropdown > a').after('<span class="tomato-toggle"><span class="tomato-toggle-inner"></span></span>');
        $('#navbar .dropdown-menu > li > .dropdown-menu').before('<span class="tomato-toggle"><span class="tomato-toggle-inner"></span></span>');
        $('.tomato-toggle').on('click', function(){
            var toclass = 'menu-active';
            $(this).children().toggleClass(toclass);
            $(this).parent().toggleClass(toclass);
            $('.dropdown-menu li:hover .dropdown-menu ').css({'display':'none'});
        });
    }
    /* ================================================
       Animation Generation
       ================================================ */
       var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
       if (isMobile == false) {
        $("[data-animation]").each(function() {
            var $this = $(this);
            $this.addClass("animation");
            if(!$("html").hasClass("no-csstransitions") && $(window).width() > 767) {
                $this.appear(function() {
                    var delay = ($this.attr("data-animation-delay") ? $this.attr("data-animation-delay") : 1);
                    if(delay > 1) $this.css("animation-delay", delay + "ms");
                    $this.addClass($this.attr("data-animation"));
                    setTimeout(function() {
                        $this.addClass("animation-visible");
                    }, delay);
                }, {accX: 0, accY: -170});
            } else {
                $this.addClass("animation-visible");
            }
        });  
    }
    
    $('.hero-slider').slick({
     infinite: true,
     slidesToShow: 1,
     slidesToScroll: 1,
     autoplay: true,
     autoplaySpeed: 2500,
     dots:false,
     arrows:false,
     pauseOnFocus:false,
     pauseOnHover:false
 });
    $(document).ajaxComplete(function(){ 
        $('.product-info .added_to_cart').addClass('btn btn-default');
    });
})(jQuery); /* End Strict Function */