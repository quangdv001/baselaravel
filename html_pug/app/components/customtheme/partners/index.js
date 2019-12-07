jQuery(document).ready(function($){
    $(".partners-carousel").owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        margin: 20,
        autoplayTimeout: 5000,
        responsive: {
            0 : {
                items : 3
            },
            480 : {
                items : 4
            },
            768 : {
                items : 6
            }
        }
    });
});