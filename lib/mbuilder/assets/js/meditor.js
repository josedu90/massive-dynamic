/**
 * *********************
 * * mBuilder Live Text Editor*
 * *********************
 * It is added as a part of Massive Dynamic since V4.0.1 and designed to work with text shortcodes. Enjoy Editing ;)
 *
 * @summary meditor provides some functionality for editing text shortcodes in builder.
 *
 * @author PixFlow
 *
 * @version 1.0.0
 * @requires jQuery, Backbone
 *
 * @class
 * @classdesc initialize all of the editor features.
 */

(function($) {
    'use strict';
    var models = {},
        views = {},
        select_positions = {
            'start': 0 ,
            'end': 0
        } ,
        collections = {};

    models.Editor = Backbone.Model;

    views.Editor = Backbone.View.extend({

        events: {
            'click .meditor-bold': 'toggle_bold',
            'click .meditor-italic': 'toggle_italic',
            'click .meditor-underline': 'toggle_underline',
            'click .meditor-nlist' : 'toggle_nlist',
            'click .meditor-blist' : 'toggle_blist',
            'click .meditor-ralign': 'toggle_ralign',
            'click .meditor-lalign': 'toggle_lalign',
            'click .meditor-calign': 'toggle_calign',
            'click .meditor-jalign': 'toggle_jalign',
            'click .meditor-indent': 'toggle_indent',
            'click .meditor-outdent': 'toggle_outdent',
            'click .meditor-heading': 'toggle_heading',
            'click .meditor-redo': 'toggle_redo',
            'click .meditor-undo': 'toggle_undo',
            'click .font-size': 'change_font_size',
            'keyup #font-size' : 'insert_font_size',
            'click .meditor-font-family': 'change_font_family',
            'click .submenu-meditor-font-family': 'change_font_family',
            'keyup #meditor-font-family' : 'insert_font_family',
            'click .letter-space': 'change_letter_space',
            'keyup #letter-space' : 'insert_letter_space',
            'click .line-height': 'change_line_height',
            'keyup #line-height' : 'insert_line_height',
            'click .meditor-font-color': 'change_font_color',
            'click .open-extra-option' : 'toggle_open_url_panel',
            'click .close-panel' : 'close_url_panel',
            'click .link': 'change_link',
            'keyup .link-input' : 'insert_link_url',
            'keydown .meditor-input': 'validate_input',
            'click .active-item' : 'input_focus',
            'click .mdb-insert-link' : 'link_input_focus',
            'click .meditor-animation' :'open_animation_setting'




},

        initialize: function() {
            this.$el = $(this.el);

            // Model attribute event listeners:
            _.bindAll(this, 'change_buttons' , 'change_editable');
            this.model.bind('change:buttons', this.change_buttons);
            this.model.bind('change:editable', this.change_editable);

            // Init Routines:
            this.change_editable();


        },


        init_color_picker: function() {
            var that = this;
            var color_picker = new ColorPicker(document.getElementById('meditor-color-picker'), {
                onUpdate: function(rgb) {
                    var color = "rgb(" + rgb[0] + ", " + rgb[1] + ", " + rgb[2] + ")";
                    $('.meditor-defult-font-color').css('background',"rgb(" + rgb[0] + ", " + rgb[1] + ", " + rgb[2] + ")");
                    that.toggle_color(color);
                }
            });

            $('#color-picker-input').on('keyup',function(e){
                if(e.keyCode == 13 ) {
                    that.toggle_color($(this).val());
                }
            });
        },

        change_editable: function() {
            this.set_button_class();
            // Im assuming that Ill add more functionality here
        },

        set_button_class: function() {
            // check the button class of the element being edited and set the associated buttons on the model
            var button_class = this.model.get('editable').attr('data-button-class') || 'default';
            this.model.set({
                buttons: meditor.config.button_classes[button_class]
            });
        },

        change_buttons: function() {
            var obj = this ;
            // render the buttons into the editor-panel
            var panel = this.$el;
            var $html = '' ;
            this.$el.empty();
            var buttons = this.model.get('buttons');
            // hide editor panel if there are no buttons in it and exit early
            if ( _.isEmpty(buttons) ) { $(this.el).hide(); return; }

                _.each(buttons, function(item){
                    var func_name = 'create_'+item.class.replace(/-/g , '_');
                    $html = '';
                    if(typeof obj[func_name] == "function"){
                        $html = obj[func_name](item);
                    }
                    panel.append($html);
                });

        },

        auto_complete: function(search_val){
            search_val = search_val.toLowerCase();
            var goal_font_array= [] ;
            var goal_var_array = [];
            var index  =  binary_index_of.call(font_name_list, search_val);
            var current_index = index -1;
            if(index == -1){
                return {"font_array":goal_font_array,"font_var": goal_var_array};
            }
            var increment = 0;
            for(index; index <= font_name_list_len; index++){
                increment++;
                if(increment < 5 && font_name_list[index].substr(0 , search_val.length).toLowerCase() == search_val){
                    goal_font_array.push(font_name_list[index]);
                    goal_var_array.push(font_var_list[index]);
                }else{
                    break ;
                }
            }
            increment = 0;
            for(current_index; current_index >= 0 ; current_index--){
                increment++;
                if(increment < 5 && font_name_list[current_index].substr(0 , search_val.length).toLowerCase() == search_val){
                    goal_font_array.push(font_name_list[current_index]);
                    goal_var_array.push(font_var_list[current_index]);
                }else{
                    break ;
                }
            }
            return {"font_array":goal_font_array,"font_var": goal_var_array};
        },

        change_font_color:function(){
            var focus_element = document.getElementById( 'meditor_focus' );
            if(null != focus_element){
                store_selection(focus_element);
            }
            this.keep_text_selected();
            var $color_picker = $('#meditor-color-picker');
            if(!$('.color-picker-container').length){
                // Init Font Color Picker
                this.init_color_picker();
            }
            if($color_picker.hasClass('open')){
                this.close_color_picker($color_picker);
            }else{
                this.open_color_picker($color_picker);
            }
        },

        open_color_picker:function($color_picker){
            var color = $('.meditor-defult-font-color').css('background-color');
            color = this.rgb2hex(color);
            $('.color-picker-container .picker-container .canvas-container input').val(color).keyup();
            $color_picker.addClass('open');
        },

        close_color_picker:function($color_picker){
            $color_picker.removeClass('open');
        },

        create_animation_controller:function () {
            var source = '<div class="live-text-animation" >'+
                '<button class=" meditor-animation">'+
                '<span class="text-animation-controller mdb-animation"><i class="path1"></i><i class="path2"></i><i class="path3"></i></span>'+
                '</button>'+
                '</div>';
            return source;

        },

        create_text_alignment:function (item) {

            var options = {
                toolbar_icon:'mdb-align-left',
                value:item.data,
                data_value:{
                    'justifyleft':{
                        'toolbar_icon':'mdb-align-left',
                        'value':'left_align',
                        'meditor_class':'meditor-lalign'
                    },
                    'justifycenter':{
                        'toolbar_icon':'mdb-align-center',
                        'value':'center_align',
                        'meditor_class':'meditor-calign'
                    },
                    'justifyright':{
                        'toolbar_icon':'mdb-align-right',
                        'value':'right_align',
                        'meditor_class':'meditor-ralign'
                    },
                    'justifyfull':{
                        'toolbar_icon':'mdb-justify',
                        'value':'full_align',
                        'meditor_class':'meditor-jalign'
                    },

                },
                value_type:'button',
                has_input:false
            };
            var source = '<div class="group-style-controller2 with-border '+item.class+'">';
            source += this.create_dropdown(options);
            source += '</div>';
            
            return source;

        },

        create_font_family_controller:function(item){
            var options = {
                toolbar_icon:'meditor-defult-text',
                value:['Open Sans','Montserrat','Playfair Display','Poppins','Roboto','Raleway','Oswald','Lato'],
                data_value:['Open Sans','Montserrat','Playfair Display','Poppins','Roboto','Raleway','Oswald','Lato'],
                value_type:'text',
                text:'Open Sans',
                has_input:true ,
                has_placeholder:'Google font',
                meditor_class: 'meditor-font-family' ,
                has_submenu: true ,
                submenu_value:[
                    [
                        {'text':'300'},
                        {'text':'300italic'},
                        {'text':'regular'},
                        {'text':'italic'},
                        {'text':'600'},
                        {'text':'600italic'},
                        {'text':'700'},
                        {'text':'800italic'},
                        {'text':'800'},
                    ] ,
                    [
                        {'text':'regular'},
                        {'text':'700'},
                    ] ,
                    [
                        {'text':'regular'},
                        {'text':'italic'},
                        {'text':'700'},
                        {'text':'700italic'},
                        {'text':'900'},
                        {'text':'900italic'},
                    ] ,
                    [
                        {'text':'regular'},
                        {'text':'300'},
                        {'text':'500'},
                        {'text':'600'},
                        {'text':'700'},
                    ] ,
                    [
                        {'text':'100'},
                        {'text':'100italic'},
                        {'text':'300'},
                        {'text':'300italic'},
                        {'text':'regular'},
                        {'text':'italic'},
                        {'text':'500'},
                        {'text':'500italic'},
                        {'text':'600'},
                        {'text':'600italic'},
                        {'text':'700'},
                        {'text':'700italic'},
                        {'text':'800'},
                        {'text':'800italic'},
                        {'text':'900'},
                        {'text':'900italic'},
                    ],
                    [
                        {'text':'100'},
                        {'text':'200'},
                        {'text':'300'},
                        {'text':'regular'},
                        {'text':'500'},
                        {'text':'600'},
                        {'text':'700'},
                        {'text':'800'},
                        {'text':'900'},
                    ] ,
                    [
                        {'text':'300'},
                        {'text':'regular'},
                        {'text':'700'},
                    ] ,
                    [
                        {'text':'100'},
                        {'text':'100italic'},
                        {'text':'300'},
                        {'text':'300italic'},
                        {'text':'regular'},
                        {'text':'italic'},
                        {'text':'700'},
                        {'text':'700italic'},
                        {'text':'900'},
                        {'text':'900italic'},
                    ]
                ]
            };
            var source = '<div class="with-border ' + item.class + ( (item.have_input) ? ' have-input' : '' ) + '" >' +
                    this.create_dropdown(options)+
                    '</div>';
            return source;
        },

        create_font_color:function(item){
            var source = '<div class="with-border font-color-controller' + ( (item.have_input) ? ' have-input' : '' ) + '" >' +
                '<button class=" meditor-' + item.class + '">'+
                '<span class="meditor-defult-font-color" ></span>'+
                '</button>'+
                '<div id="meditor-color-picker" ></div>'+
                '</div>';
            return source;
        },

        create_bold:function(item){
            var source = '<div class="bold-controller" >' +
                '<button class=" meditor-' + item.class + '">'+
                '<span class="meditor-defult-bold mdb-bold"></span>'+
                '</button>'+
                '</div>';
            return source;
        },

        create_italic:function(item){
            var source = '<div class="italic-controller"  >' +
                '<button class=" meditor-' + item.class + '">'+
                '<span class="meditor-defult-italic mdb-italic" ></span>'+
                '</button>'+
                '</div>';
            return source;
        },

        create_underline:function(item){
            var source = '<div class="with-border underline-controller" >' +
                '<button class=" meditor-' + item.class + '">'+
                '<span class="meditor-defult-underline mdb-underline"></span>'+
                '</button>'+
                '</div>';
            return source;
        },

        create_heading:function(item){
            var options = {
                toolbar_icon:"mdb-heading-1",
                value:['mdb-heading-1','mdb-heading-2','mdb-heading-3','mdb-heading-4','mdb-heading-5','mdb-heading-6','mdb-heading-p'],
                data_value:[1,2,3,4,5,6,7],
                value_type:'icon',
                has_input:false ,
                meditor_class: 'meditor-heading'
            };
            var source = '<div class="heading-controller with-border ' + item.class + '" >' ;
                source += this.create_dropdown(options);
                source += '</div>';
            return source;
        },

        create_line_height:function (item) {
            var options = {
                toolbar_icon:"mdb-line-height",
                value:[1,1.2,1.5,1.7,2],
                data_value:[1,1.2,1.5,1.7,2],
                value_type:'text',
                has_input:true,
                input_type :'number',
                meditor_class:'line-height'
            };
            var source = '<div class="with-border line-height-controller exception ' + ( (item.have_input) ? ' have-input' : '' ) +  '" >' ;
                source += this.create_dropdown(options);
                source += '</div>';
            return source;
        },

        create_font_size:function (item) {
            var options = {
                toolbar_icon:"",
                item_unit:"px",
                value:[6,8,9,10,11,12,14,16,18,20,22,24,26,28,30],
                data_value:[6,8,9,10,11,12,14,16,18,20,22,24,26,28,30],
                value_type:'text',
                has_input:true,
                input_type :'number',
                meditor_class:'font-size'
            };

            var source = '<div class="font-size-controller' + ( (item.have_input) ? ' have-input' : '' ) + '">';
            source += this.create_dropdown(options);
            source += '</div>';
            return source;
        },

        create_letter_space:function(item){
            var options = {
                toolbar_icon:"mdb-letter-spacing",
                value:[1,2,3,4,5],
                data_value:[1,2,3,4,5],
                value_type:'text',
                has_input:true,
                meditor_class:'letter-space'
            };

            var source = '<div class="letter-space-controller with-border exception ' + ( (item.have_input) ? ' have-input' : '' ) + ' ">';
            source += this.create_dropdown(options);
            source += '</div>';
            return source;
        },

        create_group_style:function (item) {
            var options = {
                toolbar_icon:"mdb-unorder-list",
                value:item.data,
                data_value:{
                    'orderedlist':{
                        'toolbar_icon':'mdb-order-list',
                        'value':'ol',
                        'meditor_class':'meditor-nlist'
                    },
                    'unorderedlist':{
                        'toolbar_icon':'mdb-unorder-list',
                        'value':'ul',
                        'meditor_class':'meditor-blist'
                    },
                    'indent':{
                        'toolbar_icon':'mdb-increase-indent',
                        'value':'indent',
                        'meditor_class':'meditor-indent'
                    },
                    'outdent':{
                        'toolbar_icon':'mdb-decrease-indent',
                        'value':'outdent',
                        'meditor_class':'meditor-outdent'
                    },

                },
                value_type:'button',
                has_input:false
            };
            var source = '<div class="group-style-controller1 with-border '+item.class+'">';
            source += this.create_dropdown(options);
            source += '</div>';

            return source;

        },

        create_dropdown : function (dropdown_options) {
            var text = dropdown_options.text?dropdown_options.text:'';
            var html = '<button class="active-item" >';
                html += '<span class="text-controller-icon '+dropdown_options.toolbar_icon+'">'+text+'</span>';
                if ( typeof dropdown_options.item_unit != 'undefined' ){
                    html += '<span class="unit">'+dropdown_options.item_unit+'</span>';
                }else{
                    html += '<span class="mdb-down-arow"></span>';
                }
            html += '</button>';
            html+='<div class="dropdown-items '+dropdown_options.value_type+'">';
            if (dropdown_options.has_input && dropdown_options.has_placeholder){
                html += '<input id="'+dropdown_options.meditor_class +'" class="meditor-input" data_input_type="'+dropdown_options.input_type+'" type="text" placeholder="'+dropdown_options.has_placeholder +'">';
                html += '<span class="icon-search3 meditor-icon-search"></span>';
            }
            else if(dropdown_options.has_input)
            {
                html += '<input id="'+dropdown_options.meditor_class +'" class="meditor-input" data_input_type="'+dropdown_options.input_type+'" type="text" >';

            }

            html += this.create_dropdown_options(dropdown_options);
            html += '</div>';

            this.open_dropdown();
            this.active_dropdown_item();

            return html;
        },

        update_dropdown : function ( dropdown_options ) {
            var dropdown_items = $( '.' + dropdown_options.item_class ).find( '.dropdown-items' );
            dropdown_items.find( 'div.meditor-font-family' ).remove();
            dropdown_items.append( this.create_dropdown_options( dropdown_options ) );
        },

        create_dropdown_options: function(dropdown_options){
            var index,
                html='';
            if('button' != dropdown_options.value_type) {
                for(index=0; index < dropdown_options.value.length; index++) {
                    if (dropdown_options.value_type == 'icon') {
                        html += '<div class="' + dropdown_options.meditor_class + ' ' + dropdown_options.value[index] + '" data-format="' + dropdown_options.data_value[index] + '">';
                    } else {
                        if( dropdown_options.data_value[index].length < 17){
                            html += '<div class="' + dropdown_options.meditor_class + '" data-format="' + dropdown_options.data_value[index] + '">'  +'<span class="text-variant-icon" ' + ' data-format="' + dropdown_options.data_value[index] + '">'+ dropdown_options.value[index] +'</span>';
                            +'<span class="text-variant-icon">'+ dropdown_options.value[index] +'</span>'
                        }else{
                            html += '<div class="' + dropdown_options.meditor_class + '" data-format="' + dropdown_options.data_value[index] +  '" title="' + dropdown_options.data_value[index] + '">'  +'<span class="text-variant-icon"' + ' data-format="' + dropdown_options.data_value[index] + '">'+ dropdown_options.value[index] +'</span>' ;
                        }


                    }
                    if(dropdown_options.has_submenu == true){
                        html += this.create_submenu(dropdown_options , index);
                    }
                    html += '</div>';
                }
            }else{
                for(var index in dropdown_options.data_value){
                    html += '<div class="'+dropdown_options.data_value[index].meditor_class+ ' ' + dropdown_options.data_value[index].toolbar_icon + '" data-format="' +  dropdown_options.data_value[index].index + '"></div>';
                }
            }
            return html;
        },

        create_submenu: function(dropdown_options , index) {
           var html = '<div class="submenu" >';
            for(var font_var in dropdown_options.submenu_value[index] ){
                var font_weight;
                if('regular'== dropdown_options.submenu_value[index][font_var].text
                    || 'normal' == dropdown_options.submenu_value[index][font_var].text){
                    font_weight = 400;
                }else{
                    font_weight = dropdown_options.submenu_value[index][font_var].text;
                }
                html += '<div class=" submenu-' + dropdown_options.meditor_class + ' ' + dropdown_options.value[index] +
                    '" data-format="' + dropdown_options.data_value[index] + '" data-font-var="' + font_weight + '" >' +
                    dropdown_options.submenu_value[index][font_var].text +
                        '</div>' ;
            }
            html += '</div>';

            return html ;
        },

        open_dropdown:function() {
            var that = this;
            $('body').off('click','.active-item');
            $('body').on('click','.active-item',function(){
                var focus_element = document.getElementById( 'meditor_focus' );
                if(null != focus_element){
                    store_selection(focus_element);
                }
                if($(this).closest('.have-input').length){
                    that.keep_text_selected();
                }
                if($(this).next('.dropdown-items').hasClass('open')){
                    var open_class = '';
                }else{
                    var open_class = 'open';
                }
                that.close_dropdown();
                $(this).next('.dropdown-items').addClass(open_class);
            });
        },

        close_dropdown :function () {
            $('.active-item + .dropdown-items , .open-link-option').removeClass('open show-panel');
        },

        active_dropdown_item : function(){
            var that = this;
            $('body').off('click','.dropdown-items > div');
            $('body').on('click','.dropdown-items > div',function(){
                var $dropdown_holder = $(this).closest('.dropdown-items');
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                var item_class = $(this).attr('class');
                var active_class ;
                var classes =  item_class.split(' ');
                for (var index = 0; index < classes.length; index++){
                    if ( classes[index].indexOf('mdb') == 0 ){
                         active_class = classes[index];
                    }
                }

                if($dropdown_holder.hasClass('icon') || $dropdown_holder.hasClass('button')){
                    $dropdown_holder.prev().find('.text-controller-icon').attr('class','').addClass('text-controller-icon '+active_class);
                }else{
                    if(!($dropdown_holder.parent().hasClass('exception'))){
                        $dropdown_holder.prev().find('.text-controller-icon').text($(this).text());
                    }
                }
                that.close_dropdown();
            });
        },
        input_focus:function (event) {
            var target = event.target || event.srcElement;
            setTimeout(function(){$(target).closest('.active-item').siblings('.dropdown-items').find( '.meditor-input' ).focus();},10);
        },
        link_input_focus:function (event) {
            var target = event.target || event.srcElement;
            setTimeout(function(){$(target).closest('.open-extra-option').siblings('.open-link-option').find( '.link-input' ).focus();},10);
        },


        validate_input : function (event) {
            if ($(event.target).attr('data_input_type') != 'number') return;

            if ((event.keyCode >= 65 && event.keyCode <= 90)){
                event.preventDefault();
            }
        },

        create_undo_redo_manger :function(item){
            var source = '<div class="' + item.class + '" >' +
                this.create_redo(item) +
                this.create_undo(item)+
                '</div>';
            return source;
        },

        create_redo:function(item){
            var source = '<div class="redo with-border">' +
                '<button class="meditor-redo">' +
                    '<span class="mdb-redo"></span>' +
                    '</button>'+
                    '</div>';
            return source;
        },
        
        create_undo:function(item){
            var source = '<div class="undo">' +
                '<button class="meditor-undo">' +
                '<span class="mdb-undo"></span>' +
                '</button>'+
                '</div>';
            return source;
        },
        link_panel:function() {

            if ($('.keep-text-selected').length) {
                var top = $('.keep-text-selected').offset().top,
                    height = $('.keep-text-selected').height(),
                    left = $('.keep-text-selected').offset().left,
                    top_link = $('.insert-link').offset().top,
                   left_link = $('.insert-link').offset().left;
                $('.open-link-option').css({'top': (top + height)-top_link , 'left': left -left_link });
            }
            else{
                $('.open-link-option').css({'top': '37px' , 'left': '-148px' });
            }
        },

        create_link : function(item) {
            var source = '<div class="insert-' + item.class + ' link-controller with-border" >' +
                    '<button class="open-extra-option"><span class="mdb-insert-link" ></span> </button>' +
                    '<div class="open-link-option" >' +
                    '<div class="meditor-link-input"> <input class="link-input" type="url" placeholder="URl" /> </div>' +
                    '<div><span class="mdb-check ' + item.class + '" ></span> </div>' +
                    '<div><span class="mdb-close close-panel"></span> </div>' +
                    '<div class="open-link-extra" > ' +
                    '<div class="rounded">' +
                    '<input type="checkbox" id="rounded" class="open-link-new-tab"  name="check"/>' +
                    ' <label for="rounded"></label>'+
                    '</div>' +
                    '<label for="rounded">'+
                    ' <p>Open in new window</p>'+
                    '</label>'+
                    '</div>' +
                    '</div>'+
                '</div>';
            return source;
        },
        open_animation_setting:function (e) {
            e.stopPropagation();
            $('#meditor_focus').closest('.mBuilder-md_live_text').find(".sc-control").click();
            $('.meditor-panel').css('display' , 'none');
        },

        close_url_panel: function(){
            $('.link-input').val("") ;
            $('.link').click();
            this.remove_text_selection();
            this.set_selection_range(document.getElementById('meditor_focus') , select_positions.start , select_positions.end );
        },

        toggle_open_url_panel:function(){
            $('.active-item + .dropdown-items').removeClass('open');
            var focus_element = document.getElementById( 'meditor_focus' );
            if(null != focus_element){
                store_selection(focus_element);
            }
            this.keep_text_selected();
            this.set_selection_range(document.getElementById('meditor_focus') , select_positions.start , select_positions.end );
            $('.open-link-option').toggleClass('show-panel');
            $('.link-input').val('');
            this.link_panel();
        },

        change_font_size: function(event,font_size){

            this.set_selection_range(document.getElementById('meditor_focus'), select_positions.start, select_positions.end);
            var size = (typeof font_size != "undefined") ? font_size : $(event.target).attr('data-format');
            this.update_font_size_controller([true , size]);
            var html_object = this.get_selection_html();
            var $selection_html = $('<div>').html(html_object.html);
            var html_child = $selection_html.find( '*' );
            if( html_child.length ) {
				html_child.css({'font-size': size + 'px'});
            }else{
                $selection_html.html('<span style="font-size: ' + size + 'px' + '">' + $selection_html.html() + "</span>");
            }

            var html = $selection_html.html();
            this.replace_selection_with_html(html);
            this.remove_extra_li();
            this.remove_extra_space();
        },

        insert_font_size : function(e){
            if(e.keyCode == 13 ){
                //check number
                var value = ($.isNumeric($(e.target).val()))?$(e.target).val():14 ;
                this.change_font_size(e,$(e.target).val());
                $(e.target).focus();
            }
        },

        change_letter_space : function(e,letter_space_size){

            var size =(typeof letter_space_size == "undefined")? $(e.target).attr('data-format'):letter_space_size ,
            focus_el = document.getElementById('meditor_focus') ;
            focus_el.style.letterSpacing=size+'px';
            focus_el.setAttribute('data-letterspace',size);
            $(focus_el).find("h1,h2,h3,h4,h5,h6,p,span").css('letter-spacing',size+"px");
            this.update_letter_spacing_controller([true , size]);
            var model_id = $('#meditor_focus').closest('.mBuilder-element').attr('data-mbuilder-id');
            builder.setModelattr(model_id , 'meditor_letter_spacing' , size);
        },

        insert_letter_space : function(e){
            if(e.keyCode == 13 ){
                this.change_letter_space(e,$(e.target).val());
            }
        },

        change_line_height : function(e,line_height_size){

            var size = (typeof line_height_size == "undefined")?$(e.target).attr('data-format'):line_height_size ,
            focus_el = document.getElementById('meditor_focus') ;
            focus_el.style.lineHeight=size+'em';
            focus_el.setAttribute('data-lineheight',size);
            $(focus_el).find("h1,h2,h3,h4,h5,h6,p,span").css('line-height',size+"em");
            this.update_line_height_controller([true , size]);
            var model_id = $('#meditor_focus').closest('.mBuilder-element').attr('data-mbuilder-id');
            builder.setModelattr(model_id , 'meditor_line_height' , size);

        },

        insert_line_height : function(e){
            if(e.keyCode == 13 ){
                this.change_line_height(e,$(e.target).val());
            }
        },

        change_font_family: function(e,font_name){
            e.stopPropagation();
            var name = (typeof font_name != "undefined") ? font_name : $(e.target).attr('data-format');
            var variant = $(e.target).attr('data-font-var');
            var font_var = (typeof variant != 'undefined') ? variant : 'regular';
            this.set_selection_range(document.getElementById('meditor_focus') , select_positions.start , select_positions.end );
            this.load_font(name , font_var );
            this.update_font_family_controller([true , name]);
            document.execCommand('StyleWithCSS', false, true);
            document.execCommand("fontName", false, name);
            document.execCommand('StyleWithCSS', false,false);
            this.set_font_variant(name,variant);
        },

        set_font_variant : function(name,variant){
            var html_object = this.get_selection_html();
            var $selection_html = $('<div>').html(html_object.html);
            var html_child = $selection_html.find( '*' );
            var font_style = ( typeof variant != "undefined" ) ? variant.replace(/[0-9]/g, '') : '';
            font_style = ( font_style != '' ) ? font_style : 'normal';
            if( html_child.length) {
				html_child.css({'font-weight': parseInt(variant) ,'font-family':name , 'font-style':font_style}).attr('data-font-weight' , variant);
            }else{
                $selection_html.html('<span data-font-weight="' + variant + '" style="font-style:' + font_style + ';font-family: ' + name + '; font-weight: ' + parseInt(variant) + '">' + $selection_html.html() + '</span>');
            }
            var html = $selection_html.html();
            this.replace_selection_with_html(html);
            this.remove_extra_li();
            this.remove_extra_space();
        },


        remove_extra_li: function(){
           setTimeout(function(){
               $('#meditor_focus').find('li').each(function () {
                   if($(this).text().trim() == ''){
                       $(this).remove();
                   }
               });
           } , 100);
        },

        remove_extra_space: function(){
            setTimeout(function(){
                $('#meditor_focus *').each(function() {
                    if($(this).text().trim() == ''){
                        $(this).remove();
                    }
                });
            } , 100);
        },

        insert_font_family : function(e){
            var value = $(e.target).val();
            if(e.keyCode == 13 ){
                //check number
                this.change_font_family(e,value);
                return;
            }

            var fonts = this.auto_complete(value);
            var options = {
                item_class:'font-family-controller',
                value:fonts.font_array,
                data_value:fonts.font_array,
                value_type:'text',
                meditor_class: 'meditor-font-family' ,
                has_submenu: true ,
                submenu_value:fonts.font_var
            };
            $('.font-family-controller').html(this.update_dropdown(options));

        },

        load_font:function (font_name , font_var) {
            WebFont.load({
                google: {
                    families: [ font_name + ':' + font_var ]
                }
            });
        },

        change_link: function () {
            var url_add = $('.link-input').val();
            if( url_add.length === 0){
                document.execCommand("unlink", false, false);
                document.execCommand('underline', false, null);
            }else{
                if( url_add.search('http://') == -1
                    && url_add.search('https://') == -1
                    && url_add.search('mailto') == -1 ){
                    url_add = 'http://' + url_add ;
                }
                this.set_selection_range(document.getElementById('meditor_focus') , select_positions.start , select_positions.end );
                var selected = this.get_selection_html();
                var html_object = this.get_selection_html();
                var $selection_html = $('<div>').html(html_object.html);
                selected = selected.html;
                if(selected.search('</a>') != -1 ){
                    document.execCommand("unlink", false , true);
                    selected = this.get_selection_html().html;
                }
                if($('.open-link-new-tab').is(":checked")){
                    $selection_html.html("<u><a href='"+url_add+"' target='_blank'>"+selected+"</a></u>");
                }else{
                    $selection_html.html("<u><a href='"+url_add+"'>"+selected+"</a></u>");
                }
                var html = $selection_html.html();
                this.replace_selection_with_html(html);
            }
            this.remove_extra_li();
            this.close_dropdown();
            this.remove_text_selection();
            this.remove_extra_space();
        },
        insert_link_url : function(e){
            if(e.keyCode == 13 ){
                //check link
                this.change_link(e,$(e.target).val());
            }
        },

        toggle_bold: function(e) {
            e.preventDefault();
            this.update_bold_controller(true);
            document.execCommand('bold', false, null);
        },

        toggle_italic: function(e){
            e.preventDefault();
            this.update_italic_controller(true);
            document.execCommand('italic', false, null);
        },

        toggle_nlist: function(e){
            e.preventDefault();
            this.update_list_controller([true , 'nlist']);
            document.execCommand('insertorderedlist',false,'');
        },

        toggle_blist: function(e){
            e.preventDefault();
            this.update_list_controller([true , 'blist']);
            document.execCommand('insertunorderedlist',false,'');
        },

        toggle_underline: function(e){
            e.preventDefault();
            var link_exists = false;
            this.update_underline_controller(true);

             document.execCommand('underline', false, null);
        },

        toggle_ralign: function(e){
          e.preventDefault();
          this.update_alignment_controller([true , 'ralign']);
          document.execCommand("JustifyRight", false, null);
        },

        toggle_lalign: function(e){
            e.preventDefault();
            this.update_alignment_controller([true , 'lalign']);
            document.execCommand("JustifyLeft", false, null);
        },

        toggle_color:function(color){
            this.set_selection_range(document.getElementById('meditor_focus') , select_positions.start , select_positions.end );
            var html_object = this.get_selection_html();
            var $selection_html = $('<div>').html(html_object.html);
            color = this.rgb2hex(color);
            var html_child = $selection_html.find( '*' );

            if( html_child.length ){
				html_child.css({'color': color});
            }else{
                $selection_html.html("<span style='color: " + color + ";'>" + $selection_html.html() + "</span>");
            }

            var html = $selection_html.html();
            this.replace_selection_with_html(html);
            this.remove_extra_li();
            this.remove_extra_space();
        },

        add_input_event: function(id){
            var that = this;
            document.getElementById(id).addEventListener('mouseup' , function () {
                that.change_font_size();
            });
        },

        toggle_calign: function(e){
            e.preventDefault();
            this.update_alignment_controller([true , 'calign']);
            document.execCommand("justifyCenter", false, null);
        },

        toggle_heading: function (e) {
            var format = $(e.target).attr('data-format');
            document.execCommand('formatBlock', false, (format == 7 ) ? 'P' : 'H' + format);
        },

        toggle_jalign: function(e){
            e.preventDefault();
            this.update_alignment_controller([true , 'jalign']);
            document.execCommand("justifyFull", false, null);
        },

        toggle_indent: function(e){
            e.preventDefault();
            document.execCommand("indent" , false , null);
        },

        keep_text_selected:function(){
            document.execCommand("BackColor", false, "#cbbe8e");
            $('#meditor_focus [style*="background-color: rgb(203, 190, 142)"]').attr('class' , 'keep-text-selected');
        },
        
        remove_text_selection:function(){

            select_positions = {
                'start': 0 ,
                'end':0
            }
            $('#meditor_focus [style*="background-color: rgb(203, 190, 142)"]').removeClass('keep-text-selected').css('background-color' , '');
        },
        
        toggle_outdent: function(e){
            e.preventDefault();
            document.execCommand("outdent" , false , null);
        },

        toggle_redo: function(e){
            e.preventDefault();
            document.execCommand("redo", false , null);
        },

        toggle_undo: function(e){
            e.preventDefault();
            document.execCommand("undo", false , null);
        },

        set_selection_range: function(el, start, end){
            if(start == 0 && end == 0){
                return false;
            }
            if (document.createRange && window.getSelection) {
                var range = document.createRange();
                range.selectNodeContents(el);
                var text_nodes = this.get_text_nodes_in(el);
                var found_start = false;
                var char_count = 0, end_char_count;

                for (var i = 0, text_node; text_node = text_nodes[i++];) {
                    end_char_count = char_count + text_node.length;
                    if (!found_start && start >= char_count && (start < end_char_count || (start == end_char_count && i <= text_nodes.length))) {
                        range.setStart(text_node, start - char_count);
                        found_start = true;
                    }
                    if (found_start && end <= end_char_count) {
                        range.setEnd(text_node, end - char_count);
                        break;
                    }
                    char_count = end_char_count;
                }

                var sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
            } else if (document.selection && document.body.createTextRange) {
                var text_range = document.body.createTextRange();
                text_range.moveToElementText(el);
                text_range.collapse(true);
                text_range.moveEnd("character", end);
                text_range.moveStart("character", start);
                text_range.select();
            }
        },

        get_text_nodes_in: function( node ){
            var text_nodes = [];
            if (node.nodeType == 3) {
                text_nodes.push(node);
            } else {
                var children = node.childNodes;
                for (var i = 0, len = children.length; i < len; ++i) {
                    text_nodes.push.apply(text_nodes, this.get_text_nodes_in(children[i]));
                }
            }
            return text_nodes;
        } ,

        hex: function(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        } ,

        rgb2hex: function (rgb) {
            if (/^#[0-9A-F]{6}$/i.test(rgb)) return rgb;
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            return "#" + this.hex(rgb[1]) + this.hex(rgb[2]) + this.hex(rgb[3]);
        },

        update_bold_controller: function( change , select_part ){
            if(change == true){
                $('.meditor-bold').toggleClass('me-active');
                return ;
            }

            if($(select_part).css('font-weight') == 'bold'){
                $('.meditor-bold').addClass('me-active');
            }else{
                $('.meditor-bold').removeClass('me-active');
            }
        },

        update_italic_controller: function( change , select_part ){
            if(change == true){
                $('.meditor-italic').toggleClass('me-active');
                return ;
            }
            if($(select_part).css('font-style') == 'italic'){
                $('.meditor-italic').addClass('me-active');
            }else{
                $('.meditor-italic').removeClass('me-active');
            }
        },

        update_underline_controller: function( change , select_part ){
            if(change == true){
                $('.meditor-underline').toggleClass('me-active');
                return ;
            }

            if($(select_part).css('text-decoration-line') == 'underline'){
                $('.meditor-underline').addClass('me-active');
            }else if($(select_part).css('text-decoration-line') == 'none'){
                if($(select_part).parents('span').css('text-decoration-line') == 'underline'){
                    $('.meditor-underline').addClass('me-active');
                }else{
                    $('.meditor-underline').removeClass('me-active');
                }
            }

        },

        update_list_controller: function( change , select_part ){
            if(change[0] == true){
                $('.meditor-' + change[1]).toggleClass('me-active');
                return ;
            }
            if($(select_part).parents('ol').length > 0){
                $('.meditor-nlist').addClass('me-active');
            }else{
                $('.meditor-nlist').removeClass('me-active');
            }

            if($(select_part).parents('ul').length > 0){
                $('.meditor-blist').addClass('me-active');
            }else{
                $('.meditor-blist').removeClass('me-active');
            }
        },

        update_alignment_controller: function( change , select_part ){
            if(change[0] == true){
                $('.meditor-' + change[1]).toggleClass('me-active');
                return ;
            }

            if($(select_part).css('text-align') == 'center'){
                $('.meditor-panel .group-style-controller2 .text-controller-icon').removeClass('mdb-align-left mdb-align-right mdb-justify').addClass('mdb-align-center');
                $('.meditor-calign').addClass('me-active');
            }else{
                $('.meditor-calign').removeClass('me-active');
            }

            if($(select_part).css('text-align') == 'right'){
                $('.meditor-panel .group-style-controller2 .text-controller-icon').removeClass('mdb-align-left mdb-align-center mdb-justify').addClass('mdb-align-right');
                $('.meditor-ralign').addClass('me-active');
            }else{
                $('.meditor-ralign').removeClass('me-active');
            }

            if($(select_part).css('text-align') == 'left' || $(select_part).css('text-align') == 'start'){
                $('.meditor-panel .group-style-controller2 .text-controller-icon').removeClass('mdb-align-center  mdb-align-right mdb-justify').addClass('mdb-align-left');
                $('.meditor-lalign').addClass('me-active');
            }else{
                $('.meditor-lalign').removeClass('me-active');
            }

            if($(select_part).css('text-align') == 'justify'){
                $('.meditor-panel .group-style-controller2 .text-controller-icon').removeClass('mdb-align-left mdb-align-center mdb-align-right').addClass('mdb-justify');
                $('.meditor-jalign').addClass('me-active');
            }else{
                $('.meditor-jalign').removeClass('me-active');
            }

        },

        update_font_size_controller: function (change , select_part ) {
            var font_size = (change[0] == false) ? $(select_part).css('font-size').replace('px' , '') :  change[1];
            $('.font-size-controller .active-item .text-controller-icon').text(parseInt(font_size));
        },

        update_letter_spacing_controller: function (change , select_part ){
            var letter_spacing = (change[0] == false) ? $(select_part).css('letter-spacing').replace('px' , '') :  change[1];
             $('.letter-space-controller .dropdown-items .meditor-input').val(letter_spacing);
        },

        update_group_style_controller:function(change , select_part) {

            if('UL' == $(select_part).parent()[0].tagName){
                $('.group-style > button .text-controller-icon').attr('class','').addClass('mdb-unorder-list me_active active')
            }else if('OL' == $(select_part).parent()[0].tagName){
                $('.group-style > button .text-controller-icon').attr('class','').addClass('mdb-order-list me_active active')
            }
        },

        update_heading_controller:function(change , select_part){

            var headings = ['H1','H2','H3','H4','H5','H6','P'];
            var check_parent_element = true;
            for(var index = 0 ; index < headings.length ;index++){

                if($(select_part).closest('p').length == 1  ){
                    $('.heading > button .text-controller-icon').attr('class','').addClass('text-controller-icon mdb-heading-p' );
                    check_parent_element = false;
                    break;
                }
                if($(select_part).closest(headings[index]).length ){
                    $('.heading > button .text-controller-icon').attr('class','').addClass('text-controller-icon mdb-heading-'+ (index*1+1) );
                    check_parent_element = false;
                    break;
                }
            }
            if(check_parent_element == true){
                $('.heading > button .text-controller-icon').attr('class','').addClass('text-controller-icon mdb-heading-p' );
                return;
            }

        },

        update_line_height_controller: function (change , select_part ){
            if(change[0] == false){
                var size = ($(select_part).css('line-height') == 'normal') ? 0 : $(select_part).css('line-height').replace('px' , ''),
                font_size = $(select_part).css('font-size').replace('px' , ''),
                 line_height =  size/font_size;
            }else{
                var line_height =  change[1];
            }
            $('.line-height-controller .dropdown-items .meditor-input').val(line_height);
        },

        update_font_family_controller: function (change , select_part ){
            var font_family = (change[0] == false) ? $(select_part).css('font-family').trim() :  change[1];
            $('.font-family').val(font_family);
            font_family = font_family.replace(/"/g, '');
            $('.meditor-defult-text').text(font_family);

        },

        update_color_controller: function (change , select_part ){
            var color = (change[0] == false) ? $(select_part).css('color') :  change[1];
            try{
                $('.meditor-defult-font-color').css('background-color',this.rgb2hex(color));
            }catch (e){}

        },

        update_controller: function (event,elem) {
            if(!elem){
                var select_part = document.elementFromPoint(event.clientX, event.clientY);
                var focus_element = document.getElementById('meditor_focus');
                if( null != focus_element
                    && false == $.contains( focus_element , select_part ) ){
                    return ;
                }
            }else{
                var select_part = elem;
            }
            this.update_bold_controller( false , select_part );
            this.update_italic_controller( false , select_part );
            this.update_underline_controller( false , select_part );
            this.update_list_controller( [false] , select_part );
            this.update_alignment_controller( [false] , select_part );
            this.update_font_size_controller( [false] , select_part );
            this.update_letter_spacing_controller( [false] , select_part );
            this.update_line_height_controller( [false] , select_part );
            this.update_font_family_controller( [false] , select_part );
            this.update_color_controller( [false] , select_part );
            this.update_heading_controller( [false] , select_part );
            this.update_group_style_controller( [false] , select_part );
        },

        // Run when a text editor active
        focused: function ($el) {
            // Trick for fix reset undo/redo stack of each shortcode on activation
            $el.prepend('<b id="meditor-empty-bold"></b>');
            $('#meditor-empty-bold').remove();
        },

        // Get HTML of selected text
        get_selection_html: function(){
            var html = "";
            if (typeof window.getSelection != "undefined") {
                var selected = window.getSelection();
                if (selected.rangeCount) {
                    var container = document.createElement("div");
                    for (var i = 0, len = selected.rangeCount; i < len; ++i) {
                        container.appendChild(selected.getRangeAt(i).cloneContents());
                    }
                    html = container.innerHTML;
                    var parent_el = selected.getRangeAt(0).commonAncestorContainer;
                    if (parent_el.nodeType != 1) {
                        parent_el = parent_el.parentNode;
                    }
                }
            } else if (typeof document.selection != "undefined") {
                if (document.selection.type == "Text") {
                    html = document.selection.createRange().htmlText;
                    var parent_el = sel.createRange().parentElement();
                }
            }
            var result = {'html':html,'parent':parent_el};
            return result;
        },

        // Replace HTML with Selected text
        replace_selection_with_html : function(html){
            var range;
            if (window.getSelection && window.getSelection().getRangeAt) {
                range = window.getSelection().getRangeAt(0);
                range.deleteContents();
                var div = document.createElement("div");
                div.innerHTML = html;
                var frag = document.createDocumentFragment(), child;
                while ((child = div.firstChild)) {
                    frag.appendChild(child);
                }
                range.insertNode(frag);
            } else if (document.selection && document.selection.createRange) {
                range = document.selection.createRange();
                html = (node.nodeType == 3) ? node.data : node.outerHTML;
                range.pasteHTML(html);
            }
        }

    });


    var meditor = {
        config : {
            // selector to specify editable elements
            selector: '.meditor',
            default_html: '<span style="font-size:20px;">Click here to edit.</span>',
            default_text: 'Click here to edit.',
            // Named sets of buttons to be specified on the editable element
            // in the markup as "data-button-class"
            button_classes: {
                'default': {
                    'save' : [
                        {
                            "name": "save" ,
                            "type" : "button" ,
                            "tooltip": "save"
                        }
                    ]
                },
                'content': {
                    'bold' :
                        {
                            "name": "bold" ,
                            "type": "button" ,
                            "tooltip": "bold" ,
                            "class": "bold",
                            "icon" : "B"
                        }
                    ,
                    'italic' :
                        {
                            "name": "italic" ,
                            "type": "button" ,
                            "tooltip": "italic" ,
                            "class": "italic",
                            "icon" : "I"
                        }
                    ,
                    'underline' :
                        {
                            "name": "underline" ,
                            "type": "button" ,
                            "tooltip": "underline" ,
                            "class": "underline",
                            "icon" : "U"

                        }
                    ,
                    'group-style':
                        {
                            "name": "group style" ,
                            "type": "dropdown" ,
                            "class": "group-style" ,
                            "data" : {
                                "orderedlist" :{
                                    "name": "Numbered List" ,
                                    "type": "button" ,
                                    "class": "nlist" ,
                                    "icon" : "OL"
                                } ,
                                "unorderedlist" : {
                                    "name": "Bullet List" ,
                                    "type": "button" ,
                                    "class": "blist" ,
                                    "icon" : "UL"
                                },
                                'indent':{
                                    "name": "indent" ,
                                    "type": "button" ,
                                    "tooltip": "indent" ,
                                    "class": "indent",
                                    "icon" : "ID"

                                },
                                'outdent':{
                                    "name": "outdent" ,
                                    "type": "button" ,
                                    "tooltip": "outdent" ,
                                    "class": "outdent",
                                    "icon" : "OD"
                                }
                            }
                        }
                    ,
                    'list-styles' :
                        {
                            "name": "list style" ,
                            "type": "dropdown" ,
                            "class": "list-style" ,
                            "data" : {
                                 "orderedlist" :{
                                     "name": "Numbered List" ,
                                     "type": "button" ,
                                     "class": "nlist" ,
                                     "icon" : "OL"
                                 } ,
                                "unorderedlist" : {
                                    "name": "Bullet List" ,
                                    "type": "button" ,
                                    "class": "blist" ,
                                    "icon" : "UL"
                                }
                            }
                        }
                    ,
                    'alignment' :
                        {
                            "name" : "Text Alignment" ,
                            "type" : "dropdown" ,
                            'class' : "text-alignment" ,
                            "data" :{
                                "justifyright":{
                                    "name" : "justify Right" ,
                                    "type": "button" ,
                                    "class": "ralign",
                                    "icon" : "JR"
                                } ,
                                "justifyleft":{
                                    "name" : "justify Left" ,
                                    "type": "button" ,
                                    "class": "lalign",
                                    "icon" : "JL"
                                } ,
                                "justifycenter":{
                                    "name" : "justify Center" ,
                                    "type": "button" ,
                                    "class": "calign",
                                    "icon" : "JC"
                                } ,
                                "justifyfull":{
                                    "name" : "justify" ,
                                    "type": "button" ,
                                    "class": "jalign",
                                    "icon" : "J"
                                }
                            }
                    },
                    'fontsize':
                        {
                            "name" : "Font Size" ,
                            "type" : "input",
                            "style" : "number" ,
                            "placeholder": "insert font size" ,
                            "class" : "font-size",
                            "have_input" : true
                        }
                    ,'letterspace':
                        {
                            "name" : "Letter Space" ,
                            "type" : "input",
                            "style" : "number" ,
                            "placeholder": "insert letter space" ,
                            "class" : "letter-space" ,
                            "have_input" : true
                        }
                    ,
                    'lineheight':
                        {
                            "name" : "Line Height " ,
                            "type" : "input",
                            "style" : "number" ,
                            "placeholder": "insert line height" ,
                            "class" : "line-height" ,
                            "have_input" : true
                        }
                    ,
                    'animation':
                        {
                            "name" : "Animation" ,
                            "type" : "text",
                            "style" : "text" ,
                            "placeholder": "Animation" ,
                            "class" : "animation-controller"

                        },
                    'fontfamily':
                        {
                            "name" : "Font Family" ,
                            "type" : "input",
                            "style" : "text" ,
                            "placeholder": "insert Font Family" ,
                            "extra": "autocomplete" ,
                            "class" : "font-family-controller" ,
                            "have_input" : true
                        }
                    ,
                    'color':
                        {
                            "name" : "Font Color" ,
                            "type" : "input",
                            "style" : "color" ,
                            "placeholder": "Change color" ,
                            "class" : "font-color" ,
                            "have_input" : true
                        }
                    ,
                    'heading' :
                        {
                            "name": "Headings" ,
                            "type": "button" ,
                            "tooltip": "Heading" ,
                            "class": "heading",
                            "icon" : "H1"

                        }
                    ,
                    'undoredomanger':{
                       "name":"Manger" ,
                        "class":"undo-redo-manger" ,
                        "data" : {
                        'redo' :
                            {
                                "name": "redo" ,
                                "type": "button" ,
                                "tooltip": "redo" ,
                                "class": "redo",
                                "icon" : ">"

                            }
                        ,
                        'undo' :
                            {
                                "name": "undo" ,
                                "type": "button" ,
                                "tooltip": "undo" ,
                                "class": "undo",
                                "icon" : "<"

                            }
                        }
                    }
                    ,
                    'link':{
                        "name" : "Link" ,
                        "type" : "input",
                        "style" : "url" ,
                        "placeholder": "insert url" ,
                        "class" : "link",
                        "icon" : "a" ,
                        "have_input" : true
                    }
                },
            }
        },
        models: models,
        views: views,
        collections:collections,
        $editable:null,
        $editor:null,
        editable_init: function(selector) {
            this.config.selector = selector;
            this.$editable = $('.inline-md-editor');


            this.create_editor_panel();
            // Firefox seems to be only browser that defaults to `StyleWithCSS == true`
            // so we turn it off here. Plus a try..catch to avoid an error being thrown in IE8.
            try {
                document.execCommand('StyleWithCSS', false, false);
            }
            catch (err) {
                // expecting to just eat IE8 error, but if different error, rethrow
                if (err.message !== "Invalid argument.") {
                    throw err;
                }
            }
            this.add_events();
            this.show_panel();

        } ,

        create_editor_panel: function(){
            // if the editor isn't already built, build it
            this.$editor = $('.meditor-panel');
            if (!this.$editor.length) {
                this.$editor = $('<div class="meditor-panel unselectable ">');
                var editor_attrs = { editable: this.$editable, editable_model: this.model };
                document.body.appendChild(this.$editor[0]);
                this.$editor.meditor_instantiate({classType: 'Editor', attrs: editor_attrs});
            }
        },

        add_events: function(){
            this.editor_panel_events();
            this.editor_content_events();
            this.body_events();
            $(document).paste_as_plain_text();
        },

        editor_content_events:function(){
            var that = this;

            this.$editable.off('mousedown.meditor');
            this.$editable.on('mousedown.meditor',function(e){

                that.views.Editor.prototype.focused($(e.target).closest('.meditor'));
                that.views.Editor.prototype.update_controller(e);
                if($('#meditor_focus').length){
                    that.views.Editor.prototype.remove_text_selection();
                }
                that.views.Editor.prototype.close_color_picker($('#meditor-color-picker'));
                that.views.Editor.prototype.close_dropdown();

            });

            this.$editable.off('focus.meditor');
            this.$editable.on('focus.meditor',function(e){
                that.show_panel();

                /*check text to make it clear for typing */
                if ($('#meditor_focus').text().trim() == that.config.default_text){
                    $('#meditor_focus').html('');
                    that.views.Editor.prototype.update_controller(e,$('#meditor_focus'));
                }
            });

            this.$editable.off('click.meditor' , 'a' );
            this.$editable.on('click.meditor' , 'a' , function(){
                var t = this;
                setTimeout(function(){
                    var tag = t;
                    var range = document.createRange();
                    range.selectNodeContents(tag);
                    window.getSelection().removeAllRanges();
                    window.getSelection().addRange(range);
                    var focus_element = document.getElementById( 'meditor_focus' );
                    if(null != focus_element){
                        store_selection(focus_element);
                    }
                    that.views.Editor.prototype.keep_text_selected();
                    $('.open-link-option').toggleClass('show-panel');
                    $('.link-input').val($(tag).attr("href")) ;
                    that.views.Editor.prototype.link_panel();
                },10)
            });
        },

        editor_panel_events:function(){
            var that = this;
            // close all open drop down when click on
            // other live text editor controllers
            this.$editor.off('mousedown.meditor');
            this.$editor.on('mousedown.meditor',function(e){
                var target = e.target || e.srcElement;
                /*check text to make it clear for typing */
                if($(target).closest('.dropdown-items').length) return false;
                if(!$(target).closest('#meditor-color-picker').length) {
                    that.views.Editor.prototype.close_color_picker($('#meditor-color-picker'));
                }
                if(!$(target).closest('.open-link-option').length) {
                    if(!$(target).closest('.active-item').next('.dropdown-items').hasClass('open')){
                        that.views.Editor.prototype.close_dropdown();
                    }
                }
                that.views.Editor.prototype.set_selection_range(document.getElementById('meditor_focus'), select_positions.start, select_positions.end);
            });
        },

        body_events:function(){
            var that = this;
            // listen for mousedowns that are not coming from the editor
            // and close the editor
            // unbind first to make sure we aren't doubling up on listeners
            $('body').unbind('mousedown.meditor').bind('mousedown.meditor', function(e) {
                // check to see if the click was in an etch tool
                var target = e.target || e.srcElement;
                if ($(target).not('.meditor-panel, .meditor-panel *, .meditor-image-tools, .meditor-image-tools *').length) {
                    // remove editor
                    that.$editor.css({
                        'display' : 'none'
                    });
                    var $meditor_focus = $('#meditor_focus');
                    $('.meditor-input').val('');
                    if($meditor_focus.length){
                        if ($meditor_focus.text().trim() == ''){
                            $meditor_focus.html(that.config.default_html);
                        }
                        that.views.Editor.prototype.remove_text_selection();
                        setTimeout(function(){
                            $meditor_focus.attr('id', '').parents('.mBuilder-element').not('.vc_row, .mBuilder-vc_column').removeClass('active-md-editor').draggable('enable');
                        } , 10);
                    }
                }
            });
        },

        show_panel:function(){
            if($('#meditor_focus').length) {
                var top = this.$editable.filter('#meditor_focus').offset().top - 35,
                    left = this.$editable.filter('#meditor_focus').offset().left  ,
                    shortcode_width = this.$editable.filter('#meditor_focus').width() ,
                    right = $(window).width() - ( left + shortcode_width ) ,
                    extra_space = shortcode_width + right;
                if( 670 > extra_space ){
                    $('.meditor-panel').css({'top': top, 'left': '' , 'right': right});
                }else{
                    $('.meditor-panel').css({'top': top, 'left':left , 'right': ''});
                }
            }
        },

    };

    // jquery helper functions
    $.fn.meditor_instantiate = function(options, cb) {
        return this.each(function() {
            var $el = $(this);
            options || (options = {});

            var settings = {
                el: this,
                attrs: {}
            };

            _.extend(settings, options);

            var model = new models[settings.classType](settings.attrs, settings);

            // initialize a view is there is one
            if (_.isFunction(views[settings.classType])) {
                var view = new views[settings.classType]({model: model, el: this, tagName: this.tagName});
            }

            // stash the model and view on the elements data object
            $el.data({model: model});
            $el.data({view: view});

            if (_.isFunction(cb)) {
                cb({model: model, view: view});
            }
        });
    };

    $.fn.meditor_find_editable = function() {
        // function that looks for the editable selector on itself or its parents
        // and returns that el when it is found
        var $el = $(this);
        return $el.is(meditor.config.selector) ? $el : $el.closest(meditor.config.selector);
    };

    $.fn.paste_as_plain_text = function(){
        $(this).unbind('paste').on('paste','[contenteditable]',function(e) {
            e.preventDefault();
            var text = (e.originalEvent || e).clipboardData.getData('text/plain');
            document.execCommand('insertText', false, text);
        });
    };

    //functions
    var binary_index_of = function(search) {
        'use strict';
        var min_index = 0;
        var max_index = font_name_list_len - 1;
        var current_index;
        var current_element;

        while (min_index <= max_index) {
            current_index = (min_index + max_index) / 2 | 0;
            current_element = this[current_index].substr(0, search.length).toLowerCase();
            if (current_element < search) {
                min_index = current_index + 1;
            }
            else if (current_element > search) {
                max_index = current_index - 1;
            }
            else {
                return current_index;
            }
        }

        return -1;
    }

    var store_selection =  function(editable){
        var save_selection ;
        if (window.getSelection && document.createRange) {
            save_selection = function (container_el) {
                var doc = container_el.ownerDocument, win = doc.defaultView;
                if(win.getSelection().anchorNode == null) return ;
                var range = win.getSelection().getRangeAt(0);
                var pre_selection_range = range.cloneRange();
                pre_selection_range.selectNodeContents(container_el);
                pre_selection_range.setEnd(range.startContainer, range.startOffset);
                var start = pre_selection_range.toString().length;
                select_positions = {
                    'start': start ,
                    'end': start +  range.toString().length
                };
                return true;
            };
            save_selection(editable);
        } else if (document.selection) {
            save_selection = function (container_el) {
                var doc = container_el.ownerDocument, win = doc.defaultView || doc.parentWindow;
                var selected_text_range = doc.selection.createRange();
                var pre_selection_text_range = doc.body.createTextRange();
                pre_selection_text_range.moveToElementText(container_el);
                pre_selection_text_range.setEndPoint("EndToStart", selected_text_range );
                var start = pre_selection_text_range.text.length;
                select_positions = {
                    'start': start ,
                    'end': start + selectedTextRange.text.length
            };
                return true;
            };
            save_selection(editable);
        }
    };

    window.meditor = meditor;
})(jQuery);