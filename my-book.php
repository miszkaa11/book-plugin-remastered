<?php
/*
Plugin Name: My Book
Description: This is my book plugin!
Author: Michal Lukaszewicz
*/

define('MY_BOOK_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MY_BOOK_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Include mb-functions.php, use require_once to stop the script if mb-functions.php is not found
require_once plugin_dir_path(__FILE__) . 'includes/mb-functions.php';

