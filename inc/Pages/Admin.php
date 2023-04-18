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
		$args = [
			[
				'option_group' => 'delvoy_plugin_settings',
				'option_name' => 'cpt_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			//1 of 3 steps adding new custom field in the same group
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'taxonomy_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'media_widget',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'gallery_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'testimonial_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'templates_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'login_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'membership_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			],
			[
				'option_group' => 'delvoy_options_group',
				'option_name' => 'chat_manager',
				'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
			]
		];

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
		$args = [
			[
				'id' => 'cpt_manager',
				'title' => 'Custom post type manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'cpt_manager',
					'class' => 'ui-toggle'
				]
			],
			//2 of 3 steps adding new custom field in the same group
			[
				'id' => 'taxonomy_manager',
				'title' => 'Taxonomy manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'taxonomy_manager',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'media_widget',
				'title' => 'Media widget',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'media_widget',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'gallery_manager',
				'title' => 'Gallery manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'gallery_manager',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'testimonial_manager',
				'title' => 'Testimonial manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'testimonial_manager',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'templates_manager',
				'title' => 'Templates manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'templates_manager',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'login_manager',
				'title' => 'Login manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'login_manager',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'membership_manager',
				'title' => 'Membership manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'membership_manager',
					'class' => 'ui-toggle'
				]
			],
			[
				'id' => 'chat_manager',
				'title' => 'Chat manager',
				'callback' => [$this->callbacks_mngr, 'checkboxField'],
				'page' => 'delvoy_plugin',
				'section' => 'delvoy_admin_index',
				'args' => [
					'label_for' => 'chat_manager',
					'class' => 'ui-toggle'
				]
			]
		];

		$this->settings->setFields($args);
	}
}