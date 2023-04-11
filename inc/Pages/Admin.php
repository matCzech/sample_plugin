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
		$this->setSettings();
		$this->setSections();
		$this->setFields();
		

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

	public function setSettings()
	{
		$args = [
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'text_example',
				'callback' => [$this->callbacks, 'delvoyOptionsGroup']
			]
		];

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				'id' => 'delvoy_admin_index',
				'title' => 'Settings',
				'callback' => [$this->callbacks, 'delvoyAdminSection'],
				'page' => 'delvoy_plugin'
			]
		];

		$this->settings->setSections($args);
	}

	public function setFields()
	{
		$args = [
			[
				'id' => 'text_example',
				'title' => 'Text example',
				'callback' => [$this->callbacks, 'delvoyTextExample'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'text_example',
					'class' => 'example-class'
				]
			]
		];

		$this->settings->setFields($args);
	}
}