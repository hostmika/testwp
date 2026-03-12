<?php
/**
 * Plugin Name: TestWP
 * Description: Plugin de gestion d'événements pour test technique.
 * Version: 1.0
 */

if (!defined('ABSPATH')) {
	exit;
}

define('TESTWP_PATH', plugin_dir_path(__FILE__));

require_once TESTWP_PATH . 'includes/post-type.php';
require_once TESTWP_PATH . 'includes/taxonomies.php';
require_once TESTWP_PATH . 'includes/meta-box.php';
require_once TESTWP_PATH . 'includes/shortcode-events.php';