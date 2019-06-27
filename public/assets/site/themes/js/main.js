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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhcHAvY29tcG9uZW50cy9idWlsZC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL2JyZWFkY3J1bWIvaW5kZXguanMiLCJhcHAvY29tcG9uZW50cy9jdXN0b210aGVtZS9jb21tb25zL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvbmF2aWdhdGlvbi9pbmRleC5qcyIsImFwcC9jb21wb25lbnRzL2N1c3RvbXRoZW1lL3BhcnRuZXJzL2luZGV4LmpzIiwiYXBwL2NvbXBvbmVudHMvY3VzdG9tdGhlbWUvc2xpZGUtb3dsL2luZGV4LmpzIiwic3JjL21haW4vX2JhY2t0b3RvcC5qcyIsInNyYy9tYWluL2FwcC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7O0FDQUEsSUFBSSxXQUFVLFFBQVEsa0NBQVIsQ0FBZDtBQUNBLElBQUksYUFBWSxRQUFRLG1DQUFSLENBQWhCO0FBQ0EsSUFBSSxhQUFZLFFBQVEsZ0NBQVIsQ0FBaEI7QUFDQSxJQUFJLGFBQVksUUFBUSxpQ0FBUixDQUFoQjtBQUNBLElBQUksYUFBWSxRQUFRLG1DQUFSLENBQWhCO0FBQ0EsSUFBSSxhQUFZLFFBQVEsbUNBQVIsQ0FBaEI7OztBQ0xBO0FBQ0E7Ozs7QUNEQSxFQUFFLHdCQUFGLEVBQTRCLFdBQTVCLENBQXdDO0FBQ3BDLFVBQU0sS0FEOEI7QUFFcEMsVUFBTSxLQUY4QjtBQUdwQyxZQUFRLEVBSDRCO0FBSXBDO0FBQ0E7QUFDQSxTQUFLLElBTitCO0FBT3BDLGFBQVMsQ0FBQyxrQ0FBRCxFQUFxQyxtQ0FBckMsQ0FQMkI7QUFRcEMsZ0JBQVk7QUFDUixXQUFHO0FBQ0MsbUJBQU8sQ0FEUjtBQUVDLG9CQUFRLEVBRlQ7QUFHQyxpQkFBSztBQUhOLFNBREs7QUFNUixhQUFLO0FBQ0QsbUJBQU8sQ0FETjtBQUVELG9CQUFRLEVBRlA7QUFHRCxpQkFBSztBQUhKLFNBTkc7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Y0FBTjtBQUNBLFVBQUUsV0FBRixFQUFlLE9BQWYsQ0FBdUI7QUFDdkIsdUJBQVc7QUFEWSxTQUF2QixFQUVHLG1CQUZIO0FBSUgsS0FORDtBQU9ILENBekJELEVBeUJHLE1BekJIOzs7OztBQ0FBOztBQUNBOztBQUVBLEVBQUUsWUFBVTtBQUNYLEdBQUUsb0JBQUYsRUFBd0IsVUFBeEIsQ0FBbUM7QUFDbEMsVUFBUTtBQUQwQixFQUFuQztBQUdBLENBSkQiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJ2YXIgY2Fyb3VzZWw9IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvc2xpZGUtb3dsL2luZGV4LmpzJylcclxudmFyIG5hdmlnYXRpb249IHJlcXVpcmUoJy4vY3VzdG9tdGhlbWUvbmF2aWdhdGlvbi9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL2NvbW1vbnMvaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9wYXJ0bmVycy9pbmRleC5qcycpXHJcbnZhciBuYXZpZ2F0aW9uPSByZXF1aXJlKCcuL2N1c3RvbXRoZW1lL2JyZWFkY3J1bWIvaW5kZXguanMnKVxyXG52YXIgbmF2aWdhdGlvbj0gcmVxdWlyZSgnLi9jdXN0b210aGVtZS9wYWdpbmF0aW9uL2luZGV4LmpzJykiLCJcInVzZSBzdHJpY3RcIjtcbi8vIyBzb3VyY2VNYXBwaW5nVVJMPWRhdGE6YXBwbGljYXRpb24vanNvbjtjaGFyc2V0PXV0Zi04O2Jhc2U2NCxleUoyWlhKemFXOXVJam96TENKemIzVnlZMlZ6SWpwYlhTd2libUZ0WlhNaU9sdGRMQ0p0WVhCd2FXNW5jeUk2SWlJc0ltWnBiR1VpT2lKcGJtUmxlQzVxY3lJc0luTnZkWEpqWlhORGIyNTBaVzUwSWpwYlhYMD0iLCIkKFwiLnByby1zZXJ2aWNlcy1jYXJvdXNlbFwiKS5vd2xDYXJvdXNlbCh7XHJcbiAgICBsb29wOiBmYWxzZSxcclxuICAgIGRvdHM6IGZhbHNlLFxyXG4gICAgbWFyZ2luOiAyMCxcclxuICAgIC8vIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgLy8gYXV0b3BsYXlUaW1lb3V0OiAxNTAwMCxcclxuICAgIG5hdjogdHJ1ZSxcclxuICAgIG5hdlRleHQ6IFtcIjxpIGNsYXNzPSdmYSBmYS1hbmdsZS1sZWZ0Jz48L2k+XCIsIFwiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLXJpZ2h0Jz48L2k+XCJdLFxyXG4gICAgcmVzcG9uc2l2ZToge1xyXG4gICAgICAgIDA6IHtcclxuICAgICAgICAgICAgaXRlbXM6IDIsXHJcbiAgICAgICAgICAgIG1hcmdpbjogMTUsXHJcbiAgICAgICAgICAgIG5hdjogZmFsc2VcclxuICAgICAgICB9LFxyXG4gICAgICAgIDQ4MDoge1xyXG4gICAgICAgICAgICBpdGVtczogMixcclxuICAgICAgICAgICAgbWFyZ2luOiAxNSxcclxuICAgICAgICAgICAgbmF2OiBmYWxzZVxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgNzY4OiB7XHJcbiAgICAgICAgICAgIGl0ZW1zOiAzLFxyXG4gICAgICAgICAgICBtYXJnaW46IDE1LFxyXG4gICAgICAgICAgICBuYXY6IGZhbHNlXHJcbiAgICAgICAgfSxcclxuICAgICAgICAxMjAwOiB7XHJcbiAgICAgICAgICAgIGl0ZW1zOiA0XHJcbiAgICAgICAgfSxcclxuICAgICAgICAxNDAwOiB7XHJcbiAgICAgICAgICAgIGl0ZW1zOiA0XHJcbiAgICAgICAgfSxcclxuICAgICAgICAxNjAwOiB7XHJcbiAgICAgICAgICAgIGl0ZW1zOiA0XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59KTsiLCIkKGZ1bmN0aW9uICgpe1xyXG5cdCd1c2Ugc3RyaWN0JztcclxuXHRcclxuXHQvKiBOYXZpZ2F0aW9uICovXHJcblx0dmFyIG5hdmlnYXRpb24gPSBmdW5jdGlvbiAobmF2aV9pY29uID0gJy5uYXZpZ2F0aW9uX2ljb24nLCBuYXZfbWVudSA9ICcubmF2aWdhdGlvbicsIGJhY2tkcm9wX25hdiA9ICdiYWNrZHJvcF9uYXYnKSB7IFxyXG5cdFx0dmFyIGFkZEljb24gPSBmYWxzZTtcclxuXHRcdGlmICgkKG5hdmlfaWNvbikubGVuZ3RoIDwgMSkge1xyXG5cdFx0XHQvLyBjb25zb2xlLmxvZygnYWRkIG5ldyBpY29uIG1lbnUnKTtcclxuXHRcdFx0dmFyIGFkZEljb24gPSB0cnVlO1xyXG5cdFx0fSAgXHJcblxyXG5cdFx0aWYgKCQobmF2X21lbnUpLmxlbmd0aCA8IDEpIHtcclxuXHRcdFx0Ly8gY29uc29sZS5sb2coXCJuYXZfbWVudSBub3QgZm91bmRcIik7XHJcblx0XHRcdHJldHVybjtcclxuXHRcdH0gZWxzZSBpZiAoJChuYXZfbWVudSkubGVuZ3RoID4gMSkge1xyXG5cdFx0XHRjb25zb2xlLndhcm4oJ1RoZXJlIGFyZSBkdXBsaWNhdGVkIG5hdmlnYXRpb25zLicpXHJcblx0XHR9XHJcblx0XHRlbHNlIHtcclxuXHRcdFx0bmF2X21lbnUgPSBuYXZfbWVudTsgXHJcblx0XHR9XHJcblx0XHR2YXIgbmF2aWdhdGlvbl9lbGVtZW50ID0gJChuYXZfbWVudSkuZmlyc3QoKTtcclxuXHRcdC8vIGNoZWNrIGhhcyBjaGlsZCBzdWJtZW51XHJcblx0XHRmdW5jdGlvbiBjaGVja19zdWIobmF2aV9jbGFzcyl7XHJcblx0XHRcdHZhciBzdWJtZW51ID0gJChuYXZpX2NsYXNzICsgJyB1bCBsaScpLmhhcygndWwnKTtcclxuXHRcdFx0dmFyIGljb24gPSAnc3ViLWljb24nO1xyXG5cdFx0XHRzdWJtZW51LmFkZENsYXNzKCdoYXNTdWInKTtcclxuXHRcdFx0c3VibWVudS5hcHBlbmQoJzxzcGFuIGNsYXNzPVwiJytpY29uKydcIj4rPC9zcGFuPicpXHJcblx0XHRcdC8vICQoJy5oYXNTdWIgPiB1bCcpLmFkZENsYXNzKCdhbmltYXRlZCBzbGlkZUluRG93bicpO1xyXG5cdFx0XHR2YXIgc3ViX2ljb24gPSAkKG5hdl9tZW51ICsgJyAuJytpY29uKTsgXHJcblxyXG5cdFx0XHRpZiAoJCgnLm1lZ2FjaGlsZCcpLmxlbmd0aCkgeyBcclxuXHRcdFx0XHR2YXIgc3VibWVudSA9ICQoJy4nK25hdmlfY2xhc3MgKyAnIHVsPmxpJykuaGFzKCd1bC5tZWdhY2hpbGQnKTtcclxuXHRcdFx0XHRpZiAoIXN1Ym1lbnUuaGFzQ2xhc3MoJ2hhc21lZ2FjaGlsZCcpKSB7XHJcblx0XHRcdFx0XHRzdWJtZW51LmFkZENsYXNzKCdoYXNtZWdhY2hpbGQnKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSBpZiAoJCgnLmhhc21lZ2FjaGlsZCcpLmxlbmd0aCkgeyBcclxuXHRcdFx0XHR2YXIgc3VibWVudSA9ICQoJy4nK25hdmlfY2xhc3MgKyAnIHVsPmxpLmhhc21lZ2FjaGlsZCcpO1xyXG5cdFx0XHRcdCQoJy4nK25hdmlfY2xhc3MgKyAnIHVsPmxpLmhhc21lZ2FjaGlsZCA+IHVsJykuYWRkQ2xhc3MoJ21lZ2FjaGlsZCcpO1xyXG5cdFx0XHR9XHJcblx0XHRcdFxyXG5cdFx0XHRzdWJfaWNvbi5jbGljayhmdW5jdGlvbiBjbGlja1N1Ykljb24oZSl7XHJcblx0XHRcdFx0Ly8gY29uc29sZS5sb2coJCh0aGlzKS5oYXNDbGFzcygnb24nKSk7XHJcblx0XHRcdFx0aWYgKCQodGhpcykuaGFzQ2xhc3MoJ29uJykpe1xyXG5cdFx0XHRcdFx0JCh0aGlzKS5yZW1vdmVDbGFzcygnb24nKTtcclxuXHRcdFx0XHRcdCQodGhpcykudGV4dCgnKycpO1xyXG5cdFx0XHRcdFx0JCh0aGlzKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnaGFzU3ViX29uJyk7XHJcblx0XHRcdFx0fSBlbHNlIHtcclxuXHRcdFx0XHRcdCQodGhpcykuYWRkQ2xhc3MoJ29uJyk7XHJcblx0XHRcdFx0XHQkKHRoaXMpLnRleHQoJy0nKTtcclxuXHRcdFx0XHRcdCQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoJ2hhc1N1Yl9vbicpO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSk7XHJcblx0XHR9IFxyXG5cdFx0Y2hlY2tfc3ViKG5hdl9tZW51KTtcclxuXHRcdC8qIGFkZCBiYWNrZHJvcF9uYXYgKi9cclxuXHRcdHZhciBiYWNrZHJvcF9jbGFzcyA9IGJhY2tkcm9wX25hdi5yZXBsYWNlKC9cXC58XFwjL2csJyAnKTtcclxuXHRcdG5hdmlnYXRpb25fZWxlbWVudC5wcmVwZW5kKCc8ZGl2IGNsYXNzPVwiJytiYWNrZHJvcF9jbGFzcysnXCI+PC9kaXY+Jyk7XHJcblx0XHR2YXIgYmFja2Ryb3AgPSAkKGJhY2tkcm9wX2NsYXNzLnNwbGl0KCcgJykuam9pbignLicpKTtcclxuXHRcdGlmICghbmF2aWdhdGlvbl9lbGVtZW50Lmhhc0NsYXNzKCduYXYtb3BlbicpKXtcclxuXHRcdFx0YmFja2Ryb3AuaGlkZSgpO1xyXG5cdFx0fVxyXG5cdFx0ZWxzZSB7XHJcblx0XHRcdGJhY2tkcm9wLnNob3coKTtcclxuXHRcdH1cclxuXHJcblx0XHR2YXIgbmF2X3RvZ2dsZSA9IGZ1bmN0aW9uIChuYXZfbWVudSkge1xyXG5cdFx0XHRpZiAoIW5hdmlnYXRpb25fZWxlbWVudC5oYXNDbGFzcygnbmF2LW9wZW4nKSl7XHJcblx0XHRcdFx0bmF2aWdhdGlvbl9lbGVtZW50LmFkZENsYXNzKCduYXYtb3BlbicpO1xyXG5cdFx0XHRcdGJhY2tkcm9wLnNob3coKTsgXHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSB7XHJcblx0XHRcdFx0bmF2aWdhdGlvbl9lbGVtZW50LnJlbW92ZUNsYXNzKCduYXYtb3BlbicpO1xyXG5cdFx0XHRcdGJhY2tkcm9wLmhpZGUoKTsgXHJcblx0XHRcdH1cclxuXHRcdH07IFxyXG5cdFx0aWYgKGFkZEljb24pIHsgXHJcblx0XHRcdHZhciBuYXZfaWNvbl90ZXh0ICA9ICc8c3BhbiBjbGFzcz1cIicrbmF2aV9pY29uLnJlcGxhY2UoL1xcLnxcXCMvZywnICcpKydcIj48c3Bhbj48L3NwYW4+PC9zcGFuPic7XHJcblx0XHRcdG5hdmlnYXRpb25fZWxlbWVudC5wcmVwZW5kKG5hdl9pY29uX3RleHQpO1xyXG5cdFx0XHRuYXZpX2ljb24gPSAkKG5hdmlfaWNvbik7XHJcblx0XHR9XHJcblx0XHRuYXZpX2ljb24uY2xpY2soZnVuY3Rpb24gKCl7XHJcblx0XHRcdG5hdl90b2dnbGUobmF2aWdhdGlvbl9lbGVtZW50KTsgIFxyXG5cdFx0fSk7XHJcblx0XHRiYWNrZHJvcC5jbGljayhmdW5jdGlvbiAoKXtcclxuXHRcdFx0bmF2X3RvZ2dsZShuYXZpZ2F0aW9uX2VsZW1lbnQpOyAgXHJcblx0XHR9KTtcclxuXHR9O1xyXG5cclxuXHRuYXZpZ2F0aW9uKCcubmF2aWdhdGlvbl9pY29uLm5hdi1sZWZ0JywgJy5uYXZpZ2F0aW9uLm5hdi1sZWZ0JywgJy5iYWNrZHJvcF9uYXYubmF2LWxlZnQnKTtcclxuXHRuYXZpZ2F0aW9uKCcuZmEuZmEtdXNlci5uYXYtcmlnaHQnLCAnLm5hdmlnYXRpb24ubmF2LXJpZ2h0JywgJy5iYWNrZHJvcF9uYXYubmF2LXJpZ2h0Jyk7XHJcblxyXG5cclxuXHQvKiBGSVggVE9QICovXHJcblx0dmFyIGZpeHRvcCA9IGZ1bmN0aW9uICh0b3BmaXgpe1xyXG5cdFx0dmFyIHRvcDtcclxuXHRcdGlmICh0b3BmaXggPT09IHVuZGVmaW5lZCkge1xyXG5cdFx0XHR0b3AgPSAkKCcudG9wJyk7XHJcblx0XHR9XHJcblx0XHRlbHNlIHtcclxuXHRcdFx0dG9wID0gdG9wZml4O1xyXG5cdFx0fVxyXG5cdFx0aWYgKHRvcC5sZW5ndGggPT09IDApIHJldHVybjtcclxuXHRcdHZhciB0b3BQb3NpdGlvbiA9IHRvcC5vZmZzZXQoKS50b3A7XHJcblxyXG5cdFx0dmFyIGZpeGVkID0gZnVuY3Rpb24oKSB7XHJcblx0XHRcdGlmICghdG9wLmhhc0NsYXNzKCdpc2ZpeGVkJykpIHtcclxuXHRcdFx0XHR0b3AuYWRkQ2xhc3MoJ2lzZml4ZWQnKTtcclxuXHRcdFx0XHQkKCdib2R5JykuYWRkQ2xhc3MoJ3RvcGZpeGVkJyk7XHJcblx0XHRcdH1cclxuXHRcdH07XHJcblx0XHR2YXIgcmVtb3ZlZml4ZWQgPSBmdW5jdGlvbiAoKSB7XHJcblx0XHRcdGlmICh0b3AuaGFzQ2xhc3MoJ2lzZml4ZWQnKSkge1xyXG5cdFx0XHRcdHRvcC5yZW1vdmVDbGFzcygnaXNmaXhlZCcpO1xyXG5cdFx0XHRcdCQoJ2JvZHknKS5yZW1vdmVDbGFzcygndG9wZml4ZWQnKTtcclxuXHRcdFx0fVxyXG5cdFx0fTtcclxuXHJcblx0XHQkKHdpbmRvdykub24oJ3Njcm9sbCcsZnVuY3Rpb24oKSB7XHJcblx0XHRcdGlmKCQod2luZG93KS53aWR0aCgpPjc2OCl7XHJcblx0XHRcdFx0aWYoJCh3aW5kb3cpLnNjcm9sbFRvcCgpID4gdG9wUG9zaXRpb24gKSB7IFxyXG5cdFx0XHRcdFx0Zml4ZWQoKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdFx0ZWxzZSB7IFxyXG5cdFx0XHRcdFx0cmVtb3ZlZml4ZWQoKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSB7IFxyXG5cdFx0XHRcdHJlbW92ZWZpeGVkKCk7XHJcblx0XHRcdH1cclxuXHRcdH0pO1xyXG5cdH07XHJcblx0Zml4dG9wKCQoJy5maXgtdG9wJykpO1xyXG59KTsiLCJqUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCQpe1xyXG4gICAgJChcIi5wYXJ0bmVycy1jYXJvdXNlbFwiKS5vd2xDYXJvdXNlbCh7XHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBkb3RzOiBmYWxzZSxcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBuYXY6IHRydWUsXHJcbiAgICAgICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLWxlZnQnPjwvaT5cIixcIjxpIGNsYXNzPSdmYSBmYS1hbmdsZS1yaWdodCc+PC9pPlwiXSxcclxuICAgICAgICBtYXJnaW46IDIwLFxyXG4gICAgICAgIGF1dG9wbGF5VGltZW91dDogNTAwMCxcclxuICAgICAgICByZXNwb25zaXZlOiB7XHJcbiAgICAgICAgICAgIDAgOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDNcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNDgwIDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiA0XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIDc2OCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogNlxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pOyIsImpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCl7XHJcbiAgICAkKFwiLnNsaWRlLW93bC1jYXJvdXNlbFwiKS5vd2xDYXJvdXNlbCh7XHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBkb3RzOiB0cnVlLFxyXG4gICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgIG5hdjogdHJ1ZSxcclxuICAgICAgICBuYXZUZXh0OiBbXCI8aSBjbGFzcz0nZmEgZmEtYW5nbGUtbGVmdCc+PC9pPlwiLFwiPGkgY2xhc3M9J2ZhIGZhLWFuZ2xlLXJpZ2h0Jz48L2k+XCJdLFxyXG4gICAgICAgIG1hcmdpbjogMjAsXHJcbiAgICAgICAgYXV0b3BsYXlUaW1lb3V0OiA1MDAwLFxyXG4gICAgICAgIHJlc3BvbnNpdmU6IHtcclxuICAgICAgICAgICAgMCA6IHtcclxuICAgICAgICAgICAgICAgIGl0ZW1zIDogMVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICA0ODAgOiB7XHJcbiAgICAgICAgICAgICAgICBpdGVtcyA6IDFcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgNzY4IDoge1xyXG4gICAgICAgICAgICAgICAgaXRlbXMgOiAxXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxufSk7IiwiKGZ1bmN0aW9uKCQpe1xyXG4gICAgJCgnYm9keScpLmFwcGVuZCgnPGEgY2xhc3M9XCJiYWNrdG90b3AgYnRuIGJ0bi1yYWlzZWQgYnRuLXByaW1hcnlcIiBocmVmPVwiIzBcIj48c3Bhbj5Ub3A8L3NwYW4+PC9hPicpOyAgIFxyXG4gICAgLy8gYnJvd3NlciB3aW5kb3cgc2Nyb2xsIChpbiBwaXhlbHMpIGFmdGVyIHdoaWNoIHRoZSBcImJhY2sgdG8gdG9wXCIgbGluayBpcyBzaG93blxyXG4gICAgdmFyIG9mZnNldCA9IDMwMCxcclxuICAgICAgICAvL2Jyb3dzZXIgd2luZG93IHNjcm9sbCAoaW4gcGl4ZWxzKSBhZnRlciB3aGljaCB0aGUgXCJiYWNrIHRvIHRvcFwiIGxpbmsgb3BhY2l0eSBpcyByZWR1Y2VkXHJcbiAgICAgICAgb2Zmc2V0X29wYWNpdHkgPSAxMjAwLFxyXG4gICAgICAgIC8vZHVyYXRpb24gb2YgdGhlIHRvcCBzY3JvbGxpbmcgYW5pbWF0aW9uIChpbiBtcylcclxuICAgICAgICBzY3JvbGxfdG9wX2R1cmF0aW9uID0gNzAwLFxyXG4gICAgICAgIC8vZ3JhYiB0aGUgXCJiYWNrIHRvIHRvcFwiIGxpbmtcclxuICAgICAgICAkYmFja190b190b3AgPSAkKCcuYmFja3RvdG9wJyk7XHJcblxyXG4gICAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpe1xyXG4gICAgICAgICggJCh0aGlzKS5zY3JvbGxUb3AoKSA+IG9mZnNldCApID8gJGJhY2tfdG9fdG9wLmFkZENsYXNzKCdpcy12aXNpYmxlJykgOiAkYmFja190b190b3AucmVtb3ZlQ2xhc3MoJ2lzLXZpc2libGUgZmFkZS1vdXQnKTtcclxuICAgICAgICBpZiggJCh0aGlzKS5zY3JvbGxUb3AoKSA+IG9mZnNldF9vcGFjaXR5ICkgeyBcclxuICAgICAgICAkYmFja190b190b3AuYWRkQ2xhc3MoJ2ZhZGUtb3V0Jyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG4gICAgJGJhY2tfdG9fdG9wLm9uKCdjbGljaycsIGZ1bmN0aW9uKGV2ZW50KXtcclxuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICQoJ2JvZHksaHRtbCcpLmFuaW1hdGUoe1xyXG4gICAgICAgIHNjcm9sbFRvcDogMCAsXHJcbiAgICAgICAgfSwgc2Nyb2xsX3RvcF9kdXJhdGlvbiBcclxuICAgICAgICApO1xyXG4gICAgfSk7IFxyXG59KShqUXVlcnkpOyIsImltcG9ydCAnLi9fYmFja3RvdG9wJztcclxuaW1wb3J0ICcuLi8uLi9hcHAvY29tcG9uZW50cy9idWlsZCc7XHJcblxyXG4kKGZ1bmN0aW9uKCl7XHJcblx0JCgnLmhlYWR3aWRnZXQtc2Nyb2xsJykuc2xpbVNjcm9sbCh7XHJcblx0XHRoZWlnaHQ6ICdhdXRvJ1xyXG5cdH0pO1xyXG59KTtcclxuIl19
