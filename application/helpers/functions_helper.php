<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(! function_exists('view'))
{
    function view($data, $flag = 0)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if($flag == 1) die();
    }
}



/*
 * Logged in user related functions
 * --------------------------------
 */
    if(! function_exists('getUserId'))
    {
        function getUserId()
        {
            $CI =& get_instance();
            $user = $CI->session->userdata('user');
            if(isset($user->USE_ID) && $user->USE_ID !=NULL)
                return $user->USE_ID;
            else
                return '';
        }
    }
    if(! function_exists('getName'))
    {
        function getName()
        {
            $CI =& get_instance();
            $user = $CI->session->userdata('user');
            if(isset($user->NAME) && $user->NAME !=NULL)
                return $user->NAME;
            else
                return '';
        }
    }
    if(! function_exists('getUserName'))
    {
        function getUserName()
        {
            $CI =& get_instance();
            $user = $CI->session->userdata('user');
            if(isset($user->USERNAME) && $user->USERNAME !=NULL)
                return $user->USERNAME;
            else
                return '';
        }
    }
    if(! function_exists('getEmail'))
    {
        function getEmail()
        {
            $CI =& get_instance();
            $user = $CI->session->userdata('user');
            if(isset($user->EMAIL) && $user->EMAIL !=NULL)
                return $user->EMAIL;
            else
                return '';
        }
    }

    if(! function_exists('getCusId'))
    {
        function getCusId()
        {
            $CI =& get_instance();
            $user = $CI->session->userdata('user');
            if(isset($user->CUS_ID) && $user->CUS_ID !=NULL)
                return $user->CUS_ID;
            else
                return '';
        }
    }

    if(! function_exists('getCusLocation'))
    {
        function getCusLocation()
        {
            $CI =& get_instance();
            $user = $CI->session->userdata('user');
            if(isset($user->LOC_ID_DEFAULT) && $user->LOC_ID_DEFAULT !=NULL)
                return $user->LOC_ID_DEFAULT;
            else
                return '';
        }
    }




/* -------------------------------- */

if(! function_exists('getRandomString'))
{
    function getRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUBWXYZ';
        $string = "";
        for($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters)-1)];
        }
        return $string;
    }
}