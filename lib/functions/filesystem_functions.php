<?php

/*
 * Deletes attachment by given url
 */
function pixflow_delete_attachment($url)
{
    global $wpdb;

    // We need to get the image's meta ID.
    $query = "SELECT ID FROM wp_posts where guid = '" . esc_url($url) . "' AND post_type = 'attachment'";
    $results = $wpdb->get_results($wpdb->prepare($query));

    // And delete it
    foreach ($results as $row) {
        wp_delete_attachment($row->ID);
    }
}

/* downloads data from given url */

function pixflow_get_url_content($url, $proxy = '')
{
    $args = array(
        'headers' => array(),
        'body' => null,
        'sslverify' => true,
    );

    $response = wp_remote_get($url, array(
            'timeout' => 45,
        )
    );

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        $ret = array('error' => $error_message, 'errorno' => '');
    } else {
        $ret = $response['body'];
    }

    return $ret;
}

// Allow users to upload to media library for using in icon shortcode
function pixflow_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'pixflow_mime_types');

function pixflow_get_filesystem()
{
    $access_type = get_filesystem_method();
    if ($access_type === 'direct') {
        /* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
        $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
        /* initialize the API */
        if (!WP_Filesystem($creds)) {
            /* any problems and we exit */
            return false;
        }
        return true;
    } else {
        return false;
    }
}

// Fix The Http Error on Uploading Images
add_filter('wp_image_editors', 'pixflow_change_graphic_lib');
function pixflow_change_graphic_lib($array)
{
    return array('WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
}

/*Allow uploader to upload fonts files*/
function pixflow_allow_font_upload ( $existing_mimes=array() ) {
    $existing_mimes['woff2'] = 'font/woff2';
    $existing_mimes['woff'] = 'font/woff';
    $existing_mimes['ttf'] = 'font/ttf';
    $existing_mimes['svg'] = 'image/svg+xml';
    $existing_mimes['eot'] = 'font/eot';
    return $existing_mimes;
}
add_filter('upload_mimes', 'pixflow_allow_font_upload');

/*
 * Fix issues  with upload custom fonts and files such as SVG that disabled from wordpress 4.7.1
 *  */
function pixflow_fix_upload_custom_issue($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' && $wp_version !== '4.7.2' ) {
        return $data;
    }
    $filetype = wp_check_filetype( $filename, $mimes );
    return array(
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    );
}
add_filter( 'wp_check_filetype_and_ext', 'pixflow_fix_upload_custom_issue', 10, 4 );