<?php
function pixflow_colorConvertor($color, $to, $alpha = 1)
{

    if (strpos($color, 'rgba') !== false) {
        $format = 'rgba';
    } elseif (strpos($color, 'rgb') !== false) {
        $format = 'rgb';
    } elseif (strpos($color, '#') !== false) {
        $format = 'hex';
    } else {
        return '#000';
    }


    switch ($format) {
        case 'rgb':
            if ($to == 'rgba') {
                sscanf($color, 'rgb(%d,%d,%d)', $r, $g, $b);
                return ('rgba(' . $r . ',' . $g . ',' . $b . ',' . $alpha . ');');
            } elseif ($to == 'hex') {
                return pixflow_rgb2hex($color);
            } elseif ($to == 'rgb') {
                return $color;
            }
            break;

        case 'rgba':
            if ($to == 'rgb') {
                return pixflow_RgbaToRgb($color);
            } elseif ($to == 'hex') {
                $rgb = pixflow_RgbaToRgb($color);
                return pixflow_rgb2hex($rgb);
            } elseif ($to == 'rgba') {
                sscanf($color, 'rgba(%d,%d,%d,%f)', $r, $g, $b, $a);
                return ('rgba(' . $r . ',' . $g . ',' . $b . ',' . $alpha . ');');
            }
            break;

        case 'hex' :
            $default = 'rgb(0,0,0)';
            //Sanitize $color if "#" is provided
            if ($color[0] == '#') {
                $color = mb_substr($color, 1);
            }
            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            } elseif (strlen($color) == 3) {
                $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            } else {
                return $default;
            }
            //Convert hexadec to rgb
            $rgb = array_map('hexdec', $hex);

            if ($to == 'rgba') {
                return 'rgba(' . implode(",", $rgb) . ',' . $alpha . ')';
            } elseif ($to == 'rgb') {
                return 'rgb(' . implode(",", $rgb) . ')';
            } elseif ($to == 'hex') {
                return $color;
            }
    }
}

function pixflow_rgb2hex($color)
{
    $hex = "#";
    if (!is_array($color)) {
        $color = explode(',', $color);
        $color[0] = str_replace('rgb', '', $color[0]);
        $color[0] = str_replace('(', '', $color[0]);
        $color[2] = str_replace(')', '', $color[2]);
    }
    $hex .= str_pad(dechex($color[0]), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($color[1]), 2, "0", STR_PAD_LEFT);
    $hex .= str_pad(dechex($color[2]), 2, "0", STR_PAD_LEFT);
    return $hex; // returns the hex value including the number sign (#)
}

// convert rgba to rgb
function pixflow_RgbaToRgb($rgba)
{

    sscanf($rgba, 'rgba(%d,%d,%d,%f)', $r, $g, $b, $a);
    return ('rgb(' . $r . ',' . $g . ',' . $b . ');');
}