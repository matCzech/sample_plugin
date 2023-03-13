<?php

/*
    @package DelvoyPlugin
*/  

class DelvoyPluginDeactivate{

    public static function deactivate(){
        flush_rewrite_rules();
    }

}