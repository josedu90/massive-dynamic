<?php
/**
 * Retrieves the attachment ID from the file URL
 * @param String the url of image
 *
 * @return image id or false
 */
function pixflow_get_image_id($image_url){
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $wpdb->prefix . "posts WHERE guid='%s';", $image_url));
    if (count($attachment))
        return $attachment[0];
    else
        return false;
}

/* Get video url from known sources such as youtube and vimeo */
function pixflow_extract_video_info($string)
{
    //check for youtube video url
    if (preg_match('/https?:\/\/(?:www\.)?youtube\.com\/watch\?v=[^&\n\s"<>]+/i', $string, $matches)) {
        $url = parse_url($matches[0]);
        parse_str($url['query'], $queryParams);

        return array('type' => 'youtube', 'url' => $matches[0], 'id' => $queryParams['v']);
    } //Vimeo
    else if (preg_match('/https?:\/\/(?:www\.)?vimeo\.com\/\d+/i', $string, $matches)) {
        $url = parse_url($matches[0]);

        return array('type' => 'vimeo', 'url' => $matches[0], 'id' => ltrim($url['path'], '/'));
    }


    return null;
}

function pixflow_extract_audio_info($string)
{
    //check for soundcloud url
    if (preg_match('/https?:\/\/(?:www\.)?soundcloud\.com\/[^&\n\s"<>]+\/[^&\n\s"<>]+\/?/i', $string, $matches)) {
        return array('type' => 'soundcloud', 'url' => $matches[0]);
    }

    return null;
}

function pixflow_soundcloud_get_embed($url, $height)
{
    $json = pixflow_get_url_content("http://soundcloud.com/oembed?format=json&url=$url"/*, '127.0.0.1:8580'*/);

    if (is_array($json))
        return 'Server Error: ' . $json['error'] . " \nError No: " . $json['errorno'];

    if (trim($json) == '')
        return 'Error: got empty response from soundcloud';

    //Convert the response string to PHP object
    $data = json_decode($json);

    if (NULL == $data)
        return "Cant decode the soundcloud response \nData: $json";

    //TODO: add additional error checks
    $data->html = str_replace('height="400"', 'height="' . $height . '"', $data->html);
    return $data->html;
}

/*Make retina image for orginal file*/
function pixflow_makeRetiaImage($post_ID)
{
    return;
    $file = get_attached_file($post_ID);
    $path_parts = pathinfo($file);
    $retinaFile = $path_parts['dirname'] . '/' . $path_parts['filename'] . '@2x.' . $path_parts['extension'];
    copy($file, $retinaFile);
    return $post_ID;
}
add_filter('add_attachment', 'pixflow_makeRetiaImage', 10, 2);

/*Remove retina original image after delete*/
function pixflow_removeRetinaImage($post_ID)
{
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    WP_Filesystem(false , false , true);
    global $wp_filesystem;
    $file = get_attached_file($post_ID);
    $path_parts = pathinfo($file);
    $retinaFile = $path_parts['dirname'] . '/' . $path_parts['filename'] . '@2x.' . $path_parts['extension'];
    $wp_filesystem->delete($retinaFile);
    return $post_ID;
}

add_filter('delete_attachment', 'pixflow_removeRetinaImage', 10, 2);


/**
 * Get remote image url and add it to media library
 * @param String the url of image
 * @param Boolean regenerate thumbnails
 *
 * @return image id or false
 */
function pixflow_save_remote_images( $image_url, $regenrate_thumbnails = false ){
    $image = $image_url;
    $get = wp_remote_get( $image );
    $type = wp_remote_retrieve_header( $get, 'content-type' );
    if (!$type)
        return false;

    $mirror = wp_upload_bits( basename( $image ), '', wp_remote_retrieve_body( $get ) );
    $attachment = array(
        'post_title'=> basename( $image ),
        'post_mime_type' => $type
    );
    $attach_id = wp_insert_attachment( $attachment, $mirror['file'] );
    if( $regenrate_thumbnails ){
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata( $attach_id, $mirror['file'] );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    }

    if( $attach_id ){
        return $attach_id;
    } else {
        return false;
    }
}