(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
'use strict';

var carousel = require('./customtheme/slide-owl/index.js');
var navigation = require('./customtheme/navigation/index.js');
var navigation = require('./customtheme/commons/index.js');
var navigation = require('./customtheme/partners/index.js');
var navigation = require('./customtheme/breadcrumb/index.js');
var navigation = require('./customtheme/pagination/index.js');

},{"./customtheme/breadcrumb/index.js":2,"./customtheme/commons/index.js":3,"./customtheme/navigation/index.js":4,"./customtheme/pagination/index.js":5,"./customtheme/partners/index.js":6,"./customtheme/slide-owl/index.js":7}],2:[function(require,module,exports){
"use strict";

},{}],3:[function(require,module,exports){
"use strict";

$(".pro-services-carousel").owlCarousel({
    loop: false,
    dots: false,
    margin: 20,
    // autoplay: true,
    // autoplayTimeout: 15000,
    nav: true,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive: {
        0: {
            items: 2,
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
            items: 4
        },
        1400: {
            items: 4
        },
        1600: {
            items: 4
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
    itemss: 3
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

},{}],4:[function(require,module,exports){
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

},{}],5:[function(require,module,exports){
arguments[4][2][0].apply(exports,arguments)
},{"dup":2}],6:[function(require,module,exports){
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

},{}],7:[function(require,module,exports){
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

},{}],8:[function(require,module,exports){
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

},{}],9:[function(require,module,exports){
'use strict';

require('./_backtotop');

require('../../app/components/build');

$(function () {
	$('.headwidget-scroll').slimScroll({
		height: 'auto'
	});
});

},{"../../app/components/build":1,"./_backtotop":8}]},{},[9])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhcHAvY29tcG9uZW50cy9idWlsZC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL2JyZWFkY3J1bWIvaW5kZXguanMiLCJhcHAvY29tcG9uZW50cy9jdXN0b210aGVtZS9jb21tb25zL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvbmF2aWdhdGlvbi9pbmRleC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL3BhcnRuZXJzL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvc2xpZGUtb3dsL2luZGV4LmpzIiwic3JjL21haW4vX2JhY2t0b3RvcC5qcyIsInNyYy9tYWluL2FwcC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7O0FDQUEsSUFBSSxXQUFVLFFBQVEsa0NBQVIsQ0FBZDtBQUNBLElBQUksYUFBWSxRQUFRLG1DQUFSLENBQWhCO0FBQ0EsSUFBSSxhQUFZLFFBQVEsZ0NBQVIsQ0FBaEI7QUFDQSxJQUFJLGFBQVksUUFBUSxpQ0FBUixDQUFoQjtBQUNBLElBQUksYUFBWSxRQUFRLG1DQUFSLENBQWhCO0FBQ0EsSUFBSSxhQUFZLFFBQVEsbUNBQVIsQ0FBaEI7OztBQ0xBO0FBQ0E7Ozs7QUNEQSxFQUFFLHdCQUFGLEVBQTRCLFdBQTVCLENBQXdDO0FBQ3BDLFVBQU0sS0FEOEI7QUFFcEMsVUFBTSxLQUY4QjtBQUdwQyxZQUFRLEVBSDRCO0FBSXBDO0FBQ0E7QUFDQSxTQUFLLElBTitCO0FBT3BDLGFBQVMsQ0FBQyxrQ0FBRCxFQUFxQyxtQ0FBckMsQ0FQMkI7QUFRcEMsZ0JBQVk7QUFDUixXQUFHO0FBQ0MsbUJBQU8sQ0FEUjtBQUVDLG9CQUFRLEVBRlQ7QUFHQyxpQkFBSztBQUhOLFNBREs7QUFNUixhQUFLO0FBQ0QsbUJBQU8sQ0FETjtBQUVELG9CQUFRLEVBRlA7QUFHRCxpQkFBSztBQUhKLFNBTkc7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Rkg7QUFJSCxLQU5EO0FBT0gsQ0F6QkQsRUF5QkcsTUF6Qkg7Ozs7O0FDQUE7O0FBQ0E7O0FBRUEsRUFBRSxZQUFVO0FBQ1gsR0FBRSxvQkFBRixFQUF3QixVQUF4QixDQUFtQztBQUNsQyxVQUFRO0FBRDBCLEVBQW5DO0FBR0EsQ0FKRCIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsInZhciBjYXJvdXNlbD0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9zbGlkZS1vd2wvaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9uYXZpZ2F0aW9uL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvY29tbW9ucy9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL3BhcnRuZXJzL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvYnJlYWRjcnVtYi9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL3BhZ2luYXRpb24vaW5kZXguanMnKSIsIlwidXNlIHN0cmljdFwiO1xuLy8jIHNvdXJjZU1hcHBpbmdVUkw9ZGF0YTphcHBsaWNhdGlvbi9qc29uO2NoYXJzZXQ9dXRmLTg7YmFzZTY0LGV5SjJaWEp6YVc5dUlqb3pMQ0p6YjNWeVkyVnpJanBiWFN3aWJtRnRaWE1pT2x0ZExDSnRZWEJ3YVc1bmN5STZJaUlzSW1acGJHVWlPaUpwYm1SbGVDNXFjeUlzSW5OdmRYSmpaWE5EYjI1MFpXNTBJanBiWFgwPSIsIiQoXCIucHJvLXNlcnZpY2VzLWNhcm91c2VsXCIpLm93bENhcm91c2VsKHtcclxuICAgIGxvb3A6IGZhbHNlLFxyXG4gICAgZG90czogZmFsc2UsXHJcbiAgICBtYXJnaW46IDIwLFxyXG4gICAgLy8gYXV0b3BsYXk6IHRydWUsXHJcbiAgICAvLyBhdXRvcGxheVRpbWVvdXQ6IDE1MDAwLFxyXG4gICAgbmF2OiB0cnVlLFxyXG4gICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICByZXNwb25zaXZlOiB7XHJcbiAgICAgICAgMDoge1xyXG4gICAgICAgICAgICBpdGVtczogMixcclxuICAgICAgICAgICAgbWFyZ2luOiAxNSxcclxuICAgICAgICAgICAgbmF2OiBmYWxzZVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgNDgwOiB7XHJcbiAgICAgICAgICAgIGl0ZW1zOiAyLFxyXG4gICAgICAgICAgICBtYXJnaW46IDE1LFxyXG4gICAgICAgICAgICBuYXY6IGZhbHNlXHJcbiAgICAgICAgfSxcclxuICAgICAgICA3Njg6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDMsXHJcbiAgICAgICAgICAgIG1hcmdpbjogMTUsXHJcbiAgICAgICAgICAgIG5hdjogZmFsc2VcclxuICAgICAgICB9LFxyXG4gICAgICAgIDEyMDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDRcclxuICAgICAgICB9LFxyXG4gICAgICAgIDE0MDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDRcclxuICAgICAgICB9LFxyXG4gICAgICAgIDE2MDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDRcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0pO1xyXG5cclxudmFyIHN5bmMxID0gJChcIi5tYWluLWNhcm91c2VsXCIpO1xyXG52YXIgc3luYzIgPSAkKFwiLnRodW1iLWNhcm91c2VsXCIpO1xyXG5zeW5jMS5vd2xDYXJvdXNlbCh7IFxyXG4gICAgbG9vcDogZmFsc2UsXHJcbiAgICBkb3RzOiBmYWxzZSxcclxuICAgIG1hcmdpbjogMjAsXHJcbiAgICBuYXY6IGZhbHNlLFxyXG4gICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICBpdGVtczogMVxyXG59KS5vbignY2hhbmdlZC5vd2wuY2Fyb3VzZWwnLCBzeW5jUG9zaXRpb24pO1xyXG52YXIgc3luYzJPcHRpb25zID0geyBcclxuICAgIGxvb3A6IGZhbHNlLFxyXG4gICAgZG90czogZmFsc2UsXHJcbiAgICBtYXJnaW46IDIwLFxyXG4gICAgLy8gYXV0b3BsYXk6IHRydWUsXHJcbiAgICAvLyBhdXRvcGxheVRpbWVvdXQ6IDE1MDAwLFxyXG4gICAgbmF2OiB0cnVlLFxyXG4gICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICBpdGVtc3M6IDNcclxuICAgIC8vIHJlc3BvbnNpdmU6IHtcclxuICAgIC8vICAgICAwOiB7XHJcbiAgICAvLyAgICAgICAgIGl0ZW1zOiAyLFxyXG4gICAgLy8gICAgICAgICBtYXJnaW46IDE1LFxyXG4gICAgLy8gICAgICAgICBuYXY6IGZhbHNlXHJcbiAgICAvLyAgICAgfSxcclxuICAgIC8vICAgICA0ODA6IHtcclxuICAgIC8vICAgICAgICAgaXRlbXM6IDIsXHJcbiAgICAvLyAgICAgICAgIG1hcmdpbjogMTUsXHJcbiAgICAvLyAgICAgICAgIG5hdjogZmFsc2VcclxuICAgIC8vICAgICB9LFxyXG4gICAgLy8gICAgIDc2ODoge1xyXG4gICAgLy8gICAgICAgICBpdGVtczogMyxcclxuICAgIC8vICAgICAgICAgbWFyZ2luOiAxNSxcclxuICAgIC8vICAgICAgICAgbmF2OiBmYWxzZVxyXG4gICAgLy8gICAgIH0sXHJcbiAgICAvLyAgICAgMTIwMDoge1xyXG4gICAgLy8gICAgICAgICBpdGVtczogMyxcclxuICAgIC8vICAgICAgICAgbWFyZ2luOiAxNVxyXG4gICAgLy8gICAgIH0sXHJcbiAgICAvLyAgICAgMTQwMDoge1xyXG4gICAgLy8gICAgICAgICBpdGVtczogMyxcclxuICAgIC8vICAgICAgICAgbWFyZ2luOiAxNVxyXG4gICAgLy8gICAgIH0sXHJcbiAgICAvLyAgICAgMTYwMDoge1xyXG4gICAgLy8gICAgICAgICBpdGVtczogMyxcclxuICAgIC8vICAgICAgICAgbWFyZ2luOiAxNVxyXG4gICAgLy8gICAgIH1cclxuICAgIC8vIH1cclxufTtcclxuICB2YXIgc3luY2VkU2Vjb25kYXJ5ID0gdHJ1ZTtcclxuXHJcblxyXG4gIHN5bmMyXHJcbiAgICAub24oJ2luaXRpYWxpemVkLm93bC5jYXJvdXNlbCcsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgc3luYzIuZmluZChcIi5vd2wtaXRlbVwiKS5lcSgwKS5hZGRDbGFzcyhcImN1cnJlbnRcIik7XHJcbiAgICB9KVxyXG4gICAgLm93bENhcm91c2VsKHN5bmMyT3B0aW9ucykub24oJ2NoYW5nZWQub3dsLmNhcm91c2VsJywgc3luY1Bvc2l0aW9uMik7XHJcblxyXG4gIGZ1bmN0aW9uIHN5bmNQb3NpdGlvbihlbCkge1xyXG4gICAgLy9pZiBzZXQgbG9vcCB0byBmYWxzZVxyXG4gICAgdmFyIGN1cnJlbnQgPSBlbC5pdGVtLmluZGV4O1xyXG4gICAgXHJcbiAgICAvL2lmIHlvdSBkaXNhYmxlIGxvb3AsIGNvbW1lbnQgdGhpcyBibG9ja1xyXG4gICAgLy8gdmFyIGNvdW50ID0gZWwuaXRlbS5jb3VudC0xO1xyXG4gICAgLy8gdmFyIGN1cnJlbnQgPSBNYXRoLnJvdW5kKGVsLml0ZW0uaW5kZXggLSAoZWwuaXRlbS5jb3VudC8yKSAtIC41KTtcclxuICAgIFxyXG4gICAgLy8gaWYoY3VycmVudCA8IDApIHtcclxuICAgIC8vICAgY3VycmVudCA9IGNvdW50O1xyXG4gICAgLy8gfVxyXG4gICAgLy8gaWYoY3VycmVudCA+IGNvdW50KcKge1xyXG4gICAgLy8gICBjdXJyZW50ID0gMDtcclxuICAgIC8vIH1cclxuICAgIFxyXG4gICAgLy9lbmQgYmxvY2tcclxuXHJcbiAgICBzeW5jMlxyXG4gICAgICAuZmluZChcIi5vd2wtaXRlbVwiKVxyXG4gICAgICAucmVtb3ZlQ2xhc3MoXCJjdXJyZW50XCIpXHJcbiAgICAgIC5lcShjdXJyZW50KVxyXG4gICAgICAuYWRkQ2xhc3MoXCJjdXJyZW50XCIpO1xyXG4gICAgdmFyIG9uc2NyZWVuID0gc3luYzIuZmluZCgnLm93bC1pdGVtLmFjdGl2ZScpLmxlbmd0aCAtIDE7XHJcbiAgICB2YXIgc3RhcnQgPSBzeW5jMi5maW5kKCcub3dsLWl0ZW0uYWN0aXZlJykuZmlyc3QoKS5pbmRleCgpO1xyXG4gICAgdmFyIGVuZCA9IHN5bmMyLmZpbmQoJy5vd2wtaXRlbS5hY3RpdmUnKS5sYXN0KCkuaW5kZXgoKTtcclxuICAgIFxyXG4gICAgaWYgKGN1cnJlbnQgPiBlbmQpIHtcclxuICAgICAgc3luYzIuZGF0YSgnb3dsLmNhcm91c2VsJykudG8oY3VycmVudCwgMTAwLCB0cnVlKTtcclxuICAgIH1cclxuICAgIGlmIChjdXJyZW50IDwgc3RhcnQpIHtcclxuICAgICAgc3luYzIuZGF0YSgnb3dsLmNhcm91c2VsJykudG8oY3VycmVudCAtIG9uc2NyZWVuLCAxMDAsIHRydWUpO1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICBmdW5jdGlvbiBzeW5jUG9zaXRpb24yKGVsKSB7XHJcbiAgICBpZihzeW5jZWRTZWNvbmRhcnkpIHtcclxuICAgICAgdmFyIG51bWJlciA9IGVsLml0ZW0uaW5kZXg7XHJcbiAgICAgIHN5bmMxLmRhdGEoJ293bC5jYXJvdXNlbCcpLnRvKG51bWJlciwgMTAwLCB0cnVlKTtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgc3luYzIub24oXCJjbGlja1wiLCBcIi5vd2wtaXRlbVwiLCBmdW5jdGlvbihlKXtcclxuICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgIHZhciBudW1iZXIgPSAkKHRoaXMpLmluZGV4KCk7XHJcbiAgICBzeW5jMS5kYXRhKCdvd2wuY2Fyb3VzZWwnKS50byhudW1iZXIsIDMwMCwgdHJ1ZSk7XHJcbiAgfSk7IiwiJChmdW5jdGlvbiAoKXtcclxuXHQndXNlIHN0cmljdCc7XHJcblx0XHJcblx0LyogTmF2aWdhdGlvbiAqL1xyXG5cdHZhciBuYXZpZ2F0aW9uID0gZnVuY3Rpb24gKG5hdmlfaWNvbiA9ICcubmF2aWdhdGlvbl9pY29uJywgbmF2X21lbnUgPSAnLm5hdmlnYXRpb24nLCBiYWNrZHJvcF9uYXYgPSAnYmFja2Ryb3BfbmF2JykgeyBcclxuXHRcdHZhciBhZGRJY29uID0gZmFsc2U7XHJcblx0XHRpZiAoJChuYXZpX2ljb24pLmxlbmd0aCA8IDEpIHtcclxuXHRcdFx0Ly8gY29uc29sZS5sb2coJ2FkZCBuZXcgaWNvbiBtZW51Jyk7XHJcblx0XHRcdHZhciBhZGRJY29uID0gdHJ1ZTtcclxuXHRcdH0gIFxyXG5cclxuXHRcdGlmICgkKG5hdl9tZW51KS5sZW5ndGggPCAxKSB7XHJcblx0XHRcdC8vIGNvbnNvbGUubG9nKFwibmF2X21lbnUgbm90IGZvdW5kXCIpO1xyXG5cdFx0XHRyZXR1cm47XHJcblx0XHR9IGVsc2UgaWYgKCQobmF2X21lbnUpLmxlbmd0aCA+IDEpIHtcclxuXHRcdFx0Y29uc29sZS53YXJuKCdUaGVyZSBhcmUgZHVwbGljYXRlZCBuYXZpZ2F0aW9ucy4nKVxyXG5cdFx0fVxyXG5cdFx0ZWxzZSB7XHJcblx0XHRcdG5hdl9tZW51ID0gbmF2X21lbnU7IFxyXG5cdFx0fVxyXG5cdFx0dmFyIG5hdmlnYXRpb25fZWxlbWVudCA9ICQobmF2X21lbnUpLmZpcnN0KCk7XHJcblx0XHQvLyBjaGVjayBoYXMgY2hpbGQgc3VibWVudVxyXG5cdFx0ZnVuY3Rpb24gY2hlY2tfc3ViKG5hdmlfY2xhc3Mpe1xyXG5cdFx0XHR2YXIgc3VibWVudSA9ICQobmF2aV9jbGFzcyArICcgdWwgbGknKS5oYXMoJ3VsJyk7XHJcblx0XHRcdHZhciBpY29uID0gJ3N1Yi1pY29uJztcclxuXHRcdFx0c3VibWVudS5hZGRDbGFzcygnaGFzU3ViJyk7XHJcblx0XHRcdHN1Ym1lbnUuYXBwZW5kKCc8c3BhbiBjbGFzcz1cIicraWNvbisnXCI+Kzwvc3Bhbj4nKVxyXG5cdFx0XHQvLyAkKCcuaGFzU3ViID4gdWwnKS5hZGRDbGFzcygnYW5pbWF0ZWQgc2xpZGVJbkRvd24nKTtcclxuXHRcdFx0dmFyIHN1Yl9pY29uID0gJChuYXZfbWVudSArICcgLicraWNvbik7IFxyXG5cclxuXHRcdFx0aWYgKCQoJy5tZWdhY2hpbGQnKS5sZW5ndGgpIHsgXHJcblx0XHRcdFx0dmFyIHN1Ym1lbnUgPSAkKCcuJytuYXZpX2NsYXNzICsgJyB1bD5saScpLmhhcygndWwubWVnYWNoaWxkJyk7XHJcblx0XHRcdFx0aWYgKCFzdWJtZW51Lmhhc0NsYXNzKCdoYXNtZWdhY2hpbGQnKSkge1xyXG5cdFx0XHRcdFx0c3VibWVudS5hZGRDbGFzcygnaGFzbWVnYWNoaWxkJyk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9XHJcblx0XHRcdGVsc2UgaWYgKCQoJy5oYXNtZWdhY2hpbGQnKS5sZW5ndGgpIHsgXHJcblx0XHRcdFx0dmFyIHN1Ym1lbnUgPSAkKCcuJytuYXZpX2NsYXNzICsgJyB1bD5saS5oYXNtZWdhY2hpbGQnKTtcclxuXHRcdFx0XHQkKCcuJytuYXZpX2NsYXNzICsgJyB1bD5saS5oYXNtZWdhY2hpbGQgPiB1bCcpLmFkZENsYXNzKCdtZWdhY2hpbGQnKTtcclxuXHRcdFx0fVxyXG5cdFx0XHRcclxuXHRcdFx0c3ViX2ljb24uY2xpY2soZnVuY3Rpb24gY2xpY2tTdWJJY29uKGUpe1xyXG5cdFx0XHRcdC8vIGNvbnNvbGUubG9nKCQodGhpcykuaGFzQ2xhc3MoJ29uJykpO1xyXG5cdFx0XHRcdGlmICgkKHRoaXMpLmhhc0NsYXNzKCdvbicpKXtcclxuXHRcdFx0XHRcdCQodGhpcykucmVtb3ZlQ2xhc3MoJ29uJyk7XHJcblx0XHRcdFx0XHQkKHRoaXMpLnRleHQoJysnKTtcclxuXHRcdFx0XHRcdCQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2hhc1N1Yl9vbicpO1xyXG5cdFx0XHRcdH0gZWxzZSB7XHJcblx0XHRcdFx0XHQkKHRoaXMpLmFkZENsYXNzKCdvbicpO1xyXG5cdFx0XHRcdFx0JCh0aGlzKS50ZXh0KCctJyk7XHJcblx0XHRcdFx0XHQkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdoYXNTdWJfb24nKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0pO1xyXG5cdFx0fSBcclxuXHRcdGNoZWNrX3N1YihuYXZfbWVudSk7XHJcblx0XHQvKiBhZGQgYmFja2Ryb3BfbmF2ICovXHJcblx0XHR2YXIgYmFja2Ryb3BfY2xhc3MgPSBiYWNrZHJvcF9uYXYucmVwbGFjZSgvXFwufFxcIy9nLCcgJyk7XHJcblx0XHRuYXZpZ2F0aW9uX2VsZW1lbnQucHJlcGVuZCgnPGRpdiBjbGFzcz1cIicrYmFja2Ryb3BfY2xhc3MrJ1wiPjwvZGl2PicpO1xyXG5cdFx0dmFyIGJhY2tkcm9wID0gJChiYWNrZHJvcF9jbGFzcy5zcGxpdCgnICcpLmpvaW4oJy4nKSk7XHJcblx0XHRpZiAoIW5hdmlnYXRpb25fZWxlbWVudC5oYXNDbGFzcygnbmF2LW9wZW4nKSl7XHJcblx0XHRcdGJhY2tkcm9wLmhpZGUoKTtcclxuXHRcdH1cclxuXHRcdGVsc2Uge1xyXG5cdFx0XHRiYWNrZHJvcC5zaG93KCk7XHJcblx0XHR9XHJcblxyXG5cdFx0dmFyIG5hdl90b2dnbGUgPSBmdW5jdGlvbiAobmF2X21lbnUpIHtcclxuXHRcdFx0aWYgKCFuYXZpZ2F0aW9uX2VsZW1lbnQuaGFzQ2xhc3MoJ25hdi1vcGVuJykpe1xyXG5cdFx0XHRcdG5hdmlnYXRpb25fZWxlbWVudC5hZGRDbGFzcygnbmF2LW9wZW4nKTtcclxuXHRcdFx0XHRiYWNrZHJvcC5zaG93KCk7IFxyXG5cdFx0XHR9XHJcblx0XHRcdGVsc2Uge1xyXG5cdFx0XHRcdG5hdmlnYXRpb25fZWxlbWVudC5yZW1vdmVDbGFzcygnbmF2LW9wZW4nKTtcclxuXHRcdFx0XHRiYWNrZHJvcC5oaWRlKCk7IFxyXG5cdFx0XHR9XHJcblx0XHR9OyBcclxuXHRcdGlmIChhZGRJY29uKSB7IFxyXG5cdFx0XHR2YXIgbmF2X2ljb25fdGV4dCAgPSAnPHNwYW4gY2xhc3M9XCInK25hdmlfaWNvbi5yZXBsYWNlKC9cXC58XFwjL2csJyAnKSsnXCI+PHNwYW4+PC9zcGFuPjwvc3Bhbj4nO1xyXG5cdFx0XHRuYXZpZ2F0aW9uX2VsZW1lbnQucHJlcGVuZChuYXZfaWNvbl90ZXh0KTtcclxuXHRcdFx0bmF2aV9pY29uID0gJChuYXZpX2ljb24pO1xyXG5cdFx0fVxyXG5cdFx0bmF2aV9pY29uLmNsaWNrKGZ1bmN0aW9uICgpe1xyXG5cdFx0XHRuYXZfdG9nZ2xlKG5hdmlnYXRpb25fZWxlbWVudCk7ICBcclxuXHRcdH0pO1xyXG5cdFx0YmFja2Ryb3AuY2xpY2soZnVuY3Rpb24gKCl7XHJcblx0XHRcdG5hdl90b2dnbGUobmF2aWdhdGlvbl9lbGVtZW50KTsgIFxyXG5cdFx0fSk7XHJcblx0fTtcclxuXHJcblx0bmF2aWdhdGlvbignLm5hdmlnYXRpb25faWNvbi5uYXYtbGVmdCcsICcubmF2aWdhdGlvbi5uYXYtbGVmdCcsICcuYmFja2Ryb3BfbmF2Lm5hdi1sZWZ0Jyk7XHJcblx0bmF2aWdhdGlvbignLmZhLmZhLXVzZXIubmF2LXJpZ2h0JywgJy5uYXZpZ2F0aW9uLm5hdi1yaWdodCcsICcuYmFja2Ryb3BfbmF2Lm5hdi1yaWdodCcpO1xyXG5cclxuXHJcblx0LyogRklYIFRPUCAqL1xyXG5cdHZhciBmaXh0b3AgPSBmdW5jdGlvbiAodG9wZml4KXtcclxuXHRcdHZhciB0b3A7XHJcblx0XHRpZiAodG9wZml4ID09PSB1bmRlZmluZWQpIHtcclxuXHRcdFx0dG9wID0gJCgnLnRvcCcpO1xyXG5cdFx0fVxyXG5cdFx0ZWxzZSB7XHJcblx0XHRcdHRvcCA9IHRvcGZpeDtcclxuXHRcdH1cclxuXHRcdGlmICh0b3AubGVuZ3RoID09PSAwKSByZXR1cm47XHJcblx0XHR2YXIgdG9wUG9zaXRpb24gPSB0b3Aub2Zmc2V0KCkudG9wO1xyXG5cclxuXHRcdHZhciBmaXhlZCA9IGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRpZiAoIXRvcC5oYXNDbGFzcygnaXNmaXhlZCcpKSB7XHJcblx0XHRcdFx0dG9wLmFkZENsYXNzKCdpc2ZpeGVkJyk7XHJcblx0XHRcdFx0JCgnYm9keScpLmFkZENsYXNzKCd0b3BmaXhlZCcpO1xyXG5cdFx0XHR9XHJcblx0XHR9O1xyXG5cdFx0dmFyIHJlbW92ZWZpeGVkID0gZnVuY3Rpb24gKCkge1xyXG5cdFx0XHRpZiAodG9wLmhhc0NsYXNzKCdpc2ZpeGVkJykpIHtcclxuXHRcdFx0XHR0b3AucmVtb3ZlQ2xhc3MoJ2lzZml4ZWQnKTtcclxuXHRcdFx0XHQkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ3RvcGZpeGVkJyk7XHJcblx0XHRcdH1cclxuXHRcdH07XHJcblxyXG5cdFx0JCh3aW5kb3cpLm9uKCdzY3JvbGwnLGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRpZigkKHdpbmRvdykud2lkdGgoKT43Njgpe1xyXG5cdFx0XHRcdGlmKCQod2luZG93KS5zY3JvbGxUb3AoKSA+IHRvcFBvc2l0aW9uICkgeyBcclxuXHRcdFx0XHRcdGZpeGVkKCk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHRcdGVsc2UgeyBcclxuXHRcdFx0XHRcdHJlbW92ZWZpeGVkKCk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9XHJcblx0XHRcdGVsc2UgeyBcclxuXHRcdFx0XHRyZW1vdmVmaXhlZCgpO1xyXG5cdFx0XHR9XHJcblx0XHR9KTtcclxuXHR9O1xyXG5cdGZpeHRvcCgkKCcuZml4LXRvcCcpKTtcclxufSk7IiwialF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigkKXtcclxuICAgICQoXCIucGFydG5lcnMtY2Fyb3VzZWxcIikub3dsQ2Fyb3VzZWwoe1xyXG4gICAgICAgIGxvb3A6IHRydWUsXHJcbiAgICAgICAgZG90czogZmFsc2UsXHJcbiAgICAgICAgYXV0b3BsYXk6IHRydWUsXHJcbiAgICAgICAgbmF2OiB0cnVlLFxyXG4gICAgICAgIG5hdlRleHQ6IFtcIjxpIGNsYXNzPSdmYSBmYS1hbmdsZS1sZWZ0Jz48L2k+XCIsXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICAgICAgbWFyZ2luOiAyMCxcclxuICAgICAgICBhdXRvcGxheVRpbWVvdXQ6IDUwMDAsXHJcbiAgICAgICAgcmVzcG9uc2l2ZToge1xyXG4gICAgICAgICAgICAwIDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiAzXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIDQ4MCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogNFxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA3NjggOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDZcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTsiLCJqUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCQpe1xyXG4gICAgJChcIi5zbGlkZS1vd2wtY2Fyb3VzZWxcIikub3dsQ2Fyb3VzZWwoe1xyXG4gICAgICAgIGxvb3A6IHRydWUsXHJcbiAgICAgICAgZG90czogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBuYXY6IHRydWUsXHJcbiAgICAgICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIixcIjxpIGNsYXNzPSdmYSBmYS1hbmdsZS1yaWdodCc+PC9pPlwiXSxcclxuICAgICAgICBtYXJnaW46IDIwLFxyXG4gICAgICAgIGF1dG9wbGF5VGltZW91dDogNTAwMCxcclxuICAgICAgICByZXNwb25zaXZlOiB7XHJcbiAgICAgICAgICAgIDAgOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDFcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNDgwIDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiAxXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIDc2OCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogMVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pOyIsIihmdW5jdGlvbigkKXtcclxuICAgICQoJ2JvZHknKS5hcHBlbmQoJzxhIGNsYXNzPVwiYmFja3RvdG9wIGJ0biBidG4tcmFpc2VkIGJ0bi1wcmltYXJ5XCIgaHJlZj1cIiMwXCI+PHNwYW4+VG9wPC9zcGFuPjwvYT4nKTsgICBcclxuICAgIC8vIGJyb3dzZXIgd2luZG93IHNjcm9sbCAoaW4gcGl4ZWxzKSBhZnRlciB3aGljaCB0aGUgXCJiYWNrIHRvIHRvcFwiIGxpbmsgaXMgc2hvd25cclxuICAgIHZhciBvZmZzZXQgPSAzMDAsXHJcbiAgICAgICAgLy9icm93c2VyIHdpbmRvdyBzY3JvbGwgKGluIHBpeGVscykgYWZ0ZXIgd2hpY2ggdGhlIFwiYmFjayB0byB0b3BcIiBsaW5rIG9wYWNpdHkgaXMgcmVkdWNlZFxyXG4gICAgICAgIG9mZnNldF9vcGFjaXR5ID0gMTIwMCxcclxuICAgICAgICAvL2R1cmF0aW9uIG9mIHRoZSB0b3Agc2Nyb2xsaW5nIGFuaW1hdGlvbiAoaW4gbXMpXHJcbiAgICAgICAgc2Nyb2xsX3RvcF9kdXJhdGlvbiA9IDcwMCxcclxuICAgICAgICAvL2dyYWIgdGhlIFwiYmFjayB0byB0b3BcIiBsaW5rXHJcbiAgICAgICAgJGJhY2tfdG9fdG9wID0gJCgnLmJhY2t0b3RvcCcpO1xyXG5cclxuICAgICQod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKXtcclxuICAgICAgICAoICQodGhpcykuc2Nyb2xsVG9wKCkgPiBvZmZzZXQgKSA/ICRiYWNrX3RvX3RvcC5hZGRDbGFzcygnaXMtdmlzaWJsZScpIDogJGJhY2tfdG9fdG9wLnJlbW92ZUNsYXNzKCdpcy12aXNpYmxlIGZhZGUtb3V0Jyk7XHJcbiAgICAgICAgaWYoICQodGhpcykuc2Nyb2xsVG9wKCkgPiBvZmZzZXRfb3BhY2l0eSApIHsgXHJcbiAgICAgICAgJGJhY2tfdG9fdG9wLmFkZENsYXNzKCdmYWRlLW91dCcpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuICAgICRiYWNrX3RvX3RvcC5vbignY2xpY2snLCBmdW5jdGlvbihldmVudCl7XHJcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAkKCdib2R5LGh0bWwnKS5hbmltYXRlKHtcclxuICAgICAgICBzY3JvbGxUb3A6IDAgLFxyXG4gICAgICAgIH0sIHNjcm9sbF90b3BfZHVyYXRpb24gXHJcbiAgICAgICAgKTtcclxuICAgIH0pOyBcclxufSkoalF1ZXJ5KTsiLCJpbXBvcnQgJy4vX2JhY2t0b3RvcCc7XHJcbmltcG9ydCAnLi4vLi4vYXBwL2NvbXBvbmVudHMvYnVpbGQnO1xyXG5cclxuJChmdW5jdGlvbigpe1xyXG5cdCQoJy5oZWFkd2lkZ2V0LXNjcm9sbCcpLnNsaW1TY3JvbGwoe1xyXG5cdFx0aGVpZ2h0OiAnYXV0bydcclxuXHR9KTtcclxufSk7XHJcbiJdfQ==
