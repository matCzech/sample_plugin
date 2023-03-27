<?php

/*
    @package DelvoyPlugin
    Link for settings
*/ 

namespace Inc\Base;

class SettingsLinks
{
    public function register(){
        add_filter("plugin_action_links_" . PLUGIN, array($this, 'settings_links'));
    }

    public function settings_links($links){
        $setting_links = '<a href="admin.php?page=delvoy_plugin">Settings</a>';
        array_push($links, $setting_links);
        return $links;
    }
}