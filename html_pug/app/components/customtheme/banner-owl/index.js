jQuery(document).ready(function($){
    $(".banner-owl-carousel").owlCarousel({
        loop: true,
        margin: 1,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0 : {
                items : 1
            },
            480 : {
                items : 2
            },
            768 : {
                items : 4
            }
        }
    });
});