<?php

namespace Inc\Base;

/**
* 
*/
class Enqueue
{
	public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function enqueue(){
        //enqueue all scripts
        wp_enqueue_style('plugin-style', PLUGIN_URL . '/assets/plug-styles.css');
        wp_enqueue_script('plugin-script', PLUGIN_URL . '/assets/plug-scripts.js');
    }
}