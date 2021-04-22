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

	// Allow overwriting te icon max width
	$max_width = apply_filters( 'one_icon_for_wp_shortcode_icon_max_width', 100 );

	ob_start();
	?>
	<div style="max-width: <?php echo (int) $max_width; ?>px; <?php echo $atts['style']; ?>">
		<?php
		// Display the icon
		do_action( 'one_icon_for_wp_display_icon', $atts['icon'] );
		?>
	</div>

	<?php
	// Return the markup
	return ob_get_clean();
}

// Add single icon shortcode
add_shortcode( 'icon', 'one_icon_for_wp_single_icon_shortcode' );
