<?php 

namespace Cpamatica\Shortcodes;

class Loader
{
    public function __construct( )
    {
        $this->load();
        $this->init();
    }

    public function load( )
    {
        include_once plugin_dir_path(__FILE__) . "posts_output/Loader.php";
    }

    public function init( )
    {
        (new \Cpamatica\Shortcodes\PostsOutput\Loader());
    }
}