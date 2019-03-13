/**
 * *********************
 * * mBuilder Composer *
 * *********************
 * mBuilder is a visual editor for shortcodes and makes working with shortcodes more easier and fun.
 * It is added as a part of Massive Dynamic since V3.0.0 and designed to work with customizer. Enjoy Editing ;)
 *
 * @summary mBuilder provides some functionality for editing shortcodes in customizer.
 *
 * @author PixFlow
 *
 * @version 1.0.0
 * @requires jQuery, jQuery.ui
 *
 * @class
 * @classdesc initialize all of the mBuilder features.
 */
var mBuilder = function () {
    // All shortcode attributes and contents stored in models, and should update after editing
    if (typeof mBuilderModels == 'undefined') {
        mBuilderModels = {};
        mBuilderModels.models = {}
    }
    this.models = mBuilderModels;
    this.lock = false;
    // All available shortcodes
    this.shortcodes = mBuilderShortcodes;

    this.settingPanel = null;

    // Defines droppable areas for drop shortcodes
    this.droppables = '' +
        '.vc_column_container,' +
        '.wpb_accordion_content,' +
        '.wpb_toggle_content,' +
        '.wpb_tour_tabs_wrapper,' +
        '.wpb_tab';

    // Container shortcodes
    this.containers = {
        'md_accordion_tab': '> .wpb_accordion_section > .wpb_accordion_content',
        'md_toggle_tab': '> .wpb_accordion_section > .wpb_toggle_content',
        'md_toggle_tab2': '> .wpb_accordion_section > .wpb_toggle_content',
        'md_tab': '> .wpb_tab',
        'md_tabs': "> .wpb_tabs > .wpb_wrapper",
        'md_modernTab': "> .wpb_tab",
        'md_modernTabs': "> .wpb_tabs > .wpb_wrapper",
        'vc_column': '> .wpb_column > .vc_column-inner> .wpb_wrapper',
        'vc_column_inner': '> .wpb_column > .vc_column-inner> .wpb_wrapper',
        'md_hor_tab': "> .wpb_tab",
        'md_hor_tabs': "> .wpb_tabs > .wpb_wrapper",
        'md_hor_tab2': "> .wpb_tab",
        'md_hor_tabs2': "> .wpb_tabs > .wpb_wrapper",
    };

    //Tab Shortcodes
    this.tabs = {
        'md_tabs': ['md_tab', '<li data-model="md_tabs"><a href="#"><i class="left-icon icon-cog"></i><span>Tab</span></a></li>'],
        'md_modernTabs': ['md_modernTab', '<li data-model="md_modernTabs"><a href="#"><i class="left-icon icon-cog"></i><div class="modernTabTitle">Tab</div></a></li>'],
        'md_hor_tabs': ['md_hor_tab', '<li data-model="md_hor_tabs"><a href="#"><i class="right-icon icon-cog"></i><div class="horTabTitle">Tab</div><i class="right-icon icon-angle-right"></i></a></li>'],
        'md_hor_tabs2': ['md_hor_tab2', '<li data-model="md_hor_tabs2"><a href="#"><i class="right-icon icon-cog"></i><div class="horTabTitle">Tab</div></a></li>'],
    };
    //Full shortcodes
    this.fullShortcodes = [
        'md_team_member_classic',
        'vc_empty_space',
        'md_button',
        'md_call_to_action',
        'md_imagebox_full',
        'md_portfolio_multisize',
        'md_showcase',
        'md_blog',
        'md_blog_carousel',
        'md_client_normal',
        'md_instagram',
        'md_blog_masonry',
        'md_process_steps',
        'md_teammember2',
        'pixflow_subscribe',
        'md_pricetabel',
        'md_google_map',
        'md_masterslider',
        'md_rev_slider',
        'md_blog_classic',
        'vc_facebook',
        'vc_tweetmeme',
        'vc_pinterest',
        'vc_gmaps',
        'vc_round_chart',
        'vc_line_chart',
        'md_product_categories',
        'md_products',
        'md_textbox',
        'md_full_button',
        'md_testimonial_classic',
        'md_client_carousel',
        'md_fancy_text',
        'md_iconbox_side',
        'md_iconbox_side2',
        'md_slider',
        'md_testimonial_carousel',
        'md_modern_subscribe',
        'md_double_slider',
        'md_skill_style2',
        'md_slider_carousel',
        'md_slider',
        'md_text_box',
        'md_wpform',
    ];

    //used in shortcodeTag method
    this.compiledTags = [];


    var isLocal = $.ui.tabs.prototype._isLocal;
    $.ui.tabs.prototype._isLocal = function (anchor) {
        return true;
    };

    this.save_callback_function = null;
	this.customSection = [];
    this.should_close_shortcode_setting_panel = true ;
    this.selected_shortcode_id = '' ;
    this.shortcodes_param = {} ;
    this.make_links_target_blank();
    this.event_drivens();
    this.renderControls();
    this.addEvents();
    this.setSortable();
    this.mediaPanel();
    this.multiMediaPanel();
    this.dropdown();
    this.googleFontPanel();
    this.shortcode_panel_functionality();
    this.set_parents();
    this.preview_mode();
    this.on_before_unload();
    this.getEditorFonts();
	this.getCustomSection();
    this.createSectionSource();
	this.shortcode_panel_drop_shortcodes();
};

/**
 * @summary makes shortcodes sortable.
 *
 * @since 1.0.0
 */

mBuilder.prototype.setSortable = function () {
    "use strict";
    var t = this,
        lastObj = null;
    var fly = null;
    $('.mBuilder-overlay,.mBuilder-overlay-holder').remove();
    var d = $('<div class="mBuilder-overlay-holder "></div>').appendTo('body'),
        overlay = $('<div class="mBuilder-overlay"></div>').appendTo('body'),
        direction = 'down',
        overEmpty = false,
        overs = $,
        helper;
    overlay.click(function () {
        d.css('width', '');
        overlay.css('display', 'none');
    });
    $('.mBuilder-element:not(.vc_row,.mBuilder-vc_column)').draggable({
        zIndex: 999999,
        helper: 'clone',
        appendTo: '.layout',
        delay: 300,
        containment: [$('.layout').offset().left, $('.layout').offset().top, $('.layout').offset().left+$('.layout').width(), $('.layout').offset().top+$('.layout').height()],
        scroll: false,
        items: ":not(.disable-sort)",
        start: function (event, ui) {
            t.removeColumnSeparator();
            $('.layout').css('overflow','hidden');
            ui.helper.css({
                width: $(this).width(),
                height: $(this).height()
            });

            clearInterval(fly);
            var that = this;

            if ($(this).hasClass("mBuilder-md_portfolio_multisize")) {
                ui.helper.addClass("portfolio-draged");
            }


            setTimeout(function () {
                overs = $('.mBuilder-element:not(.vc_row,.mBuilder-vc_column),.vc_empty-element')
                    .not(ui.helper)
                    .not(ui.helper.find('.mBuilder-element:not(.vc_row,.mBuilder-vc_column),.vc_empty-element'))
                    .not($(that).find('.mBuilder-element:not(.vc_row,.mBuilder-vc_column),.vc_empty-element'));
            }, 100);
            $(this).addClass('ui-sortable-helper');
            overlay.css('display', 'block');
        },
        drag: function (event) {
            clearInterval(fly);
            if (event.clientY < 100) {
                fly = setInterval(function () {
                    if($(window).scrollTop()==0){
                        clearInterval(fly);
                    }
                    $(window).scrollTop($(window).scrollTop() - 50)
                }, 50);
            } else if (event.clientY > $(window).height() - 50) {
                fly = setInterval(function () {
                    if($(window).scrollTop()>=$(document).height()-$(window).height()){
                        clearInterval(fly);
                    }
                    $(window).scrollTop($(window).scrollTop() + 50)
                }, 50);
            }
            var el = null;
            overs.each(function () {
                if (
                    $(this).css('display') != 'none' &&
                    event.pageY > $(this).offset().top && event.pageY < $(this).offset().top + $(this).outerHeight() &&
                    event.pageX > $(this).offset().left && event.pageX < $(this).offset().left + $(this).outerWidth()
                ) {
                    el = this;
                }
            });

            if (el) {

                overEmpty = false;
                var obj = $(el);
                if (el != this && obj.length && !obj.hasClass('vc_empty-element')) {

                    if (t.containers[obj.attr('data-mbuilder-el')] && !obj.find('.mBuilder-element').length) {
                        overEmpty = true;
                    } else {
                        d.css({border: '', borderTop: '4px solid #8fcbff'});
                    }
                } else {
                    overEmpty = true;

                }
                var objTop = obj.offset().top,
                    objLeft = obj.offset().left,
                    objHeight = obj.outerHeight(),
                    objWidth = obj.outerWidth(),
                    objHalf = objTop + objHeight / 2;
                if (lastObj) {
                    lastObj.css({'transform': ''})
                }
                if (!overEmpty) {
                    if (event.pageY < objHalf) {
                        obj.not('.vc_row').css({'transform': 'translateY(5px)'});
                        d.css({'top': objTop, 'left': objLeft, width: objWidth, height: 5, background: ''});
                        direction = 'up';
                    } else {
                        obj.not('.vc_row').css({'transform': 'translateY(-5px)'});
                        d.css({'top': objTop + objHeight, 'left': objLeft, width: objWidth, height: 5, background: ''});
                        direction = 'down';
                    }
                } else {
                    d.css({
                        'top': objTop,
                        'left': objLeft,
                        height: objHeight,
                        width: objWidth,
                        background: 'rgba(136,206,255,0.4)',
                        border: 'solid 2px #8fcbff'
                    });
                }
                lastObj = obj;
            } else {
                if (lastObj) {
                    lastObj.css({'transform': ''})
                }
                lastObj = null;
                d.css({width: '', border: ''});
            }
        },
        stop: function (event, ui) {
            $('.layout').css('overflow','');
            t.removeColumnSeparator();
            try {

                if (ui.helper.hasClass("portfolio-draged")) {
                    ui.helper.removeClass("portfolio-draged");
                }

                clearInterval(fly);
                $(this).removeClass('ui-sortable-helper');
                if (!lastObj || !lastObj.length) {
                    d.css({'width': '', border: ''});
                    setTimeout(function () {
                        overlay.css('display', 'none');
                    }, 300);
                    return;
                }
                if (direction == 'up') {
                    if (lastObj.hasClass('vc_empty-element')) {
                        var p = lastObj.find('.wpb_wrapper');
                    } else if (t.containers[lastObj.attr('data-mbuilder-el')] && overEmpty) {
                        var p = lastObj.find(t.containers[lastObj.attr('data-mbuilder-el')]);
                    } else {
                        var p = lastObj.prev('.insert-between-placeholder');
                        if (!p.length) {
                            var p = lastObj.parent().closest('.mBuilder-element').prev('.insert-between-placeholder');
                        }
                    }
                } else {
                    if (lastObj.hasClass('vc_empty-element')) {
                        var p = lastObj.find('.wpb_wrapper');
                    } else if (t.containers[lastObj.attr('data-mbuilder-el')] && overEmpty) {
                        var p = lastObj.find(t.containers[lastObj.attr('data-mbuilder-el')]);
                    } else {
                        var p = lastObj.next('.insert-between-placeholder');
                        if (!p.length) {
                            var p = lastObj.parent().closest('.mBuilder-element').next('.insert-between-placeholder');
                        }
                    }
                }
                var placeholder = p.get(0);
                if (placeholder != null) {
                    if ($(this).closest('.vc_column_container').find('.mBuilder-element').not($(this).find('.mBuilder-element')).length < 2 && lastObj.get(0) != this) {
                        $(this).closest('.vc_column_container').addClass('vc_empty-element');
                    }
                    if (lastObj.hasClass('vc_empty-element')) {
                        $(this).appendTo(placeholder);
                        lastObj.removeClass('vc_empty-element')
                    } else {
                        if (!$(this).find(placeholder).length) {
                            if (t.containers[lastObj.attr('data-mbuilder-el')] && overEmpty) {
                                p.html('');
                                $(this).appendTo(placeholder);
                            } else {
                                $(this).insertAfter(placeholder);
                            }
                        }
                    }
                    setTimeout(function () {
                        t.createPlaceholders();
                    }, 100);
                    $('body').addClass('changed');
                }
                d.css({'width': '', border: ''});
                setTimeout(function () {
                    overlay.css('display', 'none');
                }, 300);
            } catch (e) {
                console.log(e);
                d.css({'width': '', border: ''});
                setTimeout(function () {
                    overlay.css('display', 'none');
                }, 300);
            }
            $(window).resize();
        }
    });

    // Row movement
    $(".content-container,.post-content").sortable({
        cursor: "move",
        delay: 100,
        cancel: ".disable-sort",
        handle: ".mBuilder_row_move",
        items: ".vc_row",
        update: function (event, ui) {
            $('body').addClass('changed');
            t.createPlaceholders();
        },
        start : function () {
            builder.mBuilder_closeShortcodeSetting();
        }

    });
    //$(".content-container").disableSelection();
};


/**
 * @summary add shortcode controllers for edit,delete,clone and etc.
 *
 * @since 1.0.0
 */
mBuilder.prototype.renderControls = function () {
    var t = this;
    var countTiny = 0;

    $('body').addClass('compose-mode');

    var settingSvg = '<span class="mdb-new-setting" ></span>',

        duplicateSvg = '<span class="mdb-duplicatesvg" ></span>',

        deleteSvg = '<span class="mdb-deletesvg" ></span>',

        leftAlignSvg = '<span class="mdb-leftalignsvg" ></span>',

        centerAlignSvg = '<span class="mdb-centeralignsvg" ></span>',

        rightAlignSvg = '<span class="mdb-rightalignsvg" ></span>',

        optionSvg = '<span class="mdb-menu" ></span>',

        col1_1Svg = '<span class="mdb-col1-1svg" ></span>',

        col1_2Svg = '<span class="mdb-col1-2svg" ></span>',

        col1_3Svg = '<span class="mdb-col1-3svg" ></span>',

        col1_4Svg = '<span class="mdb-col1-4svg" ></span>',

        col2_4Svg = '<span class="mdb-col2-4svg" ></span>',

        col3_4Svg = '<span class="mdb-col3-4svg" ></span>',

        col3_9Svg = '<span class="mdb-col3-9svg" ></span>',

        layoutSvg = '<span class="mdb-new-layout" ></span>',

        moveSvg = '<span class="mdb-new-move" ></span>',

        rowSettingSvg = '<span class="mdb-new-setting" ></span>',

        rowDeleteSvg = '<span class="mdb-deletesvg" ></span>',

        saveSection = '<span class="mdb-savesection">'+
            '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="-405 281.3 31 33" style="enable-background:new -405 281.3 31 33;" xml:space="preserve">'+
		'<g>' +
		'<path d="M-400.1,314.2c-0.2,0-0.4,0-0.5-0.1c-0.6-0.2-1-0.8-1-1.4v-29.8c0-0.8,0.7-1.5,1.5-1.5h21.2c0.8,0,1.5,0.7,1.5,1.5v29.8\
	c0,0.6-0.4,1.2-1,1.4c-0.6,0.2-1.3,0.1-1.7-0.4l-9.5-10.6l-9.4,10.6C-399.3,314-399.7,314.2-400.1,314.2z M-389.5,299.3 \
	c0.4,0,0.9,0.2,1.1,0.5l8,8.9v-24.3h-18.1v24.2l7.9-8.8C-390.4,299.5-390,299.3-389.5,299.3C-389.5,299.3-389.5,299.3-389.5,299.3z" />' +
	'</g>' +
	'</svg>'+
    '</span>';

    $('.mBuilder-element').not('.vc_row, .vc_row_inner,.mBuilder-vc_row_inner,.mBuilder-vc_column,.mBuilder-vc_column_inner').each(function () {

        var $this = $(this);

        if ($this.hasClass('mBuilder-md_tabs') || $this.hasClass('mBuilder-md_toggle') ||
            $this.hasClass('mBuilder-md_accordion') || $this.hasClass('mBuilder-md_modernTabs') ||
            $this.hasClass('mBuilder-md_hor_tabs') || $this.hasClass('mBuilder-md_toggle2') ||
            $this.hasClass('mBuilder-md_hor_tabs2')) {
            if (!$this.find('.tabs-family').length) {
                var html = '<div class="mBuilder_controls tabs-family sc-control " >' +
                    '<div class="mBuilder_move">' + moveSvg + '</div>' +
                    '<div class="sc-setting setting">' + settingSvg + '</div>' +
                    '<div class="sc-delete">' + deleteSvg + '</div>' +
                    '</div>';
                $this.append(html);
            }
        } else if (!$this.find('.mBuilder_controls').length) {
            if ($this.hasClass('mBuilder-md_tab') || $this.hasClass('mBuilder-md_toggle_tab') ||
                $this.hasClass('mBuilder-md_accordion_tab') || $this.hasClass('mBuilder-md_modernTab') ||
                $this.hasClass('mBuilder-md_hor_tab') || $this.hasClass('mBuilder-md_toggle_tab2') ||
                $this.hasClass('mBuilder-md_hor_tab2')) {
                var html = '<div class="mBuilder_controls tab sc-control " >' +
                    '<div class="sc-setting setting">' + settingSvg + '</div>' +
                    '<div class="sc-delete">' + deleteSvg + '</div>';

                html += '</div>';
                $this.append(html);

            } else {
                var el = $this.attr('data-mbuilder-el'),
                    fullClass = '';
                if (t.fullShortcodes.indexOf(el) != -1) {
                    fullClass = 'md-full-shortcode-gizmo';
                }
                var $elem = $this;
                if ($this.find('.gizmo-container').length) {
                    $elem = $this.find('.gizmo-container').first();
                }
                
                if( el == 'md_live_text' ){
                    $elem = $this.find('.live-text-container');
                }

                var container_class='settings-holder inside-shortcode';
                if ($this.hasClass('mBuilder-md_portfolio_multisize')){
                    container_class = 'settings-holder';
                }

                var html = '<div class="mBuilder_controls sc-control " >' +
                    '<span class="handel top-left"></span>' +
                    '<span class="handel top-right"></span>' +
                    '<span class="handel bottom-left"></span>' +
                    '<span class="handel bottom-right"></span>' +
                    '<div class="'+container_class+'">' +
                    '<div class="sc-setting setting">' + settingSvg + '</div>' +
                    '<div class="sc-option">' +
                    '<div class="options-holder ' + fullClass + '">' +
                    '<a href="#" class="open-setting-panel" >' + mBuilderValues.settingText + '</a>' +
                    '<a href="#" class="animation-setting" data-tabName="Animation">' + mBuilderValues.animationText + '</a>' +
                    '<a href="#" class="sc-duplicate"><span>' + mBuilderValues.duplicateText + '</span></a>' +
                    '<a href="#" class="sc-delete"><span>' + mBuilderValues.deleteText + '</span></a>' +
                    '<a href="#" class="sc-alignment">' +
                    '<span class="left">' + leftAlignSvg + '</span>' +
                    '<span class="center">' + centerAlignSvg + '</span>' +
                    '<span class="right">' + rightAlignSvg + '</span>' +
                    '</a>' +
                    '</div>' +
                    '<a href="#" class="setting options-button">' + optionSvg + '</a>' +
                    '</div>' +
                    '</div>';


                html += '</div>'
                $elem.append(html);
            }
        }

        if (t.shortcodes[$this.attr('data-mbuilder-el')] && t.shortcodes[$this.attr('data-mbuilder-el')].as_parent) {
            if (!$this.find(' > .mBuilder_controls [data-control="add_section"]').length) {
                var btn = $('<span class="vc_btn-content"><span class="icon"></span></span>');
                var link = $('<a class="vc_control-btn" title="Add new Section" data-control="add_section" href="#" target="_blank"></a>');
                link.append(btn);
                $this.find(' > .mBuilder_controls').append(link);
                var child = t.shortcodes[$(this).attr('data-mbuilder-el')].as_parent['only'];
                btn.click(function () {
                    t.buildShortcode(this, child);
                })
            }
        }
    });

    $('.mBuilder-element.vc_row,.vc_row.vc_inner').each(function () {
        var $this = $(this);
        if (!$this.find('> .mBuilder_row_controls ').length) {
            $this.find('>.wrap').after(''+
                '<div class="mBuilder_row_controls">'+
                '<div class="mBuilder_row_layout">'+
                '<a href="#" class="title">' + layoutSvg + '</a>'+
                '<div class="mBuilder_container"><div class="holder">'+
                '<span class="col" data-colSize="12/12">' + col1_1Svg + '</span><span class="separator"></span> '+
                '<span class="col" data-colSize="6/12+6/12">' + col1_2Svg + '</span><span class="separator"></span> '+
                '<span class="col" data-colSize="4/12+4/12+4/12">' + col1_3Svg + '</span><span class="separator"></span>'+
                '<span class="col" data-colSize="3/12+3/12+3/12+3/12">' + col1_4Svg + '</span><span class="separator"></span>'+
                '<span class="col" data-colSize="2/12+8/12+2/12">' + col2_4Svg + '</span><span class="separator"></span>'+
                '<span class="col" data-colSize="10/12+2/12">' + col3_4Svg + '</span><span class="separator"></span>'+
                '<span class="col" data-colSize = "3/12+9/12">' + col3_9Svg + '</span>'+
                '<hr>'+
                '<label>' + mBuilderValues.customColText + '</label><input placeholder="12/12" autocomplete="off" name="cols" value=""><span class="submit">&#8594;</span>'+
                '</div></div>'+
                '</div>'+
                    '<div class="mBuilder_row_background"><a href="#" class="bg-button" data-tabName = "Background" ><span>' + mBuilderValues.rowBackground + '</span></a></div>'+
                    '<div href="#" class="mBuilder_row_move">' + moveSvg + '</div>'+
                    '<div class="mBuilder_setting_panel">'+
                        '<a href="#" class="mBuilder_row_setting title">' + rowSettingSvg + '</a>'+
                    '</div>'+
                    '<div class="mBuilder_row_duplicate"><a href="#" ><span>' + duplicateSvg + '</span></a></div>'+
                    '<div class="mBuilder_row_delete"><a href="#" ><span>' + rowDeleteSvg + '</span></a></div>'+
                    '<div class="mBuilder_row_save-section"><a href="#" ><span>' + saveSection + '</span></a></div>'+


                '</div>'+
                '');
        }
        var layoutValue='';
        $this.find('>.wrap >.mBuilder-vc_column').each(function(){

            var row_str = $(this).attr("class");
            var array_row_str = row_str.match(/col-sm-([0-9]+)/);

            layoutValue += (array_row_str[1] + '/12+');

        });

        $this.find('> .mBuilder_row_controls input[name="cols"]').val(layoutValue.substr(0,layoutValue.length-1));

        if (!$this.hasClass('vc_inner')) {
            if (!$this.find('> .row_border ').length) {
                $this.append('<div class="row-top-space" ></div> <div class="row_border top"></div><div class="row_border right"></div><div class="row_border left"></div><div class="row_border bottom"></div><div class="row-bottom-space" ></div><div class="add-section" ><svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g id="Master" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <path d="M9,6 L9,0 L6,0 L6,6 L0,6 L0,9 L6,9 L6,15 L9,15 L9,9 L15,9 L15,6 L9,6 Z" id="Combined-Shape" fill="#FFFFFF"></path> </g></svg></div>');
            }
        }else{
            $this.append('<div class="row-top-space" ></div><div class="row-bottom-space" ></div>');
        }
    });

    $('.mBuilder-vc_column,.mBuilder-vc_column_inner').each(function () {
        var itemClass = ($(this).hasClass('mBuilder-vc_column')) ? 'element-vc_column' : 'element-vc_column_inner';

        if (!$(this).find('> .vc_column_container > .mbuilder-column-options').length) {
            $(this).find(' > .vc_column_container').append('<div class=\"mbuilder-column-options ' + itemClass + '\" >' +
                '<span class="mdb-column-setting"></span>' +
                '<div class="extra-option">' +
                '<span class="col-title">Column Setting</span>'+
                '<a href="#" class="design" data-tabName = "Design">Design</a>' +
                '<a href="#" class="spacing" data-tabName = "Spacing">Spacing</a>' +
                '<a href="#" class="responsive" data-tabName = "Responsive">Responsive</a>' +
                '</div>'+
                '</a>'+
                '</div>'
            );
        }
        if (!$(this).find('> .column-left-space').length){
            $(this).append('<div class="column-left-space"></div>');
        }
        if (!$(this).find('> .column-right-space').length){
            $(this).append('<div class="column-right-space"></div>');
        }
    });

    for (var i in this.fullShortcodes) {
        $('.mBuilder-element[data-mbuilder-el="' + this.fullShortcodes[i] + '"]').find('.vc_control-btn-align').remove();
        $('.mBuilder-element[data-mbuilder-el="' + this.fullShortcodes[i] + '"]').find('.vc_control-btn-edit').css('left', -99);
        $('.mBuilder-element[data-mbuilder-el="' + this.fullShortcodes[i] + '"]').find('.vc_control-btn-clone').css('left', 3);
        $('.mBuilder-element[data-mbuilder-el="' + this.fullShortcodes[i] + '"]').find('.vc_control-btn-delete').css('left', 105);
    }


    this.createPlaceholders();
    $('body').trigger('render_control_finished');
};

/**
 * @summary add event to add section controllers for opening the section type
 *
 * @since 5.0
 */

mBuilder.prototype.bind_section_events = function(){

    $('body').on('click', '.section-open' , function(e){
        e.stopPropagation();
    });

    $('body').on('click', '.add-section' , function(e){
        e.stopPropagation();
        builder.open_pixflow_shortcode_panel('sections');
        var placeholder = $(this).parents('.vc_row').next();
        placeholder.toggleClass('section-open');

        if( ! placeholder.hasClass('section-open') ){
            $('.section-open').removeClass('section-open');
            builder.close_pixflow_shortcode_panel();
        }
    });
}

mBuilder.prototype.bind_resize_events = function (){
    var that = this ;
    $('body').off('render_control_finished.live_spacing finish_shortcode_progress.live_spacing').on( 'render_control_finished.live_spacing finish_shortcode_progress.live_spacing' , function(){
        that.vc_row_resize();
    });
}

mBuilder.prototype.bind_shortcode_setting_panel = function(){
    var that = this ;
    $('body').off('close-shortcode-setting-panel').on( 'close-shortcode-setting-panel' , function(){
        that.mBuilder_closeShortcodeSetting();
    });
}

/*
 * @summary The function called when build shortcode is finished and specifies new live text shortcode
 *
 * @since   Function available since Release 5
 */
mBuilder.prototype.bind_finish_shortcode_build_events = function(){
    var that = this;
    $('body').off('finish_build_shortcode.md_live_text').on('finish_build_shortcode.md_live_text'  , function(event , id, shortcode){
        if( shortcode != 'md_live_text' ){
            return ;
        }
        that.setModelattr( id , 'is_new_shortcode' , 'yes' );
        $('[data-mbuilder-id="' + id + '"]').find('.md-live-text').addClass('md-live-text-new');
    });
}

/*
* @summary The flow of the program is determined by events such as user actions (mouse clicks, key presses), finish function jobs, or messages from other programs/threads.
*
* @since   Function available since Release 5
*/
mBuilder.prototype.event_drivens = function (){
    this.bind_resize_events();
    this.bind_shortcode_setting_panel();
    this.bind_finish_shortcode_build_events();
}

mBuilder.prototype.open_shortcode_panel = function ( el_id , params , that ){
    var t = this ;
    $( 'body' ).off('update_shortcode.apply_n_close');
    var response = t.htmlSource = t.form_builder( el_id ) ;
    t.mBuilder_shortcodeSetting(t.shortcodes[params['type']].name , mBuilderValues.dontShow , response  ,
			mBuilderValues.apply , function () {
            if (params['type'] == 'vc_column' || params['type'] == 'vc_column_inner') {
                var css = '{';
                $('#mBuilder-form #mBuilderSpacing .column-design-css input,#mBuilder-form #mBuilderDesign .column-design-css input,' +
                    '#mBuilder-form #mBuilderSpacing .column-design-css select,#mBuilder-form #mBuilderDesign .column-design-css select ').each(function () {
                    if ($(this).closest('.column-design-css').hasClass('column-design-prefix-px')) {
                        var prefix = 'px';
                    } else {
                        var prefix = '';
                    }
                    if ($(this).parent().hasClass('mBuilder-upload-img')) {
                        if ($(this).val() != '' && $(this).val() != 'undefined') {
                            var val = $(this).parent().css('background-image');
                        }else{
                            return;
                        }
                    } else {
                        var val = $(this).val()
                    }
                    css += $(this).attr('name').replace(/_/g, '-') + ':' + val + prefix + ';';
                });
                $('#mBuilder-form #mBuilderDesignOptions .column-design-css select').each(function () {
                    css += $(this).attr('name').replace(/_/g, '-') + ':' + $(this).val() + ';';
                });
                css += '}';
                css = css.replace(/["]/g, '``');
                var cssInput = $('<input type="hidden" name="css">');
                cssInput.val(css).appendTo($('#mBuilder-form #mBuilderSpacing'));
            }

            $.fn.serializeObject = function () {
                var o = {};
                var a = this.serializeArray();
                $.each(a, function () {
                    if ($('input[name="' + this.name + '"], textarea[name="' + this.name + '"]').hasClass('mbuilder-skip') || this.value == '' && !$('input[name="' + this.name + '"]').hasClass('simple-textbox') && $('[name="' + this.name + '"]').prop('tagName') != 'TEXTAREA') {
                        return true;
                    }
                    if (this.value == 'Array') {
                        this.value = '';
                    }
                    if (o[this.name] !== undefined) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                    if($('input[name="'+this.name+'"]').hasClass('md-base64')){
                        o[this.name] = 'pixflow_base64'+t.b64EncodeUnicode(o[this.name]);
                    }
                    if($('textarea[name="'+this.name+'"]').hasClass('textarea_raw_html')){
                        o[this.name] = t.b64EncodeUnicode(o[this.name]);
                    }
                });
                return o;
            };
            var formData = $('#mBuilder-form').serializeObject();
            delete formData['google-fonts-families'];
            delete formData['google-fonts-styles'];
            var regex = /align="(.*?)"/;
            if (t.models.models[el_id].attr) {
                var res = t.models.models[el_id].attr.match(regex);
            } else {
                var res = null;
            }
            if (res != null) {
                formData.align = res[1];
            }
            var isTab = false;
            if (t.tabs[params['type']] || params['type'] == 'vc_row_inner') isTab = true;

            if (params['type'] == 'vc_column' || params['type'] == 'vc_column_inner') {
                if (params['attr'] && params['attr'] != '' && params['attr'].match(/^(width=['"].*?['"])|.*? width=['"].*?['"]/g)) {
                    formData.width = params['attr'].match(/^(width=['"].*?['"])| width=['"].*?['"]/g);
                    formData.width = formData.width[formData.width.length - 1].replace(/(width=)|(['"])|(undefined)|( )/g, '');
                }
            }
            t.updateShortcode(el_id, params['type'], formData, undefined, isTab);
            cssInput && cssInput.remove();
        },
			mBuilderValues.applyClose , function () {
            $( 'body' ).on( 'update_shortcode.apply_n_close',function(){
                $('.setting-panel-close').click();
                t.active_setting_panel_model_id = '';
            });
        }
    );
    var isLocal = $.ui.tabs.prototype._isLocal;
    $.ui.tabs.prototype._isLocal = function (anchor) {
        return true;
    };
    $('#mBuilderTabs').tabs();
    $('.setting-panel-wrapper .setting-panel-container').removeClass('dont-show');
    setTimeout(function () {
        t.dependencyInjection();
    }, 1);
    var name = $(that).attr('data-tabName');

    if ($(that).parent().hasClass('mBuilder_row_background')){
        $('.setting-panel-container').addClass('row-background')
    }
    $('.setting-panel-container').find('a[href="#mBuilder'+name+'"]').click();
}

/**
 * @summary add event to document for close shortcode setting panel by Esc button
 *
 * @since 4.5
 */
mBuilder.prototype.close_shortcode_setting_panel = function(){
    $(document).on('keydown' , function(e){
        if ( e.keyCode == 27 && $('.setting-panel-close').length ){
            $('.setting-panel-close').click();
        }
    });
    return ;
}


/**
 * @summary Trigger events when click on shortcode setting panel button
 *
 * @since 4.5
 */
mBuilder.prototype.update_shortcode_progress = function(){
    $('body').on('click' , '.setting-panel-btn1' , function(){
        $(this).find('.update-shortcode-progress').addClass('setting-panel-btn-click-effect');
        setTimeout(function(){
            $('.update-shortcode-progress-second').addClass('setting-panel-btn-click-effect2');
        } , 300 );
    });

    $('body').off('finish_shortcode_progress.shortcode_progress').on('finish_shortcode_progress.shortcode_progress' , function(){
        setTimeout(function () {
             $('.setting-panel-btn-click-effect2 , .setting-panel-btn-click-effect').removeClass('setting-panel-btn-click-effect2 setting-panel-btn-click-effect');
        },1000);
    });
}

mBuilder.prototype.check_shortcode_setting_pannel_status = function(e){
    var that = this ;
    if( $( e.target ).hasClass( 'datepicker--cell' )
        || $( e.target ).hasClass( 'mce-txt' )
        || e.target.tagName == "svg"
        || e.target.tagName == "path"
        || $( e.target ).hasClass('btn-icon')
        || $( e.target ).hasClass('px-icon')
        || $( e.target ).hasClass('popover-content')
        || $( e.target ).hasClass('search-control')
        || $(e.target).hasClass('text-center')
        || $(e.target).hasClass('btn')
        || that.should_close_shortcode_setting_panel == false ){
        that.should_close_shortcode_setting_panel = true ;
        return false;
    }
    
    return true ;
}

/**
 * @summary add event to shortcode controllers for edit,delete,clone and etc.
 *
 * @since 1.0.0
 */
var prev_panel_id ;
mBuilder.prototype.addEvents = function () {
    var t = this,
        $bodyGizmoOff = $('body:not(.gizmo-off)'),
        $body = $('body');

    t.bind_section_events();
    t.close_shortcode_setting_panel();
    t.update_shortcode_progress();
    $('body').on('click','a[href="#"]',function(e){
        e.preventDefault();
    });

	$('body').on('click' , '.popupSaveSection' , function (e) {
		e.stopPropagation();
	});
	$('body').on('click' , '.popupSaveSection-container, .popupSaveSection-close' , function () {
        t.closeSaveSectionPopup();
	} );

    $('body').on('click' , '.mBuilder_row_save-section' , function () {
        var rowId = $(this).closest('.mBuilder-element').attr('id');
		t.popupSaveSection( rowId );
	} );

    $('body').on( 'mouseenter' , '.vc_row:not(.vc_inner)' , function(){
        var that = $(this) ,
            $header = $('header[class *= "top"]');

        if ( ! $header.length
            || that.hasClass('vertical-aligned')
            || that.find('> .wrap').position().top > $('header').height()
        ) return;

        if($(this).index() == 1){
            setTimeout( function(){
                var top_space  = $header.height()+$header.position().top-that.find('> .wrap').position().top ;
                that.find('.mbuilder-column-options').css({
                    top: top_space + 'px'
                });
            } , 10 );
        }
    });

    $('body').on( 'mouseleave' , '.vc_row' , function(){
        $('.mbuilder-column-options').first().css({
            top: ''
        });
    });

	$( 'body' ).on( 'click', '.pixflow-delete-section', function(){
		t.deleteSection( $( this ).attr( 'data-section-name' ) );
	} );

	$( 'body' ).on( 'delete_section', function( e, name ){
		$( '[data-section-name="' + name + '"]' ).parent().fadeOut( 500, function(){
			$( this ).remove();
		} );
	} );

    $('.builder-save .save').click(function (e) {
        e.preventDefault();
        t.saveContent();
    });

    $('body').on('click' , '.meditor a' , function(e){
        e.preventDefault();
    });

    $bodyGizmoOff.on('mousedown', '.meditor', function (e) {
        e.stopPropagation();
    });
    
    $bodyGizmoOff.on('click', '.mBuilder_container, .mce-grid, .mce-reset, .mce-container, .mce-btn, .pixflow-shortcodes-panel, .datepicker--cell, .setting-panel-wrapper, .datepickers-container *, .media-modal, .sp-container ', function (e) {
        e.stopPropagation();
    });
    

    $bodyGizmoOff.on('mouseleave', '.vc_row', function () {
        t.removeColumnSeparator();
    });

    $(document).click(function (e) {
        closeAll();
        if ( t.check_shortcode_setting_pannel_status(e) ){
            $('body').trigger('close-shortcode-setting-panel');
        }
    });

    function closeAll(notMe) {
        $('.mBuilder-element').removeClass('onTop');
        var $activeElems = $('.active-gizmo').not(notMe);
        $activeElems.each(function () {
            var $this = $(this),
                $innerRow = $this.closest('.mBuilder-vc_row_inner'),
                $container = $this.find('>.mBuilder_container, .options-holder, > .extra-option');

            $this.removeClass('active-gizmo');
            TweenMax.to($this.find('.options-holder,.mBuilder_container'), .2,
                {
                    scale: .9, opacity: 0, onComplete: function () {
                    TweenMax.set($container, {height: 0, zIndex: -333, display: 'none'});
                }
                });
            $this.closest('div[class*=mBuilder-vc_column]').removeClass('upper_zIndex');

            if ($this.hasClass('mBuilder_setting_panel') || $this.hasClass('mBuilder_row_layout')) {
                $this.closest('div[class*=vc_row]').removeClass('upper_zIndex');
            }

            $this.find('>.mBuilder_container, .options-holder').removeClass('open');

            if ($this.hasClass('mBuilder_row_layout')) {
                $this.find('input').focus();
            }

            if ($innerRow.length) {
                $innerRow.removeClass('upper_inner_row_zIndex');
                $innerRow.parents('.vc_row').removeClass('upper_inner_row_zIndex');
                $innerRow.siblings('.mBuilder-element').removeClass('lower_inner_row_zIndex')
            }

        })
        $('.section-open').removeClass('section-open');
        builder.close_pixflow_shortcode_panel();
        $('.show-column-layout').removeClass('show-column-layout');
    }

    // Row Layout
    $body.off('click.mbuilder', '.mBuilder-element .mBuilder_row_layout .col,.mBuilder-element .mBuilder_row_layout .submit');
    $body.on('click.mbuilder', '.mBuilder-element .mBuilder_row_layout .col,.mBuilder-element .mBuilder_row_layout .submit', function (e) {
        e.stopPropagation();
        var row = $(this).closest('.vc_row'),
            value = $(this).attr('data-colSize');
        if ($(this).hasClass('submit')) {
            value = $(this).prev().val();
        }
        $(this).closest('.mBuilder_row_layout').find('input[name="cols"]').val(value);
        t.changeRowLayout(value, row);

    });


    // Edit Element

    $body.off('click.mbuilder', '.mBuilder-element .extra-option > a,.mBuilder_row_background > .bg-button,.mBuilder-element .mBuilder_row_setting,.mBuilder-element .sc-setting ,.mBuilder-element .animation-setting , .mBuilder-element .open-setting');
    $body.on('click.mbuilder', '.mBuilder-element .extra-option > a,.mBuilder_row_background > .bg-button,.mBuilder-element .mBuilder_row_setting,.mBuilder-element .sc-setting ,.mBuilder-element .animation-setting ,.mBuilder-element .open-setting-panel', function (e) {
        e.stopPropagation();
        closeAll();
        var params = t.getModelParams($(this).closest('.mBuilder-element').attr('data-mBuilder-id')),
            el_id = $(this).closest('.mBuilder-element').attr('data-mBuilder-id'),
            that = this;
        if( prev_panel_id == el_id && ! $(this).closest('.mBuilder-element').hasClass('vc_row') ){
            return;
        }
        t.selected_shortcode_id = el_id;
        if (params == null) {
            params = [];
            params['attr'] = '';
            params['content'] = '';
            params['type'] = $(this).closest('.mBuilder-element').attr('data-mbuilder-el');
        }
        t.active_setting_panel_model_id = el_id;
        if(params['type'] == 'md_live_text'){
            t.update_meditor_shortcode_model(el_id);
        }
        t.mBuilder_shortcodeSetting(t.shortcodes[params['type']].name , '', '', mBuilderValues.apply , function () {
        }, mBuilderValues.applyClose , function () {
        });
        if('vc_row_inner' == params['type']){
            t.update_meditor_models();
        }
        t.open_shortcode_panel( el_id , params , that);
        prev_panel_id = el_id;
    });

    // Delete Element
    $body.off('click.mbuilder', '.mBuilder-element .mBuilder_row_delete,.mBuilder-element .sc-delete');
    $body.on('click.mbuilder', '.mBuilder-element .mBuilder_row_delete,.mBuilder-element .sc-delete', function (e) {
        var el_id = $(this).closest('.mBuilder-element').attr('data-mBuilder-id');
        $(this).parents('.mBuilder_controls').addClass('active-gizmo');
        e.stopPropagation();
        var $elem = $('div[data-mbuilder-id=' + el_id + ']');
        if ($elem.hasClass('mBuilder-md_button')) {
            deleteFunc(el_id);
        } else if (!$(this).closest('.mBuilder_controls').find('.deleteMessage').length) {

            //close option panel on click
            var $this = $(this),
                $optionsHolder = $(this).closest('.mBuilder_container, .options-holder');

            var deleteBox = '<div class="deleteMessage"><p>' + mBuilderValues.deleteDescText + '</p><a class="deleteBtn">' + mBuilderValues.deleteText + '</a></div>';
            TweenMax.to($optionsHolder, .2, {
                scale: .9, opacity: 0, onComplete: function () {
                    TweenMax.set($optionsHolder, {height: 0, zIndex: -333});
                    //add delete alertBox

                    var $parent = $this.closest('.mBuilder_controls.sc-control,.mBuilder_row_controls');

                    $parent.after(deleteBox);

                    var $deleteMsgBox = $parent.siblings('.deleteMessage'),
                        $deleteBtn = $deleteMsgBox.find('.deleteBtn');


                    //deletBox Animation
                    // for tab
                    if ($elem.hasClass('mBuilder-md_tab') || $elem.hasClass('mBuilder-md_modernTab')) {

                        var left = parseInt($elem.find(' > .mBuilder_controls.tab ').css('left'));
                        left += 44;
                        $elem.find(' > .deleteMessage').css({'left': left})

                    } else if ($elem.hasClass('mBuilder-md_hor_tab') || $elem.hasClass('mBuilder-md_hor_tab2')) {
                        var top = parseInt($elem.find(' > .mBuilder_controls.tab ').css('top'));
                        top += 44;
                        $elem.find(' > .deleteMessage').css({'top': top})
                    } else if ($elem.hasClass('vc_row')) {
                        if ($('body .vc_row').first().attr('id') == $elem.attr('id')) {
                            top = '40%';
                            $elem.find(' > .deleteMessage').css({'top': top})
                        }
                    }

                    TweenMax.to($deleteMsgBox, .2, {opacity: 1, bottom: '15px'});

                    if ($parent.hasClass('sc-control')) {
                        $parent.addClass('deleteEffect')
                    } else {
                        $parent.siblings('.wrap,.sc-control').addClass('deleteEffect')
                    }

                    $deleteBtn.click(function () {
                        deleteFunc(el_id);
                    })

                    $(document).click(function (e) {
                        e.stopPropagation();
                        TweenMax.to($deleteMsgBox, .3, {
                            opacity: 0, bottom: '20px', onComplete: function () {
                                $deleteMsgBox.remove();
                            }
                        });
                        $deleteMsgBox.parents('.mBuilder_controls').removeClass('active-gizmo');

                        if ($parent.hasClass('sc-control')) {
                            $parent.removeClass('deleteEffect')
                        } else {
                            $deleteMsgBox.siblings('.wrap').removeClass('deleteEffect');

                        }
                    });

                }
            });
            $optionsHolder.removeClass('open');
            toggle = -1;

        }

        function deleteFunc(el_id) {
            t.deleteModel(el_id);

            var p = $('div[data-mbuilder-id=' + el_id + ']').parent().closest('.mBuilder-element');

            // for tab
            var $elem = $('div[data-mbuilder-id=' + el_id + ']');
            if ($elem.hasClass('mBuilder-md_tab') || $elem.hasClass('mBuilder-md_modernTab')
                || $elem.hasClass('mBuilder-md_hor_tab') || $elem.hasClass('mBuilder-md_hor_tab2')) {
                var id = $elem.children('.wpb_tab ').attr('id');
                $('a[href="#' + id + '"]').parent().remove();
            }

            $('div[data-mbuilder-id=' + el_id + ']').remove();
            if (p.attr('data-mbuilder-el') == 'vc_column' || p.attr('data-mbuilder-el') == 'vc_column_inner') {
                if (!p.find('.mBuilder-element').length) {
                    p.find('.wpb_column').addClass('vc_empty-element');
                }
            }

            t.createPlaceholders();


            $('body').css('height',$('body').css('height'));
            $('body').css('height','auto');

        }
    });

    // Copy Element
    $body.off('click.mbuilder', '.mBuilder_row_duplicate,.mBuilder-element .sc-duplicate,.tab .sc-duplicate');
    $body.on('click.mbuilder', '.mBuilder_row_duplicate,.mBuilder-element .sc-duplicate,.tab .sc-duplicate', function (e) {
        e.stopPropagation();
        TweenMax.set($(this).closest('.options-holder'), {height: 0, zIndex: -333, scale: .9, opacity: 0});
        closeAll();

        t.duplicate(this);

    });

    // Element Alignments
    $body.off('click.mbuilder', '.mBuilder-element .sc-alignment span');
    $body.on('click.mbuilder', '.mBuilder-element .sc-alignment span', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var element = $(this).closest('.mBuilder-element');
        var id = element.attr('data-mbuilder-id');

        var regex = /(align=".*?")/g;
        t.models.models[id].attr = t.models.models[id].attr.replace(regex, '');
        if ($(this).hasClass('left') || $(this).hasClass('mdb-leftalignsvg')) {
            e.preventDefault();
            t.models.models[id].attr += ' align="left"';
            element.find('[class *= "md-align-"]')
                .removeClass('md-align-right')
                .removeClass('md-align-center')
                .addClass('md-align-left')
        }
        if ($(this).hasClass('center') || $(this).hasClass('mdb-centeralignsvg')) {
            e.preventDefault();
            t.models.models[id].attr += ' align="center"';
            element.find('[class *= "md-align-"]')
                .removeClass('md-align-right')
                .removeClass('md-align-left')
                .addClass('md-align-center')
        }
        if ($(this).hasClass('right') || $(this).hasClass('mdb-rightalignsvg')) {
            e.preventDefault();
            t.models.models[id].attr += ' align="right"';
            element.find('[class *= "md-align-"]')
                .removeClass('md-align-center')
                .removeClass('md-align-left')
                .addClass('md-align-right')
        }
    });

    // Hover on delete shortcode button
    $body.on({
        mouseenter: function () {
            $(this).closest('.mBuilder_controls').addClass('delete_hover');
        },
        mouseleave: function () {
            $(this).closest('.mBuilder_controls').removeClass('delete_hover');
        }
    }, '.mBuilder-element .sc-delete');

    // open and close setting drop down menu
    $body.off('click.mbuilder', '.mBuilder_row_controls .mBuilder_setting_panel,.mBuilder_row_layout,.mbuilder-column-options,.sc-option');
    $body.on('click.mbuilder', '.mBuilder_row_controls .mBuilder_setting_panel,.mBuilder_row_layout,.mbuilder-column-options,.sc-option', function (e) {
        e.stopPropagation();
        var $this = $(this),
            $innerRow = $this.closest('.mBuilder-vc_row_inner'),
            $container = $this.find('>.mBuilder_container, > .options-holder, > .extra-option'),
            $active_gizmo = $this.closest('.active-gizmo');
        if ( $active_gizmo.length < 1 ) {
            closeAll(this);
            if ($this.closest('.gizmo-container').length) {
                $this.closest('.gizmo-container').addClass('active-gizmo');
            } else if ($this.hasClass('sc-option')) {
                $this.closest('.mBuilder_controls').addClass('active-gizmo');
            }

            $this.closest('.mBuilder-element').addClass('onTop');

            TweenMax.set($container, {scale: .9,height: 'auto', zIndex: 333, display:'block'});
            TweenMax.to($container, .2,
                {scale: 1, opacity: 1});

            $this.closest('div[class*=mBuilder-vc_column]').addClass('upper_zIndex');

            if ($this.hasClass('mBuilder_setting_panel') || $this.hasClass('mBuilder_row_layout')) {
                $this.closest('div[class*=vc_row]').addClass('upper_zIndex');
                $this.closest('.mBuilder_setting_panel,.mBuilder_row_layout').addClass('active-gizmo');
            }

            $this.find('>.mBuilder_container, .options-holder').removeClass('open');

            /* inner Row */
            if ($innerRow.length) {
                $innerRow.addClass('upper_inner_row_zIndex');
                $innerRow.parents('.vc_row').addClass('upper_inner_row_zIndex');
                $innerRow.siblings('.mBuilder-element').addClass('lower_inner_row_zIndex')
            }

        } else {

            closeAll();
        }

        if ($this.hasClass('mBuilder_row_layout')) {
            $this.find('input').focus();
        }

        // set sc-option position for first row
        var $thisScOptionPositionY = parseInt(e.clientY) - 100;
        var $thisScOptionOpen = parseInt($(".active-gizmo div.options-holder").height());

        if ($thisScOptionPositionY <= $thisScOptionOpen) {
            $(".vc_row .sc-option .options-holder").css({'top': '48px', 'z-index': '99999999'});
        }
        else {
            $(".vc_row .sc-option .options-holder").css({'top': ($thisScOptionOpen * (-1)) - 7, 'z-index': '99999999'});
        }
        // END set sc-option position for first row
        t.mBuilder_closeShortcodeSetting();
        if( $this.hasClass('mBuilder_row_layout') ){
            $this.parent().prev().addClass('show-column-layout');
        }
    });
    $body.off('click.mbuilder', '.mBuilder_row_layout input');
    $body.on('click.mbuilder', '.mBuilder_row_layout input', function (e) {
        e.stopPropagation();
    });
    var time = [];

    $body.on('mouseenter', '.mBuilder_row_controls .mBuilder_setting_panel,.mBuilder_row_layout, .mbuilder-column-options ', function (e) {
        e.stopPropagation();
        clearTimeout(time[$(this)]);
    });

    $body.on('mouseleave', '.mBuilder_row_controls .mBuilder_setting_panel,.mBuilder_row_layout, .mbuilder-column-options', function (e) {
        e.stopPropagation();
        var $this = $(this),
            $innerRow = $this.closest('.mBuilder-vc_row_inner'),
            $container =$this.find('>.mBuilder_container, > .options-holder, > .extra-option') ;
        clearTimeout(time[$this]);
        time[$this] = setTimeout(function () {
            TweenMax.to($container, .3,
                {
                    scale: .9, opacity: 0, delay: 0, onComplete: function () {
                    TweenMax.set($container, {height: 0, zIndex: -333, display: 'none'});
                    $this.removeClass('active-gizmo');
                }
                });
            $this.closest('div[class*=mBuilder-vc_column]').removeClass('upper_zIndex');

            if ($this.hasClass('mBuilder_setting_panel') || $this.hasClass('mBuilder_row_layout')) {
                $this.closest('div[class*=vc_row]').removeClass('upper_zIndex');
            }

            $container.removeClass('open');

            if ($innerRow.length) {
                $innerRow.removeClass('upper_inner_row_zIndex');
                $innerRow.parents('.vc_row').removeClass('upper_inner_row_zIndex');
                $innerRow.siblings('.mBuilder-element').removeClass('lower_inner_row_zIndex')
            }

            toggle = -1;
            closeAll($this);
        }, 200);

    });


    // open shortcode setting panel on one click
    $body.on('click', '.sc-control', function (e) {
        e.stopPropagation();
        var model_id = $(this).closest('.mBuilder-element').attr('data-mbuilder-id');
        if( t.is_shortcode_panel_open(model_id) && $('.setting-panel-container').length ){
            return ;
        }
        $(this).find('.sc-setting').click();
    });
};

/**
 * Duplicate element instantly
 * @param element
 */
mBuilder.prototype.duplicate = function( element ){
    
    var that = this ;
    var el = $( element ).closest('.mBuilder-element'),
        el_id = el.attr('data-mBuilder-id');
    do {
        var newID = Math.floor(100 + (Math.random() * 300) + 1);
    }
    while (this.models.models.hasOwnProperty(newID));
    this.models.models[newID] = JSON.parse(JSON.stringify(this.models.models[el_id]));
    var $container = $('div[data-mbuilder-id=' + el_id + ']'),
        $containerPlaceholder = $container.next('.insert-between-placeholder,.insert-after-row-placeholder'),
        $newContainer = $container.clone().attr('data-mbuilder-id', newID),
        $newContainerPlaceholder = $containerPlaceholder.clone();
    $containerPlaceholder.after($newContainer);
    $newContainer.after($newContainerPlaceholder);
    if ( $( element ).hasClass('mBuilder-vc_column_inner') || $( element ).hasClass('mBuilder-vc_column') ){
        $newContainer.find('.mBuilder-element').remove();
        $container.after($newContainer);
    }
    if ( $( element ).hasClass('mBuilder_row_duplicate') ) {
        var el = $('div[data-mBuilder-id=' + newID + ']');
        el.find('.mBuilder-element').each(function () {
            var child_id = $(this).attr('data-mBuilder-id');
            do {
                var newID = Math.floor(100 + (Math.random() * 300) + 1);
            } while ( that.models.models.hasOwnProperty( newID ) );
            that.models.models[ newID ] = JSON.parse( JSON.stringify( that.models.models[child_id] ) );
            $( this ).attr( 'data-mBuilder-id', newID );
        });
    }
    this.renderControls();
    this.setSortable();
    var $newElm = $('div[data-mbuilder-id=' + newID + ']');
    if($newElm.find('.meditor').length){
        this.bind_text_editor($newElm.find('.meditor'));
    }
    $('body').trigger('duplicate_shortcode', $newElm);

}

mBuilder.prototype.bind_text_editor = function(new_el){
    var content_defaults = {
            text: 'Default Content',
        },
        content_controllers = 'content',
        content_selector = (new_el) ? new_el : '.inline-md-editor' ,
        that = this ;
    this.set_editable(content_defaults,content_controllers,content_selector);
    $('body').off('update_shortcode.bind_text_editor');
    $('body').on('update_shortcode.bind_text_editor' , function(){
        that.bind_text_editor();
    });
}

mBuilder.prototype.update_meditor_models = function(){
    var t = this;
    $('.mBuilder-md_live_text').each(function(){
        var model_id = $(this).attr('data-mbuilder-id');
        t.update_meditor_shortcode_model(model_id);
    });
}

mBuilder.prototype.set_editable = function(defaults,controllers,selector){
    var editable_model = Backbone.Model.extend({
        defaults: 'default'

    });
    var editable_view = Backbone.View.extend({
        initialize: function() {
            this.$el.attr('data-button-class',controllers);
            meditor.editable_init(selector);
        },
        events: {
            'click': 'editable_click' ,
            'blur' : 'check_defult_text' ,
            'mouseup' : 'update_font_family_controller' ,
            'mouseleave' : 'update_font_family_controller'

        },

        check_defult_text: function(e){
            var $el = $(e.target).closest('.meditor');
            if ( $el.text().trim() == ''){
                $el.html( '<span style="font-size:20px">Click here to edit.</span>' );
            }
        },

        update_font_family_controller: function(){

            var parent_select = this.get_selection_parent_element();
            if(  $(parent_select).length && this.get_selected_text() != '' ){
                if( $(parent_select)[0].tagName == "SPAN" && !$(parent_select).children().length ){
                    var font_size = $(parent_select).css('font-size');
                }else{
                    var $get_first_span = $(parent_select).find('span').first();
                    var font_size = $get_first_span.css('font-size');
                }

                if( typeof font_size != "undefined" ){
                    $('.font-size-controller .active-item .text-controller-icon').text(parseInt(font_size));
                }
            }
        },

        get_selected_text: function() {
            if (window.getSelection) {
                return window.getSelection().toString();
            } else if (document.selection) {
                return document.selection.createRange().text;
            }
            return '';
        },

        get_selection_parent_element: function () {
            var parent_el = null,
                sel;
            if (window.getSelection) {
                sel = window.getSelection();
                if (sel.rangeCount) {
                    parent_el = sel.getRangeAt(0).commonAncestorContainer;
                    if (parent_el.nodeType != 1) {
                        parent_el = parent_el.parentNode;
                    }
                }
            } else if ((sel = document.selection) && sel.type != "Control") {
                parent_el = sel.createRange().parentElement();
            }
            return parent_el;
        },

        editable_click: function(e){
            e.stopPropagation();
            if($('body').hasClass('gizmo-off')) return ;
            var $el = $(e.target).closest('.meditor');
            if($el.attr('id') == 'meditor_focus'){
                return ;
            }
            $('.meditor').attr({
                'contenteditable':'false' ,
                'id': '' ,
            }).addClass('unselectable');
            $el.parents('.mBuilder-element').not('.vc_row, .mBuilder-vc_column').draggable({disabled:true});
            var focues_element = $el.attr({
                'contenteditable': true ,
                'id': 'meditor_focus' ,
            }).removeClass('unselectable').get(0);
            if( focues_element != "undefined" ){
                focues_element.focus();
            }
            $('.meditor-panel').css({
                display: 'flex'
            });
            $el.closest('.mBuilder-md_live_text').addClass('active-md-editor');

            builder.mBuilder_closeShortcodeSetting();

        }
    });

    var $editables = $(selector);
    if( typeof $editables[0] !== 'undefined' ){
        var model = new editable_model();
        var view = new editable_view({model: model, el: $editables, tagName: $editables[0].tagName});
    }
}

mBuilder.prototype.update_meditor_shortcode_model = function( model_id ){
    var t = this,
        $model = $("[data-mbuilder-id="+model_id+"]"),
        $shortcode = $model.find('.inline-md-editor'),
        $new_content = $shortcode.html(),
        line_height = $shortcode.attr('data-lineheight'),
        letter_spacing = $shortcode.attr('data-letterspace');
    t.setModelattr(model_id , 'meditor_line_height' , line_height);
    t.setModelattr(model_id , 'meditor_letter_spacing' , letter_spacing);
    t.models.models[model_id].content = t.b64EncodeUnicode($new_content);
}

/**
 * @summary creates placeholders and droppable areas.
 *
 * @since 1.0.0
 */

mBuilder.prototype.createPlaceholders = function () {
    $('.insert-between-placeholder').remove();
    $('.insert-after-row-placeholder').remove();
    var containers = '';
    for (i in this.shortcodes) {
        if (this.shortcodes[i].as_parent && this.shortcodes[i].as_parent.only)
            containers += "[data-mbuilder-el='" + this.shortcodes[i].as_parent.only + "'],";
    }
    containers = containers.slice(0, -1);
    $('<div/>').addClass('insert-between-placeholder').insertAfter($('.mBuilder-element').not('.vc_row,.mBuilder-vc_column, .mBuilder-vc_column_inner').not(containers));
    $('.mBuilder-vc_column, .mBuilder-vc_column_inner').each(function () {
        $('<div/>').addClass('insert-between-placeholder').insertBefore($(this).find('.wpb_wrapper:first .mBuilder-element:first-of-type').not('.mBuilder-vc_column_inner').not(containers));
    });

    $('.insert-between-placeholder').each(function () {
        $(this).attr('data-index', $('div').index(this));
    });

    var rows = $('.vc_row').not('.vc_inner');
    $('<div/>').addClass('insert-after-row-placeholder').insertAfter(rows);
    $('<div/>').addClass('insert-after-row-placeholder').prependTo('.content-container');

    if (! $('.mBuilder-element').length) {

        var element_svg ='<?xml version="1.0" encoding="UTF-8"?><svg width="128px" height="126px" viewBox="0 0 128 87" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>elements</title> <desc>Created with Sketch.</desc> <defs> <polygon id="path1" points="0.1255 0.542 126.3065 0.542 126.3065 84.8059 0.1255 84.8059"></polygon> <polygon id="path3" points="63.66675 86 127.333 86 127.333 -1.42108547e-14 0.0005 0 0.0005 86"></polygon> </defs> <g id="Page1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g transform="translate(0.000000, -1.000000)"> <g id="Group3" transform="translate(1.000000, 0.458400)"> <mask id="mask2" fill="white"> <use xlink:href="#path1"></use> </mask> <g id="Clip2"></g> <path d="M123.4715,84.8059 L2.9595,84.8059 C1.3945,84.8059 0.1255,83.5369 0.1255,81.9709 L0.1255,3.3759 C0.1255,1.8109 1.3945,0.5419 2.9595,0.5419 L123.4715,0.5419 C125.0375,0.5419 126.3065,1.8109 126.3065,3.3759 L126.3065,81.9709 C126.3065,83.5369 125.0375,84.8059 123.4715,84.8059" id="Fill1" fill="#D6E7F9" mask="url(#mask2)"></path> </g> <path d="M39.7905,40.5 L19.1265,40.5 C17.5605,40.5 16.2915,39.231 16.2915,37.665 L16.2915,17.335 C16.2915,15.769 17.5605,14.5 19.1265,14.5 L39.7905,14.5 C41.3565,14.5 42.6255,15.769 42.6255,17.335 L42.6255,37.665 C42.6255,39.231 41.3565,40.5 39.7905,40.5" id="Fill4" fill="#EEF7FF"></path> <path d="M107.7905,41.1667 L87.1265,41.1667 C85.5605,41.1667 84.2915,39.8977 84.2915,38.3317 L84.2915,18.0017 C84.2915,16.4357 85.5605,15.1667 87.1265,15.1667 L107.7905,15.1667 C109.3565,15.1667 110.6255,16.4357 110.6255,18.0017 L110.6255,38.3317 C110.6255,39.8977 109.3565,41.1667 107.7905,41.1667" id="Fill6" fill="#EEF7FF"></path> <path d="M73.4571,40.1667 L52.7931,40.1667 C51.2271,40.1667 49.9581,38.8977 49.9581,37.3317 L49.9581,17.0017 C49.9581,15.4357 51.2271,14.1667 52.7931,14.1667 L73.4571,14.1667 C75.0231,14.1667 76.2921,15.4357 76.2921,17.0017 L76.2921,37.3317 C76.2921,38.8977 75.0231,40.1667 73.4571,40.1667" id="Fill8" fill="#EEF7FF"></path> <path d="M107.7905,74.1667 L87.1265,74.1667 C85.5605,74.1667 84.2915,72.8977 84.2915,71.3317 L84.2915,51.0017 C84.2915,49.4357 85.5605,48.1667 87.1265,48.1667 L107.7905,48.1667 C109.3565,48.1667 110.6255,49.4357 110.6255,51.0017 L110.6255,71.3317 C110.6255,72.8977 109.3565,74.1667 107.7905,74.1667" id="Fill10" fill="#EEF7FF"></path> <path d="M73.1238,74.1667 L52.4598,74.1667 C50.8938,74.1667 49.6248,72.8977 49.6248,71.3317 L49.6248,51.0017 C49.6248,49.4357 50.8938,48.1667 52.4598,48.1667 L73.1238,48.1667 C74.6898,48.1667 75.9588,49.4357 75.9588,51.0017 L75.9588,71.3317 C75.9588,72.8977 74.6898,74.1667 73.1238,74.1667" id="Fill12" fill="#EEF7FF"></path> <path d="M39.4571,73.8333 L18.7931,73.8333 C17.2271,73.8333 15.9581,72.5643 15.9581,70.9983 L15.9581,50.6683 C15.9581,49.1023 17.2271,47.8333 18.7931,47.8333 L39.4571,47.8333 C41.0231,47.8333 42.2921,49.1023 42.2921,50.6683 L42.2921,70.9983 C42.2921,72.5643 41.0231,73.8333 39.4571,73.8333" id="Fill14" fill="#EEF7FF"></path> <g id="Group-18" transform="translate(0.000000, 1.458400)"> <mask id="mask4" fill="white"> <use xlink:href="#path3"></use> </mask> <g id="Clip17"></g> <path d="M125.3335,82.165 C125.3335,83.177 124.5105,84 123.4995,84 L3.8345,84 C2.8235,84 2.0005,83.177 2.0005,82.165 L2.0005,3.834 C2.0005,2.823 2.8235,2 3.8345,2 L123.4995,2 C124.5105,2 125.3335,2.823 125.3335,3.834 L125.3335,82.165 Z M123.4995,0 L3.8345,0 C1.7205,0 0.0005,1.72 0.0005,3.834 L0.0005,82.165 C0.0005,84.28 1.7205,86 3.8345,86 L123.4995,86 C125.6135,86 127.3335,84.28 127.3335,82.165 L127.3335,3.834 C127.3335,1.72 125.6135,0 123.4995,0 L123.4995,0 Z" id="Fill16" fill="#419CF8" mask="url(#mask4)"></path> </g> <path d="M41.9167,37.8739 C41.9167,38.8859 41.0937,39.7079 40.0827,39.7079 L19.2507,39.7079 C18.2397,39.7079 17.4167,38.8859 17.4167,37.8739 L17.4167,17.0429 C17.4167,16.0309 18.2397,15.2079 19.2507,15.2079 L40.0827,15.2079 C41.0937,15.2079 41.9167,16.0309 41.9167,17.0429 L41.9167,37.8739 Z M40.0827,13.2079 L19.2507,13.2079 C17.1367,13.2079 15.4167,14.9289 15.4167,17.0429 L15.4167,37.8739 C15.4167,39.9879 17.1367,41.7079 19.2507,41.7079 L40.0827,41.7079 C42.1967,41.7079 43.9167,39.9879 43.9167,37.8739 L43.9167,17.0429 C43.9167,14.9289 42.1967,13.2079 40.0827,13.2079 L40.0827,13.2079 Z" id="Fill19" fill="#419CF8"></path> <path d="M75.9167,37.8739 C75.9167,38.8859 75.0937,39.7079 74.0827,39.7079 L53.2507,39.7079 C52.2397,39.7079 51.4167,38.8859 51.4167,37.8739 L51.4167,17.0429 C51.4167,16.0309 52.2397,15.2079 53.2507,15.2079 L74.0827,15.2079 C75.0937,15.2079 75.9167,16.0309 75.9167,17.0429 L75.9167,37.8739 Z M74.0827,13.2079 L53.2507,13.2079 C51.1367,13.2079 49.4167,14.9289 49.4167,17.0429 L49.4167,37.8739 C49.4167,39.9879 51.1367,41.7079 53.2507,41.7079 L74.0827,41.7079 C76.1967,41.7079 77.9167,39.9879 77.9167,37.8739 L77.9167,17.0429 C77.9167,14.9289 76.1967,13.2079 74.0827,13.2079 L74.0827,13.2079 Z" id="Fill21" fill="#419CF8"></path> <path d="M110.0176,37.8739 C110.0176,38.8859 109.1946,39.7079 108.1836,39.7079 L87.3516,39.7079 C86.3406,39.7079 85.5176,38.8859 85.5176,37.8739 L85.5176,17.0429 C85.5176,16.0309 86.3406,15.2079 87.3516,15.2079 L108.1836,15.2079 C109.1946,15.2079 110.0176,16.0309 110.0176,17.0429 L110.0176,37.8739 Z M108.1836,13.2079 L87.3516,13.2079 C85.2376,13.2079 83.5176,14.9289 83.5176,17.0429 L83.5176,37.8739 C83.5176,39.9879 85.2376,41.7079 87.3516,41.7079 L108.1836,41.7079 C110.2976,41.7079 112.0176,39.9879 112.0176,37.8739 L112.0176,17.0429 C112.0176,14.9289 110.2976,13.2079 108.1836,13.2079 L108.1836,13.2079 Z" id="Fill23" fill="#419CF8"></path> <path d="M41.9167,71.8739 C41.9167,72.8859 41.0937,73.7079 40.0827,73.7079 L19.2507,73.7079 C18.2397,73.7079 17.4167,72.8859 17.4167,71.8739 L17.4167,51.0429 C17.4167,50.0309 18.2397,49.2079 19.2507,49.2079 L40.0827,49.2079 C41.0937,49.2079 41.9167,50.0309 41.9167,51.0429 L41.9167,71.8739 Z M40.0827,47.2079 L19.2507,47.2079 C17.1367,47.2079 15.4167,48.9289 15.4167,51.0429 L15.4167,71.8739 C15.4167,73.9879 17.1367,75.7079 19.2507,75.7079 L40.0827,75.7079 C42.1967,75.7079 43.9167,73.9879 43.9167,71.8739 L43.9167,51.0429 C43.9167,48.9289 42.1967,47.2079 40.0827,47.2079 L40.0827,47.2079 Z" id="Fill25" fill="#419CF8"></path> <path d="M75.9167,71.8739 C75.9167,72.8859 75.0937,73.7079 74.0827,73.7079 L53.2507,73.7079 C52.2397,73.7079 51.4167,72.8859 51.4167,71.8739 L51.4167,51.0429 C51.4167,50.0309 52.2397,49.2079 53.2507,49.2079 L74.0827,49.2079 C75.0937,49.2079 75.9167,50.0309 75.9167,51.0429 L75.9167,71.8739 Z M74.0827,47.2079 L53.2507,47.2079 C51.1367,47.2079 49.4167,48.9289 49.4167,51.0429 L49.4167,71.8739 C49.4167,73.9879 51.1367,75.7079 53.2507,75.7079 L74.0827,75.7079 C76.1967,75.7079 77.9167,73.9879 77.9167,71.8739 L77.9167,51.0429 C77.9167,48.9289 76.1967,47.2079 74.0827,47.2079 L74.0827,47.2079 Z" id="Fill27" fill="#419CF8"></path> <path d="M109.9167,71.8739 C109.9167,72.8859 109.0937,73.7079 108.0827,73.7079 L87.2507,73.7079 C86.2397,73.7079 85.4167,72.8859 85.4167,71.8739 L85.4167,51.0429 C85.4167,50.0309 86.2397,49.2079 87.2507,49.2079 L108.0827,49.2079 C109.0937,49.2079 109.9167,50.0309 109.9167,51.0429 L109.9167,71.8739 Z M108.0827,47.2079 L87.2507,47.2079 C85.1367,47.2079 83.4167,48.9289 83.4167,51.0429 L83.4167,71.8739 C83.4167,73.9879 85.1367,75.7079 87.2507,75.7079 L108.0827,75.7079 C110.1967,75.7079 111.9167,73.9879 111.9167,71.8739 L111.9167,51.0429 C111.9167,48.9289 110.1967,47.2079 108.0827,47.2079 L108.0827,47.2079 Z" id="Fill29" fill="#419CF8"></path> <path d="M31.1401,21.6032 C31.5481,21.6032 31.8931,21.9532 31.8931,22.3662 C31.8931,22.7802 31.5481,23.1302 31.1401,23.1302 C30.7321,23.1302 30.3871,22.7802 30.3871,22.3662 C30.3871,21.9532 30.7321,21.6032 31.1401,21.6032 M31.1401,24.3542 C32.2301,24.3542 33.1171,23.4622 33.1171,22.3662 C33.1171,21.2702 32.2301,20.3792 31.1401,20.3792 C30.0501,20.3792 29.1631,21.2702 29.1631,22.3662 C29.1631,23.4622 30.0501,24.3542 31.1401,24.3542" id="Fill31" fill="#419CF8"></path> <path d="M33.5729,32.8295 L31.4199,30.1775 L33.5989,27.5695 L37.9029,32.8295 L33.5729,32.8295 Z M21.1519,32.8295 L26.3909,25.9245 L30.1109,30.5065 C30.1229,30.5265 30.1289,30.5485 30.1439,30.5665 L31.9799,32.8295 L21.1519,32.8295 Z M34.0769,26.2215 C33.9609,26.0795 33.7889,25.9975 33.6059,25.9965 C33.4399,25.9775 33.2499,26.0765 33.1339,26.2165 L30.6339,29.2085 L26.8509,24.5475 C26.7319,24.4015 26.5489,24.3175 26.3649,24.3215 C26.1769,24.3245 26.0009,24.4135 25.8879,24.5635 L19.4319,33.0715 C19.2909,33.2565 19.2669,33.5055 19.3709,33.7135 C19.4739,33.9215 19.6859,34.0535 19.9189,34.0535 L33.2649,34.0535 L33.2809,34.0535 L39.1949,34.0535 C39.4319,34.0535 39.6469,33.9175 39.7479,33.7035 C39.8499,33.4895 39.8189,33.2365 39.6689,33.0535 L34.0769,26.2215 Z" id="Fill33" fill="#419CF8"></path> <path d="M65.1505,21.6032 C65.5585,21.6032 65.9035,21.9532 65.9035,22.3662 C65.9035,22.7802 65.5585,23.1302 65.1505,23.1302 C64.7425,23.1302 64.3975,22.7802 64.3975,22.3662 C64.3975,21.9532 64.7425,21.6032 65.1505,21.6032 M65.1505,24.3542 C66.2405,24.3542 67.1275,23.4622 67.1275,22.3662 C67.1275,21.2702 66.2405,20.3792 65.1505,20.3792 C64.0605,20.3792 63.1735,21.2702 63.1735,22.3662 C63.1735,23.4622 64.0605,24.3542 65.1505,24.3542" id="Fill35" fill="#419CF8"></path> <path d="M67.5833,32.8295 L65.4303,30.1775 L67.6093,27.5695 L71.9133,32.8295 L67.5833,32.8295 Z M55.1623,32.8295 L60.4013,25.9245 L64.1213,30.5065 C64.1333,30.5265 64.1393,30.5485 64.1543,30.5665 L65.9903,32.8295 L55.1623,32.8295 Z M68.0873,26.2215 C67.9713,26.0795 67.7993,25.9975 67.6163,25.9965 C67.4503,25.9775 67.2603,26.0765 67.1443,26.2165 L64.6443,29.2085 L60.8603,24.5475 C60.7423,24.4015 60.5593,24.3175 60.3753,24.3215 C60.1873,24.3245 60.0113,24.4135 59.8983,24.5635 L53.4423,33.0715 C53.3013,33.2565 53.2773,33.5055 53.3813,33.7135 C53.4843,33.9215 53.6963,34.0535 53.9293,34.0535 L67.2753,34.0535 L67.2913,34.0535 L73.2053,34.0535 C73.4423,34.0535 73.6573,33.9175 73.7583,33.7035 C73.8603,33.4895 73.8283,33.2365 73.6793,33.0535 L68.0873,26.2215 Z" id="Fill37" fill="#419CF8"></path> <path d="M99.3507,21.6032 C99.7587,21.6032 100.1037,21.9532 100.1037,22.3662 C100.1037,22.7802 99.7587,23.1302 99.3507,23.1302 C98.9427,23.1302 98.5977,22.7802 98.5977,22.3662 C98.5977,21.9532 98.9427,21.6032 99.3507,21.6032 M99.3507,24.3542 C100.4407,24.3542 101.3277,23.4622 101.3277,22.3662 C101.3277,21.2702 100.4407,20.3792 99.3507,20.3792 C98.2607,20.3792 97.3737,21.2702 97.3737,22.3662 C97.3737,23.4622 98.2607,24.3542 99.3507,24.3542" id="Fill39" fill="#419CF8"></path> <path d="M101.7835,32.8295 L99.6305,30.1775 L101.8095,27.5695 L106.1135,32.8295 L101.7835,32.8295 Z M89.3625,32.8295 L94.6015,25.9245 L98.3215,30.5065 C98.3335,30.5265 98.3395,30.5485 98.3545,30.5665 L100.1905,32.8295 L89.3625,32.8295 Z M102.2875,26.2215 C102.1715,26.0795 101.9995,25.9975 101.8165,25.9965 C101.6505,25.9775 101.4605,26.0765 101.3445,26.2165 L98.8445,29.2085 L95.0615,24.5475 C94.9425,24.4015 94.7595,24.3175 94.5755,24.3215 C94.3875,24.3245 94.2115,24.4135 94.0985,24.5635 L87.6425,33.0715 C87.5015,33.2565 87.4775,33.5055 87.5815,33.7135 C87.6845,33.9215 87.8965,34.0535 88.1295,34.0535 L101.4755,34.0535 L101.4915,34.0535 L107.4055,34.0535 C107.6425,34.0535 107.8575,33.9175 107.9585,33.7035 C108.0605,33.4895 108.0295,33.2365 107.8795,33.0535 L102.2875,26.2215 Z" id="Fill41" fill="#419CF8"></path> <path d="M31.1401,54.6032 C31.5481,54.6032 31.8931,54.9532 31.8931,55.3662 C31.8931,55.7802 31.5481,56.1302 31.1401,56.1302 C30.7321,56.1302 30.3871,55.7802 30.3871,55.3662 C30.3871,54.9532 30.7321,54.6032 31.1401,54.6032 M31.1401,57.3542 C32.2301,57.3542 33.1171,56.4622 33.1171,55.3662 C33.1171,54.2702 32.2301,53.3792 31.1401,53.3792 C30.0501,53.3792 29.1631,54.2702 29.1631,55.3662 C29.1631,56.4622 30.0501,57.3542 31.1401,57.3542" id="Fill43" fill="#419CF8"></path> <path d="M33.5729,65.8295 L31.4199,63.1775 L33.5989,60.5695 L37.9029,65.8295 L33.5729,65.8295 Z M21.1519,65.8295 L26.3909,58.9245 L30.1109,63.5065 C30.1229,63.5265 30.1289,63.5485 30.1439,63.5665 L31.9799,65.8295 L21.1519,65.8295 Z M34.0769,59.2215 C33.9609,59.0795 33.7889,58.9975 33.6059,58.9965 C33.4399,58.9775 33.2499,59.0765 33.1339,59.2165 L30.6339,62.2085 L26.8509,57.5475 C26.7319,57.4015 26.5489,57.3175 26.3649,57.3215 C26.1769,57.3245 26.0009,57.4135 25.8879,57.5635 L19.4319,66.0715 C19.2909,66.2565 19.2669,66.5055 19.3709,66.7135 C19.4739,66.9215 19.6859,67.0535 19.9189,67.0535 L33.2649,67.0535 L33.2809,67.0535 L39.1949,67.0535 C39.4319,67.0535 39.6469,66.9175 39.7479,66.7035 C39.8499,66.4895 39.8189,66.2365 39.6689,66.0535 L34.0769,59.2215 Z" id="Fill45" fill="#419CF8"></path> <path d="M65.1505,54.6032 C65.5585,54.6032 65.9035,54.9532 65.9035,55.3662 C65.9035,55.7802 65.5585,56.1302 65.1505,56.1302 C64.7425,56.1302 64.3975,55.7802 64.3975,55.3662 C64.3975,54.9532 64.7425,54.6032 65.1505,54.6032 M65.1505,57.3542 C66.2405,57.3542 67.1275,56.4622 67.1275,55.3662 C67.1275,54.2702 66.2405,53.3792 65.1505,53.3792 C64.0605,53.3792 63.1735,54.2702 63.1735,55.3662 C63.1735,56.4622 64.0605,57.3542 65.1505,57.3542" id="Fill47" fill="#419CF8"></path> <path d="M67.5833,65.8295 L65.4303,63.1775 L67.6093,60.5695 L71.9133,65.8295 L67.5833,65.8295 Z M55.1623,65.8295 L60.4013,58.9245 L64.1213,63.5065 C64.1333,63.5265 64.1393,63.5485 64.1543,63.5665 L65.9903,65.8295 L55.1623,65.8295 Z M68.0873,59.2215 C67.9713,59.0795 67.7993,58.9975 67.6163,58.9965 C67.4503,58.9775 67.2603,59.0765 67.1443,59.2165 L64.6443,62.2085 L60.8603,57.5475 C60.7423,57.4015 60.5593,57.3175 60.3753,57.3215 C60.1873,57.3245 60.0113,57.4135 59.8983,57.5635 L53.4423,66.0715 C53.3013,66.2565 53.2773,66.5055 53.3813,66.7135 C53.4843,66.9215 53.6963,67.0535 53.9293,67.0535 L67.2753,67.0535 L67.2913,67.0535 L73.2053,67.0535 C73.4423,67.0535 73.6573,66.9175 73.7583,66.7035 C73.8603,66.4895 73.8283,66.2365 73.6793,66.0535 L68.0873,59.2215 Z" id="Fill49" fill="#419CF8"></path> <path d="M99.3507,54.6032 C99.7587,54.6032 100.1037,54.9532 100.1037,55.3662 C100.1037,55.7802 99.7587,56.1302 99.3507,56.1302 C98.9427,56.1302 98.5977,55.7802 98.5977,55.3662 C98.5977,54.9532 98.9427,54.6032 99.3507,54.6032 M99.3507,57.3542 C100.4407,57.3542 101.3277,56.4622 101.3277,55.3662 C101.3277,54.2702 100.4407,53.3792 99.3507,53.3792 C98.2607,53.3792 97.3737,54.2702 97.3737,55.3662 C97.3737,56.4622 98.2607,57.3542 99.3507,57.3542" id="Fill51" fill="#419CF8"></path> <path d="M101.7835,65.8295 L99.6305,63.1775 L101.8095,60.5695 L106.1135,65.8295 L101.7835,65.8295 Z M89.3625,65.8295 L94.6015,58.9245 L98.3215,63.5065 C98.3335,63.5265 98.3395,63.5485 98.3545,63.5665 L100.1905,65.8295 L89.3625,65.8295 Z M102.2875,59.2215 C102.1715,59.0795 101.9995,58.9975 101.8165,58.9965 C101.6505,58.9775 101.4605,59.0765 101.3445,59.2165 L98.8445,62.2085 L95.0615,57.5475 C94.9425,57.4015 94.7595,57.3175 94.5755,57.3215 C94.3875,57.3245 94.2115,57.4135 94.0985,57.5635 L87.6425,66.0715 C87.5015,66.2565 87.4775,66.5055 87.5815,66.7135 C87.6845,66.9215 87.8965,67.0535 88.1295,67.0535 L101.4755,67.0535 L101.4915,67.0535 L107.4055,67.0535 C107.6425,67.0535 107.8575,66.9175 107.9585,66.7035 C108.0605,66.4895 108.0295,66.2365 107.8795,66.0535 L102.2875,59.2215 Z" id="Fill53" fill="#419CF8"></path> </g> </g></svg>';
        var sections_svg ='<?xml version="1.0" encoding="UTF-8"?><svg width="127px" height="126px" viewBox="0 0 127 85" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>sections</title> <desc>Created with Sketch.</desc> <defs> <polygon id="path-1" points="0 85 127 85 127 0 0 0"></polygon> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g> <path d="M122.567,83.7319 L4.236,83.7319 C2.671,83.7319 1.402,82.4629 1.402,80.8969 L1.402,3.5669 C1.402,2.0009 2.671,0.7319 4.236,0.7319 L122.567,0.7319 C124.133,0.7319 125.402,2.0009 125.402,3.5669 L125.402,80.8969 C125.402,82.4629 124.133,83.7319 122.567,83.7319 Z" id="Fill-1" fill="#D6E7F9"></path> <mask id="mask-2" fill="white"> <use xlink:href="#path-1"></use> </mask> <g id="Clip-4"></g> <polygon id="Fill-3" fill="#EEF7FF" mask="url(#mask-2)" points="13.402 60.732 113.402 60.732 113.402 25.399 13.402 25.399"></polygon> <polygon id="Fill-5" fill="#EEF7FF" mask="url(#mask-2)" points="13.402 84.205 113.402 84.205 113.402 69.399 13.402 69.399"></polygon> <polygon id="Fill-6" fill="#EEF7FF" mask="url(#mask-2)" points="13.402 16.871 113.402 16.871 113.402 2.065 13.402 2.065"></polygon> <path d="M3.8345,2 C2.8225,2 2.0005,2.823 2.0005,3.835 L2.0005,81.166 C2.0005,82.177 2.8225,83 3.8345,83 L123.1655,83 C124.1775,83 125.0005,82.177 125.0005,81.166 L125.0005,3.835 C125.0005,2.823 124.1775,2 123.1655,2 L3.8345,2 Z M123.1655,85 L3.8345,85 C1.7205,85 0.0005,83.28 0.0005,81.166 L0.0005,3.835 C0.0005,1.72 1.7205,0 3.8345,0 L123.1655,0 C125.2795,0 127.0005,1.72 127.0005,3.835 L127.0005,81.166 C127.0005,83.28 125.2795,85 123.1655,85 L123.1655,85 Z" id="Fill-7" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M16.0532,26.5635 C15.0412,26.5635 14.2192,27.3865 14.2192,28.3985 L14.2192,58.5825 C14.2192,59.5945 15.0412,60.4175 16.0532,60.4175 L110.9472,60.4175 C111.9582,60.4175 112.7812,59.5945 112.7812,58.5825 L112.7812,28.3985 C112.7812,27.3865 111.9582,26.5635 110.9472,26.5635 L16.0532,26.5635 Z M110.9472,62.4175 L16.0532,62.4175 C13.9392,62.4175 12.2192,60.6975 12.2192,58.5825 L12.2192,28.3985 C12.2192,26.2835 13.9392,24.5635 16.0532,24.5635 L110.9472,24.5635 C113.0612,24.5635 114.7812,26.2835 114.7812,28.3985 L114.7812,58.5825 C114.7812,60.6975 113.0612,62.4175 110.9472,62.4175 L110.9472,62.4175 Z" id="Fill-8" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M112.7813,0.3986 L112.7813,15.1236 C112.7813,16.1356 111.9583,16.9586 110.9473,16.9586 L16.0533,16.9586 C15.0413,16.9586 14.2183,16.1356 14.2183,15.1236 L14.2183,0.3986 L12.2183,0.3986 L12.2183,15.1236 C12.2183,17.2386 13.9393,18.9586 16.0533,18.9586 L110.9473,18.9586 C113.0613,18.9586 114.7813,17.2386 114.7813,15.1236 L114.7813,0.3986 L112.7813,0.3986 Z" id="Fill-9" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M14.2187,83.7319 L14.2187,71.8569 C14.2187,70.8449 15.0417,70.0229 16.0527,70.0229 L110.9467,70.0229 C111.9587,70.0229 112.7817,70.8449 112.7817,71.8569 L112.7817,83.7319 L114.7817,83.7319 L114.7817,71.8569 C114.7817,69.7429 113.0607,68.0229 110.9467,68.0229 L16.0527,68.0229 C13.9387,68.0229 12.2187,69.7429 12.2187,71.8569 L12.2187,83.7319 L14.2187,83.7319 Z" id="Fill-10" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M45.4813,34.5545 C46.0983,34.5545 46.6193,35.0835 46.6193,35.7085 C46.6193,36.3335 46.0983,36.8625 45.4813,36.8625 C44.8643,36.8625 44.3423,36.3335 44.3423,35.7085 C44.3423,35.0835 44.8643,34.5545 45.4813,34.5545 M45.4813,38.7135 C47.1293,38.7135 48.4703,37.3655 48.4703,35.7085 C48.4703,34.0515 47.1293,32.7035 45.4813,32.7035 C43.8333,32.7035 42.4923,34.0515 42.4923,35.7085 C42.4923,37.3655 43.8333,38.7135 45.4813,38.7135" id="Fill-11" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M49.1596,51.5285 L45.9046,47.5185 L49.1986,43.5755 L55.7066,51.5285 L49.1596,51.5285 Z M38.3016,41.0875 L43.9246,48.0165 C43.9436,48.0455 43.9526,48.0795 43.9756,48.1075 L46.7516,51.5285 L30.3786,51.5285 L38.3016,41.0875 Z M58.3766,51.8675 L49.9216,41.5375 C49.7466,41.3235 49.4856,41.1995 49.2096,41.1975 C48.9586,41.1685 48.6716,41.3185 48.4956,41.5295 L44.7166,46.0545 L38.9956,39.0065 C38.8156,38.7855 38.5396,38.6595 38.2616,38.6645 C37.9776,38.6695 37.7116,38.8035 37.5396,39.0305 L27.7776,51.8945 C27.5656,52.1745 27.5296,52.5505 27.6866,52.8655 C27.8426,53.1805 28.1636,53.3795 28.5146,53.3795 L48.6936,53.3795 L48.7186,53.3795 L57.6606,53.3795 C58.0176,53.3795 58.3436,53.1735 58.4966,52.8505 C58.6496,52.5275 58.6026,52.1445 58.3766,51.8675 L58.3766,51.8675 Z" id="Fill-12" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M75.2907,37.6474 L90.6737,37.6474 C91.1847,37.6474 91.5987,37.2334 91.5987,36.7224 C91.5987,36.2114 91.1847,35.7964 90.6737,35.7964 L75.2907,35.7964 C74.7797,35.7964 74.3657,36.2114 74.3657,36.7224 C74.3657,37.2334 74.7797,37.6474 75.2907,37.6474" id="Fill-13" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M74.4069,41.9663 C74.4069,42.4773 74.8209,42.8913 75.3319,42.8913 L97.4599,42.8913 C97.9709,42.8913 98.3849,42.4773 98.3849,41.9663 C98.3849,41.4553 97.9709,41.0413 97.4599,41.0413 L75.3319,41.0413 C74.8209,41.0413 74.4069,41.4553 74.4069,41.9663" id="Fill-14" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M97.4597,46.2847 L75.3327,46.2847 C74.8217,46.2847 74.4067,46.6987 74.4067,47.2097 C74.4067,47.7207 74.8217,48.1357 75.3327,48.1357 L97.4597,48.1357 C97.9707,48.1357 98.3847,47.7207 98.3847,47.2097 C98.3847,46.6987 97.9707,46.2847 97.4597,46.2847" id="Fill-15" fill="#419CF8" mask="url(#mask-2)"></path> <path d="M97.2641,51.5285 L75.1361,51.5285 C74.6251,51.5285 74.2111,51.9425 74.2111,52.4535 C74.2111,52.9645 74.6251,53.3795 75.1361,53.3795 L97.2641,53.3795 C97.7751,53.3795 98.1891,52.9645 98.1891,52.4535 C98.1891,51.9425 97.7751,51.5285 97.2641,51.5285" id="Fill-16" fill="#419CF8" mask="url(#mask-2)"></path> </g> </g></svg>';
        var import_svg ='<?xml version="1.0" encoding="UTF-8"?><svg width="128px" height="127px" viewBox="0 0 128 127" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Page 1</title> <desc>Created with Sketch.</desc> <defs> <polygon id="path-1" points="5.42101086e-20 0.7367 5.42101086e-20 87.6907 127.4775 87.6907 127.4775 0.7367"></polygon> <polygon id="path-3" points="0 126.583 127.478 126.583 127.478 0 0 0"></polygon> </defs> <g id="Forough" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Page-1"> <path d="M123.5291,105.5415 L3.9481,105.5415 C2.3831,105.5415 1.1141,104.2725 1.1141,102.7065 L1.1141,23.8765 C1.1141,22.3105 2.3831,21.0415 3.9481,21.0415 L123.5291,21.0415 C125.0951,21.0415 126.3641,22.3105 126.3641,23.8765 L126.3641,102.7065 C126.3641,104.2725 125.0951,105.5415 123.5291,105.5415 Z" id="Fill-1" fill="#D6E7F9"></path> <path d="M46.4464,54.7856 C47.1134,54.7856 47.6764,55.3566 47.6764,56.0326 C47.6764,56.7086 47.1134,57.2796 46.4464,57.2796 C45.7794,57.2796 45.2164,56.7086 45.2164,56.0326 C45.2164,55.3566 45.7794,54.7856 46.4464,54.7856 M46.4464,59.2796 C48.2274,59.2796 49.6764,57.8226 49.6764,56.0326 C49.6764,54.2426 48.2274,52.7856 46.4464,52.7856 C44.6654,52.7856 43.2164,54.2426 43.2164,56.0326 C43.2164,57.8226 44.6654,59.2796 46.4464,59.2796" id="Fill-3" fill="#419CF8"></path> <path d="M38.7911,61.4048 L47.9491,72.6868 L30.2301,72.6868 L38.7911,61.4048 Z M50.9631,64.3498 L57.7661,72.6198 L50.9061,72.6198 L47.5141,68.4588 L50.9631,64.3498 Z M28.2161,74.6868 L50.0491,74.6868 C50.1741,74.6868 50.2911,74.6568 50.4041,74.6138 C50.4131,74.6138 50.4221,74.6198 50.4321,74.6198 L59.8831,74.6198 C60.2701,74.6198 60.6221,74.3968 60.7871,74.0468 C60.9521,73.6968 60.9001,73.2828 60.6551,72.9838 L51.7431,62.1498 C51.5541,61.9208 51.2721,61.7878 50.9761,61.7858 C50.6451,61.7978 50.3951,61.9158 50.2051,62.1428 L46.0161,67.1328 L39.5411,59.1558 C39.3471,58.9168 39.0531,58.8018 38.7481,58.7858 C38.4411,58.7908 38.1531,58.9368 37.9681,59.1808 L27.4191,73.0828 C27.1891,73.3848 27.1511,73.7918 27.3201,74.1318 C27.4891,74.4718 27.8361,74.6868 28.2161,74.6868 L28.2161,74.6868 Z" id="Fill-5" fill="#419CF8"></path> <path d="M71.0051,57.7045 L86.5921,57.7045 C87.0521,57.7045 87.4241,57.2575 87.4241,56.7045 C87.4241,56.1515 87.0521,55.7045 86.5921,55.7045 L71.0051,55.7045 C70.5461,55.7045 70.1741,56.1515 70.1741,56.7045 C70.1741,57.2575 70.5461,57.7045 71.0051,57.7045" id="Fill-7" fill="#419CF8"></path> <path d="M71.4268,63.2052 L94.9208,63.2052 C95.6138,63.2052 96.1738,62.7582 96.1738,62.2052 C96.1738,61.6522 95.6138,61.2052 94.9208,61.2052 L71.4268,61.2052 C70.7338,61.2052 70.1738,61.6522 70.1738,62.2052 C70.1738,62.7582 70.7338,63.2052 71.4268,63.2052" id="Fill-9" fill="#419CF8"></path> <path d="M71.4268,68.7058 L94.9208,68.7058 C95.6138,68.7058 96.1738,68.2588 96.1738,67.7058 C96.1738,67.1528 95.6138,66.7058 94.9208,66.7058 L71.4268,66.7058 C70.7338,66.7058 70.1738,67.1528 70.1738,67.7058 C70.1738,68.2588 70.7338,68.7058 71.4268,68.7058" id="Fill-11" fill="#419CF8"></path> <path d="M71.4268,74.2064 L94.9208,74.2064 C95.6138,74.2064 96.1738,73.7594 96.1738,73.2064 C96.1738,72.6534 95.6138,72.2064 94.9208,72.2064 L71.4268,72.2064 C70.7338,72.2064 70.1738,72.6534 70.1738,73.2064 C70.1738,73.7594 70.7338,74.2064 71.4268,74.2064" id="Fill-13" fill="#419CF8"></path> <path d="M28.5089,94.2083 L44.0959,94.2083 C44.5559,94.2083 44.9279,93.7613 44.9279,93.2083 C44.9279,92.6553 44.5559,92.2083 44.0959,92.2083 L28.5089,92.2083 C28.0499,92.2083 27.6779,92.6553 27.6779,93.2083 C27.6779,93.7613 28.0499,94.2083 28.5089,94.2083" id="Fill-15" fill="#419CF8"></path> <path d="M28.9305,99.709 L52.4245,99.709 C53.1175,99.709 53.6775,99.262 53.6775,98.709 C53.6775,98.156 53.1175,97.709 52.4245,97.709 L28.9305,97.709 C28.2375,97.709 27.6775,98.156 27.6775,98.709 C27.6775,99.262 28.2375,99.709 28.9305,99.709" id="Fill-17" fill="#419CF8"></path> <path d="M51.9629,25.9552 L28.4689,25.9552 C27.7759,25.9552 27.2159,26.4022 27.2159,26.9552 C27.2159,27.5082 27.7759,27.9552 28.4689,27.9552 L51.9629,27.9552 C52.6559,27.9552 53.2159,27.5082 53.2159,26.9552 C53.2159,26.4022 52.6559,25.9552 51.9629,25.9552" id="Fill-19" fill="#419CF8"></path> <path d="M51.9629,31.4558 L28.4689,31.4558 C27.7759,31.4558 27.2159,31.9028 27.2159,32.4558 C27.2159,33.0088 27.7759,33.4558 28.4689,33.4558 L51.9629,33.4558 C52.6559,33.4558 53.2159,33.0088 53.2159,32.4558 C53.2159,31.9028 52.6559,31.4558 51.9629,31.4558" id="Fill-21" fill="#419CF8"></path> <path d="M85.8359,91.5513 C86.5029,91.5513 87.0659,92.1223 87.0659,92.7983 C87.0659,93.4743 86.5029,94.0453 85.8359,94.0453 C85.1689,94.0453 84.6059,93.4743 84.6059,92.7983 C84.6059,92.1223 85.1689,91.5513 85.8359,91.5513 M85.8359,96.0453 C87.6169,96.0453 89.0659,94.5883 89.0659,92.7983 C89.0659,91.0083 87.6169,89.5513 85.8359,89.5513 C84.0549,89.5513 82.6059,91.0083 82.6059,92.7983 C82.6059,94.5883 84.0549,96.0453 85.8359,96.0453" id="Fill-23" fill="#419CF8"></path> <g id="Group-27" transform="translate(0.000000, 19.583000)"> <mask id="mask-2" fill="white"> <use xlink:href="#path-1"></use> </mask> <g id="Clip-26"></g> <path d="M125.4775,82.8457 C125.4775,83.8577 124.6545,84.6807 123.6425,84.6807 L113.8885,84.6807 L113.8885,2.7367 L123.6425,2.7367 C124.6545,2.7367 125.4775,3.5597 125.4775,4.5717 L125.4775,82.8457 Z M111.8885,24.0667 L15.2225,24.0667 L15.2225,2.7367 L77.7865,2.7367 L70.3765,12.5007 C70.1475,12.8037 70.1095,13.2097 70.2785,13.5497 C70.4475,13.8907 70.7935,14.1057 71.1735,14.1057 L93.0065,14.1057 C93.1315,14.1057 93.2495,14.0747 93.3615,14.0317 C93.3715,14.0317 93.3795,14.0377 93.3895,14.0377 L102.8405,14.0377 C103.2275,14.0377 103.5795,13.8157 103.7455,13.4647 C103.9105,13.1147 103.8585,12.7007 103.6135,12.4017 L95.6625,2.7367 L111.8885,2.7367 L111.8885,24.0667 Z M15.2225,63.9307 L111.8885,63.9307 L111.8885,26.0667 L15.2225,26.0667 L15.2225,63.9307 Z M111.8885,84.6807 L95.5325,84.6807 L91.1325,79.3327 C90.9435,79.1027 90.6625,78.9707 90.3655,78.9687 C90.0345,78.9797 89.7855,79.0977 89.5945,79.3257 L85.4055,84.3157 L78.9305,76.3387 C78.7365,76.0987 78.4425,75.9847 78.1375,75.9687 C77.8315,75.9727 77.5425,76.1197 77.3575,76.3637 L71.0465,84.6807 L15.2225,84.6807 L15.2225,65.9307 L111.8885,65.9307 L111.8885,84.6807 Z M87.7095,84.6807 L90.3525,81.5327 L92.9425,84.6807 L87.7095,84.6807 Z M73.5575,84.6807 L78.1805,78.5877 L83.1265,84.6807 L73.5575,84.6807 Z M83.3025,2.7367 L90.9075,12.1057 L73.1885,12.1057 L80.2975,2.7367 L83.3025,2.7367 Z M93.9205,3.7687 L100.7235,12.0377 L93.8645,12.0377 L90.4715,7.8767 L93.9205,3.7687 Z M92.1765,2.7367 L88.9745,6.5507 L85.8775,2.7367 L92.1765,2.7367 Z M13.2225,24.0667 L13.2225,26.0667 L13.2225,84.6807 L3.8335,84.6807 C2.8225,84.6807 1.9995,83.8577 1.9995,82.8457 L1.9995,4.5717 C1.9995,3.5597 2.8225,2.7367 3.8335,2.7367 L13.2225,2.7367 L13.2225,24.0667 Z M123.6425,0.7367 L3.8335,0.7367 C1.7195,0.7367 -0.0005,2.4567 -0.0005,4.5717 L-0.0005,82.8457 C-0.0005,84.9597 1.7195,86.6807 3.8335,86.6807 L13.2965,86.6807 L13.2965,87.6907 L15.2965,87.6907 L15.2965,86.6807 L112.1805,86.6807 L112.1805,87.3527 L114.1805,87.3527 L114.1805,86.6807 L123.6425,86.6807 C125.7565,86.6807 127.4775,84.9597 127.4775,82.8457 L127.4775,4.5717 C127.4775,2.4567 125.7565,0.7367 123.6425,0.7367 L123.6425,0.7367 Z" id="Fill-25" fill="#419CF8" mask="url(#mask-2)"></path> </g> <mask id="mask-4" fill="white"> <use xlink:href="#path-3"></use> </mask> <g id="Clip-29"></g> <polygon id="Fill-28" fill="#419CF8" mask="url(#mask-4)" points="52.603 2 54.594 2 54.594 0 52.603 0"></polygon> <polygon id="Fill-30" fill="#419CF8" mask="url(#mask-4)" points="56.585 2 58.576 2 58.576 0 56.585 0"></polygon> <polygon id="Fill-31" fill="#419CF8" mask="url(#mask-4)" points="44.638 2 46.629 2 46.629 0 44.638 0"></polygon> <polygon id="Fill-32" fill="#419CF8" mask="url(#mask-4)" points="48.62 2 50.611 2 50.611 0 48.62 0"></polygon> <polygon id="Fill-33" fill="#419CF8" mask="url(#mask-4)" points="60.568 2 62.559 2 62.559 0 60.568 0"></polygon> <polygon id="Fill-34" fill="#419CF8" mask="url(#mask-4)" points="76.497 2 78.488 2 78.488 0 76.497 0"></polygon> <polygon id="Fill-35" fill="#419CF8" mask="url(#mask-4)" points="68.532 2 70.523 2 70.523 0 68.532 0"></polygon> <polygon id="Fill-36" fill="#419CF8" mask="url(#mask-4)" points="64.55 2 66.541 2 66.541 0 64.55 0"></polygon> <polygon id="Fill-37" fill="#419CF8" mask="url(#mask-4)" points="72.515 2 74.506 2 74.506 0 72.515 0"></polygon> <polygon id="Fill-38" fill="#419CF8" mask="url(#mask-4)" points="24.727 2 26.718 2 26.718 0 24.727 0"></polygon> <polygon id="Fill-39" fill="#419CF8" mask="url(#mask-4)" points="20.744 2 22.735 2 22.735 0 20.744 0"></polygon> <path d="M17.1318,2.0001 L18.7528,2.0001 L18.7528,0.0001 L17.1318,0.0001 C16.9628,0.0001 16.7968,0.0111 16.6348,0.0321 L16.8928,2.0151 C16.9708,2.0051 17.0508,2.0001 17.1318,2.0001" id="Fill-40" fill="#419CF8" mask="url(#mask-4)"></path> <path d="M15.7734,2.6016 L14.2964,1.2536 C13.6824,1.9266 13.3284,2.7946 13.2984,3.7006 L15.2964,3.7646 C15.3114,3.3356 15.4804,2.9226 15.7734,2.6016" id="Fill-41" fill="#419CF8" mask="url(#mask-4)"></path> <polygon id="Fill-42" fill="#419CF8" mask="url(#mask-4)" points="36.674 2 38.665 2 38.665 0 36.674 0"></polygon> <polygon id="Fill-43" fill="#419CF8" mask="url(#mask-4)" points="32.692 2 34.683 2 34.683 0 32.692 0"></polygon> <polygon id="Fill-44" fill="#419CF8" mask="url(#mask-4)" points="28.709 2 30.7 2 30.7 0 28.709 0"></polygon> <polygon id="Fill-45" fill="#419CF8" mask="url(#mask-4)" points="40.656 2 42.646 2 42.646 0 40.656 0"></polygon> <polygon id="Fill-46" fill="#419CF8" mask="url(#mask-4)" points="112.181 11.359 114.181 11.359 114.181 9.368 112.181 9.368"></polygon> <polygon id="Fill-47" fill="#419CF8" mask="url(#mask-4)" points="112.181 15.342 114.181 15.342 114.181 13.351 112.181 13.351"></polygon> <polygon id="Fill-48" fill="#419CF8" mask="url(#mask-4)" points="112.181 19.324 114.181 19.324 114.181 17.333 112.181 17.333"></polygon> <polygon id="Fill-49" fill="#419CF8" mask="url(#mask-4)" points="13.297 111.256 15.297 111.256 15.297 109.265 13.297 109.265"></polygon> <polygon id="Fill-50" fill="#419CF8" mask="url(#mask-4)" points="112.181 7.377 114.181 7.377 114.181 5.386 112.181 5.386"></polygon> <polygon id="Fill-51" fill="#419CF8" mask="url(#mask-4)" points="13.297 119.221 15.297 119.221 15.297 117.23 13.297 117.23"></polygon> <polygon id="Fill-52" fill="#419CF8" mask="url(#mask-4)" points="13.297 115.238 15.297 115.238 15.297 113.247 13.297 113.247"></polygon> <polygon id="Fill-53" fill="#419CF8" mask="url(#mask-4)" points="92.426 2 94.417 2 94.417 0 92.426 0"></polygon> <polygon id="Fill-54" fill="#419CF8" mask="url(#mask-4)" points="96.408 2 98.399 2 98.399 0 96.408 0"></polygon> <polygon id="Fill-55" fill="#419CF8" mask="url(#mask-4)" points="88.444 2 90.435 2 90.435 0 88.444 0"></polygon> <polygon id="Fill-56" fill="#419CF8" mask="url(#mask-4)" points="80.48 2 82.471 2 82.471 0 80.48 0"></polygon> <polygon id="Fill-57" fill="#419CF8" mask="url(#mask-4)" points="84.462 2 86.453 2 86.453 0 84.462 0"></polygon> <path d="M114.1367,3.2461 C113.9997,2.3531 113.5447,1.5331 112.8557,0.9361 L111.5467,2.4501 C111.8777,2.7351 112.0947,3.1261 112.1597,3.5491 L114.1367,3.2461 Z" id="Fill-58" fill="#419CF8" mask="url(#mask-4)"></path> <polygon id="Fill-59" fill="#419CF8" mask="url(#mask-4)" points="100.391 2 102.382 2 102.382 0 100.391 0"></polygon> <polygon id="Fill-60" fill="#419CF8" mask="url(#mask-4)" points="110.3467 0.0001 108.3557 0.0001 108.3557 2.0001 110.3787 2.0001"></polygon> <polygon id="Fill-61" fill="#419CF8" mask="url(#mask-4)" points="104.373 2 106.364 2 106.364 0 104.373 0"></polygon> <polygon id="Fill-62" fill="#419CF8" mask="url(#mask-4)" points="19.106 126.582 21.097 126.582 21.097 124.582 19.106 124.582"></polygon> <polygon id="Fill-63" fill="#419CF8" mask="url(#mask-4)" points="90.788 126.582 92.779 126.582 92.779 124.582 90.788 124.582"></polygon> <polygon id="Fill-64" fill="#419CF8" mask="url(#mask-4)" points="82.824 126.582 84.815 126.582 84.815 124.582 82.824 124.582"></polygon> <polygon id="Fill-65" fill="#419CF8" mask="url(#mask-4)" points="98.753 126.582 100.744 126.582 100.744 124.582 98.753 124.582"></polygon> <polygon id="Fill-66" fill="#419CF8" mask="url(#mask-4)" points="94.771 126.582 96.762 126.582 96.762 124.582 94.771 124.582"></polygon> <polygon id="Fill-67" fill="#419CF8" mask="url(#mask-4)" points="86.807 126.582 88.797 126.582 88.797 124.582 86.807 124.582"></polygon> <polygon id="Fill-68" fill="#419CF8" mask="url(#mask-4)" points="78.842 126.582 80.833 126.582 80.833 124.582 78.842 124.582"></polygon> <polygon id="Fill-69" fill="#419CF8" mask="url(#mask-4)" points="70.877 126.582 72.868 126.582 72.868 124.582 70.877 124.582"></polygon> <polygon id="Fill-70" fill="#419CF8" mask="url(#mask-4)" points="74.859 126.582 76.85 126.582 76.85 124.582 74.859 124.582"></polygon> <path d="M110.5752,124.5674 L110.8232,126.5514 C111.7202,126.4404 112.5532,126.0104 113.1682,125.3424 L111.6972,123.9874 C111.4022,124.3074 111.0042,124.5134 110.5752,124.5674" id="Fill-71" fill="#419CF8" mask="url(#mask-4)"></path> <polygon id="Fill-72" fill="#419CF8" mask="url(#mask-4)" points="112.181 118.883 114.181 118.883 114.181 116.892 112.181 116.892"></polygon> <polygon id="Fill-73" fill="#419CF8" mask="url(#mask-4)" points="112.181 114.9 114.181 114.9 114.181 112.909 112.181 112.909"></polygon> <polygon id="Fill-74" fill="#419CF8" mask="url(#mask-4)" points="112.181 110.918 114.181 110.918 114.181 108.927 112.181 108.927"></polygon> <polygon id="Fill-75" fill="#419CF8" mask="url(#mask-4)" points="102.735 126.582 104.726 126.582 104.726 124.582 102.735 124.582"></polygon> <polygon id="Fill-76" fill="#419CF8" mask="url(#mask-4)" points="106.718 126.582 108.709 126.582 108.709 124.582 106.718 124.582"></polygon> <polygon id="Fill-77" fill="#419CF8" mask="url(#mask-4)" points="112.1807 122.7314 112.1777 122.8374 114.1777 122.8924 114.1807 120.8744 112.1807 120.8744"></polygon> <polygon id="Fill-78" fill="#419CF8" mask="url(#mask-4)" points="66.895 126.582 68.886 126.582 68.886 124.582 66.895 124.582"></polygon> <polygon id="Fill-79" fill="#419CF8" mask="url(#mask-4)" points="27.071 126.582 29.062 126.582 29.062 124.582 27.071 124.582"></polygon> <polygon id="Fill-80" fill="#419CF8" mask="url(#mask-4)" points="23.089 126.582 25.08 126.582 25.08 124.582 23.089 124.582"></polygon> <polygon id="Fill-81" fill="#419CF8" mask="url(#mask-4)" points="31.054 126.582 33.045 126.582 33.045 124.582 31.054 124.582"></polygon> <path d="M15.2969,122.7588 L15.2969,121.2118 L13.2969,121.2118 L13.2969,122.7588 C13.2969,122.9638 13.3139,123.1638 13.3449,123.3618 L15.3189,123.0408 C15.3039,122.9488 15.2969,122.8548 15.2969,122.7588" id="Fill-82" fill="#419CF8" mask="url(#mask-4)"></path> <polygon id="Fill-83" fill="#419CF8" mask="url(#mask-4)" points="13.297 7.715 15.297 7.715 15.297 5.724 13.297 5.724"></polygon> <path d="M14.6377,125.6592 C15.3257,126.2502 16.2037,126.5782 17.1097,126.5832 L17.1207,124.5832 C16.6887,124.5812 16.2687,124.4242 15.9387,124.1412 L14.6377,125.6592 Z" id="Fill-84" fill="#419CF8" mask="url(#mask-4)"></path> <polygon id="Fill-85" fill="#419CF8" mask="url(#mask-4)" points="62.912 126.582 64.903 126.582 64.903 124.582 62.912 124.582"></polygon> <polygon id="Fill-86" fill="#419CF8" mask="url(#mask-4)" points="13.297 15.68 15.297 15.68 15.297 13.689 13.297 13.689"></polygon> <polygon id="Fill-87" fill="#419CF8" mask="url(#mask-4)" points="13.297 19.662 15.297 19.662 15.297 17.671 13.297 17.671"></polygon> <polygon id="Fill-88" fill="#419CF8" mask="url(#mask-4)" points="13.297 11.697 15.297 11.697 15.297 9.706 13.297 9.706"></polygon> <polygon id="Fill-89" fill="#419CF8" mask="url(#mask-4)" points="50.965 126.582 52.956 126.582 52.956 124.582 50.965 124.582"></polygon> <polygon id="Fill-90" fill="#419CF8" mask="url(#mask-4)" points="54.947 126.582 56.938 126.582 56.938 124.582 54.947 124.582"></polygon> <polygon id="Fill-91" fill="#419CF8" mask="url(#mask-4)" points="58.93 126.582 60.921 126.582 60.921 124.582 58.93 124.582"></polygon> <polygon id="Fill-92" fill="#419CF8" mask="url(#mask-4)" points="46.982 126.582 48.973 126.582 48.973 124.582 46.982 124.582"></polygon> <polygon id="Fill-93" fill="#419CF8" mask="url(#mask-4)" points="35.036 126.582 37.027 126.582 37.027 124.582 35.036 124.582"></polygon> <polygon id="Fill-94" fill="#419CF8" mask="url(#mask-4)" points="39.019 126.582 41.01 126.582 41.01 124.582 39.019 124.582"></polygon> <polygon id="Fill-95" fill="#419CF8" mask="url(#mask-4)" points="43 126.582 44.991 126.582 44.991 124.582 43 124.582"></polygon> </g> </g></svg>';
        var content = $('<div class="empty-page-title"><p class="intro-title">start with Massive Builder</p><p class="intro-subtitle">Create a new page</p></div>'),
            btn = $('<div class="buttons-container"><div id="p-btn-addshortcode" class="elements">'+element_svg+'<span >Add Elements</span></div>' +
                '<div id="p-btn-addsections" class="sections">'+sections_svg+'<span >Pre-made Sections</span></div>' +
                '<div id="p-btn-importdemo" class="import">'+import_svg+'<span >Import Template</span></div></div>');

        btn.find('.elements').click(function (e) {
            e.stopPropagation();
            $(this).closest('.insert-after-row-placeholder').removeClass('section-open');
            $('.pixflow-add-element-button').click();
        });
        btn.find('.sections').click(function (e) {
            e.stopPropagation();
            $(this).closest('.insert-after-row-placeholder').addClass('section-open');
            builder.open_pixflow_shortcode_panel('sections')
        });
        btn.find('.import').click(function (e) {
            e.stopPropagation();
            $(this).closest('.insert-after-row-placeholder').removeClass('section-open');
            window.location.href = $('.pixflow-builder-toolbar .site-setting').attr('href');
        });

        $('.insert-after-row-placeholder').first().addClass('blank-page');
        $('.insert-after-row-placeholder').html(content);
        content.append(btn);
    } else {
        $('.insert-after-row-placeholder').first().removeClass('blank-page').off('click');
    }

    pixflow_footerPosition();
};


/**
 * @summary remove from models object.
 *
 * @param {integer} id
 * @since 1.0.0
 */

mBuilder.prototype.deleteModel = function (id) {
    var t = this;
    for (var index in t.models.models) {
        var $el = $('div[data-mBuilder-id=' + index + ']'),
            $parent = $el.parent().closest('.mBuilder-element');
        if ($parent.length) {
            var parentId = $parent.attr('data-mBuilder-id');
            t.models.models[index].parentId = parentId;
        }
    }
    delete t.models.models[id];
    for(var element_num in t.models.models ) {
        var elements = t.models.models[element_num] ;
        if (elements['parentId'] == id) {
            t.deleteModel(element_num);
        }
    }
    $('body').addClass('changed');

};


/**
 * @summary apply row layout changes.
 *
 * @param {string} exp - layout expression example: (3/12)+(3/12)+(3/12)+(3/12)
 * @param {object} row - jQuery Object
 * @since 1.0.0
 */

mBuilder.prototype.changeRowLayout = function (exp, row) {
    var t = this;
    if(t.lock) {
        return;
    }
    if (exp.match(/([0-9]+)\/12/g)) {
        var columns = exp.match(/([0-9]+)\/12/g);
        var sum = 0;
        for (i in columns) {
            var size = parseInt(columns[i].replace('/12', ''));
            sum += size;
        }
        if (sum > 12) {
            alert('Sum of all columns is greater than 12 columns.');
            return;
        } else if (sum < 12) {
            alert('Sum of all columns is less than 12 columns.');
            return;
        }
        var i = 0;
        row.find('[data-mbuilder-el="vc_column"],[data-mbuilder-el="vc_column_inner"]').first()
            .siblings('[data-mbuilder-el="vc_column"],[data-mbuilder-el="vc_column_inner"]').addBack().each(function () {
            if (columns[i]) {
                var size = columns[i].replace('/12', '');
                $(this).find('> .vc_column_container').removeClass(function (index, css) {
                    return (css.match(/(^|\s)col-sm-[0-9]+/g) || []).join(' ');
                }).addClass('col-sm-' + size);
                $(this).removeClass(function (index, css) {
                    return (css.match(/(^|\s)col-sm-[0-9]+/g) || []).join(' ');
                }).addClass('col-sm-' + size);

                if(t.models.models[$(this).attr('data-mbuilder-id')].attr == undefined){
                    t.models.models[$(this).attr('data-mbuilder-id')].attr = '';
                }
                if (t.models.models[$(this).attr('data-mbuilder-id')].attr && t.models.models[$(this).attr('data-mbuilder-id')].attr != '' && builder.models.models[$(this).attr('data-mbuilder-id')].attr.match(/^(width=)|.*? width=/g)) {
                    t.models.models[$(this).attr('data-mbuilder-id')].attr = t.models.models[$(this).attr('data-mbuilder-id')].attr.replace(/[^-_]?width=["'].*?["']/g, ' width="' + columns[i] + '"');
                } else {
                    t.models.models[$(this).attr('data-mbuilder-id')].attr += ' width="' + columns[i] + '"';
                }
                i++;
            } else {
                var el_id = $(this).attr('data-mbuilder-id'),
                    $el = $('div[data-mBuilder-id=' + el_id + ']'),
                    $lastCol = row.find('> .wrap > .mBuilder-vc_column, > .wrap > .mBuilder-vc_column_inner').eq(columns.length - 1).find('.vc_column-inner > .wpb_wrapper');
                $el.find('.vc_column-inner > .wpb_wrapper > .mBuilder-element').each(function () {
                    var $obj = $(this).appendTo($lastCol);
                    $obj.after('<div class="insert-between-placeholder" data-index=""></div>');
                });
                t.deleteModel(el_id);
                $(this).remove();
            }
        });

        this.create_column( columns, i, row );

    } else {
        alert('You entered wrong pattern, try premade patterns instead.');
    }
};


mBuilder.prototype.create_column = function( columns, count, $row ){

    var that = this;
    if ( count >= columns.length ) {
        $('body').off('duplicate_shortcode.row_layout');
        that.vc_column_resize( $row );
        return true;
    }

    $('body').off('duplicate_shortcode.row_layout').on('duplicate_shortcode.row_layout',function( e, new_column ){

        that.setModelattr( $( new_column ).attr( 'data-mbuilder-id' ), 'width', columns[ count ] );

        var size = columns[ count ].replace('/12', '');
        $( new_column ).find('> .vc_column_container').removeClass(function (index, css) {
            return (css.match(/(^|\s)col-sm-[0-9]+/g) || []).join(' ');
        }).addClass('col-sm-' + size);
        $( new_column ).removeClass(function (index, css) {
            return (css.match(/(^|\s)col-sm-[0-9]+/g) || []).join(' ');
        }).addClass('col-sm-' + size);

        $( new_column ).find(' > .wpb_column ').addClass( 'vc_empty-element' );

        that.create_column( columns, count+1, $row );

    });
    if ($row.hasClass('vc_inner')) {
        that.duplicate( $row.find('.mBuilder-vc_column_inner:last') );
    } else {
        that.duplicate( $row.find('.mBuilder-vc_column:last') );
    }

}

/**
 * @summary open shortcode setting panel.
 *
 * @param {string} title
 * @param {string} customClass
 * @param {string} text
 * @param {string} btn1
 * @param {function} callback1 - optional
 * @param {string} btn2 - optional
 * @param {function} callback2 - optional
 * @param {function} closeCallback - optional
 * @since 1.0.0
 */
mBuilder.prototype.mBuilder_shortcodeSetting = function (title, customClass, text, btn1, callback1, btn2, callback2, closeCallback) {
    "use strict";
    var t = this;
    var update_shortcode_html = '<div class="update-shortcode-progress" ></div><div class="update-shortcode-progress-second" ></div>';
    customClass += " md-dark-background-panel";
    if ($('.setting-panel-wrapper').length) {
        $('.setting-panel-wrapper .setting-panel-title').html(title);
        $('.setting-panel-wrapper .setting-panel-text').html(text);
        $('.setting-panel-wrapper .setting-panel-container').attr('class', '').addClass('setting-panel-container ' + customClass);
        $('.setting-panel-wrapper .setting-panel-btn1').html('<span class="setting-panel-btn1-text">'+btn1+'</span>' + update_shortcode_html);
        var $messageBox = $('.setting-panel-wrapper'),
            $btn1;
    } else {
        var model_id = t.active_setting_panel_model_id,
            model_type = t.models.models[model_id].type;
        var $messageBox = $('' +
                '<div data-model-id="'+model_id+'" data-model-type="'+model_type+'" class="setting-panel-wrapper">' +
                '   <div class="setting-panel-container ' + customClass + '">' +
                '       <div class="setting-panel-close panel-accent-background-color active-text-color"><span class="mdb-plus"></span></div>' +
                '       <div class="active-text-color setting-panel-title  setting-panel-header-color">' + title + '</div>' +
                '       <div class="setting-panel-text">' + text + '</div>' +
                '       <button class="setting-panel-btn1"><span class="setting-panel-btn1-text">' + btn1 + '</span> </button>' +
                '   </div>' +
                '</div>').appendTo('body'),
            $btn1;
    }
    $messageBox.animate({opacity: 1}, 200);
    $messageBox.find('.setting-panel-container').draggable({
        handle: ".setting-panel-title" ,
        cursor: "move" ,
        stop: function(){
           t.should_close_shortcode_setting_panel = false;
        }
    });
    this.settingPanel = $messageBox;
    $btn1 = $messageBox.find('.setting-panel-btn1');
    $btn1.off('click');
    $btn1.click(function (e) {
        e.preventDefault();
        if (typeof callback1 == 'function') {
            tinymce.triggerSave();
            $('#md_text_title1_text').keyup();
            callback1();
        }
    });

    var $close = $messageBox.find('.setting-panel-close');
    $close.off('click');
    $close.on('click' , function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (typeof closeCallback == 'function') {
            closeCallback();
        }
        t.mBuilder_closeShortcodeSetting();

    });
    
};


/**
 * @summary close shortcode setting panel.
 *
 * @since 1.0.0
 */

mBuilder.prototype.mBuilder_closeShortcodeSetting = function () {
    "use strict";
    $('.sp-container').remove();
    $('.setting-panel-wrapper').fadeOut(300, function () {
        $(this).remove();
    })
    prev_panel_id ='';
};


/**
 * @summary get Model
 *
 * @param {integer} id - model ID
 *
 * @return {object} - model
 * @since 1.0.0
 */

mBuilder.prototype.getModelParams = function (id) {
    return this.models.models[id];
};


/**
 * @summary Add Shortcode Panel to the customizer side
 *
 * @since 1.0.0
 */

var clear_shortcodes_panel_animation_open;
var clear_shortcodes_panel_animation_close;
mBuilder.prototype.shortcode_panel_functionality = function () {
    var t = this;

    t.add_nicescroll();
    t.search_shortcode();

    $('.pixflow-shortcodes-panel .pixflow-add-element-button').click(function (e) {
        e.stopPropagation();
        clearTimeout(clear_shortcodes_panel_animation_open);
        clearTimeout(clear_shortcodes_panel_animation_close);
        if( $('.active-preview').length ){
            $('.builder-preview').click();
        }
        $(this).toggleClass('close-element-button');
        t.shortcode_panel_animation();

    });

    t.shortcode_panel_tabs();

};

function check_over_empty_page(el){
	obj = $(el).closest('.blank-page');
	if (obj.length) {
		lastObj = obj;
		var objTop = obj.offset().top + 100,
			objLeft = obj.offset().left + 100,
			objHeight = obj.outerHeight() - 200,
			objWidth = obj.outerWidth() - 200;
		d.css({
			'top': objTop,
			'left': objLeft,
			height: objHeight,
			width: objWidth,
			background: 'transparent',
		});
		if( ! $('.drop-here-container').length ){
			$('.empty-page-title').append('<div class="drop-here-container"> <div class="drop-here"> <div class="drop-here-circle"><div class="drop-here-plus"></div></div> <span>Drop It Here</span></div> </div>');
		}
		return true;
	}
	return false;
}

function check_over_rows( obj, d ){

	if (obj.hasClass('mBuilder-vc_column') || obj.hasClass('mBuilder-vc_column_inner')) {
		if (obj.find('> .vc_empty-element').length) {
			obj = obj.find('> .vc_empty-element');
			overEmpty = true;
		} else {
			if (!obj.hasClass('mBuilder-vc_column_inner')) {
				d.css({border: '', borderTop: '4px solid #43dc9d'});
				obj = obj.closest('.vc_row');
			} else {
				d.css({border: '', borderTop: '4px solid #8fcbff'});
				obj = obj.closest('.vc_inner');
			}
		}
		return [true,obj];
	} else if (obj.hasClass('vc_row')) {
		if (!obj.hasClass('vc_inner')) {
			d.css({border: '', borderTop: '4px solid #43dc9d'});
		} else {
			d.css({border: '', borderTop: '4px solid #8fcbff'});
			obj = obj.closest('.vc_inner');
		}
		return [true,obj];
	}
	return [false,obj];

}

function check_over_shortcode( obj, t, d ){
	if (obj.length
		&& !obj.hasClass('vc_row') && !obj.hasClass('mBuilder-vc_column')
		&& !obj.hasClass('mBuilder-vc_column_inner')) {
		if (t.containers[obj.attr('data-mbuilder-el')]) {
			if (!obj.find('.mBuilder-element').length) {
				overEmpty = true;
			} else {
				d.css({border: '', borderTop: '4px solid #8fcbff'});
			}
		} else {
			d.css({border: '', borderTop: '4px solid #8fcbff'});
		}
		return true;
	}
	return false;
}

function check_over_page(obj){
	if (obj.hasClass('content-container') && $('.vc_row').length) {
		lastObj = obj;
		d.css({
			border: '',
			height: '0px',
			left: $('.vc_row').last().offset().left + 'px',
			borderTop: '4px solid #43dc9d',
			top: $('.vc_row').last().offset().top + $('.vc_row').last().outerHeight() + 'px',
			width: obj.width()
		});
		return true;
	}
	return false;
}

function is_over_shortcode_panel( el, d ){
	if($(el).closest('.pixflow-shortcodes-panel').length){
		overEmpty = true;
		lastObj = null;
		d.css({width: '', border: ''});
		return true;
	}
}

function close_shortcode_panel_on_drag(){
	if(!$('.pixflow-shortcodes-panel').hasClass('close')){
		$('.pixflow-shortcodes-panel').addClass('close');
	}
}

function get_hovered_element(helper,x,y){
	helper.css('display','none');
	var el = document.elementFromPoint(x, y);
	helper.css('display','');
	return el;
}

///////////////////////////////////
var fly = null;
function shortcode_panel_drag_fly(event){
	clearInterval(fly);
	if (event.clientY < 100) {
		fly = setInterval(function () {
			if($(window).scrollTop()==0){
				clearInterval(fly);
			}
			$(window).scrollTop($(window).scrollTop() - 50)
		}, 50);
	} else if (event.clientY > $(window).height() - 50) {
		fly = setInterval(function () {
			if($(window).scrollTop()>=$(document).height()-$(window).height()){
				clearInterval(fly);
			}
			$(window).scrollTop($(window).scrollTop() + 50)
		}, 50);
	}
}

mBuilder.prototype.applyDragForce = function ( selector ) {
	var t = this,
		section = null,
		placeholder = null,
		sectionType = false ,
		lastObj = null,
		d = $('.mBuilder-drag-overlay');

	$( selector ).draggable({
		appendTo: "body",
		helper: "clone",
		zIndex: 9999999,
		containment: 'document',
		cursorAt: {top: 20, left: 50},
		start: function (event, ui) {

			clearInterval(fly);
			section = $(this).data('section-id');
			if( $(this).hasClass('pixflow-custom-section') ){
				sectionType = true;
			}else{
				sectionType = false;
			}
			$(this).css('visibility', 'hidden');
			if($('.insert-after-row-placeholder.blank-page').length){
				$('#p-btn-addsections').click();
			}

		},
		drag: function (event, ui) {
			shortcode_panel_drag_fly(event);
			var el = get_hovered_element(ui.helper,event.clientX, event.clientY);
			if (el) {
				if (el == d.get(0)) return true;

				if(is_over_shortcode_panel( el, d )){
					return true;
				}

				close_shortcode_panel_on_drag();
				var selector = $('.section-open').length ? '.section-open' : '.vc_row:not(.vc_inner)';
				var obj = $( el ).closest( selector );

				if( !obj.length ){
					if( lastObj != null ){
						lastObj.removeClass('section-placeholder');
					}
					lastObj = null;
					d.css( {width: '', border: ''} );

					return true;
				}
				if( obj.hasClass( 'vc_row' ) ){
					var objTop = obj.offset().top,
						objLeft = obj.offset().left,
						objHeight = obj.outerHeight(),
						objWidth = obj.outerWidth(),
						objHalf = objTop + objHeight / 2;

					if (event.clientY + $(window).scrollTop() < objHalf) {
						d.css({
							'top': objTop,
							'left': objLeft,
							width: objWidth,
							height: 5,
							background: '#6226eb',
						});
						lastObj = obj.prev('.insert-after-row-placeholder');
					} else {
						d.css({
							'top': objTop + objHeight,
							'left': objLeft,
							width: objWidth,
							height: 5,
							background: '#6226eb',
						});
						lastObj = obj.next('.insert-after-row-placeholder');
					}
				}else {
					if( ! $('.drop-here-container').length ){
						$('.empty-page-title').append('<div class="drop-here-container"> <div class="drop-here"> <div class="drop-here-circle"><div class="drop-here-plus"></div></div> <span>Drop It Here</span></div> </div>');
					}
					obj.addClass('section-placeholder');
					lastObj = obj;
				}
			} else {
				if(lastObj != null){
					lastObj.removeClass('section-placeholder');
				}
				lastObj = null;
			}
		},
		stop: function (event, ui){
			$('.drop-here-container').remove();
			clearInterval( fly );
			d.css({'width': '', border: ''});
			$('.insert-after-row-placeholder.blank-page').removeClass('section-open');
			try {
				$('.pixflow-shortcodes-panel').getNiceScroll().resize();
			} catch (e) {}
			$(this).css('visibility', 'visible');
			if (!lastObj || !lastObj.length) {
				return;
			}
			lastObj.removeClass('section-placeholder');
			placeholder = lastObj.get(0);

			if (placeholder != null) {
				if (lastObj.hasClass('insert-after-row-placeholder')) {
					$(placeholder).addClass('dropped');
					t.section_builder(section ,placeholder, sectionType );
				}
			}
		}
	});
}

mBuilder.prototype.shortcode_panel_drop_shortcodes = function(){

    var t = this,
        shortcode = null,
        section = null,
        placeholder = null,
        lastObj = null,
        d = $('<div class="mBuilder-drag-overlay"></div>').appendTo('body'),
        direction = 'down',
        overEmpty = false;

    $('.pixflow-shortcodes-panel .shortcodes').draggable({
        appendTo: "body",
        helper: "clone",
        containment: 'document',
        zIndex: 9999999,
        cursorAt: {top: 20, left: 50},
        start: function (event, ui) {

            t.shortcode_panel_animation();
            clearInterval(fly);
            shortcode = $(this).attr('id');
            $(this).css('visibility', 'hidden');

        },
        drag: function (event, ui) {

            shortcode_panel_drag_fly(event);

            var el = get_hovered_element(ui.helper,event.clientX, event.clientY);
            
            if (el) {
                if (el == d.get(0)) return true;

                if(is_over_shortcode_panel( el, d )){
                    return true;
                }
                close_shortcode_panel_on_drag();

                overEmpty = false;

                var obj = $(el).closest('.mBuilder-element,.vc_inner ,.content-container,.section-open');
                if (obj.hasClass('content-container') && $('.content-container').find('.blank-page').length) {
                    obj = $(el).closest('.mBuilder-element,.vc_inner');
                }
                if(check_over_page(obj)){
                    return true;
                }
                
                if(!check_over_shortcode( obj , t, d )){
                    var is_over_row = check_over_rows( obj, d );
                    if(is_over_row[0]){
                        obj = is_over_row[1];
                    }else{
                        if(!check_over_empty_page(el)){
                            if (lastObj) {
                                lastObj.css({'transform': ''})
                            }
                            lastObj = null;
                            d.css({width: '', border: ''});
                            return true;
                        }
                    }
                }
                if(!obj.length){
                    return true;

                }
                var objTop = obj.offset().top,
                    objLeft = obj.offset().left,
                    objHeight = obj.outerHeight(),
                    objWidth = obj.outerWidth(),
                    objHalf = objTop + objHeight / 2;
                if (lastObj) {
                    lastObj.css({'transform': ''})
                }
                if (!overEmpty) {
                    if (event.clientY + $(window).scrollTop() < objHalf) {
                        obj.not('.vc_row').css({'transform': 'translateY(5px)'});
                        d.css({'top': objTop, 'left': objLeft, width: objWidth, height: 5, background: ''});
                        direction = 'up';
                    } else {
                        obj.not('.vc_row').css({'transform': 'translateY(-5px)'});
                        d.css({
                            'top': objTop + objHeight,
                            'left': objLeft,
                            width: objWidth,
                            height: 5,
                            background: ''
                        });
                        direction = 'down';
                    }
                } else {
                    d.css({
                        'top': objTop,
                        'left': objLeft,
                        height: objHeight,
                        width: objWidth,
                        background: 'rgba(136,206,255,0.4)',
                        border: 'solid 2px #8fcbff'
                    });
                }
                lastObj = obj;
            } else {
                if (lastObj) {
                    lastObj.css({'transform': ''})
                }
                lastObj = null;
                d.css({width: '', border: ''});
            }
        },
        stop: function (event, ui){
            $('.drop-here-container').remove();
            t.clear_shortcodes_panel_input();
            t.removeColumnSeparator();
            clearInterval(fly);
            t.shortcode_panel_animation();
            try {
                $('.pixflow-shortcodes-panel').getNiceScroll().resize();
            } catch (e) {}
            $(this).css('visibility', 'visible');
            if (!lastObj || !lastObj.length) {
                return;
            }
            lastObj.css({'transform': ''})
            if(lastObj.hasClass('section-open')){
                direction = 'up';
            }
            if (direction == 'up') {
                if (lastObj.hasClass('vc_row') && !lastObj.hasClass('vc_inner')) {
                    if (lastObj.prev('.insert-after-row-placeholder').length) {
                        var p = lastObj.prev('.insert-after-row-placeholder');
                    } else {
                        var p = lastObj.prev().prev('.insert-after-row-placeholder');
                    }
                } else if (lastObj.hasClass('blank-page')) {
                    var p = lastObj;
                } else if (lastObj.hasClass('vc_empty-element')) {
                    var p = lastObj.closest('.vc_column_container');
                } else if (t.containers[lastObj.attr('data-mbuilder-el')] && overEmpty) {
                    var p = lastObj.find(t.containers[lastObj.attr('data-mbuilder-el')]);
                } else if (lastObj.hasClass('section-open')) {
                    var p = lastObj;
                }else {
                    var p = lastObj.prev('.insert-between-placeholder');
                    if (!p.length) {
                        var p = lastObj.parent().closest('.mBuilder-element').prev('.insert-between-placeholder');
                    }
                }
            } else {

                if (lastObj.hasClass('vc_row') && !lastObj.hasClass('vc_inner')) {
                    var p = lastObj.next('.insert-after-row-placeholder');
                } else if (lastObj.hasClass('blank-page')) {

                    var p = lastObj;
                } else if (lastObj.hasClass('vc_empty-element')) {
                    var p = lastObj.closest('.vc_column_container');
                } else if (t.containers[lastObj.attr('data-mbuilder-el')] && overEmpty) {
                    var p = lastObj.find(t.containers[lastObj.attr('data-mbuilder-el')]);
                } else {
                    var p = lastObj.next('.insert-between-placeholder');
                    if (!p.length) {
                        var p = lastObj.parent().closest('.mBuilder-element').next('.insert-between-placeholder');
                    }
                }
            }

            placeholder = p.get(0);
            d.css({'width': '', border: ''});
            if (lastObj.hasClass('content-container')) {
                placeholder = $('.insert-after-row-placeholder').last();
                t.buildShortcode(placeholder, 'vc_row', {}, function (response) {
                    if($('body').hasClass('one_page_scroll')){
                        pixflow_one_page_for_customizer();
                    }
                    if (shortcode == 'vc_row') {
                        return;
                    }
                    t.buildShortcode(response.find('.vc_column_container'), shortcode);
                });
            } else {
                if (placeholder != null) {
                    if (p.hasClass('insert-after-row-placeholder')) {
                        var attr = {};
                        if ( p.hasClass('blank-page') ){
                            attr.row_padding_top = t.top_page_space() + 50;
                        }
                        t.buildShortcode(placeholder, 'vc_row', attr, function (response) {
                            if($('body').hasClass('one_page_scroll')){
                                pixflow_one_page_for_customizer();
                            }
                            if (shortcode == 'vc_row') {
                                return;
                            }
                            t.buildShortcode(response.find('.vc_column_container'), shortcode);
                        });
                    } else {
                        if (shortcode == 'vc_row') {
                            shortcode = 'vc_row_inner';
                        }
                        t.buildShortcode(placeholder, shortcode);
                    }
                }
            }
        }
    });


	$('.pixflow-shortcodes-panel .section-container, .pixflow-shortcodes-panel .pixflow-custom-section').draggable({

		appendTo: "body",
		helper: "clone",
		zIndex: 9999999,
		containment: 'document',
		cursorAt: {top: 20, left: 50},
		start: function (event, ui) {

			clearInterval(fly);
			section = $(this).data('section-id');
			if( $(this).hasClass('pixflow-custom-section') ){
				sectionType = true;
			}else{
				sectionType = false;
			}
			$(this).css('visibility', 'hidden');
			if($('.insert-after-row-placeholder.blank-page').length){
				$('#p-btn-addsections').click();
			}

		},
		drag: function (event, ui) {
			shortcode_panel_drag_fly(event);
			var el = get_hovered_element(ui.helper,event.clientX, event.clientY);
			if (el) {
				if (el == d.get(0)) return true;

				if(is_over_shortcode_panel(el)){
					return true;
				}

				close_shortcode_panel_on_drag();
				var selector = $('.section-open').length ? '.section-open' : '.vc_row:not(.vc_inner)';
				var obj = $( el ).closest( selector );

				if( !obj.length ){
					if( lastObj != null ){
						lastObj.removeClass('section-placeholder');
					}
					lastObj = null;
					d.css( {width: '', border: ''} );

					return true;
				}
				if( obj.hasClass( 'vc_row' ) ){
					var objTop = obj.offset().top,
						objLeft = obj.offset().left,
						objHeight = obj.outerHeight(),
						objWidth = obj.outerWidth(),
						objHalf = objTop + objHeight / 2;

					if (event.clientY + $(window).scrollTop() < objHalf) {
						d.css({
							'top': objTop,
							'left': objLeft,
							width: objWidth,
							height: 5,
							background: '#6226eb',
						});
						lastObj = obj.prev('.insert-after-row-placeholder');
					} else {
						d.css({
							'top': objTop + objHeight,
							'left': objLeft,
							width: objWidth,
							height: 5,
							background: '#6226eb',
						});
						lastObj = obj.next('.insert-after-row-placeholder');
					}
				}else {
					if( ! $('.drop-here-container').length ){
						$('.empty-page-title').append('<div class="drop-here-container"> <div class="drop-here"> <div class="drop-here-circle"><div class="drop-here-plus"></div></div> <span>Drop It Here</span></div> </div>');
					}
					obj.addClass('section-placeholder');
					lastObj = obj;
				}
			} else {
				if(lastObj != null){
					lastObj.removeClass('section-placeholder');
				}
				lastObj = null;
			}
		},
		stop: function (event, ui){
			$('.drop-here-container').remove();
			clearInterval( fly );
			d.css({'width': '', border: ''});
			$('.insert-after-row-placeholder.blank-page').removeClass('section-open');
			try {
				$('.pixflow-shortcodes-panel').getNiceScroll().resize();
			} catch (e) {}
			$(this).css('visibility', 'visible');
			if (!lastObj || !lastObj.length) {
				return;
			}
			lastObj.removeClass('section-placeholder');
			placeholder = lastObj.get(0);

			if (placeholder != null) {
				if (lastObj.hasClass('insert-after-row-placeholder')) {
					$(placeholder).addClass('dropped');
					t.section_builder( section ,placeholder, sectionType );
				}
			}
		}
	});

	function check_over_empty_page(el){
		obj = $(el).closest('.blank-page');
		if (obj.length) {
			lastObj = obj;
			var objTop = obj.offset().top + 100,
				objLeft = obj.offset().left + 100,
				objHeight = obj.outerHeight() - 200,
				objWidth = obj.outerWidth() - 200;
			d.css({
				'top': objTop,
				'left': objLeft,
				height: objHeight,
				width: objWidth,
				background: 'transparent',
			});
			if( ! $('.drop-here-container').length ){
				$('.empty-page-title').append('<div class="drop-here-container"> <div class="drop-here"> <div class="drop-here-circle"><div class="drop-here-plus"></div></div> <span>Drop It Here</span></div> </div>');
			}
			return true;
		}
		return false;
	}

	function check_over_rows(obj){

		if (obj.hasClass('mBuilder-vc_column') || obj.hasClass('mBuilder-vc_column_inner')) {
			if (obj.find('> .vc_empty-element').length) {
				obj = obj.find('> .vc_empty-element');
				overEmpty = true;
			} else {
				if (!obj.hasClass('mBuilder-vc_column_inner')) {
					d.css({border: '', borderTop: '4px solid #43dc9d'});
					obj = obj.closest('.vc_row');
				} else {
					d.css({border: '', borderTop: '4px solid #8fcbff'});
					obj = obj.closest('.vc_inner');
				}
			}
			return [true,obj];
		} else if (obj.hasClass('vc_row')) {
			if (!obj.hasClass('vc_inner')) {
				d.css({border: '', borderTop: '4px solid #43dc9d'});
			} else {
				d.css({border: '', borderTop: '4px solid #8fcbff'});
				obj = obj.closest('.vc_inner');
			}
			return [true,obj];
		}
		return [false,obj];

	}

	function check_over_shortcode(obj){
		if (obj.length
			&& !obj.hasClass('vc_row') && !obj.hasClass('mBuilder-vc_column')
			&& !obj.hasClass('mBuilder-vc_column_inner')) {
			if (t.containers[obj.attr('data-mbuilder-el')]) {
				if (!obj.find('.mBuilder-element').length) {
					overEmpty = true;
				} else {
					d.css({border: '', borderTop: '4px solid #8fcbff'});
				}
			} else {
				d.css({border: '', borderTop: '4px solid #8fcbff'});
			}
			return true;
		}
		return false;
	}

	function check_over_page(obj){
		if (obj.hasClass('content-container') && $('.vc_row').length) {
			lastObj = obj;
			d.css({
				border: '',
				height: '0px',
				left: $('.vc_row').last().offset().left + 'px',
				borderTop: '4px solid #43dc9d',
				top: $('.vc_row').last().offset().top + $('.vc_row').last().outerHeight() + 'px',
				width: obj.width()
			});
			return true;
		}
		return false;
	}

	function is_over_shortcode_panel(el){
		if($(el).closest('.pixflow-shortcodes-panel').length){
			overEmpty = true;
			lastObj = null;
			d.css({width: '', border: ''});
			return true;
		}
	}

	function close_shortcode_panel_on_drag(){
		if(!$('.pixflow-shortcodes-panel').hasClass('close')){
			$('.pixflow-shortcodes-panel').addClass('close');
		}
	}

	function get_hovered_element(helper,x,y){
		helper.css('display','none');
		var el = document.elementFromPoint(x, y);
		helper.css('display','');
		return el;
	}

	///////////////////////////////////
	var fly = null;
	function shortcode_panel_drag_fly(event){
		clearInterval(fly);
		if (event.clientY < 100) {
			fly = setInterval(function () {
				if($(window).scrollTop()==0){
					clearInterval(fly);
				}
				$(window).scrollTop($(window).scrollTop() - 50)
			}, 50);
		} else if (event.clientY > $(window).height() - 50) {
			fly = setInterval(function () {
				if($(window).scrollTop()>=$(document).height()-$(window).height()){
					clearInterval(fly);
				}
				$(window).scrollTop($(window).scrollTop() + 50)
			}, 50);
		}
	}
};


mBuilder.prototype.add_nicescroll = function(){
    $('.pixflow-shortcodes-container, .pixflow-sections-container').niceScroll({
        horizrailenabled: false,
        cursorcolor: "rgba(204, 204, 204, 0.2)",
        cursorborder: "1px solid rgba(204, 204, 204, 0.2)",
        cursorwidth: "2px",
        enablescrollonselection: false
    });
};

mBuilder.prototype.search_shortcode = function() {
    var typing_in_search_box_time,
        typing_interval_done = 500,
        $shortcodes_category = $('.pixflow-shortcodes-panel .category-container'),
        $shortcodes = $('.category-container .shortcodes'),
        first_search_value = "";
    $('.pixflow-search-shortcode').keyup(function (e) {

        var search_value = $(this).val().toLowerCase();

        if (first_search_value != search_value) {
            $shortcodes.removeClass('active');
            $shortcodes_category.removeClass('show');

            clearTimeout(typing_in_search_box_time);
            typing_in_search_box_time = setTimeout(function () {
                if (search_value != "") {
                    $('.category-container .shortcodes[data-name*="' + search_value + '"]').addClass('active');
                    $('.category-container .shortcodes[data-name*="' + search_value + '"]').parents('.category-container').addClass('show')
                } else {
                    $shortcodes.addClass('active');
                    $shortcodes_category.addClass('show');
                }
            }, typing_interval_done);
        }
        first_search_value = search_value;
    });

};

mBuilder.prototype.shortcode_panel_animation = function() {
    $('.pixflow-shortcodes-panel').toggleClass('close');
};


/**
 * @summary build shortcode in the placeholder that given.
 *
 * @param {object | string} placeholder - placeholder to drop shortcode.
 * @param {string} shortcode - shortcode type
 * @param {Object} atts - attributes of the shortcode
 * @param {function} callback - a callback function to call after build shortcode
 * @since 1.0.0
 */

mBuilder.prototype.buildShortcode = function (placeholder, shortcode, atts, callback) {
    if (placeholder && shortcode) {
        var t = this,
			dropSection = 'pre-made' ,
            atts = atts;
        var loaderHtml = $('<div class="showbox-shotcode">' +
            '<div class="loader-shotcode">' +
            '<svg class="circular-shotcode" viewBox="25 25 50 50">' +
            '<circle class="path-shotcode" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>' +
            '</svg>' +
            '</div></div>');
        if (placeholder.prevObject) {
            var shortcodeloader = $(placeholder.prevObject).find('.vc_column-inner');
            $(loaderHtml).prependTo($(shortcodeloader));
        }
        else if ($(placeholder).hasClass('insert-between-placeholder')) {
            $(placeholder).css({
                'display': 'block',
                'height': '60px'
            }).append(loaderHtml);
        }
        else {
            if(!$(placeholder).hasClass('section-open')){
                $(placeholder).css({
                    'bottom': '0',
                    'height': 'auto'
                });
            }
            $(loaderHtml).prependTo($(placeholder));
        }

		if( typeof atts != "undefined" && true == atts.customSection ){
			dropSection = 'custom';
		}

        $.ajax({
            type: 'post',
            url: mBuilderValues.ajax_url,
            data: {
                action: 'mBuilder_buildShortcode',
                nonce: mBuilderValues.ajax_nonce,
                shortcode: shortcode,
                act: 'build',
                attrs: JSON.stringify(atts),
                mbuilder_editor: true ,
				section_type : dropSection
            },
            success: function (response) {
                if ($(placeholder).hasClass('insert-between-placeholder')) {
                    $(placeholder).css({
                        'display': 'none',
                        'height': '0px'
                    });
                }
                $('.showbox-shotcode').remove();
                var attrs = '';
                $.each(atts, function (index, value) {
                    attrs = attrs + ' ' + index + '="' + value + '"';
                });
                attrs = attrs.trim();
                response = t.setSettings(response, shortcode, placeholder, attrs);
                var id = response['id'];
                response = $(response['shortcode']);
                if ($(placeholder).hasClass('vc_column_container') || $(placeholder).hasClass('vc_row') || $(placeholder).hasClass('vc_row_inner') || $(t.droppables).filter($(placeholder)).length) {
                    if ($(placeholder).hasClass('vc_row') || $(placeholder).hasClass('vc_row_inner')) {
                        $(placeholder).find('>.wrap').append(response);
                    } else if ($(placeholder).find('>.vc_column-inner>.wpb_wrapper').length) {
                        $(placeholder).find('>.vc_column-inner>.wpb_wrapper').append(response);
                    } else {
                        if (!$(placeholder).find('.mBuilder-element').length) {
                            $(placeholder).html('');
                        }
                        $(placeholder).append(response);
                    }

                    $(placeholder).removeClass('vc_empty-element');
                } else if ($(placeholder).hasClass('vc_btn-content')) {
                    if (t.tabs[$(placeholder).closest('.mBuilder-element').attr('data-mbuilder-el')]) {
                        var tab = $(t.tabs[$(placeholder).closest('.mBuilder-element').attr('data-mbuilder-el')][1]);
                        $(placeholder).closest('.mBuilder-element').find('ul').first().append(tab);
                        var unique = Math.floor(Math.random() * 1000000);
                        tab.find('a').attr('href', '#tab-' + unique);
                        response.find('.wpb_tab').first().attr('id', 'tab-' + unique);
                    }
                    if ($(placeholder).closest('.mBuilder-element').find('ul.px_tabs_nav').parent().length) {
                        $(placeholder).closest('.mBuilder-element').find('ul.px_tabs_nav').first().parent().append(response);
                    } else {
                        $(placeholder).closest('.mBuilder-element').find('.wpb_wrapper').first().append(response);
                    }
                    t.updateShortcode($(placeholder).closest('.mBuilder-element').attr('data-mbuilder-id'), $(placeholder).closest('.mBuilder-element').attr('data-mbuilder-el'), t.models.models[$(placeholder).closest('.mBuilder-element').attr('data-mbuilder-id')].attr, undefined, true);
                } else {
                    $(placeholder).before(response);
                }
                t.specialShortcodes(shortcode, id);
                t.renderControls();
                t.setSortable();
                $(window).resize();
                if (typeof callback == 'function') {
                    callback(response);
                }
                // Callback for sectio
                //n builder
                if (typeof atts != 'undefined' && typeof atts['section_id'] != 'undefined' && typeof callback == 'function') {
                    callback(id);
                }
                $('body').addClass('changed');
                $('body').trigger('finish_build_shortcode' , [ id, shortcode ] );
            }
        })
    }
};





/**
 * @summary create shortcode model and add it to the models object
 *
 * @param {string} response - HTML response after build shortcode
 * @param {string} type - shortcode type
 * @param {string | object} parent - parent selector or jQuery object
 * @param {string} atts - attributes of the shortcode
 * @param {string} content - content of the shortcode
 *
 * @return {object} - model ID and HTML of the shortcode
 * @since 1.0.0
 */

mBuilder.prototype.setSettings = function (response, type, parent, atts, content) {
    var rand,
        inModels = true,
        t = this;
    parent = $(parent);
    if (parent.hasClass && parent.hasClass('insert-between-placeholder')) {
        parent = parent.closest('.mBuilder-element').attr('data-mbuilder-id');
    } else {
        parent = parent.attr('data-mbuilder-id');
    }
    var istab = false;
    for (var i in t.tabs) {
        if (t.tabs[i][0] == type) {
            istab = true;
        }
    }
    if (istab) {
        var unique = Math.floor(Math.random() * 1000000);
        atts += ' tab_id=\'' + unique + '\'';
    }

    if (type == 'md_text' && !content) {
        content = $(response).find('.md-text-content').html();
    }
    while (inModels) {
        rand = parseInt(Math.random() * 10000);
        if (typeof this.models.models[rand] == 'undefined') {
            t.models.models[rand] = {
                attr: atts,
                content: content,
                parentId: parent,
                type: type
            };
            inModels = false;
        }
    }

    var o = $(response).clone();
    o.find('.mBuilder-element').each(function () {
        var r = t.setSettings($(this)[0].outerHTML, $(this).attr('data-mBuilder-el'), $(this).parent().closest('.mBuilder-element'));
        $(r['shortcode']).insertAfter($(this));
        $(this).remove();
    });
    var result = [];
    var m_builder_element = o.filter('div').first().attr('data-mbuilder-id', rand);

    o.each(function(){
        if($(this)[0] == m_builder_element[0]) return;
        $(this).removeAttr('data-mbuilder-id').prependTo(m_builder_element);
    });
    result['shortcode'] = m_builder_element[0].outerHTML;
    result['id'] = rand;

    o.remove();
    return result;
};


/**
 * @summary update shortcode model and rebuild it after edit
 *
 * @param {integer} id - ID of shortcode model
 * @param {string} shortcode - shortcode type
 * @param {string | object} attr - attributes of the shortcode
 * @param {string} content - content of the shortcode
 * @since 1.0.0
 */

mBuilder.prototype.updateShortcode = function (id, shortcode, attr, content, asParent ) {
    // Update elems object
    var t = this,
        attrs = oldClasses = '';
    if (typeof attr == 'object') {
        $.each(attr, function (index, value) {
            if (index == 'content') {
                return true;
            }
            value = value.replace(new RegExp('"', 'g'), "'");
            attrs = attrs + index + '=' + '"' + value + '" ';
        });
    } else {
        attrs = attr;
    }
    if (!content) {
        var content = '';
        if (shortcode == 'vc_row') {
            content = $('[data-mbuilder-id="' + id + '"]').find('> .wrap').html();
        } else if (t.shortcodes[shortcode] && t.shortcodes[shortcode].as_parent && !t.tabs[shortcode]) {
            content = $('[data-mbuilder-id="' + id + '"]').find('> .wpb_content_element > .wpb_wrapper').html();
        } else if (t.containers[shortcode]) {
            content = $('[data-mbuilder-id="' + id + '"]').find(t.containers[shortcode]).html();
        } else {
            content = attr['content'];
        }

        t.models.models[id]['content'] = attr['content'];
    } else {
        t.models.models[id]['content'] = content;
    }
    t.models.models[id]['attr'] = attrs;
    oldClasses = $('[data-mbuilder-id="' + id + '"]').attr('class');

    attrs = typeof attr == 'object' ? JSON.stringify(attr) : attr;
    // Build shortcode
    $.ajax({
        type: 'post',
        url: mBuilderValues.ajax_url,
        data: {
            action: 'mBuilder_buildShortcode',
            nonce: mBuilderValues.ajax_nonce,
            shortcode: shortcode,
            act: 'rebuild',
            id: id,
            content: content,
            attrs: attrs,
            mbuilder_editor: true
        },
        success: function (response) {
            var container = $('.mBuilder-element[data-mbuilder-id=' + id + ']');
            html = document.createElement('div');
            html.innerHTML = response ;
            for(var i = 0 ; i < html.children.length ; i ++){
                html.children[i].setAttribute('data-mbuilder-id', id);
            }
            var parent = container.parent().closest('.mBuilder-element');
            if (asParent || (
                    parent.length &&
                    t.shortcodes[parent.attr('data-mbuilder-el')] &&
                    t.shortcodes[parent.attr('data-mbuilder-el')].as_parent &&
                    t.shortcodes[parent.attr('data-mbuilder-el')].as_parent.only == container.attr('data-mbuilder-el')
                )
            ) {
                var parentId = parent.attr('data-mbuilder-id');
                var type = parent.attr('data-mbuilder-el');
                builder.update_meditor_models();
                $.ajax({
                    type: 'post',
                    url: mBuilderValues.ajax_url,
                    data: {
                        action: 'mBuilder_doShortcode',
                        nonce: mBuilderValues.ajax_nonce,
                        shortcode: t.shortcodeTag(parent, false),
                        mbuilder_editor: true
                    },
                    success: function (response) {
                        try {
                            parent.replaceWith(response);
                            var id = $(response).find('[data-mbuilder-el="' + shortcode + '"]').first().attr('data-mbuilder-id');
                            t.specialShortcodes( shortcode, id );
                            for (var i in t.shortcodes) {
                                if (t.shortcodes[i].as_parent && t.shortcodes[i].as_parent.only == shortcode) {
                                    t.specialShortcodes(i, $( '[data-mbuilder-id="' + id + '"]' ).closest( '[data-mbuilder-el="' + i + '"]' ).attr( 'data-mbuilder-id' ) );
                                }
                            }
                            t.renderControls();
                            t.setSortable();
                            $(window).resize();
                        } catch (e) {
                            console.log(e);
                        }
                        $('body').trigger('update_shortcode');
                    }
                })
            } else {
                try {
                    container.replaceWith(html.innerHTML);
                    html = '' ;
                    html = $(response);

                    t.specialShortcodes(shortcode, id);
                    t.renderControls();
                    $(window).resize();
                } catch (e) {
                    console.log(e);
                }
                $('body').trigger('update_shortcode');
            }
            var $mbuilderId = $('[data-mbuilder-id="' + id + '"]');
            if ($mbuilderId.data('mbuilder-el') == 'md_text') {
                $mbuilderId.attr('class', oldClasses);
            }
            if($mbuilderId.hasClass('vc_row') && $('body').hasClass('one_page_scroll')){
                pixflow_one_page_for_customizer();
            }
            t.setSortable();
            $('body').addClass('changed');
            $('body').trigger('finish_shortcode_progress');
        }
    })

};

mBuilder.prototype.shortcodeRegex = function ( tag ) {
	return new RegExp( '\\[(\\[?)(' + tag + ')(?![\\w-])([^\\]\\/]*(?:\\/(?!\\])[^\\]\\/]*)*?)(?:(\\/)\\]|\\](?:([^\\[]*(?:\\[(?!\\/\\2\\])[^\\[]*)*)(\\[\\/\\2\\]))?)(\\]?)', 'g' );
}

mBuilder.prototype.sectionExists = function ( sectionName ) {
	
	if( "undefined" == typeof this.customSection[ sectionName ] ){
		return true;
	}
	return false;
}

mBuilder.prototype.getCustomSection = function(){
    if( ! customSections.length ){
        return this.customSection;
    }
	this.customSection = JSON.parse( customSections );
	return true;
};

mBuilder.prototype.createSectionSource = function(){

    var userSections = '';
	if( Object.keys( this.customSection ).length == 0 ){
		return ;
	}
	for( var i in this.customSection ){
		userSections += '<div class="pixflow-custom-section" data-section-id="' + i + '"><span class="pixflow-section-name" >'
			+ i + '</span><div class="pixflow-delete-section" data-section-name="' + i + '">+</div></div>';
	}
	var html = '<div class="pixflow-custom-sections" ><div class="pixflow-custom-section-title" >Your Sections</div>'
            + userSections
            + '</div>';

    $('.pixflow-custom-sections').remove();
    $('.pixflow-sections-container').append(html);
	
};

mBuilder.prototype.addToSectionPanel = function( sectionName ) {

	var userSections = '';
	if( Object.keys( this.customSection ).length == 1 ){
		this.createSectionSource();
		return;
	}

    userSections += '<div class="pixflow-custom-section" data-section-id="' + sectionName + '" ><span class="pixflow-section-name" >'
                        + sectionName
                        + '</span><div class="pixflow-delete-section" data-section-name="' + sectionName + '">+</div>'
                    + '</div>';

    $('.pixflow-custom-sections').append( userSections );
};

/**
 * @summary Save section
 *
 * @param {object} selector - DOM element | jQuery element
 * @param {string} sectionName - Used for custom section name
 *
 * @return {string} - shortcodeTag
 * @since 5.1
 */
mBuilder.prototype.saveSection = function( selector, sectionName ){

	if( ! this.sectionExists( sectionName ) ){
        document.getElementsByClassName("popupSaveSection-error")[0].innerHTML = 'section is already exists please choose another name';
		return ;
	}
	// upadte meditor shortcodes models before create section
	this.update_meditor_models();
	var that = this,
		getShortocdeTag = that.shortcodeTag( selector ),
		regex = that.shortcodeRegex( 'vc_row' ),
		params = regex.exec( getShortocdeTag ),
		rowAttrs = wp.shortcode.attrs( params[3] ),
		sectionContent = params[5];

	rowAttrs.named['content'] = sectionContent;
	sectionName = sectionName.trim();

    document.getElementsByClassName("popupSaveSection-button")[0].innerHTML = 'SAVING';
	$.ajax({

		type: 'post',
		url: mBuilderValues.ajax_url,
		data: {
			action			: 'mBuilder_save_custom_section',
			section			: rowAttrs.named,
			section_name	: sectionName,
		},
		success: function ( response ) {

			if( response == 1 ){
				that.customSection[ sectionName ] = rowAttrs.named ;
                document.getElementsByClassName("popupSaveSection-button")[0].innerHTML = 'SAVED';
                setTimeout(function(){
                    that.closeSaveSectionPopup();
                },500);
                that.addToSectionPanel( sectionName );
                that.applyDragForce( '.pixflow-custom-section[data-section-id="' + sectionName + '"]');
				setTimeout(function () {
					$('.pixflow-add-element-button').click();
					var down = $('.pixflow-sections-container');
					down.scrollTop( down.prop("scrollHeight") );
					$('.panel-tab[data-tab="sections"]').click();

				}, 500 );

                return ;
			}
            document.getElementsByClassName("popupSaveSection-button")[0].innerHTML = 'CREATE';
            document.getElementsByClassName("popupSaveSection-error")[0].innerHTML = 'Oops! Something went wrong with Saving!';
		},
		error: function () {
            document.getElementsByClassName("popupSaveSection-button")[0].innerHTML = 'CREATE';
            document.getElementsByClassName("popupSaveSection-error")[0].innerHTML = 'Network error!';
		},

	});

}

/**
 * @summary Close Save section popup
 *
 * @return {void}
 * @since 5.1
 */
mBuilder.prototype.closeSaveSectionPopup = function( ){

    $('.popupSaveSection-container').fadeOut(500,function(){
		$(this).css({'opacity':'1'});
		document.getElementsByClassName("popupSaveSection-field")[0].value = '';
		document.getElementsByClassName("popupSaveSection-button")[0].innerHTML = 'CREATE';
	});
	document.getElementsByClassName("popupSaveSection-error")[0].innerHTML = '';

}

mBuilder.prototype.deleteSection = function( sectionName ){

	var that = this;

	if(  that.sectionExists( sectionName ) ){
		alert('section is not exists ');
		return ;
	}
	sectionName = sectionName.trim();
	$.ajax({

		type: 'post',
		url: mBuilderValues.ajax_url,
		data: {
			action			: 'mBuilder_delete_custom_section',
			section_name	: sectionName,
		},
		success: function ( response ) {

			if( response == 1 ){
				delete that.customSection[ sectionName ];
				$('body').trigger( 'delete_section', [ sectionName ] );
				return ;
			}
			
			alert('Error on delete section');

		},
		error: function () {

			alert('Network error');

		},

	});

}

/**
 * @summary generate shortcodeTag from DOM element
 *
 * @param {object} obj - DOM element | jQuery element
 * @param {bool} onlyChildren - if true it returns just children shortcodeTags
 * @param {int} depth - used in recursive calls
 *
 * @return {string} - shortcodeTag
 * @since 1.0.0
 */
mBuilder.prototype.shortcodeTag = function (obj, onlyChildren, depth) {
    var t = this,
        el = $(obj),
        id = el.attr('data-mbuilder-id');

    if (!el.length) {
        return '';
    }
    if (!depth) {
        depth = 0;
    }
    var model = t.models.models[id];
    model.attr = model.attr != undefined ? model.attr : '';
    model.content = model.content != undefined ? model.content : '';
    if (!onlyChildren) {
        var tag = '[' + model.type + ' ' + model.attr + ' mbuilder-id="' + id + '"]' + model.content;
    }
    depth++;

    el.find('.mBuilder-element').each(function () {
        for (var i in t.compiledTags) {
            if (t.compiledTags[i] == this) return;
        }
        tag += t.shortcodeTag(this, false, depth);
    });
    t.compiledTags.push(el.get(0));
    depth--;

    if (!onlyChildren) {
        tag += '[/' + model.type + ']';
    }
    if (depth == 0) {
        t.compiledTags = [];
    }
    return tag;
};

/**
 * @summary save contents and shortcodes to the database
 *
 * @since 1.0.0
 */

mBuilder.prototype.saveContent = function () {
    var t = this;
    $('body').addClass('content-saving');
    // Set Parents
    this.set_parents();
    // Calculate orders
    $('.mBuilder-element').each(function () {
        var $el = $(this),
            id = $el.attr('data-mBuilder-id');

        var order = 1;
        $el.siblings(".mBuilder-element").addBack().each(function () {
            t.models.models[$(this).attr('data-mbuilder-id')]['order'] = order++;
        });
    });
    // upadte meditor shortcodes models
    t.update_meditor_models();
    var models = {};
    for(i in t.models.models){
        if(t.models.models[i]!=null){
            models[i] = t.models.models[i];
        }
    }
    this.save_button_animation_start();
    $.ajax({
        type: 'post',
        url: mBuilderValues.ajax_url,
        data: {
            action: 'mBuilder_saveContent',
            nonce: mBuilderValues.ajax_nonce,
            models: JSON.stringify(models),
            id: $('meta[name="post-id"]').attr('content'),
            mbuilder_editor: true
        },
        success: function (response) {
            $('body').removeClass('content-saving changed');
            t.save_button_animation_end();
            if(typeof t.save_callback_function == 'function') {
                t.save_callback_function();
            }
        }
    });
};


/**
 * @summary Apply dependencies to the shortcode setting panel
 *
 * @since 1.0.0
 */
var dependChange = [] ;
mBuilder.prototype.dependencyInjection = function () {
    var tabs = this.settingPanel.find('#mBuilderTabs > ul li');
    this.settingPanel.find('[data-mBuilder-dependency]').each(function () {
        var json = JSON.parse($(this).attr('data-mBuilder-dependency'));
        var el = $(this);
        if(typeof json.element == 'undefined')
            return ;
        var depend = $('[name=' + json.element + ']');
        dependChange.push(depend);
        if (depend.attr('type') != 'hidden'  || depend.attr('data-type') == 'dropdown') {

            if (typeof json.value != 'object') {
                json.value = [json.value];
            }
            if ($.inArray($(depend).val(), json.value) != -1
                && !$(depend).closest('.vc_column').hasClass('dependency-hide')
            ) {
                el.removeClass('dependency-hide');
            } else {
                el.addClass('dependency-hide');
            }
            el.find('select,input').trigger('change');

            tabs.each(function () {
                var id = $(this).attr('aria-controls');
                var result = false;
                var element = document.getElementById(id);
                $(element).find('>.vc_column').each(function () {
                    if (!$(this).hasClass('dependency-hide')) {
                        result = true;
                        return false;
                    }
                });
                if (!result) {
                    $(this).addClass('dependency-hide');
                } else {
                    $(this).removeClass('dependency-hide');
                }
            });
            //

            depend.change(function () {
                if (typeof json.value != 'object') {
                    json.value = [json.value];
                }
                if ($.inArray($(this).val(), json.value) != -1
                    && ! $(this).closest('.vc_column').hasClass('dependency-hide')
                ) {
                    el.removeClass('dependency-hide');
                } else {
                    el.addClass('dependency-hide');
                }

                el.find('select,input').trigger('change');
                el.find('.dropdown-title').click();

                tabs.each(function () {
                    var id = $(this).attr('aria-controls');
                    var result = false;
                    var element = document.getElementById(id);
                    $(element).find('>.vc_column').each(function () {
                        if (!$(this).hasClass('dependency-hide')) {
                            result = true;
                            return false;
                        }
                    });
                    if (!result) {
                        $(this).addClass('dependency-hide');
                    } else {
                        $(this).removeClass('dependency-hide');
                    }
                });
            });
        } else {

            if (typeof json.value != 'object') {
                json.value = [json.value];
            }
            if ($.inArray(depend.val(), json.value) != -1
                && !depend.closest('.vc_column').hasClass('dependency-hide')
            ) {
                el.removeClass('dependency-hide');
            } else {
                el.addClass('dependency-hide');
            }
            el.find('select,input').trigger('change');

            tabs.each(function () {
                var id = $(this).attr('aria-controls');
                var result = false;
                var element = document.getElementById(id);
                $(element).find('>.vc_column').each(function () {
                    if (!$(this).hasClass('dependency-hide') ) {
                        result = true;
                        return false;
                    }
                });
                if (!result) {
                    $(this).addClass('dependency-hide');
                } else {
                    $(this).removeClass('dependency-hide');
                }
            });

            depend.siblings('[data-name=' + depend.attr('name') + ']').change(function () {
                setTimeout(function(){
                    if (typeof json.value != 'object') {
                        json.value = [json.value];
                    }
                    if ($.inArray(depend.val(), json.value) != -1
                        && ! depend.closest('.vc_column').hasClass('dependency-hide')
                    ) {
                        el.removeClass('dependency-hide');
                    } else {
                        el.addClass('dependency-hide');
                    }
                    el.find('select,input').trigger('change');

                    tabs.each(function () {
                        var id = $(this).attr('aria-controls');
                        var result = false;
                        var element = document.getElementById(id);
                        $(element).find('>.vc_column').each(function () {
                            if (!$(this).hasClass('dependency-hide')) {
                                result = true;
                                return false;
                            }
                        });
                        if (!result) {
                            $(this).addClass('dependency-hide');
                        } else {
                            $(this).removeClass('dependency-hide');
                        }
                    });
                },1);

            });
        }
    });
    setTimeout(function(){
        $('.setting-panel-container').css('display' , 'block');
    } , 50 );
};



/**
 * @summary media panel for the image controller in the shortcode setting panel
 *
 * @since 1.0.0
 */

mBuilder.prototype.mediaPanel = function () {
    // Set all variables to be used in scope
    var frame;

    // ADD IMAGE LINK
    $('body').on('click', '.mBuilder-upload-img.single', function (event) {

        event.preventDefault();
        $(this).addClass('active-upload');
        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = window.top.wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        var t = this;
        // When an image is selected in the media frame...
        frame.on('select', function () {
            var $this = $('.mBuilder-upload-img.single.active-upload');
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            $this.css('background-image', 'url("' + attachment.url + '")').css('background-size', '100% 100%');

            // Send the attachment id to our hidden input
            $this.find('input').val(attachment.id);

            $this.find('.remove-img').removeClass('mBuilder-hidden');
            $('.mBuilder-upload-img.single').removeClass('active-upload');

        });

        // Finally, open the modal on click
        frame.open();
    });

    // DELETE IMAGE LINK
    $('body').on('click', '.mBuilder-upload-img.single .remove-img', function (event) {

        event.preventDefault();
        event.stopPropagation();
        // Clear out the preview image

        $(this).closest('.mBuilder-upload-img').css({'background-image': '', 'background-size': ''});

        $(this).parent().removeClass('has-img');
        $(this).addClass('mBuilder-hidden');

        // Delete the image id from the hidden input
        $(this).siblings('input').val('');

    });
};

/**
 * @summary set parents for models and delete extra models
 *
 * @since 1.0.0
 */
mBuilder.prototype.set_parents = function () {
    var t = this;
    for (var index in t.models.models) {
        var $el = $('div[data-mBuilder-id=' + index + ']'),
            $parent = $el.parent().closest('.mBuilder-element');
        if (!$el.length) {
            delete(t.models.models[index]);
        }
        if ($parent.length) {
            var parentId = $parent.attr('data-mBuilder-id');
            t.models.models[index].parentId = parentId;
        }
    }
};

/**
 * @summary dropdown controller in the shortcode setting panel
 *
 * @since 1.0.0
 */
mBuilder.prototype.dropdown = function(){
    $('body').on('click','.dropdown-title',function(){

        var $dropdown = $(this).parent(),
            this_tab = $(this).closest( '.mBuilder-edit-el' );
        $( '#mBuilderTabs .mbuilder-dropdown' ).not( $dropdown ).removeClass( 'open' );
        if ( $dropdown.hasClass( 'open' ) ){
            $dropdown.removeClass( 'open' )
        }else{
            $dropdown.addClass( 'open' );
            var last_dropdown = this_tab.find( '.mbuilder-controller' ).last();
            if ( last_dropdown.is( '.dropdown' ) && last_dropdown.find( '.mbuilder-dropdown.open' ).length ) {
                this_tab.scrollTop( this_tab[0].scrollHeight );
            }
        }
        
    });
    $('body').on('click','.dropdown-option',function(){
        var $dropdown = $(this).closest('.mbuilder-dropdown'),
            $selected_element = $(this).closest('.mbuilder-dropdown').find('.mbilder-dropdown-selected');

        $dropdown.find('.dropdown-option').removeClass('selected-option');
        $(this).addClass('selected-option');
        $selected_element.html($(this).text());
        $dropdown.find('input').val($(this).attr('data-dropdown-value'));
        $dropdown.find('input').trigger('change_font_family');
        $dropdown.find('input').trigger('change');
        $dropdown.find('.dropdown-title').click();
    });

    $('body').on('click','.mBuilder-edit-el',function(e){
        if ($(e.target).hasClass('dropdown-title')
            || $(e.target).closest('.dropdown-title').length
        ){
            return;
        }
        $('.mbuilder-dropdown').removeClass('open')
    });
}

/**
 * @summary multi media panel for the multi image controller in the shortcode setting panel
 *
 * @since 1.0.0
 */

mBuilder.prototype.multiMediaPanel = function () {
    // Set all variables to be used in scope
    var frame;

    // ADD IMAGE LINK
    $('body').on('click', '.mBuilder-upload-imgs .mBuilder-upload-img', function (event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        /* if (false) {
         frame.open();
         return;
         }*/

        // Create a new media frame
        frame = window.top.wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: 'add'  // Set to true to allow multiple files to be selected
        });

        var t = this,
            $container = $(t).parent();
        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').toJSON();
            var attachments = '';
            $container.find('.mBuilder-upload-img').remove();
            for (var i = 0; i < attachment.length; i++) {
                if(attachment[i]['id'] == ''){
                    continue;
                }
                attachments = attachments + attachment[i]['id'] + ',';
                if (attachment[i]['id'] != "" )
                    $container.append('<div data-id="' + attachment[i]['id'] + '" class="mBuilder-upload-img has-img" style="background-image: url(' + attachment[i].url + ')"><span class="remove-img"><span class="px-icon icon-cancel2"></span></span></div>');
            }
            $container.append('<div class="mBuilder-upload-img"><span class="remove-img mBuilder-hidden">X</span></div>');
            attachments = attachments.slice(0, -1);
            // Send the attachment id to our hidden input
            $container.find('input').val(attachments);
        });

        // Finally, open the modal on click
        frame.on('open',function() {
            var selection = frame.state().get('selection');
            var ids = $container.find('input').val().split(',');
            ids.forEach(function(id) {
                var attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : [] );
            });
        });

        frame.open();
    });

    // DELETE IMAGE LINK
    $('body').on('click', '.mBuilder-upload-imgs .mBuilder-upload-img .remove-img', function (event) {
        var t = this,
            $container = $(t).parent().parent(),
            $this = $(this).parent();
        event.preventDefault();
        event.stopPropagation();
        // Delete the image id from the hidden input
        var val = $container.find('input').val(),
            valarr = val.split(","),
            index = valarr.indexOf($this.attr('data-id'));
        if (index > -1) {
            valarr.splice(index, 1);
        }
        $container.find('input').val(valarr.join());
        // Clear out the preview image
        $this.remove();
    });
};


/**
 * @summary Google Font Controller in the Shortcode setting panel
 *
 * @since 1.0.0
 */

mBuilder.prototype.googleFontPanel = function () {

    function generateInputVal(paramName) {
        var $fontFamily = $('.google-fonts-families[data-input="' + paramName + '"]'),
            $fontStyle = $('.google-fonts-styles[data-input="' + paramName + '"]'),
            $input = $('input[name="' + paramName + '"]'),
            fontFamily = 'font_family:' + encodeURIComponent($fontFamily.find('>input').val()),
            fontStyle = 'font_style:' + encodeURIComponent($fontStyle.find('>input').val());
        $input.attr('value',fontFamily + '|' + fontStyle);
    }

    $('body').on('change_font_family', 'input[name="google-fonts-families"]', function (event) {
        // check if event  doesn't call from jquery
        var $this = $(this).parent();
        $('.google-fonts-styles[data-input="' + $this.attr("data-input") + '"] .dropdown-options').html('<div class="active-text-color">Loading...</div>');
        $.ajax({
            type: 'post',
            url: mBuilderValues.ajax_url,
            data: {
                action: 'pixflow_loadFontStyles',
                nonce: mBuilderValues.ajax_nonce,
                fontKey: $this.find(".selected-option").attr('data-font-id'),
                value: '',
                mbuilder_editor: true
            },
            success: function (response) {

                $('.google-fonts-styles[data-input="' + $this.attr("data-input") + '"] .dropdown-options').html(response);
                generateInputVal($this.attr('data-input'));
            }
        });
    });
    $('body').on('change', 'input[name = "google-fonts-styles"]', function (event) {
        generateInputVal($(this).parent().attr('data-input'));
    });
};


/**
 * @summary call user functions that sets to call after each shortcode build or rebuild
 *
 * @param {string} type - shortcode type
 * @param {object} obj - jQuery object of shortcode
 * @since 1.0.0
 */

mBuilder.prototype.specialShortcodes = function (type, id) {
    var that = this;
    var obj = $( '[data-mbuilder-id='+ id +']' );
    var obj_child = obj.find('[data-mbuilder-id]');
    if ( obj_child.length ){
        obj_child.each(function(){
            that.specialShortcodes( $(this).attr('data-mbuilder-el') , $(this).attr('data-mbuilder-id') );
        });
    }

    if (typeof this[type + "Shortcode"] == 'function') {
        this[type + "Shortcode"](obj);
    }

    obj.parents('.mBuilder-element[data-mbuilder-el="md_accordion_tab"]').find('h3.ui-state-active').siblings('.wpb_accordion_content').css('height', '');
    obj.parents('.mBuilder-element[data-mbuilder-el="md_toggle_tab"]').find('h3.ui-state-active').siblings('.wpb_toggle_content').css('height', '');
    obj.parents('.mBuilder-element[data-mbuilder-el="md_toggle_tab2"]').find('h3.ui-state-active').siblings('.wpb_toggle_content').css('height', '');
};

mBuilder.prototype.vc_empty_spaceShortcode = function (obj) {

    var that = this;
    var id = $(obj).attr('data-mbuilder-id');
    $(obj).find( '.vc_empty_space' ).resizable({
        maxWidth : 500,
        minWidth : 0,
        handles  : 's',
        create: function (event,ui) {
            if( !that.getModelattr(id,'height') ){
                that.setModelattr(id,'height',$(obj).height());
            }
            if( ! $(obj).find( '.space-resize-val').length ) {
                $(this).append('<div class="space-resize-val"><span class="space-resize-value">Spacing: ' + parseInt(  $(obj).css('height') ) + 'px</span></div>');

            }
        },
        resize : function () {
            if( ! $(obj).find( '.space-resize-value').length ) {
                $(this).append('<div class="space-resize-val"><span class="space-resize-value">Spacing: ' + parseInt(  $(obj).css('height') ) + 'px</span></div>');


            }else{
                $(obj).find('.space-resize-value').text('Spacing: '+ $(obj).height() + 'px');
            }
        } ,
        stop : function () {
            that.setModelattr( id,'height', $( this ).height() );
        }
    });

    $('body').off('duplicate_shortcode.empty_space').on('duplicate_shortcode.empty_space',function(e, obj){

        if( ! $( obj ).hasClass( 'mBuilder-vc_empty_space' ) ) {
            return;
        }
        
        var id = $( obj ).attr( 'data-mbuilder-id' );
        $(obj).find('.ui-resizable-handle').remove();
        $(obj).find( '.vc_empty_space' ).resizable({
            maxWidth : 500,
            minWidth : 0,
            handles  : 's',
            create: function (event,ui) {
                if( !that.getModelattr(id,'height') ){
                    that.setModelattr(id,'height',$(obj).height());
                }
            },

            stop : function () {
                that.setModelattr( id,'height', $( this ).height() );
            }

        });
    });

};

mBuilder.prototype.md_portfolio_multisizeShortcode = function (obj) {
    'use strict';
    var $portfolioItem = $(obj).find('.isotope .item'),
        panelSetting = '<div class="portfolio-panel-setting">' +
            '                   <div class="tooltip">SET IMAGE SIZE</div>'+
            '                   <div class="setting-holder">' +
            '                       <div class="state"></div>'+
            '                       <span data-size="thumbnail-small" class="small-size portfolio-size"></span>' +
            '                       <span data-size="thumbnail-medium" class="average-size portfolio-size"></span>' +
            '                       <span data-size="thumbnail-large" class="large-size portfolio-size"></span>' +
            '                   </div>' +
            '               </div>';

    $portfolioItem.append(panelSetting);
    $portfolioItem.find('.portfolio-size').each(function (index, value) {
        $(this).attr('data-item_id', $(this).parent().parent().attr('data-item_id'));
    });
    $portfolioItem.hover(function () {
        var $this =$(this),
            position = parseInt($this.css('padding-top'))+10;
        $this.find('.portfolio-panel-setting').css({top: position,right:position, opacity: '1'});
    }, function () {
        var $this =$(this),
            position = parseInt($this.css('padding-top'));

        $(this).find('.portfolio-panel-setting').css({top: position,right:position+10, opacity: '0'});

    });


    $portfolioItem.find('.portfolio-panel-setting').hover(function(){
        $(this).addClass('hovering');
        TweenMax.fromTo($(this).find('.tooltip'),.3, {top:-60,opacity:0}, {top:-33,opacity:1});
    },function(){
        $(this).removeClass('hovering');
        TweenMax.fromTo($(this).find('.tooltip'),.3, {top:-33,opacity:1}, {top:-70,opacity:0});
    });

    $portfolioItem.find('.portfolio-panel-setting span').click(function () {
        if ($(this).hasClass('small-size')) {
            $(this).parents('.item').removeClass('thumbnail-medium thumbnail-large').addClass('thumbnail-small');
            $(this).siblings('.state').removeClass('active-average active-large').addClass('active-small');
            $(this).siblings().removeClass('current');
            $(this).addClass('current');
            pixflow_portfolioMultisize();
        } else if ($(this).hasClass('average-size')) {
            $(this).parents('.item').removeClass('thumbnail-small thumbnail-large').addClass('thumbnail-medium');
            $(this).siblings().removeClass('current');
            $(this).siblings('.state').removeClass('active-large active-small').addClass('active-average');
            $(this).addClass('current');
            pixflow_portfolioMultisize();
        } else if ($(this).hasClass('large-size')) {
            $(this).parents('.item').removeClass('thumbnail-medium thumbnail-small').addClass('thumbnail-large');
            $(this).siblings().removeClass('current');
            $(this).addClass('current');
            $(this).siblings('.state').removeClass('active-average active-small').addClass('active-large');
            pixflow_portfolioMultisize();
        } else if ($(this).hasClass('setting')) {
            $(this).closest('.vc_md_portfolio_multisize').find('a[title="Edit Portfolio Multi-Size"]')[0].click();
        }
        var item = $(this).parents('.portfolio-item'),
            post_id = item.data("item_id"),
            size = $(this).attr('data-size');
        jQuery.ajax({
            type: "post",
            url: mBuilderValues.ajax_url,
            data: "action=pixflow_portfolio_size&nonce=" + mBuilderValues.ajax_nonce + "&portfolio_size=" + size + "&post_id=" + post_id,
            success: function (res) {
                return res;
            }
        })
    });

    $portfolioItem.find('.portfolio-panel-setting span').hover(function(){
        var $item = $(this);

        if($item.hasClass('small-size')){
            $item.siblings('.state').removeClass('average large').addClass('small');

        }else if($item.hasClass('average-size')){
            $item.siblings('.state').removeClass('large small').addClass('average');

        }else{
            $item.siblings('.state').removeClass('average small').addClass('large');

        }
    },function(){
        var $item = $(this);
        if($item.hasClass('small-size')){
            $item.siblings('.state').removeClass('average large').addClass('small');

        }else if($item.hasClass('average-size')){
            $item.siblings('.state').removeClass('large small').addClass('average');

        }else{
            $item.siblings('.state').removeClass('average small').addClass('large');

        }

        $('.state').removeClass('average small large');

    });

    $('.portfolio .shortcode-btn a').click(function(e){
        e.preventDefault();
        return;
    })
};

mBuilder.prototype.md_tabsShortcode = function (obj) {

    obj.find('.px_tabs_nav > li').click(function () {
        var id = $(this).find('> a').attr('href'),
            num = $(this).position().left;
        $(id).next().css({left: num});
    });

    obj.find('ul.ui-tabs-nav').sortable({
        cursor: "move",
        items: "li:not(.unsortable)",
        delay: 100,
        axis: "x",
        zIndex: 10000,
        tolerance: "intersect",
        update: function (event, ui) {
            $('body').addClass('changed');
            var prev = ui.item.prev();
            var prevId = prev.find('a').attr('href');
            var id = ui.item.find('a').attr('href');
            if (prevId) {
                $(id).parent().insertAfter($(prevId).parent());
            } else {
                $(id).parent().insertAfter($(id).parent().parent().find('ul').first());
            }
        }
    });
};

mBuilder.prototype.md_live_textShortcode = function(obj){
    var t = this;
    $(function(){
        t.bind_text_editor(obj.find('.meditor'));
    });
}

mBuilder.prototype.md_modernTabsShortcode = function (obj) {
    obj.find('.px_tabs_nav > li').click(function () {
        var id = $(this).find('> a').attr('href'),
            num = $(this).position().left;
        $(id).next().css({left: num});
    });

    setTimeout(function () {
        obj.find('.px_tabs_nav > li').first().click();
    }, 500);

    obj.find('ul.ui-tabs-nav').sortable({
        cursor: "move",
        items: "li:not(.unsortable)",
        delay: 100,
        axis: "x",
        zIndex: 10000,
        tolerance: "intersect",
        update: function (event, ui) {
            $('body').addClass('changed');
            var prev = ui.item.prev();
            var prevId = prev.find('a').attr('href');
            var id = ui.item.find('a').attr('href');
            if (prevId) {
                $(id).parent().insertAfter($(prevId).parent());
            } else {
                $(id).parent().insertAfter($(id).parent().parent().find('ul').first());
            }
        }
    })
};

mBuilder.prototype.md_hor_tabsShortcode = function (obj) {
    obj.find('.px_tabs_nav > li').click(function () {
        var id = $(this).find('> a').attr('href'),
            num = $(this).position().top + 15;
        $(id).next().css({top: num});
    });
    obj.find('ul.ui-tabs-nav').sortable({
        cursor: "move",
        items: "li:not(.unsortable)",
        delay: 100,
        axis: "y",
        zIndex: 10000,
        tolerance: "intersect",
        update: function (event, ui) {
            $('body').addClass('changed');
            var prev = ui.item.prev();
            var prevId = prev.find('a').attr('href');
            var id = ui.item.find('a').attr('href');
            if (prevId) {
                $(id).parent().insertAfter($(prevId).parent());
            } else {
                $(id).parent().insertAfter($(id).parent().parent().find('ul').first());
            }
        }
    })
};

mBuilder.prototype.md_hor_tabs2Shortcode = function (obj) {
    obj.find('.px_tabs_nav > li').click(function () {
        var id = $(this).find('> a').attr('href'),
            num = $(this).position().top + 20;
        $(id).next().css({top: num});
    });

    obj.find('ul.ui-tabs-nav').sortable({
        cursor: "move",
        items: "li:not(.unsortable)",
        delay: 100,
        axis: "y",
        zIndex: 10000,
        tolerance: "intersect",
        update: function (event, ui) {
            $('body').addClass('changed');
            var prev = ui.item.prev();
            var prevId = prev.find('a').attr('href');
            var id = ui.item.find('a').attr('href');
            if (prevId) {
                $(id).parent().insertAfter($(prevId).parent());
            } else {
                $(id).parent().insertAfter($(id).parent().parent().find('ul').first());
            }
        }
    })
};

/**
 * @summary get value attribite from model attributes
 *
 * @since 1.0.0
 */

mBuilder.prototype.getModelattr = function (modelID, attr) {

    var t = this,
	    attrs = t.models.models[ modelID ].attr,
	    pattern = attr + '=\\s*["|\'](.*?)["|\'](?=\\s*\\w*=["|\'])',
	    regex = new RegExp( pattern, 'gm' );

	var result = regex.exec( attrs );
	if ( result !== null ) {
		return result[ 1 ];
    } else {
        return false;
    }

};

mBuilder.prototype.removeColumnSeparator = function () {
    var $coulmnMode = $('.column-hover-mode');
    if ($coulmnMode.length) {
        $coulmnMode.remove();
    }
};

// Create A list Of Fonts with Their Varients
var font_name_list = [],
    font_name_list_len = '' ;
font_var_list = [];
mBuilder.prototype.getEditorFonts = function () {
    var $fontList ,
        count = 0 ,
        google_font_url = mBuilderValues.google_font;
    $.get( google_font_url ,  function (data) {
        $fontList =  JSON.parse(data) ;
        for( count  in $fontList.items ){
            $fontVarMenu = [];
            for(var i=0 ; i < $fontList.items[count].variants.length ; i++){
                var e = {
                    text:$fontList.items[count].variants[i],
                    classes:'pixflow-editor-font'
                }
                $fontVarMenu.push(e);
            }
            font_name_list.push($fontList.items[count].family.toString());
            font_var_list.push($fontVarMenu);
        }
        font_name_list_len = font_name_list.length;
        return ;
    });
};

//popupSaveSection
mBuilder.prototype.popupSaveSection = function ( rowId ) {
    var that = this;
    $( '.popupSaveSection-container' ).css({ 'display': 'flex' });
	if ( ! $('.popupSaveSection').length ){
		var popupSaveSection = '<div class="popupSaveSection-container">'+
            '<div class="popupSaveSection">' +
			'<div class="popupSaveSection-close">+</div>' +
			'<div class="popupSaveSection-content">' +
				'<span class="popupSaveSection-title">Save Your Section</span>'+
				'<span class="popupSaveSection-dec">Sections are reusable. It is a good idea to save your section, so you can use it again later.</span>'+
                '<span class="popupSaveSection-error"></span>'+
				'<span class="popupSaveSection-input"><input class="popupSaveSection-field" type="text" name="" placeholder="Section Name"></span>'+
				'<span ><a class="popupSaveSection-button" href="#">CREATE</a></span>'+
			'</div>';
			$('body').append( popupSaveSection );
	}
	$('.popupSaveSection-button').off('click').on('click',function(){
		var value = $('.popupSaveSection-input input').val();
		that.saveSection( '#' + rowId, value);
	})
};


// Convert String to base64
mBuilder.prototype.b64EncodeUnicode = function (str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function (match, p1) {
        return String.fromCharCode('0x' + p1);
    }));
};

/**
 * @summary set value to model attribute
 *
 * @since 1.0.0
 */
mBuilder.prototype.setModelattr = function (modelID, attr, value) {
    var t = this,
        attrs = t.models.models[modelID].attr;
    var re = new RegExp(attr + '=(\'|")([.\\s\\S]*?)(\'|")', 'gm');
    var str = attrs;
    var m;
    if ((m = re.exec(str)) !== null) {
        var find = new RegExp(attr + '=(\'|")([.\\s\\S]*?)(\'|")', 'gm');
        var replace = attr + '="' + value + '" ';
        attrs = str.replace(find, replace);
    } else {
        attrs = attrs + ' ' + attr + '="' + value + '" ';
    }

    t.models.models[modelID].attr = attrs;
};

mBuilder.prototype.make_links_target_blank = function () {

    $('body').on('click','a:not(.pixflow-builder-toolbar a)',function(e){
        $(this).attr('target','_blank');
    });
};

/*
 * Preview button functionality in pixflow builder toolbar
 * */
mBuilder.prototype.preview_mode = function () {
    "use strict";
    var $preview_button = $('.builder-preview');
    if (!$preview_button.length)
        return;

    function preview_off($this,$body){
        if($body.length){
            //$('.mBuilder_row_controls').css('display','flex');
            $( ".mBuilder-vc_column .vc_column-inner > .wpb_wrapper" ).removeClass("disable-sort");
            $( ".content-container" ).removeClass("disable-sort");
            $('.meditor').attr('contenteditable' , 'true' );
        }
        try {
            $(".px_tabs_nav").sortable("enable");
            $('.mBuilder-element:not(.vc_row,.mBuilder-vc_column)').draggable("enable");
        }catch(e){}

        $body.removeClass('gizmo-off');
        $('.pixflow-shortcodes-panel').css({left:''});
        $('.space-resize-val , .ui-resizable-handle').css('display' , 'block');
        $('.space-resize-val').css('display' , 'flex');
        try{
            $this.removeClass('hold-collapse');
            $('.wpb_content_element .px_tabs_nav.md-custom-tab > li:last-child').css('display','inline-block');
            $('.sortable-handle').css('border','1px dashed rgba(92,92,92,.9)');
        }catch (e){}
    }
    function preview_on($this,$body){
        if($body.length){
            $( ".mBuilder-vc_column .vc_column-inner > .wpb_wrapper" ).addClass("disable-sort");
            $( ".content-container" ).addClass("disable-sort");
            $body.addClass('gizmo-off');
            $('.meditor').attr({
                contentEditable: 'false'
            });
            $('.space-resize-val , .ui-resizable-handle').css('display' , 'none');
            $('.pixflow-shortcodes-panel').css({left:'-310px'});
            try {
                $(".px_tabs_nav").sortable("disable");
                $('.mBuilder-element:not(.vc_row,.mBuilder-vc_column)').draggable("disable");
            }catch(e){}
            $(this).addClass('hold-collapse');
        }


        try {
            $this.addClass('hold-collapse');
            $body.off('click','.vc_empty-element,.vc_templates-blank, .vc_add-element-action, .vc_control-btn-append, .vc_element-container');
            $('.vc_row .vc_vc_column,.sortable-handle').css('border','none');
            $('.wpb_content_element .px_tabs_nav.md-custom-tab > li:last-child').css('display','none');
        } catch (e) {}
    }
    $preview_button.unbind('click');
    $preview_button.click(function () {
        var $this = $(this),
            $body = $('body.pixflow-builder');
        $this.toggleClass('active-preview');
        $('.pixflow-add-element-button').removeClass('close-element-button');
        if($this.hasClass('hold-collapse')){
            preview_off($this,$body);
        }else {
            preview_on($this,$body);
        }
    });
};

mBuilder.prototype.save_button_animation_start = function(){
    $('.builder-controls .builder-save').addClass('saving');
    $('.builder-controls .builder-save .save-loading').animate({width: '90%'}, 7000);
    $('.builder-controls .builder-save .save').html(mBuilderValues.saving);

};

mBuilder.prototype.save_button_animation_end = function(){
    $('.builder-controls .builder-save .save-loading').stop().animate({'width': '100%'}, 200, 'swing', function () {
        $('.builder-controls .builder-save .save').html(mBuilderValues.saved);
        $('.builder-controls .builder-save .save-loading').css('width', '0%');
        $('.builder-controls .builder-save').removeClass('active-dropdown-view');

        setTimeout(function () {
            $('.builder-controls .builder-save').removeClass('saving');
            $('.builder-controls .builder-save .save').html(mBuilderValues.save);
        }, 2000);
    });
};

mBuilder.prototype.mBuilder_message_box = function(title, customClass, text, btn1, callback1, btn2, callback2, closeCallback){
    "use strict";
    var t = this;
    $('.message-box-wrapper').remove();
    var $messageBox = $('' +
            '<div class="message-box-wrapper">' +
            '   <div class="message-box-container '+ customClass +'">' +
            '       <div class="message-box-close"/>' +
            '       <div class="message-box-title">' + title + '</div>' +
            '       <div class="message-box-text">' + text + '</div>' +
            '       <button class="message-box-btn1">'+ btn1 +'</button>' +
            '   </div>' +
            '</div>').appendTo('body'),
        $btn1;

    $messageBox.animate({opacity:1},200);
    $btn1 = $messageBox.find('.message-box-btn1');

    $btn1.click(function(){
        if(typeof callback1 == 'function') {
            callback1();
        }
    });
    if(btn2){
        var $btn2 = $('<button class="message-box-btn2">'+ btn2 +'</button>').insertAfter($btn1);
        $btn2.click(function(){
            if(typeof callback2 == 'function'){
                callback2();
            }
        });
    }
    if(!btn2){
        $btn1.css("width","100%");
    }

    var $close = $messageBox;
    $close.on('click', function(e) {
        if (e.target !== this)
            return;
        if(typeof closeCallback == 'function'){
            closeCallback();
        }
        t.mBuilder_close_message_box();
    });
};

mBuilder.prototype.mBuilder_close_message_box = function(){
    "use strict";

    $('.message-box-wrapper').fadeOut(300,function(){
        $(this).remove();
    })
};

mBuilder.prototype.on_before_unload = function(){
    var t = this;
    var leave_builder_msg = "You're about to leave Massive Builder",
        edit_setting_msg = "You're about to edit setting",
        import_demo_msg = "You're about to import template";
    $('.builder-dashboard a, .builder-sitesetting a, .builder-customizer a, .builder-close a').click(function(){
        var $that = $(this);
        if($('body').hasClass('changed')) {
            if($that.parent().hasClass('builder-sitesetting')){
                var leave_msg = edit_setting_msg;
            }else if($that.parent().hasClass('builder-customizer')){
                var leave_msg = import_demo_msg;
            }else{
                var leave_msg = leave_builder_msg;
            }
            t.mBuilder_message_box(leave_msg, '', mBuilderValues.saveMessages , mBuilderValues.updateFirst , function () {
                t.save_callback_function = function () {
                    window.location = $that.attr('href');
                }
                t.saveContent();
            }, mBuilderValues.justLeave , function () {
                window.location = $that.attr('href');
            }, function () {
                return false;
            });
            return false;
        }
    })
};

var open_shortcode_time = open_shortcode_time_duration =  '' ;
mBuilder.prototype.remove_time_out = function (){
    clearTimeout(open_shortcode_time_duration);
}

mBuilder.prototype.shortcode_panel_tabs  = function(){
    "use strict";
    $('.pixflow-shortcodes-panel .panel-tabs .panel-tab').click(function(){
        var $this = $(this);
        if($this.hasClass('active-tab')){
            return;
        }
        $([$this, $this.siblings()]).toggleClass('active-tab');
        $('.sections-tab,.elements-tab').toggleClass('active-tab');
    })

};

mBuilder.prototype.open_pixflow_shortcode_panel  = function(tab){
    "use strict";
    if(typeof tab == 'undefined'){
        var tab = 'elements';
    }
    if(tab == 'elements'){
        $('.pixflow-shortcodes-panel .panel-tabs .panel-tab[data-tab="elements"]').click();
    }else{
        $('.pixflow-shortcodes-panel .panel-tabs .panel-tab[data-tab="sections"]').click();
    }
    clearTimeout(open_shortcode_time);
    clearTimeout(open_shortcode_time_duration);
    var $shortcodes_panel = $(".pixflow-shortcodes-panel");

    $shortcodes_panel.removeClass('hide-panel');
    $(".pixflow-add-element-button").addClass('clicked');
    $shortcodes_panel.addClass("opened");
    $shortcodes_panel.find('.pixflow-search-shortcode').focus();
   $shortcodes_panel.find('.shortcodes').mousedown(function () {
       builder.mBuilder_closeShortcodeSetting();

   })


};

mBuilder.prototype.close_pixflow_shortcode_panel = function() {

    var $shortcodes_panel = $(".pixflow-shortcodes-panel");
    clearTimeout(open_shortcode_time_duration);
    if ($shortcodes_panel.hasClass("opened")) {
        $(".pixflow-add-element-button").removeClass('clicked');
        $shortcodes_panel.removeClass("opened");
        open_shortcode_time = setTimeout(function () {
            $shortcodes_panel.addClass('hide-panel')
        },800);
        this.clear_shortcodes_panel_input();

    }

};

mBuilder.prototype.clear_shortcodes_panel_input = function() {

    $('.pixflow-search-shortcode').val('');
    $('.pixflow-shortcodes-container .category-container').addClass('show').find('.shortcodes').addClass('active');

};

/*
 * Section Builder function
 * */
mBuilder.prototype.section_builder = function( section_id, placeholder, sectionType ){
    var t = builder;
    this.buildShortcode(
        placeholder
        , 'vc_row'
        , {
            'section_id'	:section_id ,
			'customSection' : sectionType
        }
        // Callback function to set model attributes
        , function(id){
            if(parseInt(id)){
                // Set Row Attributes
                var $row = $('.mBuilder-element[data-mbuilder-id="'+id+'"]'),
                    row_attrs = $row.find('> .section-shortcode-attrs').text();
                t.models.models[id]['attr'] = row_attrs;
                // Set Shortcodes attribitues in Row
                $row.find('.mBuilder-element').each(function(){
                    var $model = $(this),
                        model_id = $model.data('mbuilder-id'),
                        model_attrs = $model.find('> .section-shortcode-attrs').text();
                    t.models.models[model_id]['attr'] = model_attrs;

                    if ($model.hasClass('mBuilder-vc_empty_space')) {
                        t.vc_empty_spaceShortcode($model);
                    }
                })
                $('.section-shortcode-attrs').remove();
                // Init live Text Editors
                var $live_texts = $row.find('.meditor');
                if($live_texts.length){
                    t.bind_text_editor($live_texts);
                }

            }
            if($('body').hasClass('one_page_scroll')){
                pixflow_one_page_for_customizer();
            }
        }
    );

}

/**
 * Check if new shortcode drop and refresh shortcode params
 *
 * @param boolean reset specifies the shortcode params should be refresh or not
 *
 * @return boolean
 * @since 5
 */
mBuilder.prototype.refresh_shortcode_params = function( reset ) {

    if( !this.shortcodes_param.length || reset ){
        this.shortcodes_param = _.extend( this.shortcodes_param, JSON.parse( shortcode_maps.shortcodes_param ) );
    }

    return true;

};

/**
 * Get the shortcode params
 *
 * @param string model_type the name of shortcode
 *
 * @return Object params of shortcode
 * @since 5
 */
mBuilder.prototype.get_shortcode_param = function( model_type ) {

    this.refresh_shortcode_params();
    var params =  this.shortcodes_param[model_type].params;

    return params;

};

/**
 * Check if title slider is on while text number is less that 2 then set title slider off
 *
 * @param int model_id it contains the id of shortcode
 *
 * @return boolean
 * @since 5
 */
mBuilder.prototype.set_title_slider = function ( model_id ){
    var that = this;
    var title_slider = that.getModelattr( model_id , 'md_text_use_title_slider' );
    if( false !== title_slider ){
        var text_number = that.getModelattr( model_id , 'md_text_number' );
        if( text_number < 2 || false === text_number ){
            that.setModelattr( model_id , 'md_text_use_title_slider' , '' );
        }
    }
    return true;
}

/**
 * Create group of each shortcode
 *
 * @param Object params of shortcodes
 *
 * @return Object form with tabs
 * @since 5
 */
mBuilder.prototype.get_groups_param = function( params ){
    var form = {};
    params.forEach(function( param ){
        if( typeof param.group == 'undefined' ){
            param.group = "General" ;
        }

        if(typeof form[param.group] == 'undefined'){
            form[param.group] = [] ;
        }

        form[param.group].push( param );
    });
    return form ;
}

/**
 * Generate the css attribute for coulmn shortcode
 *
 * @param string model_type the name of shortcode
 *
 * @return array final css that contains css property Individually and css contains the css string
 * @since 5
 */
mBuilder.prototype.generate_css_attr = function( model_type , model_id ){
    var final_css = [] ;
    var that = this ;
    if( "vc_column" == model_type ){
        var css = that.getModelattr( model_id , 'css' );
        if ( false != css ){
            var matches = css.match(/.*?{(.*?)}.*?/);
            if( "object" == typeof matches && null != matches[1] ){
                css = matches[1];
                css = css.replace( /``/g , '\'' );
                css = css.replace( /[!]important/g, '' ).trim();
                css = css.replace( /px/g , '' ).trim();
                css = css.replace(/url[(](.*?)[)]/g,'$1').trim();

                css = css.split(';');
                css.forEach(function( css_prop ){
                    if( css_prop != '' ){
                        var css_property = css_prop.split(/:(?!\/\/)/g);
                        var object_name = css_property[0].replace( /-/g , '_' ).trim();
                        final_css[object_name] = css_property[1].trim() ;
                    }
                });
            }else{
                css = '' ;
            }
        }
    }
    return [ final_css , css ] ;
}

/**
 * Set the general tab in the first tab
 *
 * @param Objcet form contains the form tabs
 * @param int model_id it contains the id of shortcode
 *
 * @return boolean
 * @since 5
 */
mBuilder.prototype.reorder_groups = function( form ){
    if(  typeof form["General"] != "undefined" && form["General"].length ){
        var general_tab = form["General"] ;
        delete form['General'];
        form = jQuery.extend( { 'General' : general_tab } , form );
    }
    return form;
}

/**
 * Set the custom classes for each controller
 *
 * @param Object params of shortcodes
 * @param Object group_html contains the html source of each tab
 * @param String group show the tab name
 *
 * @return Object group_html with the custom classes
 * @since 5
 */
mBuilder.prototype.set_custom_classes = function(param , group_html , group ){
    var dependency = '';
    if( typeof param.dependency != "undefined" ){
        dependency = "data-mBuilder-dependency='" + JSON.stringify( param.dependency ) + "'";
    }
    if( typeof param.mb_dependency != "undefined" ){
        dependency = "data-mBuilder-dependency='" + JSON.stringify( param.mb_dependency ) + "'";
    }
    if( typeof group_html[group] == "undefined" ){
        group_html[group] = '' ;
    }

    var edit_classes = ( typeof param.edit_field_class != "undefined" ) ? param.edit_field_class : '' ;
    edit_classes += ' setting-background mbuilder-controller ';
    if(typeof param.color_picker != 'undefined'){
        edit_classes += ' has-colorpicker ';
    }
    group_html[group] += '<div class="vc_col-sm-12 vc_column ' +  param.type + ' ' + edit_classes + '" ' + dependency + ' >';
    return group_html;
}

/**
 * Create the params of shortcodes
 *
 * @param Object params of shortcodes
 * @param array final css that contains css property Individually and css contains the css string
 * @param int model_id it contains the id of shortcode
 *
 * @return Object shortcode params of shortcodes
 * @since 5
 */
mBuilder.prototype.create_dependecy = function( param, final_css, model_id) {
    var shortcodes_param = {} ;
    var default_value = '' ;
    var that = this ;


    if( 'content' == param.param_name ){
        if( "undefined" == typeof shortcodes_param [param.param_name ] ){
            shortcodes_param [param.param_name ] = '';
        }
        shortcodes_param [ param.param_name ] = that.models.models[ model_id ].content;
    } else if( false !== that.getModelattr( model_id , 'css' )
        && param.param_name in final_css
        && typeof shortcodes_param[param.param_name] == "undefined"
    ){
        shortcodes_param[ param.param_name ] = final_css[ param.param_name ].replace('!important' , '');
    } else {
        if( "undefined" == typeof shortcodes_param [param.param_name ] ){
            shortcodes_param [param.param_name ] = '';
        }
        shortcodes_param [ param.param_name ] = that.getModelattr( model_id, param.param_name ) ;
    }
    
    if( typeof param.value != "string" && typeof param.value != "undefined"){
        default_value = Object.keys(param.value)[0];

    }else{
        default_value =  ( typeof param.value != "undefined" ) ? param.value : '' ;
    }
    shortcodes_param [ param.param_name ] = ( shortcodes_param [param.param_name ] !== false ) ? shortcodes_param [param.param_name ].replace( /"/g , '"' ) : default_value ;
    return shortcodes_param;
}

/**
 * Create the html source of each external type
 *
 * @param Object params of shortcodes
 * @param array final css that contains css property Individually and css contains the css string
 * @param Object shortcode params of shortcodes
 *
 * @return array the new form html source and js sources that need to be load
 * @since 5
 */
mBuilder.prototype.load_external_type = function(param , group_data , shortcodes_param){
    var group_html = group_data[0] ,
        group = group_data[1] ,
        group_js = group_data[2];
    var param_class_name = param['type'].replace( /_/g , '-' ).toLowerCase() ;
    group_html[group] +='<label class="mBuilder_element_label active-text-color ' + param_class_name + '-heading">' +
        param.heading  +
        '</label><div class="edit_form_line param-' + param_class_name + '">' ;

    group_html[group] += builder[ shortcode_maps.mBuilder_external_types[param['type']]['callback'] ](  shortcode_maps.mBuilder_external_types[param['type']]['callback'] , param ,  shortcodes_param [ param.param_name ] );
    group_html[group] +='</div>';
    group_js.push ( shortcode_maps.mBuilder_external_types[param['type']]['requiredjs'] );
    return [group_html , group_js];
}

/**
 * Create the html source of text feild controller 
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return object the html source of form panel
 * @since 5
 */
mBuilder.prototype.create_textfield_source = function ( group_data , param , shortcodes_param ) {
    var group_html = group_data[0] ,
        group = group_data[1];
    group_html[group] += '<lable class="mBuilder_element_label active-text-color">' + param.heading + '</lable>' +
        '<div class="edit_form_line"><input type="text" class="simple-textbox wpb_vc_param_value wpb-textinput" placeholder="Put your Text" autocomplete="off" value="' + shortcodes_param [param.param_name ] + '" name="' + param.param_name + '"></div>';
    return group_html;
}

/**
 * Create the html source of hidden feild controller
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return object the html source of form panel
 * @since 5
 */
mBuilder.prototype.create_hidden_source = function ( group_data , param , shortcodes_param ) {
    var group_html = group_data[0] ,
        group = group_data[1];
    group_html[group] +=
        '<input type="hidden" class="wpb_vc_param_value wpb-textinput" value="' + shortcodes_param [ param.param_name ] + '" name="' + param.param_name + '">';
    return group_html ;
}

/**
 * Create the html source of textarea html feild controller
 *
 * @param int model_id it contains the id of shortcode
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 *
 * @return object the html source of form panel
 * @since 5
 */
mBuilder.prototype.create_textarea_html_source = function ( group_data, param, model_id ) {
    var group_html = group_data[0] ,
        group = group_data[1] ,
        that = this ;
    group_html[group] +=
        '<div class="edit_form_line"><textarea id="' + param.param_name + '" name="' + param.param_name + '">' + that.models.models[ model_id ].content + '</textarea></div>';
    return group_html;
}

/**
 * Create the html source of textarea feild controller
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return object the html source of form panel
 * @since 5
 */
mBuilder.prototype.create_textarea_source = function( group_data , param , shortcodes_param ){
    var group_html = group_data[0] ,
        group = group_data[1];
    group_html[group] +=
        '<label class="mBuilder_element_label active-text-color ">' + param.heading + '</label>' +
        '<div class="edit_form_line param-textarea"><textarea placeholder="Enter your Text here..." id="' + param.param_name + '" name="' + param.param_name + '">' + shortcodes_param [ param.param_name ]  + '</textarea></div>';
    return group_html;
}

/**
 * Create the html source of dropdown source feild controller
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return object the html source of form panel
 * @since 5
 */
mBuilder.prototype.create_dropdown_source = function( group_data , param , shortcodes_param ){
    var group_html = group_data[0] ,
        group = group_data[1];
    var default_value =  ( typeof param.value != "undefined" ) ? Object.keys(param.value)[0] : '' ;
    var options = '',
        selected_value = new Array(default_value , param.value[default_value] );
    $.each( param.value , function( option_key , option_value ){
        var option_class =' dropdown-option active-text-color ';
        if ( option_value == shortcodes_param [ param.param_name ]  ) {
            option_class += ' selected-option ';
            selected_value[0] = option_key;
            selected_value[1]= option_value;
        }
        options += '<div data-dropdown-value="' + option_value + '" class="'+ option_class +'">' + option_key + '</div>';
    });
    group_html[group] +=
        '<div class="edit_form_line">' +
        '<div class="mbuilder-dropdown">'+
        '<input name="' + param.param_name + '" data-type="dropdown" type="hidden"  value="'+selected_value[1]+'">'+
        '<div class="dropdown-title">'+
        '<div class="mBuilder_element_label active-text-color">' + param.heading + '</div>' +
        '<span class="mbilder-dropdown-selected inactive-text-color">'+selected_value[0]+'</span>'+
        '<span class="mbuilder-dropdown-arrow px-icon icon-arrow-down6 inactive-text-color "></span>' +
        '</div>'+
        '<div class="dropdown-options setting-background ">' +
        options +
        '</div> '+
        '</div>' +
        '</div>';
    return group_html;
}

/**
 * Create the html source of single image attach feild controller
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return array the new html source of form panel and attachment id
 * @since 5
 */
mBuilder.prototype.create_attach_image_source = function( group_data , param , shortcodes_param ){
    var group_html = group_data[0] ,
        group = group_data[1] ,
        attachment_id =  group_data[2];
    var image_id = parseInt( shortcodes_param [ param.param_name ]  ) ,
        placeholder = '' ;
    if( '' != image_id
        && typeof image_id == "number"
        && 0 != image_id
        && ! isNaN(image_id) ){
        attachment_id.push( image_id );
        placeholder += '<div data-id="' + image_id + '" class="mBuilder-upload-img single has-img change-bg-' + image_id + '" ><span class="remove-img"></span>';
        group_html[group] +=
            '<div class="mBuilder_element_label active-text-color">' + param.heading + '</div>' +
            '<div class="edit_form_line">' +
            placeholder +
            '<input type="text" name="' + param.param_name  + '" value="' + shortcodes_param [ param.param_name ] +'"></div>' +
            '</div>';
    }else{
        placeholder = '<div class="mBuilder-upload-img single"><span class="remove-img mBuilder-hidden"></span><span class="add-image"></span>';
        group_html[group] +=
            '<div class="mBuilder_element_label active-text-color">' + param.heading + '</div>' +
            '<div class="edit_form_line">' +
            placeholder +
            '<input type="text" name="' + param.param_name  + '" value="' + shortcodes_param [ param.param_name ] +'"></div>' +
            '</div>';
    }
    return [ group_html , attachment_id ] ;
}

/**
 * Create the html source of multi image attach feild controller
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return array the new html source of form panel and attachment id
 * @since 5
 */
mBuilder.prototype.create_attach_images_source = function( group_data , param , shortcodes_param ){
    var group_html = group_data[0] ,
        group = group_data[1] ,
        attachment_id =  group_data[2];
    var images_id = ( "undefined" != typeof shortcodes_param [ param.param_name ] && "" != shortcodes_param [ param.param_name ] ) ? shortcodes_param [ param.param_name ].split(',') : [] ,
        placeholder = '';
    if( images_id.length ){
        for( var count in images_id ){
            if( 'length' !== images_id[ count ]){
                attachment_id.push( images_id[ count ] );
                placeholder += '<div data-id="' + images_id[ count ] + '" class="mBuilder-upload-img multi has-img change-bg-' + images_id[count] + '"><span class="remove-img "><span class="px-icon icon-cancel2"></span> </span></div>';
            }
        }
        placeholder += '<div class="mBuilder-upload-img multi"><span class="remove-img mBuilder-hidden "><span class="px-icon icon-cancel2"></span></span></div>';
    }else{
        placeholder = '<div class="mBuilder-upload-img multi"><span class="remove-img mBuilder-hidden "><span class="px-icon icon-cancel2"></span></span></div>';
    }
    group_html[group] +=
        '<div class="mBuilder_element_label active-text-color ">' + param.heading + '</div>' +
        '<div class="edit_form_line mBuilder-upload-imgs">' +
        placeholder +
        '<input  type="text" name="' + param.param_name  + '" value="' + shortcodes_param [ param.param_name ] +'" class="mBuilder-hidden"></div>' ;
    return [ group_html , attachment_id ];
}

/**
 * Create the html source of google font feild controller
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return Object the new html source of form panel
 * @since 5
 */
mBuilder.prototype.create_google_fonts_source = function ( group_data , param , shortcodes_param ) {
    var group_html = group_data[0] ,
        group = group_data[1]  ,
        that = this ;
    var input_value = shortcodes_param [ param.param_name ];
    var value = decodeURIComponent( input_value ) ;
    value = value.replace( "font_family:" , '' );
    value = value.replace( "font_style:" , '' );
    var font_family = value.split(':');
    font_family = font_family[0];
    var font_style =  value.split('|');
    font_style = font_style[1];
    value = {
        font_family: font_family ,
        font_style: font_style
    };
    var fonts = shortcode_maps.google_gonts ,
        font_key = 0 ,
        options = '' ,
        option_classes = ' dropdown-option active-text-color '
    selected_value = [];
    $.each( fonts , function( fkey , font_data ){
        var select = '' ;
        if( value.font_family.toLowerCase() == font_data.font_family.toLowerCase() ){
            font_key = fkey ;
            option_classes += 'selected-option';
            selected_value[0] = font_data.font_family +  ':' + font_data.font_styles;
            selected_value[1] = font_data.font_family;
        }else{
            option_classes = ' dropdown-option active-text-color '
        }
        options +=
            '<div data-font-id="' + fkey + '" data-dropdown-value="' + font_data.font_family +  ':' + font_data.font_styles + '" data-font="' + font_data.font_family  +
            '" class="' + option_classes + '">' + font_data.font_family + '</div>';
    });
    font_style_options = that.load_font_styles( font_key , value['font_style'] );
    group_html[ group ] +=
        '<div class="edit_form_line  mBuilder-google-font-picker">'+
        '<div class="mbuilder-dropdown google-fonts-families" data-input="' + param['param_name'] + '">' +
        '<input name="google-fonts-families" data-type="dropdown" type="hidden"  value="'+selected_value[0]+'">'+
        '<div class="dropdown-title">'+
        '<div class="mBuilder_element_label active-text-color">Font Family</div>' +
        '<span class="mbilder-dropdown-selected inactive-text-color">'+selected_value[1]+'</span>'+
        '<span class="mbuilder-dropdown-arrow px-icon icon-arrow-down6 inactive-text-color "></span>' +
        '</div>'+
        '<div class="dropdown-options setting-background ">' +
        options +
        '</div> '+
        '</div>' +
        '<div class="mbuilder-dropdown google-fonts-styles" data-input="' + param['param_name'] + '">' +
        '<input name="google-fonts-styles" data-type="dropdown" type="hidden"  value="'+font_style_options[1][0]+'">'+
        '<div class="dropdown-title">'+
        '<div class="mBuilder_element_label active-text-color">Font Style</div>' +
        '<span class="mbilder-dropdown-selected inactive-text-color">'+font_style_options[1][1]+'</span>'+
        '<span class="mbuilder-dropdown-arrow px-icon icon-arrow-down6 inactive-text-color "></span>' +
        '</div>'+
        '<div class="dropdown-options setting-background ">' +
        font_style_options[0] +
        '</div> '+
        '</div>' +
        '<input type="text" name="' + param['param_name'] + '" value="' + input_value + '" class="mBuilder-hidden"/>' +
        '</div>';
    return group_html;
}

/**
 * Check if the cuurent shortcode setting panel open preventy from re open it again
 *
 * @param int id it contains the id of shortcode
 *
 * @return Object the new html source of form panel
 * @since 5
 */
mBuilder.prototype.is_shortcode_panel_open = function( id ) {
    if (id == this.selected_shortcode_id) {
        return true;
    }
    this.selected_shortcode_id = id;
    return false;
}

/**
 * Build setting panel form and inputs to edit shortcodes visually
 *
 * @param model_id int shorcode model id
 *
 * @return void
 * @since 5
 */

mBuilder.prototype.form_builder = function( model_id ){

    var that = this ;
    that.set_title_slider( model_id );
    // Get groups of params
    var model_type = that.models.models[ model_id ]['type'];
    var params = that.get_shortcode_param( model_type );
    var form = that.get_groups_param( params ) ;
    
    // Generate VC column shortcode css attributes
    var css_attrs = that.generate_css_attr(model_type , model_id );
    var final_css = css_attrs[0] ;
   // var css = css_attrs[1] ;

    form = that.reorder_groups(form);
    var group_html = {};
    var group_js = [] ;
    var form_html = '<form id="mBuilder-form" autocomplete="off"><div id="mBuilderTabs"><ul class="setting-panel-header-color">';
    var attachment_id = [] ;
    $.each(form, function(group, params) {
        form_html += '<li><a href="#mBuilder' +  group.replace( /\s/g , '' ) + '">' + group + '</a></li>' ;
        $.each( params , function( key , param ){
            // Continue if param is inline color picker
            if( ( param.type == 'md_vc_colorpicker' && param.inline_color_picker == true ) || param.type == 'md_vc_separator' ){
                return true;
            }
            group_html = that.set_custom_classes(param , group_html , group);
            var shortcodes_param = that.create_dependecy( param , final_css , model_id);
            if( typeof shortcode_maps.mBuilder_external_types[param.type] != "undefined"
                && typeof builder[ shortcode_maps.mBuilder_external_types[param['type']]['callback'] ] == "function"  ){
                var load_external_result = that.load_external_type( param , [ group_html , group , group_js ] , shortcodes_param );
                group_js = load_external_result[1];
                group_html = load_external_result[0];
            }else{
                var param_result = that.create_param_source( param, [ group_html , group , attachment_id , model_id ], shortcodes_param );
                attachment_id = param_result[1];
                group_html = param_result[0];
                // Add inline color picker filed
                group_html =  that.add_inline_color_picker( [params , param , model_id], group_html, group);
            }
            group_html[ group ] += '</div>';
        });
    });
    form_html = that.create_form_source( form_html , group_html , group_js );
    that.get_attachment_url( attachment_id );
    return form_html;

};

/**
 * Call the function of params and create the html source
 *
 * @param array group_data contains the html group of shortcode and the name of shortcodes tab
 * @param Object params of shortcodes
 * @param Object shortcode params of shortcodes
 *
 * @return array the new html source of form panel and attachment id
 * @since 5
 */
mBuilder.prototype.create_param_source = function ( param, group_data , shortcodes_param) {
    var group_html = group_data[0] ,
        group = group_data[1] ,
        attachment_id = group_data[2] ,
        model_id = group_data[3] ,
        that = this;
    switch( param.type ){
        case 'textfield':
            group_html = that.create_textfield_source( [ group_html , group  ] , param , shortcodes_param );
            break;
        case 'hidden':
            group_html = that.create_hidden_source( [ group_html , group  ] , param , shortcodes_param );
            break;
        case 'textarea_html':
            group_html = that.create_textarea_html_source( [ group_html , group  ], param , model_id );
            break;
        case 'textarea':
            group_html = that.create_textarea_source( [ group_html , group  ] , param , shortcodes_param );
            break;
        case 'dropdown':
            group_html = that.create_dropdown_source( [ group_html , group  ] , param , shortcodes_param );
            break;
        case 'attach_image':
            var result = that.create_attach_image_source( [ group_html , group , attachment_id ] , param , shortcodes_param );
            group_html = result[0];
            attachment_id = result[1];
            break;
        case 'attach_images':
            var result = that.create_attach_images_source( [ group_html , group , attachment_id ] , param , shortcodes_param );
            group_html = result[0];
            attachment_id = result[1];
            break;
        case 'google_fonts':
            group_html = that.create_google_fonts_source( [ group_html , group ] , param , shortcodes_param );
        default:
            break;
    }
    var output = [ group_html , attachment_id ];
    return output;
}

/**
 * Create the html source of single image attach feild controller
 *
 * @param Object the form html source
 * @param Object the form html source
 * @param array group_js the list of java script url that should be to load
 *
 * @return string the html source of form
 * @since 5
 */
mBuilder.prototype.create_form_source = function( form_html , group_html , group_js){
    form_html += "</ul>" ;
    group_js = _.uniq( group_js );
    $.each( group_html  , function( key , html){
        form_html += '<div id="mBuilder' +   key.replace(/\s/g , '') + '" class="mBuilder-edit-el">' +  html + "</div>" ;
    });
    form_html += '<script src="' + shortcode_maps.spectrum.js + '"></script>' +
        '<link rel="stylesheet" href="' + shortcode_maps.spectrum.css + '">'  +
        '<script src="' + shortcode_maps.nouislider.js + '"></script>' +
        '<link rel="stylesheet" href="' + shortcode_maps.nouislider.css + '">';

    for ( var js in group_js ){
        if( group_js[js] != "length"){
            form_html += '<script src="' + group_js[js] + '"></script>';
        }
    }
    form_html += '</div></form>';
    return form_html;
}

mBuilder.prototype.add_inline_color_picker = function( params_data , group_html, group ){
    var params = params_data[0] ,
        param = params_data[1],
        model_id = params_data[2],
        that = this;
    if(typeof param.color_picker != 'undefined'){
        var color_picker_param = params.filter(function( obj ) {
            return obj.param_name == param.color_picker;
        });
        color_picker_param = color_picker_param[0];
        if( typeof color_picker_param != 'undefined' ){
            color_picker_param.opacity = ( typeof color_picker_param.opacity == 'undefined' ) ? false : color_picker_param.opacity;
            group_html[group] += '<input opacity="'+color_picker_param.opacity+'" type="text" value="'+ that.getModelattr( model_id, color_picker_param.param_name ) +'" name="'+ color_picker_param.param_name +'" class="wpb_vc_param_value wpb-textinput '+ color_picker_param.type +'_field md_vc_colorpicker" />';
        }
    }
    return group_html;
}

mBuilder.prototype.pixflow_vc_base64_text_field = function ( temp_name , settings, value ){
    var that = this;
    if(value.indexOf('pixflow_base64') !== -1){
        value = value.replace('pixflow_base64','');
        value = that.base64_decode(value);
    }
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        param_name : settings['param_name'] ,
        base64_value : that.base64_encode( value )
    } ) ;
                    return output;
};

mBuilder.prototype.pixflow_vc_iconpicker_field = function( temp_name , settings, value ){
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        param_name : settings['param_name'] ,
        value : value ,
        type: settings['type']
    } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_description_field = function (temp_name , settings, value ){
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        param_name : settings['param_name'] ,
        value : settings['value'] ,
    } ) ;
    output = output.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
    return output;
}

mBuilder.prototype.pixflow_group_title_field = function (temp_name , settings, value ){
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        param_name : settings['param_name'] ,
        title : settings['heading']
    } ) ;
    //output = output.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
    return output;
}

mBuilder.prototype.pixflow_vc_datepicker_field = function( temp_name , settings, value  ){
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        param_name : settings['param_name'] ,
        value : value ,
        type: settings['type']
    } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_base64_textarea_field = function ( temp_name , settings, value  ) {
    var that = this ;
    if(value.indexOf('pixflow_base64') !== -1){
        value = value.replace('pixflow_base64','');
        value = that.base64_decode( value );
    }
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        param_name : settings['param_name'] ,
        value : value ,
        base64_value: that.base64_encode( value )
    } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_multiselect_field = function ( temp_name , settings, value ) {
    var that = this ,
        items = ( typeof settings['items'] != "undefined" && typeof settings['items'] == "object" ) ? settings['items'] : [] ,
        defaults = ( typeof settings['defaults'] != "undefined"  && settings['defaults'] == 'all') ? items : [] ,
        id = that.uniqid() ,
        length = items.length ,
        template = wp.template( 'mbuilder-field-type-' + temp_name );
    value = ( value != '') ? value : defaults.join(',');
    var values = value.trim().split(',') ;
    values = values.map( Function.prototype.call, String.prototype.trim );
    var output =  template( {
        id: id ,
        value : value ,
        param_name : settings['param_name'] ,
        type : settings['type'] ,
        values: values ,
        length: length ,
        items: items
    } ) ;
    return output;

}

mBuilder.prototype.pixflow_vc_url_field = function ( temp_name , settings, value  ) {
    var that = this ;
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        id: that.uniqid() ,
        value : value ,
        param_name : settings['param_name'] ,
        base64_value: that.base64_encode( value )
    } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_colorpicker_field = function ( temp_name , settings, value ) {
    var that = this ;
    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        id: that.uniqid() ,
        param_name : settings['param_name'] ,
        value : value ,
        opacity: ( typeof settings['opacity'] != "undefined" && settings['opacity'] === true ) ? true : false
    } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_checkbox_field = function ( temp_name , settings, value ) {
    var that = this,
        template = wp.template( 'mbuilder-field-type-' + temp_name ),
        checked = (value.toLocaleLowerCase() == 'yes')?'checked="checked"':'',
        output =  template( {
            id: that.uniqid() ,
            param_name : settings['param_name'] ,
            value : value.toLocaleLowerCase() ,
            type: settings['type'],
            checked: checked
        } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_slider_field = function ( temp_name , settings , value ) {
    var that = this ;
    var defaults_setting = {};
    var defaults = {
        'min': '0',
        'max': '100',
        'prefix': '%',
        'step': '1',
        'decimal': '0'
    };
    defaults_setting = ( typeof settings['defaultSetting'] != "undefined" && settings['defaultSetting'] != ''  ) ? settings['defaultSetting'] : defaults ;
    if( typeof value != "undefined" ){
        if( parseInt( defaults_setting['step'] ) < 1 ){
            value = ( parseFloat(value) === '' ) ? defaults_setting['min'] : parseFloat(value) ;
            value = that.number_format( value , 1 );
        }else{
            value = ( parseInt( value ) === '' ) ? defaults_setting['min'] : parseInt( value ) ;
        }
    }else{
        value = 0 ;
    }

    if ( isNaN( value ) == true ){
        value = 0;
    }
    var template = wp.template( 'mbuilder-field-type-' + temp_name ),
        output =  template( {
            id: that.uniqid() ,
            param_name : settings['param_name'] ,
            value : value ,
            type: settings['type'],
            min: defaults_setting['min'] ,
            max: defaults_setting['max'] ,
            step: defaults_setting['step'] ,
            prefix: defaults_setting['prefix']
        } ) ;
    return output;
}

mBuilder.prototype.pixflow_vc_gradientcolorpicker_field = function ( temp_name , settings , value  ) {
    var that = this ;
    if(value.indexOf('pixflow_base64') !== -1){
        value = value.replace('pixflow_base64','');
        value = that.base64_decode(value);
    }
    value = value.replace('``', '"');
    value = value.replace('\'', '"');
    var defaults = {
        'color1': '#fff'
        ,'color2': '#000'
        ,'color1Pos': '0'
        ,'color2Pos': '100'
        ,'angle': '0'
    };
    var default_color = ( typeof settings['defaultColor'] != "undefined" && settings['defaultColor'] != ''  ) ? settings['defaultColor'] : defaults;
    if(typeof value != 'undefined' && value != ''){
        try {
            value = JSON.parse( value );
        } catch (e) {
            value = default_color;
        }
    }else{
        value = default_color;
    }

    var template = wp.template( 'mbuilder-field-type-' + temp_name );
    var output =  template( {
        id: that.uniqid()
        , param_name : settings['param_name']
        , json_value : JSON.stringify(value)
        , type: settings['type']
        , color1_pos: value.color1Pos
        , color2_pos: value.color2Pos
        , color1: value.color1
        , color2: value.color2
        , angle: value.angle
    } ) ;
    return output;
}


/**
 * @summary formats a number with grouped thousands.
 *
 * @param {int} Required. The number to be formatted.
 * @param {int} Optional. Specifies how many decimals. If this parameter is set, the number will be formatted with a dot (.) as decimal point.
 * @param {string} Optional. Specifies what string to use for decimal point
 * @param {string} Optional. Specifies what string to use for thousands separator. Only the first character of separator is used.
 *
 *@return {int} The formatted number
 *
 * @since 4.5
 */
mBuilder.prototype.number_format = function( number, decimals, dec_point, thousands_sep) {
    var number  = number*1;
    var str = number.toFixed( decimals ? decimals : 0 ).toString().split('.');
    var parts = [];
    for ( var i=str[0].length; i>0; i-=3 ) {
        parts.unshift( str[0].substring(Math.max(0,i-3),i) );
    }
    str[0] = parts.join( thousands_sep?thousands_sep : ',' );
    return str.join( dec_point ? dec_point : '.' );
}

mBuilder.prototype.base64_decode = function (str) {
    return decodeURIComponent(Array.prototype.map.call(atob(str), function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
};

mBuilder.prototype.base64_encode = function (str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function (match, p1) {
        return String.fromCharCode('0x' + p1);
    }));
};

mBuilder.prototype.uniqid = function() {

    this.length = 8;
    this.timestamp = +new Date;

    var _getRandom_int = function( min, max ) {
        return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
    }

    this.generate = function() {
        var ts = this.timestamp.toString();
        var parts = ts.split( "" ).reverse();
        var id = "";

        for( var i = 0; i < this.length; ++i ) {
            var index = _getRandom_int( 0, parts.length - 1 );
            id += parts[index];
        }

        return id;
    }

    return this.generate();
}

mBuilder.prototype.get_attachment_url = function ( images_id ){
    var that = this ;
    var request_count = 0 ;
    wp.media.attachment( images_id[ request_count ] ).fetch().then(function () {
        if(typeof wp.media.attachment( images_id[ request_count ] ).attributes.sizes != 'undefined' && typeof wp.media.attachment( images_id[ request_count ] ).attributes.sizes.thumbnail != 'undefined'){
            var img_url = wp.media.attachment( images_id[ request_count ] ).attributes.sizes.thumbnail.url;
        } else {
            var img_url = wp.media.attachment( images_id[ request_count ] ).get('url');
        }

        $('.change-bg-' + images_id[ request_count ]).css({
            backgroundImage : 'url(' +  img_url +')'
        });
        request_count++;
        if ( typeof images_id[request_count] != "undefined" ) {
            that.get_attachment_url( images_id.slice( 1 , images_id.length ) );
        }
    });
}

mBuilder.prototype.load_font_styles = function( key , value ){
    var fonts = shortcode_maps.google_gonts ;
    var font_key = key;
    var value = value;
    var font_styles = fonts[font_key];
    font_styles = font_styles.font_types.split(',');
    var options = '' ,
        option_classes = ' dropdown-option active-text-color ',
        selected_value = [];

    for( var count in font_styles ){
        if ( value.toLowerCase() == font_styles[ count ].toLowerCase() ){
            option_classes += 'selected-option'
            selected_value[0] = font_styles[ count ];
            var temp = font_styles[ count ].split(':');
            selected_value[1] = temp[0];
        }else{
            option_classes = ' dropdown-option active-text-color ';
        }

        options += '<div data-dropdown-value="' + font_styles[ count ] + '" class="' + option_classes + '">';
        var title = font_styles[ count ].split(':');
        options += title[0] + '</div>';

    }
    return [options,selected_value];
}
// builder instance
var builder = null;
var $ = jQuery;
$(function () {
    builder = new mBuilder();

    $('[data-mbuilder-el] , .vc_row').each(function () {
        var type = ( $(this).hasClass('vc_row') ) ? 'vc_row' : $(this).attr('data-mbuilder-el');
        if (typeof builder[type + "Shortcode"] == 'function') {
            builder[type + 'Shortcode']($(this));
        }
    });
});

$(document).on('mouseenter', '.vc_row', function () {
    var mainPadding = parseInt($('main').css('padding-top')),
        top = mainPadding,
        num = 0,
        firstRow = $('main .vc_row').first(),
        $firstRowControls = firstRow.find('> .wrap + .mBuilder_row_controls'),
        $headerTop = $('header[class *= "top"]'),
        headerHeight = $headerTop.height()+3;

    firstRow.addClass('first-row');
    if (!$(this).closest('.first-row').length
    //|| firstRow.hasClass('vertical-aligned')
    ){
        return;
    }
    
    if($('header').is('.left') || $('header').is('.right')){
        $firstRowControls.css('top', '0');
    }else {

        if (!$(this).hasClass('vc_inner')) {

            if (mainPadding >= headerHeight + 45) {
                //content is not under header now check if row has space to view its settings or not
                if (!$firstRowControls.hasClass('flag')) {
                    var number =  ($(this).hasClass('sloped_row') || $(this).hasClass('row_video')) ? '2px':'-45px';
                    $firstRowControls.css('top', parseInt( number ) - 4 + 'px' );
                    $firstRowControls.addClass('flag');
                }
            } else {
                //row has enough space to view its setting
                // check if it is under header or not
                var headerTop = parseInt($headerTop.css('top'));
                headerHeight += headerTop;
                num = (headerHeight + 45 <= mainPadding ) ? - 45 : headerHeight - mainPadding;

                if(num < 0)
                    num = 2;

                if (!$firstRowControls.hasClass('flag')) {
                    $firstRowControls.css({'top': parseInt( num ) - 4 + 'px' });
                    $firstRowControls.addClass('flag')
                }
            }
        } else {
            var $innerRow = $(this),
                $innerRowControls = $innerRow.find('.mBuilder_row_controls'),
                rowTop = $innerRowControls.closest('.first-row').find('> .mBuilder_row_controls').position().top;

            if ($innerRowControls.offset().top <= rowTop){
                $innerRowControls.css({'top': parseInt( rowTop ) - 4 + 'px' });

            }
        }
    }
});

mBuilder.prototype.top_page_space = function(){
    var $header_top = $( 'header[class *= "top"]' ),
        header_height = $header_top.height()+3,
        header_top_space = parseInt( $header_top.css( 'top' ) );

    return header_height + header_top_space;
};


$(document).on('mouseleave', '.vc_row ', function () {

    var firstRow = $('main .vc_row').first(),
        firstRowControls = firstRow.find('> .wrap + .mBuilder_row_controls');

    if($(this).hasClass('vc_inner')){
        if (! $(this).closest('.first-row').length){
            return;
        }
    }else if (! $(this).hasClass('first-row')){
        return;
    }
    firstRow.removeClass('first-row');

    if (firstRowControls.hasClass('flag')) {
        firstRowControls.removeClass('flag')
    }
});

$(document).on('click','.pixflow-add-element-button',function(e){
    e.stopPropagation();
    builder.open_pixflow_shortcode_panel();
    if ( $('.setting-panel-wrapper').length > 0 ){
        builder.mBuilder_closeShortcodeSetting();
    }
});

window.onbeforeunload = function (e) {
    e = e || window.event;
    if($('body').hasClass('changed')){
        if (e) {
            e.returnValue = 'Sure?';
        }
        // For Safari
        return 'Sure?';
    }
};

mBuilder.prototype.vc_column_resize = function (obj) {
    var that = this;
    obj.find('.mBuilder-vc_column,.mBuilder-vc_column_inner').each(function(){
        that.column_left_space($(this),that);
        that.column_right_space($(this),that);
    });
}

mBuilder.prototype.get_model_id = function ($obj) {
    return $obj.attr('data-mbuilder-id');
}

mBuilder.prototype.column_left_space = function ($obj,that) {

    var $left_space_element = $obj.find('> .column-left-space'),
        $column = $obj.find('> .vc_column_container > .vc_column-inner');
    $left_space_element.width(parseInt($column.css('padding-left')));
    if (! $left_space_element.find('.column-resize-val').length ){
        $left_space_element.append('<div class="column-resize-val"><span class="column-resize-value" >Spacing: '+$column.css('padding-left')+'</span></div>');
    }
    this.set_column_resize($left_space_element,that,this.get_model_id($obj));
}

mBuilder.prototype.column_right_space = function ($obj,that) {
    var $right_space_element = $obj.find('> .column-right-space'),
        $column = $obj.find('> .vc_column_container > .vc_column-inner');
    $right_space_element.width(parseInt($column.css('padding-right')));
    if (! $right_space_element.find('.column-resize-val').length ){
        $right_space_element.append('<div class="column-resize-val"><span class="column-resize-value" >Spacing: '+$column.css('padding-right')+'</span></div>');
    }
    this.set_column_resize($right_space_element,that,this.get_model_id($obj));
}

mBuilder.prototype.set_column_resize = function ($space_element,that,id){
    var $column = $space_element.parent().find('> .vc_column_container > .vc_column-inner');
    //check if it is left space or right
    var padding = ($space_element.hasClass('column-left-space'))?'padding-left':'padding-right';
    $space_element.resizable({
        maxWidth : 500,
        minWidth : 0,
        handles: (padding== 'padding-left')?'e':'w' ,
        create: function(){
            var colum_space_width = $(this).width();
            if( colum_space_width <= 15 ){
                $(this).addClass('defult_space_width');
            }else{
                $(this).removeClass('defult_space_width');
            }
        } ,
        start: function () {
            $(this).addClass('start-resizing');
            $(this).removeClass('defult_space_width');
        },
        resize : function (event, ui) {
            $(this).css('left','');
            $column.css(padding,'');
            var column_style = $column.attr('style') + ';' + padding + ':'+$(this).width()+'px !important;';
            $column.attr('style',column_style);
            if($(this).find('> .column-resize-val').length){
                $(this).find('> .column-resize-val .column-resize-value').text('Spacing: '+ $(this).width()+'px');

                    if ($(window).width() <= 1366){
                        if (!$(this).find('> .column-resize-val  em').length){
                            $(this).find('> .column-resize-val .column-resize-value').after('<em>Space controller has no effect in this screen size</em>');
                        }
                    }

            }else{
                $(this).append('<div class="column-resize-val"><span class="column-resize-value" >Spacing: '+ $(this).width() +'</span></div>');
                if ($(window).width() <= 1366){
                    if (!$(this).find('> .column-resize-val  em').length){
                        $(this).find('> .column-resize-val .column-resize-value').after('<em>Space controller has no effect in this screen size</em>');
                    }
                }
            }
        },
        stop : function (event,ui) {
            var colum_space_width = $(this).width();
            var model_css = that.getModelattr(id,'css');
            $(this).find('> .column-resize-val em').remove();
            if (model_css){
                var re = new RegExp(padding+':(.*?);', 'gm');
                if ((re.exec(model_css)) !== null) {
                    var find = new RegExp(padding+":(.*?);", 'gm');
                    var replace = padding+':' + $(this).width() + 'px!important;';
                    model_css = model_css.replace(find, replace);
                } else {
                    model_css = model_css.replace("}",'');
                    model_css = model_css + padding + ':' + $(this).width() + 'px!important;}';
                }

            }else{
                var css_style = $column.attr('class');
                css_style = css_style.replace(/ /g,'.');
                model_css = '.'+css_style+'{'+padding+':' + $(this).width() + 'px!important;}'
            }

            that.setModelattr(id,'css',model_css);
            that.setModelattr(id,padding.replace('-' , '_'),$(this).width())
            if( colum_space_width <= 15 ){
                $(this).addClass('defult_space_width');
            }else{
                $(this).removeClass('defult_space_width');
            }
            $(this).removeClass('start-resizing');
            var $isotopes = $column.find('.isotope');
            if($isotopes.length){
                $isotopes.isotope('layout')
            }
        }
    });
}

mBuilder.prototype.vc_row_resize = function () {
    var that = this;
    $('.vc_row').each(function () {
        var $element_object = $(this),
            id = $element_object.attr('data-mbuilder-id');
        that.vc_column_resize($(this));
        if (!$(this).hasClass('fit-to-height')) {
            that.row_shortcode_top_resize($element_object, id);
            that.row_shortcode_bottom_resize($element_object, id);
        }
    });
}

mBuilder.prototype.row_shortcode_top_resize = function($element_object , id ){
   var row_padding =  parseInt(  $element_object.css('padding-top') ) ,
       resize_area =  $element_object.find('> .row-top-space');
    resize_area.css('height' , + row_padding + 'px' );
    if(resize_area.css('height' )== 0){
    }
    var resize_info = {
        resize_area : resize_area ,
        dir : 'top'
    }
    this.make_element_resizable( id , resize_info,  $element_object );
}

mBuilder.prototype.row_shortcode_bottom_resize = function( $element_object , id ){
    var row_padding =  parseInt(  $element_object.css('padding-bottom') ) ,
        resize_area =  $element_object.find('> .row-bottom-space'),
        resize_s =  $element_object.find('> .row-bottom-space .ui-resizable-s');
    resize_s.css('height' , row_padding )
    resize_area.css('height' , + row_padding + 'px' );
    var resize_info = {
        resize_area : resize_area ,
        dir : 'bottom'
    }
    this.make_element_resizable( id , resize_info ,  $element_object );
}

mBuilder.prototype.make_element_resizable = function( id , resize_info ,  $element_object ){
    var that = this;
    resize_info.resize_area.resizable({
        maxHeight: 800,
        minHeight: 0,
        handles: 's' ,
        create: function(){
            var space_height = $(this).height();
            if( ! $(this).find('.row-resize-val').length ) {
                $(this).append('<div class="row-resize-val"><span class="row-resize-value">Spacing: ' + parseInt( space_height ) + 'px</span></div>');
            }
            if( space_height <= 15 ){
                $(this).addClass('defult-space-height');
            }else{
                $(this).removeClass('defult-space-height');
            }
        },
        start: function () {
           $(this).addClass('start-resizing');
           $(this).removeClass('defult-space-height');
           // $('.ui-resizable-s').css('height' , $(this).height());
        },
        resize : function () {
            var space_height = $(this).height();
            $(this).css('top' , '');
            $element_object.css( 'padding-' + resize_info.dir , space_height +'px');
            // $('.ui-resizable-s').css('height' , $(this).height());
            if($(this).find('> .row-resize-val').length){
                $(this).find('> .row-resize-val .row-resize-value').text('spacing: '+ $(this).height() +'px');
            }else{
                $(this).append('<div class="row-resize-val"><span class="row-resize-value">Spacing: '+ space_height  +'px</span></div>');
            }
        } ,
        stop: function(){
            var space_height = $(this).height();
            if($element_object.hasClass('vc_inner')){
                id = $element_object.closest('.mBuilder-vc_row_inner').attr('data-mbuilder-id');
                that.setModelattr( id , 'inner_row_padding_'+ resize_info.dir , $(this).height() );
            }else{
                that.setModelattr( id , 'row_padding_'+ resize_info.dir , $(this).height() );
            }
            if( space_height <= 15 ){
                $(this).addClass('defult-space-height');
            }else{
                $(this).removeClass('defult-space-height');
            }
            $(this).removeClass('start-resizing');
        }
    });
}


