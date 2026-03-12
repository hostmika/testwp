<?php

function testwp_register_taxonomies() {
    $genre_labels = array(
        'name'              => 'Genres',
        'singular_name'     => 'Genre',
        'search_items'      => 'Rechercher des genres',
        'all_items'         => 'Tous les genres',
        'parent_item'       => 'Genre parent',
        'parent_item_colon' => 'Genre parent :',
        'edit_item'         => 'Modifier le genre',
        'update_item'       => 'Mettre à jour le genre',
        'add_new_item'      => 'Ajouter un genre',
        'new_item_name'     => 'Nom du nouveau genre',
        'menu_name'         => 'Genres',
    );

    register_taxonomy('event_genre', 'event', array(
        'hierarchical'      => true,
        'labels'            => $genre_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'genre'),
        'show_in_rest'      => true,
    ));

    $type_labels = array(
        'name'              => 'Types',
        'singular_name'     => 'Type',
        'search_items'      => 'Rechercher des types',
        'all_items'         => 'Tous les types',
        'parent_item'       => 'Type parent',
        'parent_item_colon' => 'Type parent :',
        'edit_item'         => 'Modifier le type',
        'update_item'       => 'Mettre à jour le type',
        'add_new_item'      => 'Ajouter un type',
        'new_item_name'     => 'Nom du nouveau type',
        'menu_name'         => 'Types',
    );

    register_taxonomy('event_type', 'event', array(
        'hierarchical'      => true,
        'labels'            => $type_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'type'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'testwp_register_taxonomies');