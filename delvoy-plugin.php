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

    public $plugin_title;

    function __construct(){
        $this->plugin_title = plugin_basename(__FILE__);
        $this->create_post_type();
    }

    function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
        add_action('admin_menu', array($this, 'add_admin_pages'));
        add_filter("plugin_action_links_$this->plugin_title", array($this, 'settings_link'));
    }

    protected function create_post_type(){
        add_action('init', array($this, 'custom_post_type'));
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
        wp_enqueue_script('plugin-script', plugins_url('/assets/plug-scripts.js', __FILE__));
    }

    public function add_admin_pages(){
        add_menu_page( 'DeLvoy plugin', 'DeLvoy', 'manage_options', 'delvoy_plugin', array($this, 'admin_index'), 'dashicons-store', 110);
    }

    public function admin_index(){
        require_once plugin_dir_path(__FILE__) . 'templates/admin_page.php';
    }

    public function settings_link($links){
        $settings_link = '<a href="admin.php?page=delvoy_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    function activate(){
        require_once plugin_dir_path(__FILE__) . 'inc/delvoy-plugin-activate.php';
        DelvoyPluginActivate::activate();
    }

}

if(class_exists('DeLvoyPlugin')){
    $delvoy_plugin = new DeLvoyPlugin();
    $delvoy_plugin->register();
}

//activation
register_activation_hook( __FILE__, array($delvoy_plugin, 'activate') );

//deactivation
require_once plugin_dir_path(__FILE__) . '/inc/delvoy-plugin-deactivate.php';
register_deactivation_hook( __FILE__, array('DelvoyPluginDeactivate', 'deactivate') );

