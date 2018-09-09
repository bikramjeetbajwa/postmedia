<?php

if(! function_exists('get_default_date_format')){
    function get_default_date_format(){
        return 'd-M-y h:i:s a P';
    }
}

if(! function_exists('convert_to_gmt')){
    function convert_to_gmt($local_date = null, $format = null){
        if($local_date === null) {
            $local_date = date(get_default_date_format());
        }
        if($format === null) {
            $format = get_default_date_format();
        }

        $local_timezone = new DateTimeZone(date_default_timezone_get());
        $date = new DateTime($local_date, $local_timezone);
        $date->setTimezone(new DateTimeZone('GMT'));
        $gmt_date = $date->format($format);
        return $gmt_date;
    }
}

if(! function_exists('convert_to_local')){
    function convert_to_local($date = null, $format = null ){
        if($date === null) {
            return null;
        }
        if($format === null) {
            $format = get_default_date_format();
        }
        $local_timezone = new DateTimeZone(date_default_timezone_get());
        $local_date = date($format, strtotime($date));
        $new_date = new DateTime($local_date, $local_timezone);
        $outbound_dt = $new_date->format($format);;
        return $outbound_dt;
    }
}

if(! function_exists('convert_date_for_db')){
    function convert_date_for_db($date = null){
        if($date === null) {
            return null;
        }
        $db_date 	= convert_to_gmt($date, 'd-M-y h:i:s a P');
        return $db_date;
    }
}
if(! function_exists('format_date')){
    function format_date($date = null, $format = null ){
        if($date === null) {
            return null;
        }
        if($format === null) {
            $format = get_default_date_format();
        }
        $outbound_dt 	= date($format, strtotime($date));
        return $outbound_dt;
    }
}



if(! function_exists('get_timezone_offset')){
        function get_timezone_offset( $origin_tz = null, $type = 'HR') {
        if($origin_tz === null) {
            if(!is_string($origin_tz = date_default_timezone_get())) {
                return false; // A UTC timestamp was returned -- bail out!
            }
        }
        $origin_dtz = new DateTimeZone($origin_tz);
        $origin_dt = new DateTime("now", $origin_dtz);
        if($type == 'SEC'){
            $offset = $origin_dtz->getOffset($origin_dt);
        }
        else if($type == 'MIN'){
            $offset = $origin_dtz->getOffset($origin_dt)/60;
        }
        else{
            $offset = ($origin_dtz->getOffset($origin_dt)/60)/60;
        }
        return $offset;
    }

}

if(! function_exists('add_interval')){
    function add_interval($date = null, $interval = null, $convert_to_gmt = false, $format = null){
        if($date === null) {
            $date = date(get_default_date_format());
        }
        if($format === null) {
            $format = get_default_date_format();
        }
        if($interval != null) {
            $datetime = new DateTime($date);
            $datetime->add(new DateInterval($interval)); //P1D
            $outbound_dt = $datetime->format($format) ;
        }
        else{
            $outbound_dt = $date;
        }
        if($convert_to_gmt){
            $outbound_dt = convert_to_gmt($outbound_dt);
        }
        return $outbound_dt;
    }
}

if(! function_exists('sub_interval')){
    function sub_interval($date = null, $interval = null, $convert_to_gmt = false, $format = null)
    {
        if($date === null) {
            $date = date(get_default_date_format());
        }
        if($format === null) {
            $format = get_default_date_format();
        }
        if($interval != null) {
            $datetime = new DateTime($date);
            $datetime->sub(new DateInterval($interval)); //P1D
            $outbound_dt = $datetime->format($format) ;
        }
        else{
            $outbound_dt = $date;
        }
        if($convert_to_gmt){
            $outbound_dt = convert_to_gmt($outbound_dt);
        }
        return $outbound_dt;
    }
}



