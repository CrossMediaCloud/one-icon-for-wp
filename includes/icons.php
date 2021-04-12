<?php
/*
 * Helper around icons.
 */

/**
 * Class one_icon_for_wp_icons
 */
class ONE_ICON_FOR_WP_ICONS {

	/**
	 * one_icon_for_wp_icons constructor.
	 */
	function __construct() {
		// Add own icons to icon list
		add_filter( 'one-icon-for-wp-icon-list', array( __CLASS__, 'one_icon_for_wp_add_font_awesome' ) );
	}

	/**
	 * Extent icon list.
	 *
	 * @param array $icon_list
	 *
	 * @return array
	 */
	private function one_icon_for_wp_add_font_awesome( array $icon_list ): array {
		return $icon_list;
	}

}

new one_icon_for_wp_icons();
