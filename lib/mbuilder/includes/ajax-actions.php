<?php
/**
 * mBuilder AJAX functions
 *
 * @author PixFlow
 */
if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {


    /**
     * Load shortcodes file
     *
     * @since 2.0.0
     */
    function pixflow_require_shortcodes_files() {
        $shortcodesBootStrap = PixflowFramework::Pixflow_Shortcodes();
        PixflowFramework::Pixflow_Require_Files( PIXFLOW_THEME_LIB . '/shortcodes', $shortcodesBootStrap );
        do_action( 'mBuilder_shortcodes_init' );
        return true;
    }

    /**
     * Setting Panel Generator
     *
     * @since 1.0.0
     */
    function mBuilder_settingPanel() {
        global $mBuilderShortcodes;
        do_action( 'mBuilder_shortcodes_init' );
        $type = $_POST[ 'type' ];
        $content = $_POST[ 'content' ];
        MBuilder::load_shortcode_map( $type );
        $attrs = MBuilder::parseAttributes( $_POST[ 'attr' ] );
        if ( $content == '' && trim( $_POST[ 'attr' ] ) == '' ) {
            $content = $mBuilderShortcodes[ $type ][ 'default_content' ];
        }
        // Check Text shortcode and add multi title attr to it
        if ( 'md_text' == $type && ( isset( $attrs[ 'md_text_number' ] ) && $attrs[ 'md_text_number' ] > 1 ) && $md_text_use_title_slider == 'yes' ) {
            $attrs[] = 'md_text_use_title_slider="yes';
            $attrs[ 'md_text_use_title_slider' ] = 'yes';
        }
        echo '<form id="mBuilder-form" onsubmit="return false;">';
        MBuilder::buildForm( $mBuilderShortcodes[ $type ][ 'params' ], $attrs, $content );
        echo '</form>';
        wp_die();

    }



    add_action( 'wp_ajax_pixflow_clear_md_cache', 'pixflow_cleaar_md_cache' );
    add_action( 'wp_ajax_nopriv_pixflow_clear_md_cache', 'pixflow_cleaar_md_cache' );

    function pixflow_cleaar_md_cache(){
        $upload_dir   = wp_upload_dir();
        $dirname=$upload_dir['basedir'] . "/md_cache";

        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }





    add_action( 'wp_ajax_mBuilder_settingPanel', 'mBuilder_settingPanel' );
    add_action( 'wp_ajax_nopriv_mBuilder_settingPanel', 'mBuilder_settingPanel' );

    /**
     * execute shortcode and build it then send it to the builder
     *
     * @since 1.0.0
     */
    // @Todo: Refactor
    function mBuilder_buildShortcode() {
        global $shortcode_tags, $mBuilderShortcodes, $in_mbuilder;
        $in_mbuilder = true;
        pixflow_require_shortcodes_files();
        $action = $_POST[ 'act' ];
        $shortcode = $_POST[ 'shortcode' ];
        $attrs = ( isset( $_POST[ 'attrs' ] ) ) ? $_POST[ 'attrs' ] : '{}';
        $attrs = MBuilder::parseAttributes( $attrs );
        MBuilder::load_shortcode_map( $shortcode );

        /*add Column size to mbuilder tag*/
        $el_classes = '';

        if ( $_POST[ 'shortcode' ] == 'vc_column' || $_POST[ 'shortcode' ] == 'vc_column_inner' ) {
            $width = ( isset( $attrs[ 'width' ] ) ) ? $attrs[ 'width' ] : '1/1';
            $width = explode( '/', $width );
            $width = $width[ 0 ] / $width[ 1 ] * 12;
            $el_classes .= "col-sm-$width";
        }
        if ( $action == 'build' ) {
            if ( $_POST[ 'shortcode' ] == 'vc_row' && isset( $attrs[ 'section_id' ] ) ) {
                $section_name = $attrs[ 'section_id' ];
                if ( isset( $_POST[ 'section_type' ] ) && 'custom' == $_POST[ 'section_type' ] ) {
                    $section_list = get_option( 'pixflow_custom_section' );
                    $section_list = json_decode( $section_list, true );
                    $goal_Section = $section_list[ $section_name ];
                    $content = $goal_Section[ 'content' ];
                    $mBuilderShortcodes[ 'vc_row' ][ 'default_content' ] = str_replace( '\\', '', $content );
                    unset( $goal_Section[ 'content' ] );
                    $row_attrs = $attrs = $goal_Section;
                } else {
                    $section_id = $attrs[ 'section_id' ];
                    require_once( PIXFLOW_THEME_SECTIONS . "/section-$section_id.php" );
                    $content = $section_params[ 'content' ];
                    $mBuilderShortcodes[ 'vc_row' ][ 'default_content' ] = $content;
                    unset( $section_params[ 'content' ] );
                    $row_attrs = $attrs = $section_params;
                }

            } else {
                $mBuilderShortcodes[ 'vc_row' ][ 'default_content' ] = '[vc_column][/vc_column]';
                MBuilder::load_shortcode_map( 'vc_column' );
                MBuilder::print_shortcode_map( 'vc_column' );
            }
            $mBuilderShortcodes[ 'vc_row_inner' ][ 'default_content' ] = '[vc_column_inner][/vc_column_inner]';
            if ( $_POST[ 'shortcode' ] != 'vc_row' ) {
                echo "<div class='mBuilder-element mBuilder-" . esc_attr( $shortcode ) . " vc_" . esc_attr( $shortcode ) . " " . esc_attr( $el_classes ) . "' data-mBuilder-el='" . esc_attr( $shortcode ) . "'>";
            }

            // Get enqueued scripts and styles before run shortcode
            $beforeScripts = $beforeStyles = $afterScripts = $afterStyles = array();
            global $wp_scripts, $wp_styles;
            $scripts = $wp_scripts->queue;
            $styles = $wp_styles->queue;
            foreach ( $scripts as $handle ) {
                $beforeScripts[] = $wp_scripts->registered[ $handle ]->src;
            }
            foreach ( $styles as $handle ) {
                $beforeStyles[] = $wp_styles->registered[ $handle ]->src;
            }
            ob_start();
            print( call_user_func_array( $shortcode_tags[ $_POST[ 'shortcode' ] ], array( $attrs, $mBuilderShortcodes[ $_POST[ 'shortcode' ] ][ 'default_content' ], $_POST[ 'shortcode' ] ) ) );
            $output = ob_get_clean();
            // Get enqueued scripts and styles in shortcode and print them
            global $wp_scripts, $wp_styles;
            $scripts = $wp_scripts->queue;
            $styles = $wp_styles->queue;
            foreach ( $scripts as $handle ) {
                $afterScripts[] = $wp_scripts->registered[ $handle ]->src;
            }
            $shortcodeScripts = array_diff( $afterScripts, $beforeScripts );
            foreach ( $shortcodeScripts as $script ) {
                $script = ( substr( $script, 0, '4' ) == '/wp-' ) ? get_site_url() . $script : $script;
                echo '<script src="' . esc_url( $script ) . '"></script>';
            }
            foreach ( $styles as $handle ) {
                $afterStyles[] = $wp_styles->registered[ $handle ]->src;
            }
            $shortcodeStyles = array_diff( $afterStyles, $beforeStyles );
            foreach ( $shortcodeStyles as $style ) {
                $style = ( substr( $style, 0, '4' ) == '/wp-' ) ? get_site_url() . $style : $style;
                echo "<link rel='stylesheet' href='" . esc_url( $style ) . "' type='text/css' media='all'/>";
            }
            MBuilder::print_shortcode_map( $shortcode );
            // Load shortcodes map used in section if section dropped
            if ( isset( $section_name ) && $section_name != '' ) {
                $shortcodes = MBuilder::get_shortcodes_by_content( $content );
                foreach ( $shortcodes as $used_shortcode ) {
                    MBuilder::load_shortcode_map( $used_shortcode );
                    MBuilder::print_shortcode_map( $used_shortcode );
                }
            }
            /* Load shortcode params if has child like tabs */
            if ( isset( $mBuilderShortcodes[ $shortcode ][ 'as_parent' ][ 'only' ] ) ) {
                $child_shortcode = $mBuilderShortcodes[ $shortcode ][ 'as_parent' ][ 'only' ];
                MBuilder::load_shortcode_map( $child_shortcode );
                MBuilder::print_shortcode_map( $child_shortcode );
            }

            print( $output );
            if ( $_POST[ 'shortcode' ] != 'vc_row' ) {
                echo "</div>";
            }
        } elseif ( $action == 'rebuild' ) {
            $id = $_POST[ 'id' ];
            $content = stripslashes( $_POST[ 'content' ] );
            // Get enqueued scripts and styles before run shortcode
            $beforeScripts = $beforeStyles = $afterScripts = $afterStyles = array();
            global $wp_scripts, $wp_styles;
            $scripts = $wp_scripts->queue;
            $styles = $wp_styles->queue;
            foreach ( $scripts as $handle ) {
                $beforeScripts[] = $wp_scripts->registered[ $handle ]->src;
            }
            foreach ( $styles as $handle ) {
                $beforeStyles[] = $wp_styles->registered[ $handle ]->src;
            }
            if ( $_POST[ 'shortcode' ] != 'vc_row' ) {
                echo "<div class='mBuilder-element mBuilder-" . esc_attr( $shortcode ) . " vc_" . esc_attr( $shortcode ) . " " . esc_attr( $el_classes ) . "' data-mBuilder-el='" . esc_attr( $shortcode ) . "' data-mbuilder-id='" . esc_attr( $id ) . "'>";
            }
            ob_start();
            print( call_user_func_array( $shortcode_tags[ $shortcode ], array( $attrs, $content, $shortcode ) ) );
            $output = ob_get_clean();
            // Get enqueued scripts and styles in shortcode and print them
            global $wp_scripts, $wp_styles;
            $scripts = $wp_scripts->queue;
            $styles = $wp_styles->queue;
            foreach ( $scripts as $handle ) {
                $afterScripts[] = $wp_scripts->registered[ $handle ]->src;
            }
            $shortcodeScripts = array_diff( $afterScripts, $beforeScripts );
            foreach ( $shortcodeScripts as $script ) {
                $script = ( substr( $script, 0, '4' ) == '/wp-' ) ? get_site_url() . $script : $script;
                echo '<script src="' . esc_url( $script ) . '"></script>';
            }
            foreach ( $styles as $handle ) {
                $afterStyles[] = $wp_styles->registered[ $handle ]->src;
            }
            $shortcodeStyles = array_diff( $afterStyles, $beforeStyles );
            foreach ( $shortcodeStyles as $style ) {
                $style = ( substr( $style, 0, '4' ) == '/wp-' ) ? get_site_url() . $style : $style;
                echo "<link rel='stylesheet' href='" . esc_url( $style ) . "' type='text/css' media='all'/>";
            }
            print( $output );
            if ( $_POST[ 'shortcode' ] != 'vc_row' ) {
                pixflow_load_fonts();
                echo "</div>";
            }
        }
        wp_die();
    }

    add_action( 'wp_ajax_mBuilder_buildShortcode', 'mBuilder_buildShortcode' );
    add_action( 'wp_ajax_nopriv_mBuilder_buildShortcode', 'mBuilder_buildShortcode' );

    /**
     * do shortcode and build it then send it to the builder
     *
     * @since 1.0.0
     */
    function mBuilder_doShortcode() {
        global $in_mbuilder;
        pixflow_require_shortcodes_files();
        $in_mbuilder = true;
        $shortcode = stripslashes( $_POST[ 'shortcode' ] );

        print( pixflow_js_remove_wpautop( $shortcode ) );

        wp_die();
    }

    add_action( 'wp_ajax_mBuilder_doShortcode', 'mBuilder_doShortcode' );
    add_action( 'wp_ajax_nopriv_mBuilder_doShortcode', 'mBuilder_doShortcode' );

    /**
     * Get content from builder and return generated wordPress shortcodes
     *
     * @return void
     * @since 1.0.0
     */
    function mBuilder_getContent() {
        $models = $_POST[ 'models' ];
        $builder = MBuilder::getInstance();
        $content = $builder->getContent( $models );

        print( $content );
        wp_die();
    }

    add_action( 'wp_ajax_mBuilder_getContent', 'mBuilder_getContent' );
    add_action( 'wp_ajax_nopriv_mBuilder_getContent', 'mBuilder_getContent' );

    /**
     * Get content from builder and generate wordpress shortcodes then save it to the database
     *
     * @return void
     * @since 1.0.0
     */
//@TODO: keep (change camelcase)
    function mBuilder_saveContent() {
        $models = $_POST[ 'models' ];
        $id = $_POST[ 'id' ];
        $builder = MBuilder::getInstance();
        $builder->getContent( $models );
        $builder->saveContent( $id );
        $builder->generate_static_js_css( $id );
        wp_die();
    }

    add_action( 'wp_ajax_mBuilder_saveContent', 'mBuilder_saveContent' );
    add_action( 'wp_ajax_nopriv_mBuilder_saveContent', 'mBuilder_saveContent' );

    /**
     * Google Font Styles DropDown Loader
     *
     * @param $key
     * @param $value
     *
     * @return void|string - options of select input
     * @since 1.0.0
     */
    function pixflow_loadFontStyles( $key = 0, $value = '' ) {
        global $fonts;
        $fontKey = ( isset( $_POST[ 'fontKey' ] ) ) ? $_POST[ 'fontKey' ] : $key;
        $value = ( isset( $_POST[ 'value' ] ) ) ? $_POST[ 'value' ] : $value;
        $fontStyles = $fonts[ $fontKey ];
        $fontStyles = explode( ',', $fontStyles->font_types );
        $options = '';
        $options_classes = ' dropdown-option active-text-color ';
        foreach ( $fontStyles as $style ) {
            if ( strtolower( $value ) == strtolower( $style ) ) {
                $options_classes += ' selected-option ';
            } else {
                $options_classes = ' dropdown-option active-text-color ';
            }
            $options .= '<div data-dropdown-value="' . $style . '" class="' . $options_classes . '">';
            $title = explode( ':', $style );
            $options .= $title[ 0 ] . '</div>';
        }
        if ( isset( $_POST[ 'fontKey' ] ) ) {
            print( $options );
            wp_die();
        } else {
            return $options;
        }
    }

    add_action( 'wp_ajax_pixflow_loadFontStyles', 'pixflow_loadFontStyles' );
    add_action( 'wp_ajax_nopriv_pixflow_loadFontStyles', 'pixflow_loadFontStyles' );
}