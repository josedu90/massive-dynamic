<?php
add_shortcode('md_wpform', 'pixflow_get_style_script'); // pixflow_wp_form

function pixflow_sc_wpform( $atts, $content = null ){

    $output = $testimonial_classic_num = '';

    extract( shortcode_atts( array(
            'md_form_id'  => ''),
        $atts )
    );

    $animation = array();
    $animation = pixflow_shortcodeAnimation('md_wpform',$atts);
    $id = pixflow_sc_id('md_wpform');

    if (!(is_plugin_active( 'wpforms-lite/wpforms.php' ))) {
        $url = admin_url('themes.php?page=tgmpa-install-plugins');
        $a='<a href="'.$url.'">WPForms Lite</a>';
        $mis = '<div class="miss-shortcode"><p class="title">'. esc_attr__('Oops!! Something\'s Missing','massive-dynamic').'</p><p class="desc">'.sprintf(esc_attr__('Please install and activate %s to use this shortcode','massive-dynamic'),$a).'</p></div>';
        return $mis;
    }else{
        ob_start();
        if ($md_form_id == ''){
            $url = admin_url('themes.php?page=install-required-plugins');
            $a='<a href="'.$url.'">WPForms Lite</a>';
            $mis = '<div class="miss-shortcode"><p class="title">'. esc_attr__('Oops!! Something\'s Missing','massive-dynamic').'</p><p class="desc">'.sprintf(esc_attr__('Can\'t find any form, please create a form in %s, then use this shortcode. ','massive-dynamic'),$a).'</p></div>';
            return $mis;
        }else{ ?>
            <div class="sc-wp-form <?php echo esc_attr($id.' '.$animation['has-animation']); ?>" <?php echo esc_attr($animation['animation-attrs']); ?> >
                <?php print(do_shortcode("[wpforms id='{$md_form_id}']")); ?>
            </div>
        <?php }
    }
    return ob_get_clean();
}