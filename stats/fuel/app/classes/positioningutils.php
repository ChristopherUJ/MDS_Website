<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of positioningutils
 *
 * @author David Weber
 */
class PositioningUtils {

    /**
     * Get distance between to positions in kilometers
     *
     * Code from http://www.corecoding.com/getfile.php?file=25
     */
    public static function get_distance($from, $to, $unit = 'K', $round = true) {
        $theta = $from['longitude'] - $to['longitude'];
        $dist = sin(deg2rad($from['latitude'])) * sin(deg2rad($to['latitude'])) + cos(deg2rad($from['latitude'])) * cos(deg2rad($to['latitude'])) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $dist = $dist * 60 * 1.1515;

        if ($unit == "K") {
            $dist *= 1.609344;
        } else if ($unit == "N") {
            $dist *= 0.8684;
        }

        if ($round) {
            $dist = round($dist, 1);
        }
        return $dist;
    }

    /**
     * Get bearing from position to another
     *
     * Code from http://www.corecoding.com/getfile.php?file=25
     */
    public static function get_bearing($from, $to) {
        if (round($from['longitude'], 1) == round($to['longitude'], 1)) {
            if ($from['latitude'] < $to['latitude']) {
                $bearing = 0;
            } else {
                $bearing = 180;
            }
        } else {
            $dist = self::get_distance($from, $to, 'N');
            $arad = acos((sin(deg2rad($to['latitude'])) - sin(deg2rad($from['latitude'])) * cos(deg2rad($dist / 60))) / (sin(deg2rad($dist / 60)) * cos(deg2rad($from['latitude']))));
            $bearing = $arad * 180 / pi();
            if (sin(deg2rad($to['longitude'] - $from['longitude'])) < 0) {
                $bearing = 360 - $bearing;
            }
        }

        $dirs = array("N", "E", "S", "W");

        $rounded = round($bearing / 22.5) % 16;
        if (($rounded % 4) == 0) {
            $dir = $dirs[$rounded / 4];
        } else {
            $dir = $dirs[2 * floor(((floor($rounded / 4) + 1) % 4) / 2)];
            $dir .= $dirs[1 + 2 * floor($rounded / 8)];
        }

        return $dir;
    }

    /**
     * Converts DMS ( Degrees / minutes / seconds ) to decimal format longitude / latitude
     *
     * Code from http://www.web-max.ca/PHP/misc_6.php
     */
    public static function coordinate_to_decimal($deg, $min = 0, $sec = 0, $modifier = 1) {
        return ($deg + ((($min * 60) + ($sec)) / 3600)) * $modifier;
    }

    /**
     * Converts decimal longitude / latitude to DMS ( Degrees / minutes / seconds )
     *
     * Code from http://www.web-max.ca/PHP/misc_6.php
     */
    public static function decimal_to_coordinate($dec) {
        // This is the piece of code which may appear to
        // be inefficient, but to avoid issues with floating
        // point math we extract the integer part and the float
        // part by using a string function.
        $vars = explode(".", $dec);
        $deg = $vars[0];
        $tempma = "0.{$vars[1]}";
        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min * 60);
        $coordinate = array
            (
            'deg' => $deg,
            'min' => $min,
            'sec' => $sec
        );
        return $coordinate;
    }

    public static function pretty_print_to_decimal($pretty_print) {
        $modifier = (strpos($pretty_print, 'S') !== false || strpos($pretty_print, 'W') !== false) ? -1 : 1;
        $numerics = trim(preg_replace('/[\'NSEW\s°]/', ' ', $pretty_print));
        $numerics = str_replace('  ', ' ', $numerics);

        $coordinate = explode(' ', $numerics);
        if (!isset($coordinate[0]))
            $coordinate[0] = 0;
        if (!isset($coordinate[1]))
            $coordinate[1] = 0;
        if (!isset($coordinate[2]))
            $coordinate[2] = 0;

        return self::coordinate_to_decimal($coordinate[0], $coordinate[1], $coordinate[2], $modifier);
    }

    /**
     * Pretty-print a coordinate value (latitude or longitude)
     *
     * Code from http://en.wikipedia.org/wiki/Geographic_coordinate_conversion
     *
     * @return string
     */
    public static function pretty_print_coordinate($coordinate) {
        return sprintf("%0.0f° %2.3f", floor(abs($coordinate)), 60 * (abs($coordinate) - floor(abs($coordinate)))
        );
    }

    /**
     * Pretty-print a full coordinate (longitude and latitude)
     *
     * Code from http://en.wikipedia.org/wiki/Geographic_coordinate_conversion
     *
     * @return string
     */
    public static function pretty_print_coordinates($latitude, $longitude) {
        return sprintf("%s %s, %s %s", ($latitude > 0) ? "N" : "S", self::pretty_print_coordinate($latitude), ($longitude > 0) ? "E" : "W", self::pretty_print_coordinate($longitude)
        );
    }

}

?>
