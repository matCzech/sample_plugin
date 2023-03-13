<?php

/*
    @package DelvoyPlugin
*/  

class DelvoyPluginActivate{

    public static function activate(){
        echo 'test';
        //$this -> custom_post_type();
        flush_rewrite_rules();

    }

}