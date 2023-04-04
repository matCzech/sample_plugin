<?php 
/**
 * @package  DeLvoyPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();

		$this->setPages();
		$this->setSubPages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages(){
		$this->pages = array(
			array(
				'page_title' => 'DeLvoy Plugin', 
				'menu_title' => 'DeLvoy', 
				'capability' => 'manage_options', 
				'menu_slug' => 'delvoy_plugin', 
				'callback' => array($this->callbacks, 'adminDashboard'), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSubPages(){
		$this->subpages = array(
			array(
				'parent_slug' => 'delvoy_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'delvoy_cpt', 
				'callback' => array($this->callbacks, 'cptManagerDashboard')
			),
			array(
				'parent_slug' => 'delvoy_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'delvoy_taxonomies', 
				'callback' => array($this->callbacks, 'taxoManagerDashboard')
			),
			array(
				'parent_slug' => 'delvoy_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'delvoy_widgets', 
				'callback' => array($this->callbacks, 'customWidgetsDashboard')
			)
		);
	}
}