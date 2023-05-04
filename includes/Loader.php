<?php
/**
 * File for Loader class
 * php version 8.1.9
 * 
 * @category Includes
 * @package  Cpamatica-test
 * @author   Matthew Ermakov <mazdaraser.91@gmail.com>
 * @license  "License 1.0"
 * @link     https://google.com
 */

namespace Cpamatica\Includes;

/**
 * Responsible for loading of all includes
 * 
 * @category Includes
 * @package  Cpamatica-test
 * @author   Matthew Ermakov <mazdaraser.91@gmail.com>
 * @license  "License 1.0"
 * @link     https://google.com/loader-class
 */
class Loader
{
    private const PLUGIN_INCLUDES_DIR   = PLUGIN_DIR . 'includes/';
    private const PLUGIN_SHORTCODES_DIR = PLUGIN_DIR . 'shortcodes/';

    private const LOADING_FILES = [
        // Api
        self::PLUGIN_INCLUDES_DIR . 'External/API.php',

        // Helpers
        self::PLUGIN_INCLUDES_DIR . 'Helpers/RenderView.php',

        // Main handlers
        self::PLUGIN_INCLUDES_DIR . 'Handlers/Category.php',
        self::PLUGIN_INCLUDES_DIR . 'Handlers/User.php',
        self::PLUGIN_INCLUDES_DIR . 'Handlers/Media.php',
        self::PLUGIN_INCLUDES_DIR . 'Handlers/Post.php',

        // CRON
        self::PLUGIN_INCLUDES_DIR . 'Handlers/Cron.php',
    ];

    /**
     * Creates instance for the class
     * 
     * @return void
     */
    public function __construct()
    {
        foreach ( self::LOADING_FILES as $file) {
            include_once $file;
        }
    }
}
