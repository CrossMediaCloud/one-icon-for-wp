<?php

/**
 * Public helper to render icon, allowing custom icons by themes to be displayed.
 *
 * @param string $icon_name
 */
function one_icon_for_wp_display_icon( string $icon_name ): void {

	// Build default icon path
	$svg_path = dirname( dirname( __FILE__ ) ) . '/assets/svg/' . $icon_name . '.svg';
	// Check if plugin own icon is displayed
	if ( file_exists( $svg_path ) ) {
		echo file_get_contents( $svg_path );

		return;
	}

	// Build the path to search for in themes
	$icon_sub_path = '/one-icon-for-wp/' . $icon_name . '.svg';

	// Check child theme
	if ( file_exists( get_stylesheet_directory() . $icon_sub_path ) ) {
		// Output icon from child theme
		echo file_get_contents( get_stylesheet_directory() . $icon_sub_path );

		return;
	}

	// Check parent theme
	if ( file_exists( get_template_directory() . $icon_sub_path ) ) {
		// Output icon from parent theme
		echo file_get_contents( get_template_directory() . $icon_sub_path );

		return;
	}

	/**
	 * Allow other plugin to to render own icons.
	 */
	do_action( 'one_icon_for_wp_missing_icon_to_display', $icon_name );

}
