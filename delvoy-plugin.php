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

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', plugin_basename(__FILE__));

use Inc\Base\Activate;
use Inc\Base\Deactivate;

function activate_delvoy_plugin(){
    Activate::activate();
}

function deactivate_delvoy_plugin(){
    Deactivate::deactivate();
}

register_activation_hook(__FILE__,'activate_delvoy_plugin');
register_deactivation_hook(__FILE__,'deactivate_delvoy_plugin');

if(class_exists('Inc\\Init')){
    Inc\Init::register_services();
}

