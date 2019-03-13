/**
 * *********************
 * * Massive One Page Scroll Options
 * *********************
 * It is added as a part of Massive Dynamic since V3.8 and designed for section scrolling. Enjoy Editing ;)
 *
 *
 * @author PixFlow
 *
 * @version 1.0.0
 * @requires jQuery
 *
 */


// Start with defining global variable
var $row_element = $('.vc_row:not(.vc_inner)'),
	row_count = $row_element.length,
	current_row_index = 0,
	last_row_index = 0,
	do_scroll = true,
	footer_show = false,
	window_height = $(window).height(),
	brightness;


/**
 * Init one page scroll
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_init_one_page_scroll() {
	"use strict";
    if(isMobile() && $('body').hasClass('disable_section_scroll_mobile') ){
        $('body').removeClass('one_page_scroll');
        return false;
    }
    if ($('body').hasClass('compose-mode') && $("body").hasClass('one_page_scroll')) {
		pixflow_one_page_for_customizer();
		return false;
	}
	if ($("body").hasClass('one_page_scroll')) {
		var footer_height = $('footer').height();
		$('footer').css('bottom', '-' + parseInt(footer_height) + 'px');
		pixflow_prepare_pages(row_count);
		if (pixflow_isTouchDevice()) {
			pixflow_set_event_touch_on_document();
		}
		pixflow_set_event_on_window(row_count);
		pixflow_check_url();
		pixflow_bind_event_on_link();
	}
	return false;
}

/**
 * Set touch event for scrolling the page on touch devices
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_set_event_touch_on_document() {
	var last_touch_pos = 0;

	// Detect the position of touching
	$(document).bind('touchstart', function (e) {
		last_touch_pos = e.originalEvent.touches[0].clientY;
	});

	$(document).bind('touchend', function (e) {
		if (do_scroll == false)
			return true;
		var current_touch_pos = e.originalEvent.changedTouches[0].clientY;
		if (last_touch_pos > current_touch_pos + 5) {
			if ($('.row-active').find(' > .wrap').hasClass('mobile-row-over-height')) {
				pixflow_row_scroll(row_count, 'down');
			} else {
				pixflow_scroll_page('down', row_count);
			}
		} else {
			if ($('.row-active').find(' > .wrap').hasClass('mobile-row-over-height')) {
				pixflow_row_scroll(row_count, 'up');
			} else {
				pixflow_scroll_page('up', row_count);
			}
		}
	});
	return true;
}

/**
 * Set scroll event for scrolling page
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_set_event_on_window(row_count) {
	$(window).off('wheel').on('wheel', function (event) {
		if (event.originalEvent.deltaY > 0) {
			pixflow_scroll_page('down', row_count);
			$(window).off();
		} else {
			pixflow_scroll_page('up', row_count);
			$(window).off();
		}
	});

	return false;
}

/**
 * Scroll the row if the content of row is bigger that document height
 *
 * @param direction that up or down
 * @param int row_num it shows the number if rows in page ( not inner row )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_row_scroll( row_count, direction ) {

	if ( pixflow_isMobile() ) {
			if ( current_row_index === ( $( '.vc_row' ).last().index() + 1 )
				&& true === footer_show
				&& 'up' == direction )  {
				pixflow_scroll_page( 'up', row_count );
				return false;
		}

		pixflow_row_scroll_mobile( direction );
	} else {
		pixflow_row_scroll_desktop( row_count, direction);
	}

}


/**
 * Scroll the row if the content of row is bigger that document height in desktop using browser scroll
 *
 * @param direction that up or down
 *
 * @return boolean
 * @since 3.8
 */
var should_scroll_up = false,
	should_scroll_down = false;
function pixflow_row_scroll_mobile(direction) {
	var $active_row = $('.row-active').find(' > .wrap');
	if ($active_row.scrollTop() + $active_row.innerHeight() >= $active_row[0].scrollHeight && direction == 'down') {
		if (should_scroll_down == true) {
			pixflow_scroll_page('down', row_count);
			should_scroll_down = false;
		} else {
			should_scroll_down = true;
		}
	}
	if ($active_row.scrollTop() == 0 && direction == 'up') {
		if (should_scroll_up == true) {
			pixflow_scroll_page('up', row_count);
			should_scroll_up = false;
		} else {
			should_scroll_up = true;
		}
	}
	return false;
}


/**
 * Scroll the row if the content of row is bigger that document height in desktop using nicescroll
 *
 * @param direction that up or down
 * @param int row_num it shows the number if rows in page ( not inner row )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_row_scroll_desktop(row_count, direction) {
	var $nice_scroll = $('.row-active').find('.nicescroll-cursors').last();
	if ((($nice_scroll.offset().top + $nice_scroll.height()) + 4 ) >= $nice_scroll.parent().height() && direction == 'down') {
		pixflow_scroll_page('down', row_count);
		return true;
	}
	if (parseInt($nice_scroll.css('top')) == 0 && direction == 'up') {
		pixflow_scroll_page('up', row_count);
		return true;
	}
}


/**
 * check the page and if the url have row sections scroll into it
 *
 * @return boolean
 * @since 4.4
 */
var first_time_check = false;
function pixflow_check_url(goal_row) {
	var row_src, row_index;
	row_src = ( null != goal_row ) ? goal_row : window.location.hash;
	row_src = row_src.replace('#', '');
	row_index = parseInt($('#' + row_src).closest('.vc_row:not(.vc-inner)').attr('data-index'));
	if ($(window).width() <= 1280 && pixflow_isTouchDevice()) {
		if (first_time_check == true) {
			if ($('.navigation-mobile').css('display') != 'none') {
				$('.navigation-button').click();
			}
		}
		first_time_check = true;
	}
	setTimeout(function () {
		$('#pix-nav').find('li').eq(row_index).find('span').click();
	}, 700);
}

/**
 * Bind events on button and links to scroll in the section
 *
 * @return boolean
 * @since 4.4
 */
function pixflow_bind_event_on_link() {
	$('a:not(.navigation-button)').on('click', function (e) {
		var url = $(this).attr('href');
		if (url.search('#') != -1) {
			var get_url = window.location.origin;
			var url_part = url.split('/');
			var protocol = url_part[0];
			var host = url_part[2];
			var base_target_url = protocol + '//' + host;
			if (
				get_url == base_target_url
				|| protocol == url
			) {
				e.preventDefault();
				var get_hash_part = url.substring(url.indexOf('#') + 1);
				pixflow_check_url(get_hash_part);
			}
		}
	});
}

/**
 * Set min height for rows in customizer
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_one_page_for_customizer() {
	$row_obj = $('.vc_row:not(.vc_inner)');
	var window_screen = parseInt($(window).height());
	$row_obj.each(function () {
		$(this).css({
			minHeight: window_screen + 'px'
		});
	});
}

/**
 * make page ready for section scrolling like Creating bullet and set height for rows
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 * @return boolean
 * @since 3.8
 */
function pixflow_prepare_pages(row_count) {
	pixflow_set_height_for_rows();
	pixflow_create_bullet(row_count);
	$(window).load(function () {
		pixflow_set_color(0);
	});
	return false;
}

/**
 * Set the height of each rows equal screen height
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_set_height_for_rows() {
	pixflow_set_style_for_onepage();
	var screen_height = $(window).height(),
		$vc_row = $('.vc_row:not(.vc_inner)'),
		count = 0;
	$('.layout').css('min-height', screen_height);
	$vc_row.each(function () {
		pixflow_detect_color(count);
		$(this).attr('data-index', count);
		$(this).addClass('full-page').css({
			'height': screen_height + 'px',
			'top': screen_height + 'px',
			zIndex: 8
		});
		pixflow_check_for_nicescoll(count);
		count++;
	});
	$vc_row.first().addClass('row-active').css({
		'top': '0px',
		zIndex: 10
	});
	return true;
}

/**
 * Set the important styles for one page
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_set_style_for_onepage() {
	var ua = navigator.userAgent;
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile|CriOS/i.test(ua)) {
		$('body , html').css({overflow: 'hidden', height: '100%', position: 'static'});
	} else {
		$('body').css({overflow: 'hidden', height: '100%'});
	}

	var style = document.createElement('style');
	style.type = 'text/css';
	if (style.styleSheet) {
		style.styleSheet.cssText = '::-webkit-scrollbar {display: none;} html { overflow: -moz-scrollbars-none; } body{overflow: hidden;} .gather-overlay{position:fixed !important}';
	} else {
		style.appendChild(document.createTextNode('::-webkit-scrollbar {display: none;} html { overflow: -moz-scrollbars-none; } .gather-overlay{position:fixed !important}'));
	}
	document.getElementsByTagName('head')[0].appendChild(style);
	var header_top = parseInt($('header:not(.header-clone)').css('top'));
	if ($('body').hasClass('admin-bar')) {
		header_top += 32;
	}
	$('body.one_page_scroll:not(.compose-mode) header:not(.header-clone)').css({top: header_top});
	return false;
}

/**
 * Check the content of row and add class if row is bigger than window
 *
 * @param int index that show the index  of row
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_set_over_height_for_mobile(index) {
	var $element = $('.vc_row:not(.vc_inner)').eq(index);
	if ($element.hasClass('row-over-height'))
		return;

	$element.find('>.wrap').addClass('mobile-row-over-height');

}

/**
 * Check the content of row and add nicescroll if row is bigger than window
 *
 * @param int index that show the index  of row
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_check_for_nicescoll(index) {
	if (pixflow_isMobile()) {
		pixflow_set_over_height_for_mobile(index);
		pixflow_mobile_row_over_height();
		return false;
	}
	var $element = $('.vc_row:not(.vc_inner)').eq(index);
	if ($element.hasClass('row-over-height'))
		return;
	if ($element.find('>.wrap').height() > $(window).height()) {
		$element.addClass('row-over-height').find('>.wrap').niceScroll({
			horizrailenabled: false,
			cursorcolor: "rgba(204, 204, 204, 0.2)",
			cursorborder: "1px solid rgba(204, 204, 204, 0.2)",
			cursorwidth: "2px",
			touchbehavior: true,
			preventmultitouchscrolling: false,
			enablescrollonselection: false
		});
	}
	return false;
}

/**
 * Create bullet for each row
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_create_bullet(row_count) {
	var bullet_source = '<div id="pix-nav" class="background--light"><ul>';
	bullet_source += '<li class="bullet-active" ><span data-index="0"></span></li>';
	for (var count = 1; count < row_count; count++) {
		bullet_source += '<li><span data-index="' + count + '"></span></li>';
	}
	bullet_source += "</ul></div>";
	$('body').append(bullet_source);
	$('#pix-nav').css('top', ( $(window).height() / 2 ) + 'px');
	pixflow_add_event_for_bullet(row_count);
}

/**
 * Add click event on bullet for each row
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_add_event_for_bullet(row_count) {
	$('body').on('click', '#pix-nav span', function () {
		var current_index = parseInt($('.bullet-active').find('span').attr('data-index'));
		var move_to = parseInt($(this).attr('data-index'));
		if (move_to > current_index) {
			last_row_index = current_row_index;
			if (current_row_index == move_to) {
				return;
			}
			current_row_index = move_to;
			pixflow_scroll_page('down', row_count, type = 'click');
		} else {
			if (footer_show == true) {
				pixflow_footer_scroll_up_visible();
				footer_show = false;
			}
			last_row_index = current_row_index;
			if (current_row_index == move_to) {
				return;
			}
			current_row_index = move_to;
			pixflow_scroll_page('up', row_count, type = 'click');
		}
	});
}

/**
 * Detect the direction of scrolling and call the Intended function
 *
 * @param direction that up or down
 * @param int row_num it shows the number if rows in page ( not inner row )
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_scroll_page(direction, row_count, type) {

	if (do_scroll == false)
		return;

	switch (direction) {
		case'up':
			pixflow_scroll_up(row_count, type);
			break;
		case 'down':
			pixflow_scroll_down(row_count, type);
			break;
		default:
			return false;
			break;
	}
	return false;
}

/**
 * Scroll the row to down
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_scroll_down(row_count, type) {
	do_scroll = false;
	if (current_row_index >= row_count - 1 && type != 'click') {
		pixflow_footer_visibilty(row_count);
		setTimeout(function () {
			pixflow_set_event_on_window(row_count);
		}, 10);
		return;
	}
	pixflow_check_for_nicescoll();
	$('.bullet-active').removeClass('bullet-active');
	if (type == 'click') {
		$('#pix-nav').find('li').eq(current_row_index).addClass('bullet-active');
		pixflow_check_for_nicescoll(current_row_index);
	} else {
		$('#pix-nav').find('li').eq(current_row_index + 1).addClass('bullet-active');
		pixflow_check_for_nicescoll(current_row_index + 1);
	}
	pixflow_scroll_down_animate(type);
}

/**
 * Anmiate the rows on scrolling down
 *
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_scroll_down_animate(type) {
	setTimeout(function () {
		pixflow_set_color(current_row_index);
	}, 500);
	if (type == 'click') {
		if (last_row_index == current_row_index)
			last_row_index = current_row_index - 1;
		$this_row = $('.vc_row:not(.vc_inner)').eq(last_row_index);
		$next_row = $('.vc_row:not(.vc_inner)').eq(current_row_index);

	} else {
		$this_row = $('.vc_row:not(.vc_inner)').eq(current_row_index);
		$next_row = $this_row.next();
	}
	$this_row.css({zIndex: 9});
	setTimeout(function () {
		pixflow_shortcodeAnimationScroll();
		pixflow_onepage_scroll_svg_animate();
	}, 800);
	pixflow_call_tweenMax_for_scroll_down($this_row, $next_row);
	if (type != 'click') {
		current_row_index++;
	}
	pixflow_back_shortcode_to_position();
	$('.row-active').removeClass('row-active');
	$('.vc_row:not(.vc_inner)').eq(current_row_index).addClass('row-active');
}

/**
 * Scroll the row to up
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_scroll_up(row_count, type) {
	do_scroll = false;
	if (footer_show == true) {
		pixflow_footer_scroll_up_visible();
		return;
	}
	if (current_row_index <= 0 && type != 'click') {
		current_row_index = 0;
		do_scroll = true;
		setTimeout(function () {
			pixflow_set_event_on_window(row_count);
		}, 1);
		return;
	}
	$('.bullet-active').removeClass('bullet-active');
	if (type != 'click') {
		$('#pix-nav').find('li').eq(current_row_index - 1).addClass('bullet-active');
	} else {
		$('#pix-nav').find('li').eq(current_row_index).addClass('bullet-active');
	}
	if (type != 'click') {
		pixflow_set_color(current_row_index - 1);
		pixflow_check_for_nicescoll(current_row_index - 1);
	} else {
		pixflow_set_color(current_row_index);
		pixflow_check_for_nicescoll(current_row_index);
	}
	pixflow_scroll_up_animate(type);
}

/**
 * Anmiate the rows on scrolling up
 *
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_scroll_up_animate(type) {
	var $this_row, $prev_row;
	if (type != 'click') {
		$this_row = $('.vc_row:not(.vc_inner)').eq(current_row_index);
		$prev_row = $this_row.prev();
	} else {
		$this_row = $('.vc_row:not(.vc_inner)').eq(last_row_index);
		$prev_row = $('.vc_row:not(.vc_inner)').eq(current_row_index);
	}
	pixflow_call_tweenMax_for_scroll_up($this_row, $prev_row, type);
	if (type != 'click') {
		current_row_index--;
	}
	pixflow_back_shortcode_to_position();
	$('.row-active').removeClass('row-active');
	$('.vc_row:not(.vc_inner)').eq(current_row_index).addClass('row-active');
	return;
}

/**
 * Anmiate the rows on scrolling down
 *
 * @param Object this_row it shows the current row should animated
 * @param Object prev_row it highlighting the last row
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_call_tweenMax_for_scroll_up($this_row, $prev_row, type) {
	$this_row.css({zIndex: 9});
	TweenMax.to($this_row, 1, {
		scale: .75, opacity: 0, ease: Power4.easeOut, onComplete: function () {
			if (type != 'click') {
				TweenMax.to($this_row, 0, {top: window_height, scale: 1, opacity: 1, zIndex: 8, ease: Power4.easeOut});
			} else {
				var count = 0;
				$('.vc_row:not(.vc_inner)').each(function () {
					if (count > parseInt($prev_row.attr('data-index'))) {
						TweenMax.to($(this), 0, {
							top: window_height,
							scale: 1,
							opacity: 1,
							zIndex: 8,
							ease: Power4.easeOut
						});
					}
					count++;
				});
			}
		}
	});
	setTimeout(function () {
		pixflow_shortcodeAnimationScroll();
		pixflow_onepage_scroll_svg_animate();
	}, 800);
	$prev_row.css({zIndex: '10'});
	TweenMax.to($prev_row, 1, {
		top: "0px", ease: Power4.easeOut, delay: .1, onComplete: function () {
			do_scroll = true;
			pixflow_set_event_on_window(row_count);
		}
	});
}

/**
 * Anmiate the rows on scrolling down
 *
 * @param Object this_row it shows the current row should animated
 * @param Object next_row it highlighting the next row
 * @param String type it says the user behavior in how user scrolling the row ( click or scroll )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_call_tweenMax_for_scroll_down($this_row, $next_row, type) {
	TweenMax.to($this_row, 1, {
		scale: .75, opacity: 0, ease: Power4.easeOut, onComplete: function () {
			if (type != 'click') {
				TweenMax.to($this_row, 0, {
					top: '-' + window_height,
					scale: 1,
					opacity: 1,
					zIndex: 8,
					ease: Power4.easeOut
				});
			} else {
				var count = 0;
				$('.vc_row:not(.vc_inner)').each(function () {
					if (count == parseInt($next_row.attr('data-index'))) {
						return;
					}
					TweenMax.to($(this), 0, {
						top: '-' + window_height,
						scale: 1,
						opacity: 1,
						zIndex: 8,
						ease: Power4.easeOut
					});
					count++;
				});
			}
			do_scroll = true;
		}
	});
	$next_row.css({zIndex: 10});
	TweenMax.to($next_row, 1, {
		top: "0px", ease: Power4.easeOut, delay: .1, onComplete: function () {
			pixflow_set_event_on_window(row_count);
		}
	});
}

/**
 * get back the shortcodes to their position after their animation executed
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_back_shortcode_to_position() {
	$('.row-active').find('.has-animation').each(function () {
		var $this = $(this),
			animation_speed = Number($this.attr('data-animation-speed')) * 0.001,
			animation_delay = Number($this.attr('data-animation-delay')),
			animation_position = $this.attr('data-animation-position'),
			animation_easing = $this.attr('data-animation-easing'),
			move = 50;
		$(this).removeClass('show-animation');
		var shortcode_animation_list = [animation_position, $this, animation_speed, animation_delay, animation_easing, move];
		pixflow_get_shortcode_back_to_position(shortcode_animation_list);
	});
}

/**
 * Ready for scroll footer
 *
 * @param int row_num it shows the number if rows in page ( not inner row )
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_footer_visibilty(row_count) {
	if ($('footer').attr('data-footer-status') == 'off') {
		do_scroll = true;
		return false;
	}
	footer_show = true;
	current_row_index = row_count - 1;
	var footer_height = $('footer').height();
	this_row = $('.vc_row:not(.vc_inner)').last();
	TweenMax.to(this_row, 1, {top: "-" + footer_height + "px", ease: Power4.easeOut});
	TweenMax.to($('footer'), 1, {
		bottom: "0px", opacity: 1, ease: Power4.easeOut, onComplete: function () {
			do_scroll = true;
			pixflow_set_event_on_window(row_count);
		}
	});
	return false;
}

/**
 * Scroll up the footer if visible
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_footer_scroll_up_visible() {
	if ($('footer').attr('data-footer-status') == 'off') {
		do_scroll = true;
		return;
	}
	var footer_height = $('footer').height(),
		$this_row = $('.vc_row:not(.vc_inner)').last();
	TweenMax.to($this_row, 1, {top: "0px", repeatDelay: 0.5, ease: Power4.easeOut});
	TweenMax.to($('footer'), 1, {
		bottom: "-" + footer_height + "px",
		opacity: 0,
		repeatDelay: 0.5,
		ease: Power4.easeOut,
		onComplete: function () {
			do_scroll = true;
			footer_show = false;
			pixflow_set_event_on_window(row_count);
		}
	});
	return false;
}

/**
 * Set color of each row
 *
 * @param index of row
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_set_color(row) {
	pixflow_change_color($('.vc_row:not(.vc_inner)').eq(row).attr('data-detect-color'));
}

/**
 * Detect the color
 *
 * @param index of row
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_detect_color(index) {
	var canvas = document.createElement('canvas'),
		canvas_obj = canvas.getContext('2d');
	if ($('.vc_row:not(.vc_inner)').eq(index).find('> .row-image').last().length) {
		var bg_url = $('.vc_row:not(.vc_inner)').eq(index).find('> .row-image').last().css('backgroundImage').replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '');
		if (bg_url != "none") {
			var img = new Image();
			img.onload = function () {
				canvas_obj.drawImage(img, 0, 0);
				pixflow_get_image_brightness(canvas.toDataURL(), function (brightness) {
					$('.vc_row:not(.vc_inner)').eq(index).attr('data-detect-color', brightness);
					return;
				});
			};
			img.src = bg_url;
		}
	} else {
		canvas.setAttribute('width', '20px');
		canvas.setAttribute('height', '20px');
		canvas_obj.beginPath();
		canvas_obj.rect(0, 0, 20, 20);
		canvas_obj.fillStyle = $('.vc_row:not(.vc_inner)').eq(index).attr('data-bgcolor');
		canvas_obj.fill();
		pixflow_get_image_brightness(canvas.toDataURL(), function (brightness) {
			$('.vc_row:not(.vc_inner)').eq(index).attr('data-detect-color', brightness);
			return;
		});
	}
}

/**
 * Change the color of bullet and menus
 *
 * @param index of row
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_change_color(brightness) {
	if (brightness > 160) {
		$('#pix-nav').removeClass('background--dark').addClass('background--light');
		if ($('header').hasClass('top-gather')) {
			$('header .logo').find('img').attr('src', $('header .logo-img').attr('data-dark-url'));
			$('.gather-menu-icon').css('color', 'black');
			if ($('.navigation-button').length) {
				$('.navigation-button').find('span').css('color', 'black');
			}
			if ($('.shopcart-item').length) {
				$('.shopcart-item').find('.icon').css('color', 'black');
			}
			if ($('.notification-item').length) {
				$('.notification-item').find('.icon').css('color', 'black');
			}
			if ($('.search-item').length) {
				$('.search-item').find('.icon').css('color', 'black');
			}
			if ($('.mobile-shopcart').length) {
				$('.mobile-shopcart').find('span').css('color', 'black');
			}
		}
	} else {
		$('#pix-nav').addClass('background--dark').removeClass('background--light');
		if ($('header').hasClass('top-gather')) {
			$('header .logo-img').attr('src', $('header .logo-img').attr('data-light-url'));
			$('.gather-menu-icon').css('color', '#ffffff');
			if ($('.shopcart-item').length) {
				$('.shopcart-item').find('.icon').css('color', '#ffffff');
			}
			if ($('.navigation-button').length) {
				$('.navigation-button').find('span').css('color', '#ffffff');
			}
			if ($('.notification-item').length) {
				$('.notification-item').find('.icon').css('color', '#ffffff');
			}
			if ($('.search-item').length) {
				$('.search-item').find('.icon').css('color', '#ffffff');
			}
			if ($('.mobile-shopcart').length) {
				$('.mobile-shopcart').find('span').css('color', '#ffffff');
			}
		}
	}
}

/**
 * Calculate the brightness of image
 *
 * @param image url
 * @param Callbcak function
 *
 * @return boolean
 * @since 3.8
 */
function pixflow_get_image_brightness(image_src, callback) {
	var img = document.createElement("img");
	var brightness = 0;
	img.src = image_src;
	img.classList.add('pixflow-bright-img');
	img.style.display = "none";
	document.body.appendChild(img);

	var color_sum = 0;

	img.onload = function () {
		// create canvas
		var canvas = document.createElement("canvas");
		canvas.width = this.width;
		canvas.height = this.height;

		var ctx = canvas.getContext("2d");
		ctx.drawImage(this, 0, 0);

		var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
		var data = imageData.data;
		var r, g, b, avg;

		for (var x = 0, len = data.length; x < len; x += 4) {
			r = data[x];
			g = data[x + 1];
			b = data[x + 2];

			avg = Math.floor((r + g + b) / 3);
			color_sum += avg;
		}

		brightness = Math.floor(color_sum / (this.width * this.height));
		callback(brightness);
		$('.pixflow-bright-img').remove();
	}
}

/**
 * Close footer if scroll on last section
 *
 * This function execute just in mobile devices
 *
 *
 * @return void
 * @since 5.1
 */
function pixflow_mobile_row_over_height() {

	$('.mobile-row-over-height').last().on('scroll', function () {

		if (true == footer_show) {
			pixflow_footer_scroll_up_visible();
			footer_show = false;
		}

	});

}