<?php

/*
    @package DelvoyPlugin
*/

/*
    Plugin Name: DeLvoy plugin
    Plugin URI: https://matweb.net
    Description: Plugin creation battlefield
    Version: 1.0.0
    Author: mCzech
    License: GPLv2 or later
*/

defined ('ABSPATH') or die();

if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')){
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


if(class_exists('Inc\\Init')){
    Inc\Init::register_services();
}

