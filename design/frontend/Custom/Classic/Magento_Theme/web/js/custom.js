require(['jquery', 'jquery/ui', 'owl.carousel.min'],
        function (jQuery, jQueryUi, owlCarousel) {

            jQuery(document).ready(function () {
                
                jQuery('#banner-slide').owlCarousel({
                    loop: true,
                    margin: 2,
                    nav: true,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    dots: false,
                    autoplay: true,
                    items: 1,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ],
                })

            });

        });