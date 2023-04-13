<?php 
/**
 * @package  DeLvoyPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard(){
        require_once($this->plugin_path . '/templates/admin.php');
    }

    public function cptManagerDashboard(){
        require_once($this->plugin_path . '/templates/cpt-manager.php');
    }

    public function taxoManagerDashboard(){
        require_once($this->plugin_path . '/templates/taxonomies-manager.php');
    }

    public function customWidgetsDashboard(){
        require_once($this->plugin_path . '/templates/custom-widgets.php');
    }

    public function delvoyOptionsGroup($input){
        return $input;
    }

    public function delvoyAdminSection(){
        echo 'show section text';
    }

    public function delvoyTextExample(){
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="'.$value.'" placeholder="Place text">';
    }

    //3 of 3 steps adding new custom field in the same group
    public function delvoyAnotherExample(){
        $value = esc_attr(get_option('another_example'));
        echo '<input type="text" class="regular-text" name="another_example" value="'.$value.'" placeholder="Place text">';
    }
}