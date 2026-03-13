<?php

if (!defined('ABSPATH')) {
    exit;
}

function testwp_render_events($atts) {

    $atts = shortcode_atts(array(
        'genre' => '',
    ), $atts);

    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => 8,
        'paged'          => 1,
    );

    if (!empty($atts['genre'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'event_genre',
                'field'    => 'slug',
                'terms'    => sanitize_title($atts['genre']),
            ),
        );
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {

        echo '<div class="events-list" data-genre="' . esc_attr($atts['genre']) . '" data-page="1">';

        while ($query->have_posts()) {
            $query->the_post();
            testwp_render_event_card();
        }

        echo '</div>';

        if ($query->max_num_pages > 1) {
            echo '<div class="events-loadmore-wrap">';
            echo '<button class="events-loadmore">Voir plus</button>';
            echo '</div>';
        }

    } else {
        echo '<p class="no-events">Aucun événement trouvé pour ce genre.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

function testwp_render_event_card() {

    $lieu  = get_post_meta(get_the_ID(), '_event_lieu', true);
    $tarif = get_post_meta(get_the_ID(), '_event_tarif', true);

    echo '<div class="event">';
    echo '<p class="event-title">' . esc_html(get_the_title()) . '</p>';

    if ($lieu) {
        echo '<p><strong>Lieu :</strong> ' . esc_html($lieu) . '</p>';
    }

    if ($tarif) {
        echo '<p><strong>Tarif :</strong> ' . esc_html($tarif) . '</p>';
    }

    echo '</div>';
}

function testwp_loadmore_handler() {

    check_ajax_referer('testwp_loadmore', 'nonce');

    $page  = isset($_POST['page'])  ? intval($_POST['page'])          : 1;
    $genre = isset($_POST['genre']) ? sanitize_title($_POST['genre']) : '';

    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => 8,
        'paged'          => $page,
    );

    if (!empty($genre)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'event_genre',
                'field'    => 'slug',
                'terms'    => $genre,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {

        $html = '';

        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            testwp_render_event_card();
            $html .= ob_get_clean();
        }

        wp_reset_postdata();

        wp_send_json_success(array(
            'html'     => $html,
            'has_more' => $page < $query->max_num_pages,
        ));

    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_testwp_loadmore',        'testwp_loadmore_handler');
add_action('wp_ajax_nopriv_testwp_loadmore', 'testwp_loadmore_handler');
add_shortcode('events', 'testwp_render_events');