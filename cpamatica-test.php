<?php
/**
 * Plugin Name: CPAMATICA test
 * php version 8.1.9
 *  
 * Description: A simple WordPress plugin.
 * Version: 1.0.0
 * Author: Matthew Ermakov
 * License: GPL2
 * 
 * @category Pluginfile
 * @package  Cpmatica-test
 * @author   Matthew Ermakov <mazdaraser.91@gmail.com>
 * @license  "License 1.0"
 * @link     https://google.com/cpmatica-test
 */

namespace Cpamatica;

if (! defined('ABSPATH') ) {
    return;
}

define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PLUGIN_ASSETS_DIR', PLUGIN_DIR . "assets/");

/**
 * Responsible for initizlizing of plugin entries
 * 
 * @category Includes
 * @package  Cpamatica-test
 * @author   Matthew Ermakov <mazdaraser.91@gmail.com>
 * @license  "License 1.0"
 * @link     https://google.com/loader-class
 */
class CpmaticaTest
{
    /**
     * Creates instance for the class
     * 
     * @return void
     */
    public function __construct()
    {
        $this->getEntries();
    }

    /**
     * Gets all entries
     * 
     * @return void
     */
    public function getEntries()
    {
        include_once PLUGIN_DIR . 'includes/Loader.php'; 
        include_once PLUGIN_DIR . 'shortcodes/Loader.php'; 

        // Initialize includes
        (new \Cpamatica\Includes\Loader());

        // Initialize shortcodes
        (new \Cpamatica\Shortcodes\Loader());
    }
}

// Plugin init
(new CpmaticaTest());
