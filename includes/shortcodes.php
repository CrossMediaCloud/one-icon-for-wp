<?php

/*
 * Add shortcode
 */

class ONE_ICON_FOR_WP_SHORTCODES {

	public function __construct() {

		// Add single icon shortcode
		add_shortcode( 'icon', array( $this, 'single_icon' ) );

	}

	/**
	 * Single icon.
	 *
	 * @param array $atts
	 */
	public function single_icon( array $atts ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'icon' => 'font-awesome/brands/font-awesome-flag',
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

}

new  ONE_ICON_FOR_WP_SHORTCODES();
