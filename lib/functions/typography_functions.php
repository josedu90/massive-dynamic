<?php

//Load Google Font Dropdown
function pixflow_googleFontsDropDown()
{
    global $md_allowed_HTML_tags;
    $id = $_POST['id'];
    $gf = new PixflowGoogleFonts(pixflow_path_combine(PIXFLOW_THEME_LIB_URI, 'googlefonts.txt'));
    $fontNames = $gf->Pixflow_GetFontNames();
    $string = '';
    $default = ('PIXFLOW_' . defined(strtoupper(str_replace('-', '_', $id)))) ? constant('PIXFLOW_' . strtoupper(str_replace('-', '_', $id))) : '';
    $value = pixflow_get_theme_mod($id, $default);
    foreach ($fontNames as $font) {
        $selected = ($font == $value) ? 'selected' : '';
        $string .= '<span value="' . $font . '" class="select-item ' . $selected . '">' . $font . '<span class="cd-dropdown-option"></span></span>';
    }
    echo wp_kses($string, $md_allowed_HTML_tags);
    wp_die();
}

add_action('wp_ajax_nopriv_pixflow_googleFontsDropDown', 'pixflow_googleFontsDropDown');
add_action('wp_ajax_pixflow_googleFontsDropDown', 'pixflow_googleFontsDropDown');

/**
 * Return The Font Family Of String In Style Attribute
 * @param String It Is String Variable
 *
 * @return Array The List Of Font Family That Used And Return False If Nothing Found
 * @since 2.0.0
 */

function pixflow_extract_font_families( $string ){
    $fonts = array();
    preg_match_all('/<[^>]+ (style=".*?")/i', $string , $style);
    foreach ($style[1] as $tag){
        preg_match("/font-family(.*?):(.*?)(;|$)/",  htmlspecialchars_decode( $tag ) , $matches);
        preg_match('@font-weight(\s*):(.*?)(\s?)("|;|$)@i', $tag, $result);
        if (!empty($matches[2])) {
            $font_name = trim( str_replace(array('"' , '\'') , '' , $matches[2]));
            if($font_name != '') {
                $font_name .= !empty($result[2]) ? ':' . trim($result[2]) : '' ;
                $fonts[] = $font_name;
            }
        }
    }
    if( count($fonts) > 0 ) {
        return $fonts ;
    }else{
        return false ;
    }
}

/**
 * Create The List Of Merge All Font Family
 * @param String It Is String Variable
 *
 * @return true
 * @since 2.0.0
 */
function pixflow_merge_fonts( $font_name ) {
    global $pixflow_merge_font_list;
    if( array_search( $font_name , $pixflow_merge_font_list ) === false ){
            $pixflow_merge_font_list[] =  $font_name ;
    }
    return true ;
}


/**
 * Build The Google Font Request
 * @param Content Contains The All Of Shortcode Content
 *
 * @return true
 * @since 2.0.0
 */
function pixflow_load_fonts(){

	global $pixflow_merge_font_list, $in_mbuilder;
    $font_list = implode($pixflow_merge_font_list) ;
    $font_list = substr(trim($font_list), -1) != '|' ? $font_list  : substr($font_list, 0, -1)  ;
    $font_list = explode('|' , $font_list);
    $font_list  = array_unique($font_list);
    wp_enqueue_style('vc_google_text_fonts' , '//fonts.googleapis.com/css?family=' . implode('|' , $font_list) , array()  );
    $font_list = implode('|', $font_list);
    if( $in_mbuilder && '' != $font_list  ) {
        echo("<link rel='stylesheet' href='//fonts.googleapis.com/css?family=" . $font_list . "' type='text/css' media='all'/>");
	}
	
}
add_action( 'wp_footer', 'pixflow_load_fonts');


/**
 * Convert all the font tags to span tags
 * @param String content
 *
 * @return string converted content
 * @since 2.0.0
 */
function pixflow_convert_font_to_span($content){
    if($content == '')
        return $content;
    $content = str_replace('<font' , '<span' , $content);
    $content = str_replace('</font>' , '</span>' , $content);
    return $content;
}

/**
 * Return The Font Family Of String In Style and font weight in md live text shortcode
 * @param String It Is String Variable
 *
 * @return Array The List Of Font Family That Used And Return False If Nothing Found
 * @since 2.0.0
 */

function pixflow_extract_live_text_fonts($content){
	
	$fonts = array();
	preg_match_all('/<span(.*?)>(.*?)<\/span>/', $content , $span);
	foreach ($span[0] as $tag){
		preg_match("/font-family(.*?):(.*?)(;|$)/",  htmlspecialchars_decode( $tag ) , $matches);
		preg_match('/data-font-weight="(.*?)"/', $tag, $result);
		if (!empty($matches[2])) {
			$font_name = trim( str_replace(array('"' , '\'') , '' , $matches[2]));
			if($font_name != '') {
				$font_name .= !empty($result[1]) ? ':' . trim($result[1]) : '' ;
				$fonts[] = $font_name;
			}
		}
	}

	if( count($fonts) > 0 ) {
		return $fonts ;
	}else{
		return false ;
	}
}