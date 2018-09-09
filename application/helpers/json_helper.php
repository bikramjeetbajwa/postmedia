<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('show_json_result')) {

    //todo: validate this function
    function show_json_result($result, $show_total = False, $status_code = 200, $status_message = '')
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        set_status_header($status_code, $status_message);
        $total = sizeof($result);
        if ($total == 0)
            $result = '';
        if ($show_total) {
            $json_data = '{"total":' . $total . ',"data":' . json_encode($result) . "}";
        } else {
            $json_data = '{"data":' . json_encode($result) . '}';
        }
        echo $json_data;
        exit;
    }
}

if ( ! function_exists('show_json_message')) {
    function show_json_message($code, $data, $status = TRUE, $status_code = 200, $status_message = '')
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        set_status_header($status_code, $status_message);
        $json_data = json_encode(
            array(
                'status' => $status,
                'code' => $code,
                'data' => $data,
            )
        );
        echo $json_data;
        exit;
    }
}