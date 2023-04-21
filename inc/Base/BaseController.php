<?php 
/**
 * @package  DeLvoyPlugin
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;
	public $managers = [];

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/delvoy-plugin.php';

		$this->managers = [
			'cpt_manager' => 'Custom post type manager',
			'taxonomy_manager' => 'Taxonomy manager',
			'media_widget' => 'Media widget',
			'gallery_manager' => 'Gallery manager',
			'testimonial_manager' => 'Testimonial manager',
			'templates_manager' => 'Templates manager',
			'login_manager' => 'Login manager',
			'membership_manager' => 'Membership manager',
			'chat_manager' => 'Chat manager'
		];
	}
}