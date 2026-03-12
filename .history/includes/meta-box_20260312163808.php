<?php
// Ajout des meta boxes
function testwp_add_meta_boxes() {
    add_meta_box(
        'event_details',
        'Détails de l\'événement',
        'testwp_render_meta_box',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'testwp_add_meta_boxes');

function testwp_render_meta_box($post) {
    wp_nonce_field('testwp_save_meta', 'testwp_meta_nonce');
    
    $lieu = get_post_meta($post->ID, '_event_lieu', true);
    $tarif = get_post_meta($post->ID, '_event_tarif', true);
    ?>
    <p>
        <label for="event_lieu">Lieu :</label>
        <input type="text" id="event_lieu" name="event_lieu" value="<?php echo esc_attr($lieu); ?>" class="widefat" />
    </p>
    <p>
        <label for="event_tarif">Tarif :</label>
        <input type="text" id="event_tarif" name="event_tarif" value="<?php echo esc_attr($tarif); ?>" class="widefat" />
        <small>Exemple : Gratuit, 15€, Sur devis...</small>
    </p>
    <?php
}

function testwp_save_meta($post_id) {
    // Vérifications de sécurité
    if (!isset($_POST['testwp_meta_nonce']) || !wp_verify_nonce($_POST['testwp_meta_nonce'], 'testwp_save_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['event_lieu'])) {
        update_post_meta($post_id, '_event_lieu', sanitize_text_field($_POST['event_lieu']));
    }
    
    if (isset($_POST['event_tarif'])) {
        update_post_meta($post_id, '_event_tarif', sanitize_text_field($_POST['event_tarif']));
    }
}
add_action('save_post', 'testwp_save_meta');