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

class DeLvoyPlugin{ 

    //public

    //protected

    //private

    function __construct(){
        $this->create_post_type();
    }

    function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    protected function create_post_type(){
        add_action('init', array($this, 'custom_post_type'));
    }

    function activate(){
        //generate CPT
        $this -> custom_post_type();
        //flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
         //flush rewrite rules 
         flush_rewrite_rules(); 
    }

    function custom_post_type(){
        register_post_type( 'book', [
            'public' => true,
            'label' => 'Books'
        ]);
    }

    function enqueue(){
        //enqueue all scripts
        wp_enqueue_style('plugin-style', plugins_url('/assets/plug-styles.css', __FILE__));
        wp_enqueue_script('plugin-script', plugins_url('/assets/plug-scripts.js' __FILE__));
    }

}

if(class_exists('DeLvoyPlugin')){
    $delvoy_plugin = new DeLvoyPlugin();
    $delvoy_plugin->register();
}

//activation
register_activation_hook( __FILE__, array($delvoy_plugin, 'activate') );

//deactivation
register_deactivation_hook( __FILE__, array($delvoy_plugin, 'deactivate') );

