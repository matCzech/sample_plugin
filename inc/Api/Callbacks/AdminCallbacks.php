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


}