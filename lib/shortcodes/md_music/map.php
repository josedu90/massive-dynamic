<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Music
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
function pixflow_music_param()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $track_num_param = 'music_num';
    $track_num = 12;
    $dropDown = array(
        esc_attr__("Seven", 'massive-dynamic') => 7,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("Six", 'massive-dynamic') => 6,
        esc_attr__("Eight", 'massive-dynamic') => 8,
        esc_attr__("Nine", 'massive-dynamic') => 9,
        esc_attr__("Ten", 'massive-dynamic') => 10,
        esc_attr__("Eleven", 'massive-dynamic') => 11,
        esc_attr__("Twelve", 'massive-dynamic') => 12,
    );

    $param = array(

        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Tracks", 'massive-dynamic'),
            "param_name" => "tr_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first ",
        ),

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Number of Tracks", 'massive-dynamic'),
            "param_name" => $track_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Album", 'massive-dynamic'),
            "param_name" => "category_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first ",
        ),
        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_sep" . ++$separatorCounter,
        ),
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Name", 'massive-dynamic'),
            "param_name" => "music_album",
            "value" => "Audio Jungle",
            "admin_label" => false,
        ),

        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_sep" . ++$separatorCounter,
        ),

        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Artist", 'massive-dynamic'),
            "param_name" => "music_artist",
            "value" => "by PR MusicProductions",
            "admin_label" => false,
        ),

        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_sep" . ++$separatorCounter,
        ),

        array(
            "type" => "attach_image",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Image", 'massive-dynamic'),
            "param_name" => "music_image",
            "admin_label" => false,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appreance", 'massive-dynamic'),
            "param_name" => "app_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first ",
        ),
        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_sep" . ++$separatorCounter,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Track Color", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_texts_color",
            "value" => 'rgb(80,80,80)',
            "admin_label" => false,
        ),

        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_sep" . ++$separatorCounter,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Play Color", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_played_color",
            "value" => 'rgb(106, 222, 174)',
            "admin_label" => false,
        ),

        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "music_sep" . ++$separatorCounter,
        ),

        array(
            "type" => "dropdown",
            "heading" => esc_attr__("Orientation", 'massive-dynamic'),
            "param_name" => "music_alignment",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue last",
            "value" => array(
                esc_attr__("Right to Left", 'massive-dynamic') => "right-music-panel",
                esc_attr__("Left to Right", 'massive-dynamic') => "left-music-panel",
            ),
        ),
        array(
            "type" => "md_vc_description",
            "param_name" => "music_description",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "admin_label" => false,
            "value" => esc_attr__("Tip: to see how this shortcode appears when you scroll, save your changes in builder and check your website outside builder area.", 'massive-dynamic'),
        ),

    );

    $i = 1;
    for ($i = 1; $i <= (int)$track_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $track_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue first",
            "group" => esc_attr__("Track ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Track Name", 'massive-dynamic'),
            "param_name" => "music_track_name_" . $i,
            "value" => "Inspiring " . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $track_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Track ", 'massive-dynamic') . $i,
            "param_name" => "music_sep" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $track_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            'type' => 'textfield',
            "edit_field_class" => $filedClass . "glue last",
            'param_name' => 'music_track_url' . $i,
            "group" => esc_attr__("Track ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Track Link", 'massive-dynamic'),
            "value" => 'https://0.s3.envato.com/files/131328937/preview.mp3',
            "admin_label" => false,
            'dependency' => array(
                'element' => $track_num_param,
                'value' => $value
            ),
        );
    }
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Music", 'massive-dynamic'),
    "base" => "md_music",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Media','massive-dynamic'),
    "params" => pixflow_music_param()
));
