( function( $ ) {
    $( document ).ready( function() {
        if ( $( '.testimonial-slider' ).length ) {
            const swiper = new Swiper('.testimonial-slider', {
                // Optional parameters
                loop: authorpro_slider_settings.loop,
                slidesPerView: authorpro_slider_settings.slidesPerView,
                autoplay: authorpro_slider_settings.autoplay ? { delay: 5000 } : false,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    });
} )( jQuery );
