<?php
/**
 * Empty Space Shortcode
 *
 * @author Pixflow
 */

add_shortcode("vc_empty_space",'mBuilder_vcEmptySpace');

function mBuilder_vcEmptySpace($atts,$content){
    extract( shortcode_atts( array(
        'height'                   => '100'
    ), $atts ));
    $id = uniqid('empty_space_');
    ob_start();
    ?>

    <div class='vc_empty_space gizmo-container small-gizmo no-setting-gizmo no-animation-gizmo clearfix <?php echo esc_attr($id);?>' style='height:<?php echo esc_attr($height); ?>px'></div>
    <?php
	$section_attr = '';
	// Output shortcode attributes if row dropped as section
	if ( isset( $_POST['attrs'] ) && strpos( $_POST['attrs'], 'section_id' ) ) {
		$attributes = '';
		foreach( $atts as $k => $v ) {
			$attributes .= "$k=\"$v\" ";
		}
		$section_attr = '<span class="section-shortcode-attrs">'.$attributes.'</span>';
	}
    return ob_get_clean().$section_attr;
}

