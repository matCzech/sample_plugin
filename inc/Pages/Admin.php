<?php 
/**
 * @package  DeLvoyPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;
	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();
	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

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
		$args = [];

		foreach($this->managers as $key => $manager){

			$args[] = [
				'option_group' => 'delvoy_plugin_settings',
				'option_name' => $manager,
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			];
		}

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				'id' => 'delvoy_admin_index',
				'title' => 'Settings manager',
				'callback' => [$this->callbacks_mngr, 'adminSectionManager'],
				'page' => 'delvoy_plugin'
			]
		];

		$this->settings->setSections($args);
	}

	public function setFields()
	{
		$args = [];

		foreach($this -> managers as $key => $manager){

			$args[] = [
				'id' => $key,
				'title' => $manager,
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => $key,
					'class' => 'ui-toggle'
				]
			];
		}

		$this->settings->setFields($args);
	}
}