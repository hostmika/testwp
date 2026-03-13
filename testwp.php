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
define('TESTWP_URL', plugin_dir_url(__FILE__));
define('TESTWP_VERSION', '1.0'); 

require_once TESTWP_PATH . 'includes/post-type.php';
require_once TESTWP_PATH . 'includes/taxonomies.php';
require_once TESTWP_PATH . 'includes/meta-box.php';
require_once TESTWP_PATH . 'includes/shortcode-events.php';

function testwp_enqueue_styles() {

    if (!is_admin()) {

        wp_enqueue_style(
            'testwp-events',
            TESTWP_URL . 'assets/css/events.css',
            array(),
            TESTWP_VERSION,
            'all'
        );

        wp_enqueue_script(
            'testwp-events',
            TESTWP_URL . 'assets/js/events.js',
            array('jquery'),
            TESTWP_VERSION,
            true
        );

        wp_localize_script('testwp-events', 'testwpAjax', array(
            'url'   => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('testwp_loadmore'),
        ));

    }

}
add_action('wp_enqueue_scripts', 'testwp_enqueue_styles');