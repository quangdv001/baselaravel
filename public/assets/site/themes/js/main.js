(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
'use strict';

$(function () {

    $('#carouselSlider').carousel({
        interval: 3030,
        cycle: true
    });

    $("#carouselSlider").on('slide.bs.carousel', function (e) {
        // console.log('A new slide is about to be shown!', e, e.to, e.relatedTarget);
        var containerNode = $($(e.relatedTarget).data('node'));
        var bgImg = $(e.relatedTarget).data('image');
        var bgSize = $(e.relatedTarget).data('size');
        var bgColor = $(e.relatedTarget).data('color');
        var bgRepeat = $(e.relatedTarget).data('repeat');
        var bgPosition = $(e.relatedTarget).data('position');
        // console.log('node: ', (containerNode.length > 0) && bgImg, 'img', bgImg)
        if (bgImg) {
            if (containerNode.length > 0) {
                containerNode.css({
                    backgroundRepeat: bgRepeat || 'no-repeat',
                    backgroundImage: 'url(' + bgImg + ')',
                    backgroundPosition: bgPosition || 'center bottom',
                    backgroundSize: bgSize || '100% auto',
                    backgroundColor: bgColor
                });
            }
        } else containerNode.css('background-image', '');
    });
});

},{}],2:[function(require,module,exports){
'use strict';

var carousel = require('./customtheme/slide-owl/index.js');
var navigation = require('./bootstrap/carousel/index.js');
var navigation = require('./customtheme/navigation/index.js');
var navigation = require('./customtheme/commons/index.js');
var navigation = require('./customtheme/partners/index.js');
var navigation = require('./customtheme/breadcrumb/index.js');
var navigation = require('./customtheme/pagination/index.js');

},{"./bootstrap/carousel/index.js":1,"./customtheme/breadcrumb/index.js":3,"./customtheme/commons/index.js":4,"./customtheme/navigation/index.js":5,"./customtheme/pagination/index.js":6,"./customtheme/partners/index.js":7,"./customtheme/slide-owl/index.js":8}],3:[function(require,module,exports){
"use strict";

},{}],4:[function(require,module,exports){
"use strict";

$(".pro-services-carousel").owlCarousel({
    loop: true,
    dots: true,
    center: true,
    margin: 20,
    // autoplay: true,
    // autoplayTimeout: 15000,
    nav: true,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive: {
        0: {
            items: 1,
            margin: 15,
            nav: false
        },
        480: {
            items: 2,
            margin: 15,
            nav: false
        },
        768: {
            items: 3,
            margin: 15,
            nav: false
        },
        1200: {
            items: 3
        },
        1400: {
            items: 3
        },
        1600: {
            items: 3
        }
    }
});

var sync1 = $(".main-carousel");
var sync2 = $(".thumb-carousel");
sync1.owlCarousel({
    loop: false,
    dots: false,
    margin: 20,
    nav: false,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    items: 1
}).on('changed.owl.carousel', syncPosition);
var sync2Options = {
    loop: false,
    dots: false,
    margin: 20,
    // autoplay: true,
    // autoplayTimeout: 15000,
    nav: true,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    items: 4
    // responsive: {
    //     0: {
    //         items: 2,
    //         margin: 15,
    //         nav: false
    //     },
    //     480: {
    //         items: 2,
    //         margin: 15,
    //         nav: false
    //     },
    //     768: {
    //         items: 3,
    //         margin: 15,
    //         nav: false
    //     },
    //     1200: {
    //         items: 3,
    //         margin: 15
    //     },
    //     1400: {
    //         items: 3,
    //         margin: 15
    //     },
    //     1600: {
    //         items: 3,
    //         margin: 15
    //     }
    // }
};
var syncedSecondary = true;

sync2.on('initialized.owl.carousel', function () {
    sync2.find(".owl-item").eq(0).addClass("current");
}).owlCarousel(sync2Options).on('changed.owl.carousel', syncPosition2);

function syncPosition(el) {
    //if set loop to false
    var current = el.item.index;

    //if you disable loop, comment this block
    // var count = el.item.count-1;
    // var current = Math.round(el.item.index - (el.item.count/2) - .5);

    // if(current < 0) {
    //   current = count;
    // }
    // if(current > count) {
    //   current = 0;
    // }

    //end block

    sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();

    if (current > end) {
        sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
        sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
}

function syncPosition2(el) {
    if (syncedSecondary) {
        var number = el.item.index;
        sync1.data('owl.carousel').to(number, 100, true);
    }
}

sync2.on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
});

},{}],5:[function(require,module,exports){
'use strict';

$(function () {
	'use strict';

	/* Navigation */

	var navigation = function navigation() {
		var navi_icon = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '.navigation_icon';
		var nav_menu = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '.navigation';
		var backdrop_nav = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'backdrop_nav';

		var addIcon = false;
		if ($(navi_icon).length < 1) {
			// console.log('add new icon menu');
			var addIcon = true;
		}

		if ($(nav_menu).length < 1) {
			// console.log("nav_menu not found");
			return;
		} else if ($(nav_menu).length > 1) {
			console.warn('There are duplicated navigations.');
		} else {
			nav_menu = nav_menu;
		}
		var navigation_element = $(nav_menu).first();
		// check has child submenu
		function check_sub(navi_class) {
			var submenu = $(navi_class + ' ul li').has('ul');
			var icon = 'sub-icon';
			submenu.addClass('hasSub');
			submenu.append('<span class="' + icon + '">+</span>');
			// $('.hasSub > ul').addClass('animated slideInDown');
			var sub_icon = $(nav_menu + ' .' + icon);

			if ($('.megachild').length) {
				var submenu = $('.' + navi_class + ' ul>li').has('ul.megachild');
				if (!submenu.hasClass('hasmegachild')) {
					submenu.addClass('hasmegachild');
				}
			} else if ($('.hasmegachild').length) {
				var submenu = $('.' + navi_class + ' ul>li.hasmegachild');
				$('.' + navi_class + ' ul>li.hasmegachild > ul').addClass('megachild');
			}

			sub_icon.click(function clickSubIcon(e) {
				// console.log($(this).hasClass('on'));
				if ($(this).hasClass('on')) {
					$(this).removeClass('on');
					$(this).text('+');
					$(this).parent().removeClass('hasSub_on');
				} else {
					$(this).addClass('on');
					$(this).text('-');
					$(this).parent().addClass('hasSub_on');
				}
			});
		}
		check_sub(nav_menu);
		/* add backdrop_nav */
		var backdrop_class = backdrop_nav.replace(/\.|\#/g, ' ');
		navigation_element.prepend('<div class="' + backdrop_class + '"></div>');
		var backdrop = $(backdrop_class.split(' ').join('.'));
		if (!navigation_element.hasClass('nav-open')) {
			backdrop.hide();
		} else {
			backdrop.show();
		}

		var nav_toggle = function nav_toggle(nav_menu) {
			if (!navigation_element.hasClass('nav-open')) {
				navigation_element.addClass('nav-open');
				backdrop.show();
			} else {
				navigation_element.removeClass('nav-open');
				backdrop.hide();
			}
		};
		if (addIcon) {
			var nav_icon_text = '<span class="' + navi_icon.replace(/\.|\#/g, ' ') + '"><span></span></span>';
			navigation_element.prepend(nav_icon_text);
			navi_icon = $(navi_icon);
		}
		navi_icon.click(function () {
			nav_toggle(navigation_element);
		});
		backdrop.click(function () {
			nav_toggle(navigation_element);
		});
	};

	navigation('.navigation_icon.nav-left', '.navigation.nav-left', '.backdrop_nav.nav-left');
	navigation('.fa.fa-user.nav-right', '.navigation.nav-right', '.backdrop_nav.nav-right');

	/* FIX TOP */
	var fixtop = function fixtop(topfix) {
		var top;
		if (topfix === undefined) {
			top = $('.top');
		} else {
			top = topfix;
		}
		if (top.length === 0) return;
		var topPosition = top.offset().top;

		var fixed = function fixed() {
			if (!top.hasClass('isfixed')) {
				top.addClass('isfixed');
				$('body').addClass('topfixed');
			}
		};
		var removefixed = function removefixed() {
			if (top.hasClass('isfixed')) {
				top.removeClass('isfixed');
				$('body').removeClass('topfixed');
			}
		};

		$(window).on('scroll', function () {
			if ($(window).width() > 768) {
				if ($(window).scrollTop() > topPosition) {
					fixed();
				} else {
					removefixed();
				}
			} else {
				removefixed();
			}
		});
	};
	fixtop($('.fix-top'));
});

},{}],6:[function(require,module,exports){
arguments[4][3][0].apply(exports,arguments)
},{"dup":3}],7:[function(require,module,exports){
"use strict";

jQuery(document).ready(function ($) {
    $(".partners-carousel").owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 3
            },
            480: {
                items: 4
            },
            768: {
                items: 6
            }
        }
    });
});

},{}],8:[function(require,module,exports){
"use strict";

jQuery(document).ready(function ($) {
    $(".slide-owl-carousel").owlCarousel({
        loop: true,
        dots: true,
        autoplay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            768: {
                items: 1
            }
        }
    });
});

},{}],9:[function(require,module,exports){
'use strict';

(function ($) {
    $('body').append('<a class="backtotop btn btn-raised btn-primary" href="#0"><span>Top</span></a>');
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,

    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
    offset_opacity = 1200,

    //duration of the top scrolling animation (in ms)
    scroll_top_duration = 700,

    //grab the "back to top" link
    $back_to_top = $('.backtotop');

    $(window).scroll(function () {
        $(this).scrollTop() > offset ? $back_to_top.addClass('is-visible') : $back_to_top.removeClass('is-visible fade-out');
        if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('fade-out');
        }
    });

    $back_to_top.on('click', function (event) {
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0
        }, scroll_top_duration);
    });
})(jQuery);

},{}],10:[function(require,module,exports){
'use strict';

require('./_backtotop');

require('../../app/components/build');

$(function () {
	var configDatePicker = {
		showOtherMonths: true
	};
	$('#start-date').datepicker(configDatePicker);
	$('#end-date').datepicker(configDatePicker);
});

},{"../../app/components/build":2,"./_backtotop":9}]},{},[10])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhcHAvY29tcG9uZW50cy9ib290c3RyYXAvY2Fyb3VzZWwvaW5kZXguanMiLCJhcHAvY29tcG9uZW50cy9idWlsZC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL2JyZWFkY3J1bWIvaW5kZXguanMiLCJhcHAvY29tcG9uZW50cy9jdXN0b210aGVtZS9jb21tb25zL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvbmF2aWdhdGlvbi9pbmRleC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL3BhcnRuZXJzL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvc2xpZGUtb3dsL2luZGV4LmpzIiwic3JjL21haW4vX2JhY2t0b3RvcC5qcyIsInNyYy9tYWluL2FwcC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7O0FDQUEsRUFBRSxZQUFXOztBQUVULE1BQUUsaUJBQUYsRUFBcUIsUUFBckIsQ0FBOEI7QUFDMUIsa0JBQVUsSUFEZ0I7QUFFMUIsZUFBTztBQUZtQixLQUE5Qjs7QUFLQSxNQUFFLGlCQUFGLEVBQXFCLEVBQXJCLENBQXdCLG1CQUF4QixFQUE2QyxVQUFVLENBQVYsRUFBYTtBQUN0RDtBQUNBLFlBQUksZ0JBQWdCLEVBQUUsRUFBRSxFQUFFLGFBQUosRUFBbUIsSUFBbkIsQ0FBd0IsTUFBeEIsQ0FBRixDQUFwQjtBQUNBLFlBQUksUUFBUSxFQUFFLEVBQUUsYUFBSixFQUFtQixJQUFuQixDQUF3QixPQUF4QixDQUFaO0FBQ0EsWUFBSSxTQUFTLEVBQUUsRUFBRSxhQUFKLEVBQW1CLElBQW5CLENBQXdCLE1BQXhCLENBQWI7QUFDQSxZQUFJLFVBQVUsRUFBRSxFQUFFLGFBQUosRUFBbUIsSUFBbkIsQ0FBd0IsT0FBeEIsQ0FBZDtBQUNBLFlBQUksV0FBVyxFQUFFLEVBQUUsYUFBSixFQUFtQixJQUFuQixD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RFksU0FBdkIsRUFFRyxtQkFGSDtBQUlILEtBTkQ7QUFPSCxDQXpCRCxFQXlCRyxNQXpCSDs7Ozs7QUNBQTs7QUFDQTs7QUFHQSxFQUFFLFlBQVU7QUFDWCxLQUFJLG1CQUFtQjtBQUN0QixtQkFBaUI7QUFESyxFQUF2QjtBQUdBLEdBQUUsYUFBRixFQUFpQixVQUFqQixDQUE0QixnQkFBNUI7QUFDQSxHQUFFLFdBQUYsRUFBZSxVQUFmLENBQTBCLGdCQUExQjtBQUNBLENBTkQiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCIkKGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICQoJyNjYXJvdXNlbFNsaWRlcicpLmNhcm91c2VsKHtcclxuICAgICAgICBpbnRlcnZhbDogMzAzMCxcclxuICAgICAgICBjeWNsZTogdHJ1ZVxyXG4gICAgfSk7XHJcbiAgICBcclxuICAgICQoXCIjY2Fyb3VzZWxTbGlkZXJcIikub24oJ3NsaWRlLmJzLmNhcm91c2VsJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAvLyBjb25zb2xlLmxvZygnQSBuZXcgc2xpZGUgaXMgYWJvdXQgdG8gYmUgc2hvd24hJywgZSwgZS50bywgZS5yZWxhdGVkVGFyZ2V0KTtcclxuICAgICAgICB2YXIgY29udGFpbmVyTm9kZSA9ICQoJChlLnJlbGF0ZWRUYXJnZXQpLmRhdGEoJ25vZGUnKSk7XHJcbiAgICAgICAgdmFyIGJnSW1nID0gJChlLnJlbGF0ZWRUYXJnZXQpLmRhdGEoJ2ltYWdlJyk7XHJcbiAgICAgICAgdmFyIGJnU2l6ZSA9ICQoZS5yZWxhdGVkVGFyZ2V0KS5kYXRhKCdzaXplJyk7XHJcbiAgICAgICAgdmFyIGJnQ29sb3IgPSAkKGUucmVsYXRlZFRhcmdldCkuZGF0YSgnY29sb3InKTtcclxuICAgICAgICB2YXIgYmdSZXBlYXQgPSAkKGUucmVsYXRlZFRhcmdldCkuZGF0YSgncmVwZWF0Jyk7XHJcbiAgICAgICAgdmFyIGJnUG9zaXRpb24gPSAkKGUucmVsYXRlZFRhcmdldCkuZGF0YSgncG9zaXRpb24nKTtcclxuICAgICAgICAvLyBjb25zb2xlLmxvZygnbm9kZTogJywgKGNvbnRhaW5lck5vZGUubGVuZ3RoID4gMCkgJiYgYmdJbWcsICdpbWcnLCBiZ0ltZylcclxuICAgICAgICBpZiAoYmdJbWcpIHtcclxuICAgICAgICAgICAgaWYgKGNvbnRhaW5lck5vZGUubGVuZ3RoID4gMCkge1xyXG4gICAgICAgICAgICAgICAgY29udGFpbmVyTm9kZS5jc3Moe1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmRSZXBlYXQ6IGJnUmVwZWF0IHx8ICduby1yZXBlYXQnLFxyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmRJbWFnZTogJ3VybCgnICsgYmdJbWcgKyAnKScsXHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZFBvc2l0aW9uOiBiZ1Bvc2l0aW9uIHx8ICdjZW50ZXIgYm90dG9tJyxcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kU2l6ZTogYmdTaXplIHx8ICcxMDAlIGF1dG8nLFxyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmRDb2xvcjogYmdDb2xvclxyXG4gICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9IGVsc2UgY29udGFpbmVyTm9kZS5jc3MoJ2JhY2tncm91bmQtaW1hZ2UnLCAnJyk7XHJcbiAgICB9KTtcclxufSk7XHJcbiIsInZhciBjYXJvdXNlbD0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9zbGlkZS1vd2wvaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9ib290c3RyYXAvY2Fyb3VzZWwvaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9uYXZpZ2F0aW9uL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvY29tbW9ucy9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL3BhcnRuZXJzL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvYnJlYWRjcnVtYi9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL3BhZ2luYXRpb24vaW5kZXguanMnKSIsIlwidXNlIHN0cmljdFwiO1xuLy8jIHNvdXJjZU1hcHBpbmdVUkw9ZGF0YTphcHBsaWNhdGlvbi9qc29uO2NoYXJzZXQ9dXRmLTg7YmFzZTY0LGV5SjJaWEp6YVc5dUlqb3pMQ0p6YjNWeVkyVnpJanBiWFN3aWJtRnRaWE1pT2x0ZExDSnRZWEJ3YVc1bmN5STZJaUlzSW1acGJHVWlPaUpwYm1SbGVDNXFjeUlzSW5OdmRYSmpaWE5EYjI1MFpXNTBJanBiWFgwPSIsIiQoXCIucHJvLXNlcnZpY2VzLWNhcm91c2VsXCIpLm93bENhcm91c2VsKHtcclxuICAgIGxvb3A6IHRydWUsXHJcbiAgICBkb3RzOiB0cnVlLFxyXG4gICAgY2VudGVyOnRydWUsXHJcbiAgICBtYXJnaW46IDIwLFxyXG4gICAgLy8gYXV0b3BsYXk6IHRydWUsXHJcbiAgICAvLyBhdXRvcGxheVRpbWVvdXQ6IDE1MDAwLFxyXG4gICAgbmF2OiB0cnVlLFxyXG4gICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICByZXNwb25zaXZlOiB7XHJcbiAgICAgICAgMDoge1xyXG4gICAgICAgICAgICBpdGVtczogMSxcclxuICAgICAgICAgICAgbWFyZ2luOiAxNSxcclxuICAgICAgICAgICAgbmF2OiBmYWxzZVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgNDgwOiB7XHJcbiAgICAgICAgICAgIGl0ZW1zOiAyLFxyXG4gICAgICAgICAgICBtYXJnaW46IDE1LFxyXG4gICAgICAgICAgICBuYXY6IGZhbHNlXHJcbiAgICAgICAgfSxcclxuICAgICAgICA3Njg6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDMsXHJcbiAgICAgICAgICAgIG1hcmdpbjogMTUsXHJcbiAgICAgICAgICAgIG5hdjogZmFsc2VcclxuICAgICAgICB9LFxyXG4gICAgICAgIDEyMDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDNcclxuICAgICAgICB9LFxyXG4gICAgICAgIDE0MDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDNcclxuICAgICAgICB9LFxyXG4gICAgICAgIDE2MDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDNcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0pO1xyXG5cclxudmFyIHN5bmMxID0gJChcIi5tYWluLWNhcm91c2VsXCIpO1xyXG52YXIgc3luYzIgPSAkKFwiLnRodW1iLWNhcm91c2VsXCIpO1xyXG5zeW5jMS5vd2xDYXJvdXNlbCh7IFxyXG4gICAgbG9vcDogZmFsc2UsXHJcbiAgICBkb3RzOiBmYWxzZSxcclxuICAgIG1hcmdpbjogMjAsXHJcbiAgICBuYXY6IGZhbHNlLFxyXG4gICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICBpdGVtczogMVxyXG59KS5vbignY2hhbmdlZC5vd2wuY2Fyb3VzZWwnLCBzeW5jUG9zaXRpb24pO1xyXG52YXIgc3luYzJPcHRpb25zID0geyBcclxuICAgIGxvb3A6IGZhbHNlLFxyXG4gICAgZG90czogZmFsc2UsXHJcbiAgICBtYXJnaW46IDIwLFxyXG4gICAgLy8gYXV0b3BsYXk6IHRydWUsXHJcbiAgICAvLyBhdXRvcGxheVRpbWVvdXQ6IDE1MDAwLFxyXG4gICAgbmF2OiB0cnVlLFxyXG4gICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICBpdGVtczogNFxyXG4gICAgLy8gcmVzcG9uc2l2ZToge1xyXG4gICAgLy8gICAgIDA6IHtcclxuICAgIC8vICAgICAgICAgaXRlbXM6IDIsXHJcbiAgICAvLyAgICAgICAgIG1hcmdpbjogMTUsXHJcbiAgICAvLyAgICAgICAgIG5hdjogZmFsc2VcclxuICAgIC8vICAgICB9LFxyXG4gICAgLy8gICAgIDQ4MDoge1xyXG4gICAgLy8gICAgICAgICBpdGVtczogMixcclxuICAgIC8vICAgICAgICAgbWFyZ2luOiAxNSxcclxuICAgIC8vICAgICAgICAgbmF2OiBmYWxzZVxyXG4gICAgLy8gICAgIH0sXHJcbiAgICAvLyAgICAgNzY4OiB7XHJcbiAgICAvLyAgICAgICAgIGl0ZW1zOiAzLFxyXG4gICAgLy8gICAgICAgICBtYXJnaW46IDE1LFxyXG4gICAgLy8gICAgICAgICBuYXY6IGZhbHNlXHJcbiAgICAvLyAgICAgfSxcclxuICAgIC8vICAgICAxMjAwOiB7XHJcbiAgICAvLyAgICAgICAgIGl0ZW1zOiAzLFxyXG4gICAgLy8gICAgICAgICBtYXJnaW46IDE1XHJcbiAgICAvLyAgICAgfSxcclxuICAgIC8vICAgICAxNDAwOiB7XHJcbiAgICAvLyAgICAgICAgIGl0ZW1zOiAzLFxyXG4gICAgLy8gICAgICAgICBtYXJnaW46IDE1XHJcbiAgICAvLyAgICAgfSxcclxuICAgIC8vICAgICAxNjAwOiB7XHJcbiAgICAvLyAgICAgICAgIGl0ZW1zOiAzLFxyXG4gICAgLy8gICAgICAgICBtYXJnaW46IDE1XHJcbiAgICAvLyAgICAgfVxyXG4gICAgLy8gfVxyXG59O1xyXG4gIHZhciBzeW5jZWRTZWNvbmRhcnkgPSB0cnVlO1xyXG5cclxuXHJcbiAgc3luYzJcclxuICAgIC5vbignaW5pdGlhbGl6ZWQub3dsLmNhcm91c2VsJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICBzeW5jMi5maW5kKFwiLm93bC1pdGVtXCIpLmVxKDApLmFkZENsYXNzKFwiY3VycmVudFwiKTtcclxuICAgIH0pXHJcbiAgICAub3dsQ2Fyb3VzZWwoc3luYzJPcHRpb25zKS5vbignY2hhbmdlZC5vd2wuY2Fyb3VzZWwnLCBzeW5jUG9zaXRpb24yKTtcclxuXHJcbiAgZnVuY3Rpb24gc3luY1Bvc2l0aW9uKGVsKSB7XHJcbiAgICAvL2lmIHNldCBsb29wIHRvIGZhbHNlXHJcbiAgICB2YXIgY3VycmVudCA9IGVsLml0ZW0uaW5kZXg7XHJcbiAgICBcclxuICAgIC8vaWYgeW91IGRpc2FibGUgbG9vcCwgY29tbWVudCB0aGlzIGJsb2NrXHJcbiAgICAvLyB2YXIgY291bnQgPSBlbC5pdGVtLmNvdW50LTE7XHJcbiAgICAvLyB2YXIgY3VycmVudCA9IE1hdGgucm91bmQoZWwuaXRlbS5pbmRleCAtIChlbC5pdGVtLmNvdW50LzIpIC0gLjUpO1xyXG4gICAgXHJcbiAgICAvLyBpZihjdXJyZW50IDwgMCkge1xyXG4gICAgLy8gICBjdXJyZW50ID0gY291bnQ7XHJcbiAgICAvLyB9XHJcbiAgICAvLyBpZihjdXJyZW50ID4gY291bnQpwqB7XHJcbiAgICAvLyAgIGN1cnJlbnQgPSAwO1xyXG4gICAgLy8gfVxyXG4gICAgXHJcbiAgICAvL2VuZCBibG9ja1xyXG5cclxuICAgIHN5bmMyXHJcbiAgICAgIC5maW5kKFwiLm93bC1pdGVtXCIpXHJcbiAgICAgIC5yZW1vdmVDbGFzcyhcImN1cnJlbnRcIilcclxuICAgICAgLmVxKGN1cnJlbnQpXHJcbiAgICAgIC5hZGRDbGFzcyhcImN1cnJlbnRcIik7XHJcbiAgICB2YXIgb25zY3JlZW4gPSBzeW5jMi5maW5kKCcub3dsLWl0ZW0uYWN0aXZlJykubGVuZ3RoIC0gMTtcclxuICAgIHZhciBzdGFydCA9IHN5bmMyLmZpbmQoJy5vd2wtaXRlbS5hY3RpdmUnKS5maXJzdCgpLmluZGV4KCk7XHJcbiAgICB2YXIgZW5kID0gc3luYzIuZmluZCgnLm93bC1pdGVtLmFjdGl2ZScpLmxhc3QoKS5pbmRleCgpO1xyXG4gICAgXHJcbiAgICBpZiAoY3VycmVudCA+IGVuZCkge1xyXG4gICAgICBzeW5jMi5kYXRhKCdvd2wuY2Fyb3VzZWwnKS50byhjdXJyZW50LCAxMDAsIHRydWUpO1xyXG4gICAgfVxyXG4gICAgaWYgKGN1cnJlbnQgPCBzdGFydCkge1xyXG4gICAgICBzeW5jMi5kYXRhKCdvd2wuY2Fyb3VzZWwnKS50byhjdXJyZW50IC0gb25zY3JlZW4sIDEwMCwgdHJ1ZSk7XHJcbiAgICB9XHJcbiAgfVxyXG4gIFxyXG4gIGZ1bmN0aW9uIHN5bmNQb3NpdGlvbjIoZWwpIHtcclxuICAgIGlmKHN5bmNlZFNlY29uZGFyeSkge1xyXG4gICAgICB2YXIgbnVtYmVyID0gZWwuaXRlbS5pbmRleDtcclxuICAgICAgc3luYzEuZGF0YSgnb3dsLmNhcm91c2VsJykudG8obnVtYmVyLCAxMDAsIHRydWUpO1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICBzeW5jMi5vbihcImNsaWNrXCIsIFwiLm93bC1pdGVtXCIsIGZ1bmN0aW9uKGUpe1xyXG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgdmFyIG51bWJlciA9ICQodGhpcykuaW5kZXgoKTtcclxuICAgIHN5bmMxLmRhdGEoJ293bC5jYXJvdXNlbCcpLnRvKG51bWJlciwgMzAwLCB0cnVlKTtcclxuICB9KTsiLCIkKGZ1bmN0aW9uICgpe1xyXG5cdCd1c2Ugc3RyaWN0JztcclxuXHRcclxuXHQvKiBOYXZpZ2F0aW9uICovXHJcblx0dmFyIG5hdmlnYXRpb24gPSBmdW5jdGlvbiAobmF2aV9pY29uID0gJy5uYXZpZ2F0aW9uX2ljb24nLCBuYXZfbWVudSA9ICcubmF2aWdhdGlvbicsIGJhY2tkcm9wX25hdiA9ICdiYWNrZHJvcF9uYXYnKSB7IFxyXG5cdFx0dmFyIGFkZEljb24gPSBmYWxzZTtcclxuXHRcdGlmICgkKG5hdmlfaWNvbikubGVuZ3RoIDwgMSkge1xyXG5cdFx0XHQvLyBjb25zb2xlLmxvZygnYWRkIG5ldyBpY29uIG1lbnUnKTtcclxuXHRcdFx0dmFyIGFkZEljb24gPSB0cnVlO1xyXG5cdFx0fSAgXHJcblxyXG5cdFx0aWYgKCQobmF2X21lbnUpLmxlbmd0aCA8IDEpIHtcclxuXHRcdFx0Ly8gY29uc29sZS5sb2coXCJuYXZfbWVudSBub3QgZm91bmRcIik7XHJcblx0XHRcdHJldHVybjtcclxuXHRcdH0gZWxzZSBpZiAoJChuYXZfbWVudSkubGVuZ3RoID4gMSkge1xyXG5cdFx0XHRjb25zb2xlLndhcm4oJ1RoZXJlIGFyZSBkdXBsaWNhdGVkIG5hdmlnYXRpb25zLicpXHJcblx0XHR9XHJcblx0XHRlbHNlIHtcclxuXHRcdFx0bmF2X21lbnUgPSBuYXZfbWVudTsgXHJcblx0XHR9XHJcblx0XHR2YXIgbmF2aWdhdGlvbl9lbGVtZW50ID0gJChuYXZfbWVudSkuZmlyc3QoKTtcclxuXHRcdC8vIGNoZWNrIGhhcyBjaGlsZCBzdWJtZW51XHJcblx0XHRmdW5jdGlvbiBjaGVja19zdWIobmF2aV9jbGFzcyl7XHJcblx0XHRcdHZhciBzdWJtZW51ID0gJChuYXZpX2NsYXNzICsgJyB1bCBsaScpLmhhcygndWwnKTtcclxuXHRcdFx0dmFyIGljb24gPSAnc3ViLWljb24nO1xyXG5cdFx0XHRzdWJtZW51LmFkZENsYXNzKCdoYXNTdWInKTtcclxuXHRcdFx0c3VibWVudS5hcHBlbmQoJzxzcGFuIGNsYXNzPVwiJytpY29uKydcIj4rPC9zcGFuPicpXHJcblx0XHRcdC8vICQoJy5oYXNTdWIgPiB1bCcpLmFkZENsYXNzKCdhbmltYXRlZCBzbGlkZUluRG93bicpO1xyXG5cdFx0XHR2YXIgc3ViX2ljb24gPSAkKG5hdl9tZW51ICsgJyAuJytpY29uKTsgXHJcblxyXG5cdFx0XHRpZiAoJCgnLm1lZ2FjaGlsZCcpLmxlbmd0aCkgeyBcclxuXHRcdFx0XHR2YXIgc3VibWVudSA9ICQoJy4nK25hdmlfY2xhc3MgKyAnIHVsPmxpJykuaGFzKCd1bC5tZWdhY2hpbGQnKTtcclxuXHRcdFx0XHRpZiAoIXN1Ym1lbnUuaGFzQ2xhc3MoJ2hhc21lZ2FjaGlsZCcpKSB7XHJcblx0XHRcdFx0XHRzdWJtZW51LmFkZENsYXNzKCdoYXNtZWdhY2hpbGQnKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSBpZiAoJCgnLmhhc21lZ2FjaGlsZCcpLmxlbmd0aCkgeyBcclxuXHRcdFx0XHR2YXIgc3VibWVudSA9ICQoJy4nK25hdmlfY2xhc3MgKyAnIHVsPmxpLmhhc21lZ2FjaGlsZCcpO1xyXG5cdFx0XHRcdCQoJy4nK25hdmlfY2xhc3MgKyAnIHVsPmxpLmhhc21lZ2FjaGlsZCA+IHVsJykuYWRkQ2xhc3MoJ21lZ2FjaGlsZCcpO1xyXG5cdFx0XHR9XHJcblx0XHRcdFxyXG5cdFx0XHRzdWJfaWNvbi5jbGljayhmdW5jdGlvbiBjbGlja1N1Ykljb24oZSl7XHJcblx0XHRcdFx0Ly8gY29uc29sZS5sb2coJCh0aGlzKS5oYXNDbGFzcygnb24nKSk7XHJcblx0XHRcdFx0aWYgKCQodGhpcykuaGFzQ2xhc3MoJ29uJykpe1xyXG5cdFx0XHRcdFx0JCh0aGlzKS5yZW1vdmVDbGFzcygnb24nKTtcclxuXHRcdFx0XHRcdCQodGhpcykudGV4dCgnKycpO1xyXG5cdFx0XHRcdFx0JCh0aGlzKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnaGFzU3ViX29uJyk7XHJcblx0XHRcdFx0fSBlbHNlIHtcclxuXHRcdFx0XHRcdCQodGhpcykuYWRkQ2xhc3MoJ29uJyk7XHJcblx0XHRcdFx0XHQkKHRoaXMpLnRleHQoJy0nKTtcclxuXHRcdFx0XHRcdCQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoJ2hhc1N1Yl9vbicpO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSk7XHJcblx0XHR9IFxyXG5cdFx0Y2hlY2tfc3ViKG5hdl9tZW51KTtcclxuXHRcdC8qIGFkZCBiYWNrZHJvcF9uYXYgKi9cclxuXHRcdHZhciBiYWNrZHJvcF9jbGFzcyA9IGJhY2tkcm9wX25hdi5yZXBsYWNlKC9cXC58XFwjL2csJyAnKTtcclxuXHRcdG5hdmlnYXRpb25fZWxlbWVudC5wcmVwZW5kKCc8ZGl2IGNsYXNzPVwiJytiYWNrZHJvcF9jbGFzcysnXCI+PC9kaXY+Jyk7XHJcblx0XHR2YXIgYmFja2Ryb3AgPSAkKGJhY2tkcm9wX2NsYXNzLnNwbGl0KCcgJykuam9pbignLicpKTtcclxuXHRcdGlmICghbmF2aWdhdGlvbl9lbGVtZW50Lmhhc0NsYXNzKCduYXYtb3BlbicpKXtcclxuXHRcdFx0YmFja2Ryb3AuaGlkZSgpO1xyXG5cdFx0fVxyXG5cdFx0ZWxzZSB7XHJcblx0XHRcdGJhY2tkcm9wLnNob3coKTtcclxuXHRcdH1cclxuXHJcblx0XHR2YXIgbmF2X3RvZ2dsZSA9IGZ1bmN0aW9uIChuYXZfbWVudSkge1xyXG5cdFx0XHRpZiAoIW5hdmlnYXRpb25fZWxlbWVudC5oYXNDbGFzcygnbmF2LW9wZW4nKSl7XHJcblx0XHRcdFx0bmF2aWdhdGlvbl9lbGVtZW50LmFkZENsYXNzKCduYXYtb3BlbicpO1xyXG5cdFx0XHRcdGJhY2tkcm9wLnNob3coKTsgXHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSB7XHJcblx0XHRcdFx0bmF2aWdhdGlvbl9lbGVtZW50LnJlbW92ZUNsYXNzKCduYXYtb3BlbicpO1xyXG5cdFx0XHRcdGJhY2tkcm9wLmhpZGUoKTsgXHJcblx0XHRcdH1cclxuXHRcdH07IFxyXG5cdFx0aWYgKGFkZEljb24pIHsgXHJcblx0XHRcdHZhciBuYXZfaWNvbl90ZXh0ICA9ICc8c3BhbiBjbGFzcz1cIicrbmF2aV9pY29uLnJlcGxhY2UoL1xcLnxcXCMvZywnICcpKydcIj48c3Bhbj48L3NwYW4+PC9zcGFuPic7XHJcblx0XHRcdG5hdmlnYXRpb25fZWxlbWVudC5wcmVwZW5kKG5hdl9pY29uX3RleHQpO1xyXG5cdFx0XHRuYXZpX2ljb24gPSAkKG5hdmlfaWNvbik7XHJcblx0XHR9XHJcblx0XHRuYXZpX2ljb24uY2xpY2soZnVuY3Rpb24gKCl7XHJcblx0XHRcdG5hdl90b2dnbGUobmF2aWdhdGlvbl9lbGVtZW50KTsgIFxyXG5cdFx0fSk7XHJcblx0XHRiYWNrZHJvcC5jbGljayhmdW5jdGlvbiAoKXtcclxuXHRcdFx0bmF2X3RvZ2dsZShuYXZpZ2F0aW9uX2VsZW1lbnQpOyAgXHJcblx0XHR9KTtcclxuXHR9O1xyXG5cclxuXHRuYXZpZ2F0aW9uKCcubmF2aWdhdGlvbl9pY29uLm5hdi1sZWZ0JywgJy5uYXZpZ2F0aW9uLm5hdi1sZWZ0JywgJy5iYWNrZHJvcF9uYXYubmF2LWxlZnQnKTtcclxuXHRuYXZpZ2F0aW9uKCcuZmEuZmEtdXNlci5uYXYtcmlnaHQnLCAnLm5hdmlnYXRpb24ubmF2LXJpZ2h0JywgJy5iYWNrZHJvcF9uYXYubmF2LXJpZ2h0Jyk7XHJcblxyXG5cclxuXHQvKiBGSVggVE9QICovXHJcblx0dmFyIGZpeHRvcCA9IGZ1bmN0aW9uICh0b3BmaXgpe1xyXG5cdFx0dmFyIHRvcDtcclxuXHRcdGlmICh0b3BmaXggPT09IHVuZGVmaW5lZCkge1xyXG5cdFx0XHR0b3AgPSAkKCcudG9wJyk7XHJcblx0XHR9XHJcblx0XHRlbHNlIHtcclxuXHRcdFx0dG9wID0gdG9wZml4O1xyXG5cdFx0fVxyXG5cdFx0aWYgKHRvcC5sZW5ndGggPT09IDApIHJldHVybjtcclxuXHRcdHZhciB0b3BQb3NpdGlvbiA9IHRvcC5vZmZzZXQoKS50b3A7XHJcblxyXG5cdFx0dmFyIGZpeGVkID0gZnVuY3Rpb24oKSB7XHJcblx0XHRcdGlmICghdG9wLmhhc0NsYXNzKCdpc2ZpeGVkJykpIHtcclxuXHRcdFx0XHR0b3AuYWRkQ2xhc3MoJ2lzZml4ZWQnKTtcclxuXHRcdFx0XHQkKCdib2R5JykuYWRkQ2xhc3MoJ3RvcGZpeGVkJyk7XHJcblx0XHRcdH1cclxuXHRcdH07XHJcblx0XHR2YXIgcmVtb3ZlZml4ZWQgPSBmdW5jdGlvbiAoKSB7XHJcblx0XHRcdGlmICh0b3AuaGFzQ2xhc3MoJ2lzZml4ZWQnKSkge1xyXG5cdFx0XHRcdHRvcC5yZW1vdmVDbGFzcygnaXNmaXhlZCcpO1xyXG5cdFx0XHRcdCQoJ2JvZHknKS5yZW1vdmVDbGFzcygndG9wZml4ZWQnKTtcclxuXHRcdFx0fVxyXG5cdFx0fTtcclxuXHJcblx0XHQkKHdpbmRvdykub24oJ3Njcm9sbCcsZnVuY3Rpb24oKSB7XHJcblx0XHRcdGlmKCQod2luZG93KS53aWR0aCgpPjc2OCl7XHJcblx0XHRcdFx0aWYoJCh3aW5kb3cpLnNjcm9sbFRvcCgpID4gdG9wUG9zaXRpb24gKSB7IFxyXG5cdFx0XHRcdFx0Zml4ZWQoKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdFx0ZWxzZSB7IFxyXG5cdFx0XHRcdFx0cmVtb3ZlZml4ZWQoKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSB7IFxyXG5cdFx0XHRcdHJlbW92ZWZpeGVkKCk7XHJcblx0XHRcdH1cclxuXHRcdH0pO1xyXG5cdH07XHJcblx0Zml4dG9wKCQoJy5maXgtdG9wJykpO1xyXG59KTsiLCJqUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCQpe1xyXG4gICAgJChcIi5wYXJ0bmVycy1jYXJvdXNlbFwiKS5vd2xDYXJvdXNlbCh7XHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBuYXY6IHRydWUsXHJcbiAgICAgICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIixcIjxpIGNsYXNzPSdmYSBmYS1hbmdsZS1yaWdodCc+PC9pPlwiXSxcclxuICAgICAgICBtYXJnaW46IDIwLFxyXG4gICAgICAgIGF1dG9wbGF5VGltZW91dDogNTAwMCxcclxuICAgICAgICByZXNwb25zaXZlOiB7XHJcbiAgICAgICAgICAgIDAgOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDNcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNDgwIDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiA0XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIDc2OCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogNlxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pOyIsImpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCl7XHJcbiAgICAkKFwiLnNsaWRlLW93bC1jYXJvdXNlbFwiKS5vd2xDYXJvdXNlbCh7XHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBkb3RzOiB0cnVlLFxyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIG5hdjogdHJ1ZSxcclxuICAgICAgICBuYXZUZXh0OiBbXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtbGVmdCc+PC9pPlwiLFwiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLXJpZ2h0Jz48L2k+XCJdLFxyXG4gICAgICAgIG1hcmdpbjogMjAsXHJcbiAgICAgICAgYXV0b3BsYXlUaW1lb3V0OiA1MDAwLFxyXG4gICAgICAgIHJlc3BvbnNpdmU6IHtcclxuICAgICAgICAgICAgMCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogMVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA0ODAgOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDFcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNzY4IDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiAxXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufSk7IiwiKGZ1bmN0aW9uKCQpe1xyXG4gICAgJCgnYm9keScpLmFwcGVuZCgnPGEgY2xhc3M9XCJiYWNrdG90b3AgYnRuIGJ0bi1yYWlzZWQgYnRuLXByaW1hcnlcIiBocmVmPVwiIzBcIj48c3Bhbj5Ub3A8L3NwYW4+PC9hPicpOyAgIFxyXG4gICAgLy8gYnJvd3NlciB3aW5kb3cgc2Nyb2xsIChpbiBwaXhlbHMpIGFmdGVyIHdoaWNoIHRoZSBcImJhY2sgdG8gdG9wXCIgbGluayBpcyBzaG93blxyXG4gICAgdmFyIG9mZnNldCA9IDMwMCxcclxuICAgICAgICAvL2Jyb3dzZXIgd2luZG93IHNjcm9sbCAoaW4gcGl4ZWxzKSBhZnRlciB3aGljaCB0aGUgXCJiYWNrIHRvIHRvcFwiIGxpbmsgb3BhY2l0eSBpcyByZWR1Y2VkXHJcbiAgICAgICAgb2Zmc2V0X29wYWNpdHkgPSAxMjAwLFxyXG4gICAgICAgIC8vZHVyYXRpb24gb2YgdGhlIHRvcCBzY3JvbGxpbmcgYW5pbWF0aW9uIChpbiBtcylcclxuICAgICAgICBzY3JvbGxfdG9wX2R1cmF0aW9uID0gNzAwLFxyXG4gICAgICAgIC8vZ3JhYiB0aGUgXCJiYWNrIHRvIHRvcFwiIGxpbmtcclxuICAgICAgICAkYmFja190b190b3AgPSAkKCcuYmFja3RvdG9wJyk7XHJcblxyXG4gICAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpe1xyXG4gICAgICAgICggJCh0aGlzKS5zY3JvbGxUb3AoKSA+IG9mZnNldCApID8gJGJhY2tfdG9fdG9wLmFkZENsYXNzKCdpcy12aXNpYmxlJykgOiAkYmFja190b190b3AucmVtb3ZlQ2xhc3MoJ2lzLXZpc2libGUgZmFkZS1vdXQnKTtcclxuICAgICAgICBpZiggJCh0aGlzKS5zY3JvbGxUb3AoKSA+IG9mZnNldF9vcGFjaXR5ICkgeyBcclxuICAgICAgICAkYmFja190b190b3AuYWRkQ2xhc3MoJ2ZhZGUtb3V0Jyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG4gICAgJGJhY2tfdG9fdG9wLm9uKCdjbGljaycsIGZ1bmN0aW9uKGV2ZW50KXtcclxuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICQoJ2JvZHksaHRtbCcpLmFuaW1hdGUoe1xyXG4gICAgICAgIHNjcm9sbFRvcDogMCAsXHJcbiAgICAgICAgfSwgc2Nyb2xsX3RvcF9kdXJhdGlvbiBcclxuICAgICAgICApO1xyXG4gICAgfSk7IFxyXG59KShqUXVlcnkpOyIsImltcG9ydCAnLi9fYmFja3RvdG9wJztcclxuaW1wb3J0ICcuLi8uLi9hcHAvY29tcG9uZW50cy9idWlsZCc7XHJcbiBcclxuXHJcbiQoZnVuY3Rpb24oKXtcdFxyXG5cdHZhciBjb25maWdEYXRlUGlja2VyID0geyBcclxuXHRcdHNob3dPdGhlck1vbnRoczogdHJ1ZVxyXG5cdH1cclxuXHQkKCcjc3RhcnQtZGF0ZScpLmRhdGVwaWNrZXIoY29uZmlnRGF0ZVBpY2tlcik7XHJcblx0JCgnI2VuZC1kYXRlJykuZGF0ZXBpY2tlcihjb25maWdEYXRlUGlja2VyKTtcclxufSk7XHJcbiJdfQ==
