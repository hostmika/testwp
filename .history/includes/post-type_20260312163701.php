<?php

function testwp_register_post_type() {
    $labels = array(
        'name'               => 'Événements',
        'singular_name'      => 'Événement',
        'menu_name'          => 'Événements',
        'add_new'            => 'Ajouter',
        'add_new_item'       => 'Ajouter un événement',
        'edit_item'          => 'Modifier l\'événement',
        'new_item'           => 'Nouvel événement',
        'view_item'          => 'Voir l\'événement',
        'search_items'       => 'Rechercher des événements',
        'not_found'          => 'Aucun événement trouvé',
        'not_found_in_trash' => 'Aucun événement dans la corbeille'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'evenements'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'thumbnail'),
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_rest'        => true,
    );

    register_post_type('event', $args);
}
add_action('init', 'testwp_register_post_type');