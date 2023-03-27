<?php

/*
    @package DelvoyPlugin
*/  

namespace Inc\Base;

class Activate{

    public static function activate(){
        echo 'test';
        //$this -> custom_post_type();
        flush_rewrite_rules();

    }

}