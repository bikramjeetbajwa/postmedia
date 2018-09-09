<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['header'] = array();
$config['sidebar'] = array(
    1 => array(
        'title'             => 'Dashboard',
        'link_type'         => 'page',
        'page_id'           => 1,
        'module_name'       => '',
        'url'               => 'Dashboard',
        'uri'               => '',
        'position'          => 1,
        'target'            => '',
        'parent_id'         => 0,
        'is_parent'         => 1,
        'show_menu'         => 1,
        'icon'              => 'fa fa-dashboard'
    ),
    2 => array(
        'title'             => 'Service Calls',
        'link_type'         => 'page',
        'page_id'           => 1,
        'module_name'       => '',
        'url'               => 'service_call',
        'uri'               => '',
        'position'          => 2,
        'target'            => '',
        'parent_id'         => 0,
        'is_parent'         => 1,
        'show_menu'         => 1,
        'icon'              => 'fa fa-cogs',

    ),
    /*
    3 => array(
        'title'             => 'Invoices',
        'link_type'         => 'page',
        'page_id'           => 1,
        'module_name'       => '',
        'url'               => 'invoice',
        'uri'               => '',
        'position'          => 3,
        'target'            => '',
        'parent_id'         => 0,
        'is_parent'         => 1,
        'show_menu'         => 1,
        'icon'              => 'fa fa-bank',

        'children'          => array(
            1 => array(
                'title'             => 'List All',
                'link_type'         => 'page',
                'page_id'           => 1,
                'module_name'       => '',
                'url'               => 'invoice/',
                'uri'               => '',
                'position'          => 1,
                'target'            => '',
                'parent_id'         => 2,
                'is_parent'         => 0,
                'show_menu'         => 1,
                'icon'              => ''
            ),
        ),
    ),
    4 => array(
        'title'             => 'Preventive Maintenance',
        'link_type'         => 'page',
        'page_id'           => 1,
        'module_name'       => '',
        'url'               => 'pm',
        'uri'               => '',
        'position'          => 4,
        'target'            => '',
        'parent_id'         => 0,
        'is_parent'         => 1,
        'show_menu'         => 1,
        'icon'              => 'fa fa-calendar-o'
    ),
    5 => array(
        'title'             => 'Ownerships',
        'link_type'         => 'page',
        'page_id'           => 1,
        'module_name'       => '',
        'url'               => 'ownerships',
        'uri'               => '',
        'position'          => 4,
        'target'            => '',
        'parent_id'         => 0,
        'is_parent'         => 1,
        'show_menu'         => 1,
        'icon'              => 'fa fa-newspaper-o'
    ),
    */
    6 => array(
        'title'             => 'Contact Us',
        'link_type'         => 'page',
        'page_id'           => 1,
        'module_name'       => '',
        'url'               => 'Contact',
        'uri'               => '',
        'position'          => 4,
        'target'            => '',
        'parent_id'         => 0,
        'is_parent'         => 1,
        'show_menu'         => 1,
        'icon'              => 'fa fa-envelope-o'
    ),


);


$config['footer'] = array();