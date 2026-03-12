<?php
/**
 * Register Custom Post Type: Event
 */

if (!defined('ABSPATH')) {
    exit;
}

function testwp_register_post_type() {
    $labels = array(
        'name'                  => _x('Événements', 'Post type general name', 'testwp'),
        'singular_name'         => _x('Événement', 'Post type singular name', 'testwp'),
        'menu_name'             => _x('Événements', 'Admin Menu text', 'testwp'),
        'name_admin_bar'        => _x('Événement', 'Add New on Toolbar', 'testwp'),
        'add_new'               => __('Ajouter nouveau', 'testwp'),
        'add_new_item'          => __('Ajouter nouvel événement', 'testwp'),
        'new_item'              => __('Nouvel événement', 'testwp'),
        'edit_item'             => __('Modifier événement', 'testwp'),
        'view_item'             => __('Voir événement', 'testwp'),
        'all_items'             => __('Tous les événements', 'testwp'),
        'search_items'          => __('Rechercher événements', 'testwp'),
        'not_found'             => __('Aucun événement trouvé.', 'testwp'),
        'not_found_in_trash'    => __('Aucun événement dans la corbeille.', 'testwp'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'events'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('event', $args);
}

add_action('init', 'testwp_register_post_type');