$(function (){
	'use strict';
	
	/* Navigation */
	var navigation = function (navi_icon = '.navigation_icon', nav_menu = '.navigation', backdrop_nav = 'backdrop_nav') { 
		var addIcon = false;
		if ($(navi_icon).length < 1) {
			// console.log('add new icon menu');
			var addIcon = true;
		}  

		if ($(nav_menu).length < 1) {
			// console.log("nav_menu not found");
			return;
		} else if ($(nav_menu).length > 1) {
			console.warn('There are duplicated navigations.')
		}
		else {
			nav_menu = nav_menu; 
		}
		var navigation_element = $(nav_menu).first();
		// check has child submenu
		function check_sub(navi_class){
			var submenu = $(navi_class + ' ul li').has('ul');
			var icon = 'sub-icon';
			submenu.addClass('hasSub');
			submenu.append('<span class="'+icon+'">+</span>')
			// $('.hasSub > ul').addClass('animated slideInDown');
			var sub_icon = $(nav_menu + ' .'+icon); 

			if ($('.megachild').length) { 
				var submenu = $('.'+navi_class + ' ul>li').has('ul.megachild');
				if (!submenu.hasClass('hasmegachild')) {
					submenu.addClass('hasmegachild');
				}
			}
			else if ($('.hasmegachild').length) { 
				var submenu = $('.'+navi_class + ' ul>li.hasmegachild');
				$('.'+navi_class + ' ul>li.hasmegachild > ul').addClass('megachild');
			}
			
			sub_icon.click(function clickSubIcon(e){
				// console.log($(this).hasClass('on'));
				if ($(this).hasClass('on')){
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
		var backdrop_class = backdrop_nav.replace(/\.|\#/g,' ');
		navigation_element.prepend('<div class="'+backdrop_class+'"></div>');
		var backdrop = $(backdrop_class.split(' ').join('.'));
		if (!navigation_element.hasClass('nav-open')){
			backdrop.hide();
		}
		else {
			backdrop.show();
		}

		var nav_toggle = function (nav_menu) {
			if (!navigation_element.hasClass('nav-open')){
				navigation_element.addClass('nav-open');
				backdrop.show(); 
			}
			else {
				navigation_element.removeClass('nav-open');
				backdrop.hide(); 
			}
		}; 
		if (addIcon) { 
			var nav_icon_text  = '<span class="'+navi_icon.replace(/\.|\#/g,' ')+'"><span></span></span>';
			navigation_element.prepend(nav_icon_text);
			navi_icon = $(navi_icon);
		}
		navi_icon.click(function (){
			nav_toggle(navigation_element);  
		});
		backdrop.click(function (){
			nav_toggle(navigation_element);  
		});
	};

	navigation('.navigation_icon.nav-left', '.navigation.nav-left', '.backdrop_nav.nav-left');
	navigation('.fa.fa-user.nav-right', '.navigation.nav-right', '.backdrop_nav.nav-right');


	/* FIX TOP */
	var fixtop = function (topfix){
		var top;
		if (topfix === undefined) {
			top =$('.top');
		}
		else {
			top = topfix;
		}
		var topPosition = top.offset().top;

		var fixed = function() {
			if (!top.hasClass('isfixed')) {
				top.addClass('isfixed');
				$('body').addClass('topfixed');
			}
		};
		var removefixed = function () {
			if (top.hasClass('isfixed')) {
				top.removeClass('isfixed');
				$('body').removeClass('topfixed');
			}
		};

		$(window).on('scroll',function() {
			if($(window).width()>768){
				if($(window).scrollTop() > topPosition ) { 
					fixed();
				}
				else { 
					removefixed();
				}
			}
			else { 
				removefixed();
			}
		});
	};
	fixtop($('.fix-top'));
});