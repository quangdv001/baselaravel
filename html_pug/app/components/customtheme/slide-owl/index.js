jQuery(document).ready(function($){
    $(".slide-owl-carousel").owlCarousel({
        loop: true,
        dots: true,
        autoplay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        margin: 20,
        autoplayTimeout: 5000,
        responsive: {
            0 : {
                items : 1
            },
            480 : {
                items : 1
            },
            768 : {
                items : 1
            }
        }
    });
});