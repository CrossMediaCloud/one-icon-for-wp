<?php

/**
 * Single icon shortcode.
 *
 * @param array $atts
 */
function one_icon_for_wp_single_icon_shortcode( array $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'icon'  => 'font-awesome/brands/font-awesome-flag',
			'style' => '',
		),
		$atts
	);

	if ( ! empty( $atts['style'] ) ) {
		echo '<div style="' . $atts['style'] . '">';
	}

	// Display the icon
	do_action( 'one_icon_for_wp_display_icon', $atts['icon'] );

	if ( ! empty( $atts['style'] ) ) {
		echo '</div>';
	}

}

// Add single icon shortcode
add_shortcode( 'icon', 'one_icon_for_wp_single_icon_shortcode' );
