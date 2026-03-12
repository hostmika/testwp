<?php

function testwp_render_events($atts) {

	$atts = shortcode_atts(array(
		'genre' => '',
	), $atts);

	$args = array(
		'post_type' => 'event',
		'posts_per_page' => -1,
	);


	$query = new WP_Query($args);

	ob_start();

	if ($query->have_posts()) {

		echo '<div class="events-list">';

		while ($query->have_posts()) {

			$query->the_post();

			$lieu = get_post_meta(get_the_ID(), '_event_lieu', true);
			$tarif = get_post_meta(get_the_ID(), '_event_tarif', true);

			echo '<div class="event">';
			echo '<h3>' . esc_html(get_the_title()) . '</h3>';

			if ($lieu) {
				echo '<p><strong>Lieu :</strong> ' . esc_html($lieu) . '</p>';
			}

			if ($tarif) {
				echo '<p><strong>Tarif :</strong> ' . esc_html($tarif) . '</p>';
			}

			echo '</div>';

		}

		echo '</div>';

	}

	wp_reset_postdata();

	return ob_get_clean();

}

add_shortcode('events', 'testwp_render_events');