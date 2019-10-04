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
arguments[4][2][0].apply(exports,arguments)
},{"dup":2}],4:[function(require,module,exports){
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhcHAvY29tcG9uZW50cy9idWlsZC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL2JyZWFkY3J1bWIvaW5kZXguanMiLCJhcHAvY29tcG9uZW50cy9jdXN0b210aGVtZS9uYXZpZ2F0aW9uL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvcGFydG5lcnMvaW5kZXguanMiLCJhcHAvY29tcG9uZW50cy9jdXN0b210aGVtZS9zbGlkZS1vd2wvaW5kZXguanMiLCJzcmMvbWFpbi9fYmFja3RvdG9wLmpzIiwic3JjL21haW4vYXBwLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7QUNBQSxJQUFJLFdBQVUsUUFBUSxrQ0FBUixDQUFkO0FBQ0EsSUFBSSxhQUFZLFFBQVEsbUNBQVIsQ0FBaEI7QUFDQSxJQUFJLGFBQVksUUFBUSxnQ0FBUixDQUFoQjtBQUNBLElBQUksYUFBWSxRQUFRLGlDQUFSLENBQWhCO0FBQ0EsSUFBSSxhQUFZLFFBQVEsbUNBQVIsQ0FBaEI7QUFDQSxJQUFJLGFBQVksUUFBUSxtQ0FBUixDQUFoQjs7O0FDTEE7QUFDQTs7Ozs7O0FDREEsRUFBRSxZQUFXO0FBQ1o7O0FBRUE7O0FBQ0EsS0FBSSxhQUFhLFNBQWIsVUFBYSxHQUFtRztBQUFBLE1BQXpGLFNBQXlGLHVFQUE3RSxrQkFBNkU7QUFBQSxNQUF6RCxRQUF5RCx1RUFBOUMsYUFBOEM7QUFBQSxNQUEvQixZQUErQix1RUFBaEIsY0FBZ0I7O0FBQ25ILE1BQUksVUFBVSxLQUFkO0FBQ0EsTUFBSSxFQUFFLFNBQUYsRUFBYSxNQUFiLEdBQXNCLENBQTFCLEVBQTZCO0FBQzVCO0FBQ0EsT0FBSSxVQUFVLElBQWQ7QUFDQTs7QUFFRCxNQUFJLEVBQUUsUUFBRixFQUFZLE1BQVosR0FBcUIsQ0FBekIsRUFBNEI7QUFDM0I7QUFDQTtBQUNBLEdBSEQsTUFHTyxJQUFJLEVBQUUs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O0FBQ0EsMEJBQXNCLEdBSjFCOztBQUtJO0FBQ0EsbUJBQWUsRUFBRSxZQUFGLENBTm5COztBQVFBLE1BQUUsTUFBRixFQUFVLE1BQVYsQ0FBaUIsWUFBVTtBQUNyQixVQUFFLElBQUYsRUFBUSxTQUFSLEtBQXNCLE1BQXhCLEdBQW1DLGFBQWEsUUFBYixDQUFzQixZQUF0QixDQUFuQyxHQUF5RSxhQUFhLFdBQWIsQ0FBeUIscUJBQXpCLENBQXpFO0FBQ0EsWUFBSSxFQUFFLElBQUYsRUFBUSxTQUFSLEtBQXNCLGNBQTFCLEVBQTJDO0FBQzNDLHlCQUFhLFFBQWIsQ0FBc0IsVUFBdEI7QUFDQztBQUNKLEtBTEQ7O0FBT0EsaUJBQWEsRUFBYixDQUFnQixPQUFoQixFQUF5QixVQUFTLEtBQVQsRUFBZTtBQUNwQyxjQUFNLGNBQU47QUFDQSxVQUFFLFdBQUYsRUFBZSxPQUFmLENBQXVCO0FBQ3ZCLHVCQUFXO0FBRFksU0FBdkIsRUFFRyxtQkFGSDtBQUlILEtBTkQ7QUFPSCxDQXpCRCxFQXlCRyxNQXpCSDs7Ozs7QUNBQTs7QUFDQTs7QUFFQSxFQUFFLFlBQVU7QUFDWCxHQUFFLG9CQUFGLEVBQXdCLFVBQXhCLENBQW1DO0FBQ2xDLFVBQVE7QUFEMEIsRUFBbkM7QUFHQSxDQUpEIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwidmFyIGNhcm91c2VsPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL3NsaWRlLW93bC9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL25hdmlnYXRpb24vaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9jb21tb25zL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvcGFydG5lcnMvaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9icmVhZGNydW1iL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvcGFnaW5hdGlvbi9pbmRleC5qcycpIiwiXCJ1c2Ugc3RyaWN0XCI7XG4vLyMgc291cmNlTWFwcGluZ1VSTD1kYXRhOmFwcGxpY2F0aW9uL2pzb247Y2hhcnNldD11dGYtODtiYXNlNjQsZXlKMlpYSnphVzl1SWpvekxDSnpiM1Z5WTJWeklqcGJYU3dpYm1GdFpYTWlPbHRkTENKdFlYQndhVzVuY3lJNklpSXNJbVpwYkdVaU9pSnBibVJsZUM1cWN5SXNJbk52ZFhKalpYTkRiMjUwWlc1MElqcGJYWDA9IiwiJChmdW5jdGlvbiAoKXtcclxuXHQndXNlIHN0cmljdCc7XHJcblx0XHJcblx0LyogTmF2aWdhdGlvbiAqL1xyXG5cdHZhciBuYXZpZ2F0aW9uID0gZnVuY3Rpb24gKG5hdmlfaWNvbiA9ICcubmF2aWdhdGlvbl9pY29uJywgbmF2X21lbnUgPSAnLm5hdmlnYXRpb24nLCBiYWNrZHJvcF9uYXYgPSAnYmFja2Ryb3BfbmF2JykgeyBcclxuXHRcdHZhciBhZGRJY29uID0gZmFsc2U7XHJcblx0XHRpZiAoJChuYXZpX2ljb24pLmxlbmd0aCA8IDEpIHtcclxuXHRcdFx0Ly8gY29uc29sZS5sb2coJ2FkZCBuZXcgaWNvbiBtZW51Jyk7XHJcblx0XHRcdHZhciBhZGRJY29uID0gdHJ1ZTtcclxuXHRcdH0gIFxyXG5cclxuXHRcdGlmICgkKG5hdl9tZW51KS5sZW5ndGggPCAxKSB7XHJcblx0XHRcdC8vIGNvbnNvbGUubG9nKFwibmF2X21lbnUgbm90IGZvdW5kXCIpO1xyXG5cdFx0XHRyZXR1cm47XHJcblx0XHR9IGVsc2UgaWYgKCQobmF2X21lbnUpLmxlbmd0aCA+IDEpIHtcclxuXHRcdFx0Y29uc29sZS53YXJuKCdUaGVyZSBhcmUgZHVwbGljYXRlZCBuYXZpZ2F0aW9ucy4nKVxyXG5cdFx0fVxyXG5cdFx0ZWxzZSB7XHJcblx0XHRcdG5hdl9tZW51ID0gbmF2X21lbnU7IFxyXG5cdFx0fVxyXG5cdFx0dmFyIG5hdmlnYXRpb25fZWxlbWVudCA9ICQobmF2X21lbnUpLmZpcnN0KCk7XHJcblx0XHQvLyBjaGVjayBoYXMgY2hpbGQgc3VibWVudVxyXG5cdFx0ZnVuY3Rpb24gY2hlY2tfc3ViKG5hdmlfY2xhc3Mpe1xyXG5cdFx0XHR2YXIgc3VibWVudSA9ICQobmF2aV9jbGFzcyArICcgdWwgbGknKS5oYXMoJ3VsJyk7XHJcblx0XHRcdHZhciBpY29uID0gJ3N1Yi1pY29uJztcclxuXHRcdFx0c3VibWVudS5hZGRDbGFzcygnaGFzU3ViJyk7XHJcblx0XHRcdHN1Ym1lbnUuYXBwZW5kKCc8c3BhbiBjbGFzcz1cIicraWNvbisnXCI+Kzwvc3Bhbj4nKVxyXG5cdFx0XHQvLyAkKCcuaGFzU3ViID4gdWwnKS5hZGRDbGFzcygnYW5pbWF0ZWQgc2xpZGVJbkRvd24nKTtcclxuXHRcdFx0dmFyIHN1Yl9pY29uID0gJChuYXZfbWVudSArICcgLicraWNvbik7IFxyXG5cclxuXHRcdFx0aWYgKCQoJy5tZWdhY2hpbGQnKS5sZW5ndGgpIHsgXHJcblx0XHRcdFx0dmFyIHN1Ym1lbnUgPSAkKCcuJytuYXZpX2NsYXNzICsgJyB1bD5saScpLmhhcygndWwubWVnYWNoaWxkJyk7XHJcblx0XHRcdFx0aWYgKCFzdWJtZW51Lmhhc0NsYXNzKCdoYXNtZWdhY2hpbGQnKSkge1xyXG5cdFx0XHRcdFx0c3VibWVudS5hZGRDbGFzcygnaGFzbWVnYWNoaWxkJyk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9XHJcblx0XHRcdGVsc2UgaWYgKCQoJy5oYXNtZWdhY2hpbGQnKS5sZW5ndGgpIHsgXHJcblx0XHRcdFx0dmFyIHN1Ym1lbnUgPSAkKCcuJytuYXZpX2NsYXNzICsgJyB1bD5saS5oYXNtZWdhY2hpbGQnKTtcclxuXHRcdFx0XHQkKCcuJytuYXZpX2NsYXNzICsgJyB1bD5saS5oYXNtZWdhY2hpbGQgPiB1bCcpLmFkZENsYXNzKCdtZWdhY2hpbGQnKTtcclxuXHRcdFx0fVxyXG5cdFx0XHRcclxuXHRcdFx0c3ViX2ljb24uY2xpY2soZnVuY3Rpb24gY2xpY2tTdWJJY29uKGUpe1xyXG5cdFx0XHRcdC8vIGNvbnNvbGUubG9nKCQodGhpcykuaGFzQ2xhc3MoJ29uJykpO1xyXG5cdFx0XHRcdGlmICgkKHRoaXMpLmhhc0NsYXNzKCdvbicpKXtcclxuXHRcdFx0XHRcdCQodGhpcykucmVtb3ZlQ2xhc3MoJ29uJyk7XHJcblx0XHRcdFx0XHQkKHRoaXMpLnRleHQoJysnKTtcclxuXHRcdFx0XHRcdCQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2hhc1N1Yl9vbicpO1xyXG5cdFx0XHRcdH0gZWxzZSB7XHJcblx0XHRcdFx0XHQkKHRoaXMpLmFkZENsYXNzKCdvbicpO1xyXG5cdFx0XHRcdFx0JCh0aGlzKS50ZXh0KCctJyk7XHJcblx0XHRcdFx0XHQkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdoYXNTdWJfb24nKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0pO1xyXG5cdFx0fSBcclxuXHRcdGNoZWNrX3N1YihuYXZfbWVudSk7XHJcblx0XHQvKiBhZGQgYmFja2Ryb3BfbmF2ICovXHJcblx0XHR2YXIgYmFja2Ryb3BfY2xhc3MgPSBiYWNrZHJvcF9uYXYucmVwbGFjZSgvXFwufFxcIy9nLCcgJyk7XHJcblx0XHRuYXZpZ2F0aW9uX2VsZW1lbnQucHJlcGVuZCgnPGRpdiBjbGFzcz1cIicrYmFja2Ryb3BfY2xhc3MrJ1wiPjwvZGl2PicpO1xyXG5cdFx0dmFyIGJhY2tkcm9wID0gJChiYWNrZHJvcF9jbGFzcy5zcGxpdCgnICcpLmpvaW4oJy4nKSk7XHJcblx0XHRpZiAoIW5hdmlnYXRpb25fZWxlbWVudC5oYXNDbGFzcygnbmF2LW9wZW4nKSl7XHJcblx0XHRcdGJhY2tkcm9wLmhpZGUoKTtcclxuXHRcdH1cclxuXHRcdGVsc2Uge1xyXG5cdFx0XHRiYWNrZHJvcC5zaG93KCk7XHJcblx0XHR9XHJcblxyXG5cdFx0dmFyIG5hdl90b2dnbGUgPSBmdW5jdGlvbiAobmF2X21lbnUpIHtcclxuXHRcdFx0aWYgKCFuYXZpZ2F0aW9uX2VsZW1lbnQuaGFzQ2xhc3MoJ25hdi1vcGVuJykpe1xyXG5cdFx0XHRcdG5hdmlnYXRpb25fZWxlbWVudC5hZGRDbGFzcygnbmF2LW9wZW4nKTtcclxuXHRcdFx0XHRiYWNrZHJvcC5zaG93KCk7IFxyXG5cdFx0XHR9XHJcblx0XHRcdGVsc2Uge1xyXG5cdFx0XHRcdG5hdmlnYXRpb25fZWxlbWVudC5yZW1vdmVDbGFzcygnbmF2LW9wZW4nKTtcclxuXHRcdFx0XHRiYWNrZHJvcC5oaWRlKCk7IFxyXG5cdFx0XHR9XHJcblx0XHR9OyBcclxuXHRcdGlmIChhZGRJY29uKSB7IFxyXG5cdFx0XHR2YXIgbmF2X2ljb25fdGV4dCAgPSAnPHNwYW4gY2xhc3M9XCInK25hdmlfaWNvbi5yZXBsYWNlKC9cXC58XFwjL2csJyAnKSsnXCI+PHNwYW4+PC9zcGFuPjwvc3Bhbj4nO1xyXG5cdFx0XHRuYXZpZ2F0aW9uX2VsZW1lbnQucHJlcGVuZChuYXZfaWNvbl90ZXh0KTtcclxuXHRcdFx0bmF2aV9pY29uID0gJChuYXZpX2ljb24pO1xyXG5cdFx0fVxyXG5cdFx0bmF2aV9pY29uLmNsaWNrKGZ1bmN0aW9uICgpe1xyXG5cdFx0XHRuYXZfdG9nZ2xlKG5hdmlnYXRpb25fZWxlbWVudCk7ICBcclxuXHRcdH0pO1xyXG5cdFx0YmFja2Ryb3AuY2xpY2soZnVuY3Rpb24gKCl7XHJcblx0XHRcdG5hdl90b2dnbGUobmF2aWdhdGlvbl9lbGVtZW50KTsgIFxyXG5cdFx0fSk7XHJcblx0fTtcclxuXHJcblx0bmF2aWdhdGlvbignLm5hdmlnYXRpb25faWNvbi5uYXYtbGVmdCcsICcubmF2aWdhdGlvbi5uYXYtbGVmdCcsICcuYmFja2Ryb3BfbmF2Lm5hdi1sZWZ0Jyk7XHJcblx0bmF2aWdhdGlvbignLmZhLmZhLXVzZXIubmF2LXJpZ2h0JywgJy5uYXZpZ2F0aW9uLm5hdi1yaWdodCcsICcuYmFja2Ryb3BfbmF2Lm5hdi1yaWdodCcpO1xyXG5cclxuXHJcblx0LyogRklYIFRPUCAqL1xyXG5cdHZhciBmaXh0b3AgPSBmdW5jdGlvbiAodG9wZml4KXtcclxuXHRcdHZhciB0b3A7XHJcblx0XHRpZiAodG9wZml4ID09PSB1bmRlZmluZWQpIHtcclxuXHRcdFx0dG9wID0kKCcudG9wJyk7XHJcblx0XHR9XHJcblx0XHRlbHNlIHtcclxuXHRcdFx0dG9wID0gdG9wZml4O1xyXG5cdFx0fVxyXG5cdFx0dmFyIHRvcFBvc2l0aW9uID0gdG9wLm9mZnNldCgpLnRvcDtcclxuXHJcblx0XHR2YXIgZml4ZWQgPSBmdW5jdGlvbigpIHtcclxuXHRcdFx0aWYgKCF0b3AuaGFzQ2xhc3MoJ2lzZml4ZWQnKSkge1xyXG5cdFx0XHRcdHRvcC5hZGRDbGFzcygnaXNmaXhlZCcpO1xyXG5cdFx0XHRcdCQoJ2JvZHknKS5hZGRDbGFzcygndG9wZml4ZWQnKTtcclxuXHRcdFx0fVxyXG5cdFx0fTtcclxuXHRcdHZhciByZW1vdmVmaXhlZCA9IGZ1bmN0aW9uICgpIHtcclxuXHRcdFx0aWYgKHRvcC5oYXNDbGFzcygnaXNmaXhlZCcpKSB7XHJcblx0XHRcdFx0dG9wLnJlbW92ZUNsYXNzKCdpc2ZpeGVkJyk7XHJcblx0XHRcdFx0JCgnYm9keScpLnJlbW92ZUNsYXNzKCd0b3BmaXhlZCcpO1xyXG5cdFx0XHR9XHJcblx0XHR9O1xyXG5cclxuXHRcdCQod2luZG93KS5vbignc2Nyb2xsJyxmdW5jdGlvbigpIHtcclxuXHRcdFx0aWYoJCh3aW5kb3cpLndpZHRoKCk+NzY4KXtcclxuXHRcdFx0XHRpZigkKHdpbmRvdykuc2Nyb2xsVG9wKCkgPiB0b3BQb3NpdGlvbiApIHsgXHJcblx0XHRcdFx0XHRmaXhlZCgpO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0XHRlbHNlIHsgXHJcblx0XHRcdFx0XHRyZW1vdmVmaXhlZCgpO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fVxyXG5cdFx0XHRlbHNlIHsgXHJcblx0XHRcdFx0cmVtb3ZlZml4ZWQoKTtcclxuXHRcdFx0fVxyXG5cdFx0fSk7XHJcblx0fTtcclxuXHRmaXh0b3AoJCgnLmZpeC10b3AnKSk7XHJcbn0pOyIsImpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCl7XHJcbiAgICAkKFwiLnBhcnRuZXJzLWNhcm91c2VsXCIpLm93bENhcm91c2VsKHtcclxuICAgICAgICBsb29wOiB0cnVlLFxyXG4gICAgICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIG5hdjogdHJ1ZSxcclxuICAgICAgICBuYXZUZXh0OiBbXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtbGVmdCc+PC9pPlwiLFwiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLXJpZ2h0Jz48L2k+XCJdLFxyXG4gICAgICAgIG1hcmdpbjogMjAsXHJcbiAgICAgICAgYXV0b3BsYXlUaW1lb3V0OiA1MDAwLFxyXG4gICAgICAgIHJlc3BvbnNpdmU6IHtcclxuICAgICAgICAgICAgMCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogM1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA0ODAgOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDRcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNzY4IDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiA2XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufSk7IiwialF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigkKXtcclxuICAgICQoXCIuc2xpZGUtb3dsLWNhcm91c2VsXCIpLm93bENhcm91c2VsKHtcclxuICAgICAgICBsb29wOiB0cnVlLFxyXG4gICAgICAgIGRvdHM6IHRydWUsXHJcbiAgICAgICAgYXV0b3BsYXk6IHRydWUsXHJcbiAgICAgICAgbmF2OiB0cnVlLFxyXG4gICAgICAgIG5hdlRleHQ6IFtcIjxpIGNsYXNzPSdmYSBmYS1hbmdsZS1sZWZ0Jz48L2k+XCIsXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtcmlnaHQnPjwvaT5cIl0sXHJcbiAgICAgICAgbWFyZ2luOiAyMCxcclxuICAgICAgICBhdXRvcGxheVRpbWVvdXQ6IDUwMDAsXHJcbiAgICAgICAgcmVzcG9uc2l2ZToge1xyXG4gICAgICAgICAgICAwIDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiAxXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIDQ4MCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogMVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA3NjggOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDFcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTsiLCIoZnVuY3Rpb24oJCl7XHJcbiAgICAkKCdib2R5JykuYXBwZW5kKCc8YSBjbGFzcz1cImJhY2t0b3RvcCBidG4gYnRuLXJhaXNlZCBidG4tcHJpbWFyeVwiIGhyZWY9XCIjMFwiPjxzcGFuPlRvcDwvc3Bhbj48L2E+Jyk7ICAgXHJcbiAgICAvLyBicm93c2VyIHdpbmRvdyBzY3JvbGwgKGluIHBpeGVscykgYWZ0ZXIgd2hpY2ggdGhlIFwiYmFjayB0byB0b3BcIiBsaW5rIGlzIHNob3duXHJcbiAgICB2YXIgb2Zmc2V0ID0gMzAwLFxyXG4gICAgICAgIC8vYnJvd3NlciB3aW5kb3cgc2Nyb2xsIChpbiBwaXhlbHMpIGFmdGVyIHdoaWNoIHRoZSBcImJhY2sgdG8gdG9wXCIgbGluayBvcGFjaXR5IGlzIHJlZHVjZWRcclxuICAgICAgICBvZmZzZXRfb3BhY2l0eSA9IDEyMDAsXHJcbiAgICAgICAgLy9kdXJhdGlvbiBvZiB0aGUgdG9wIHNjcm9sbGluZyBhbmltYXRpb24gKGluIG1zKVxyXG4gICAgICAgIHNjcm9sbF90b3BfZHVyYXRpb24gPSA3MDAsXHJcbiAgICAgICAgLy9ncmFiIHRoZSBcImJhY2sgdG8gdG9wXCIgbGlua1xyXG4gICAgICAgICRiYWNrX3RvX3RvcCA9ICQoJy5iYWNrdG90b3AnKTtcclxuXHJcbiAgICAkKHdpbmRvdykuc2Nyb2xsKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgKCAkKHRoaXMpLnNjcm9sbFRvcCgpID4gb2Zmc2V0ICkgPyAkYmFja190b190b3AuYWRkQ2xhc3MoJ2lzLXZpc2libGUnKSA6ICRiYWNrX3RvX3RvcC5yZW1vdmVDbGFzcygnaXMtdmlzaWJsZSBmYWRlLW91dCcpO1xyXG4gICAgICAgIGlmKCAkKHRoaXMpLnNjcm9sbFRvcCgpID4gb2Zmc2V0X29wYWNpdHkgKSB7IFxyXG4gICAgICAgICRiYWNrX3RvX3RvcC5hZGRDbGFzcygnZmFkZS1vdXQnKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbiAgICAkYmFja190b190b3Aub24oJ2NsaWNrJywgZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJCgnYm9keSxodG1sJykuYW5pbWF0ZSh7XHJcbiAgICAgICAgc2Nyb2xsVG9wOiAwICxcclxuICAgICAgICB9LCBzY3JvbGxfdG9wX2R1cmF0aW9uIFxyXG4gICAgICAgICk7XHJcbiAgICB9KTsgXHJcbn0pKGpRdWVyeSk7IiwiaW1wb3J0ICcuL19iYWNrdG90b3AnO1xyXG5pbXBvcnQgJy4uLy4uL2FwcC9jb21wb25lbnRzL2J1aWxkJztcclxuXHJcbiQoZnVuY3Rpb24oKXtcclxuXHQkKCcuaGVhZHdpZGdldC1zY3JvbGwnKS5zbGltU2Nyb2xsKHtcclxuXHRcdGhlaWdodDogJ2F1dG8nXHJcblx0fSk7XHJcbn0pO1xyXG4iXX0=
