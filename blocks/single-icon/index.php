<?php
/**
 * Register client-side assets (scripts and stylesheets) for the block.
 *
 * @package one-icon-for-wp
 * @since 1.0.0
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 */
function one_icon_for_wp_single_icon_block_init() {

	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	// Get file directory
	$dir = dirname( __FILE__ );

	/*
	 * Add main js file
	 */
	// Put main js file name into var
	$index_js = 'index.js';

	// Register main js file
	wp_register_script(
		'one-icon-for-wp-single-icon-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-components',
			'wp-editor',
			'wp-server-side-render',
			'wp-compose',
			'wp-data',
			'wp-api',
		),
		filemtime( "$dir/$index_js" )
	);

	// Add data to editor
	wp_localize_script( 'one-icon-for-wp-single-icon-block-editor', 'one_icon_for_wp_icon_list', apply_filters( 'one-icon-for-wp-icon-list', array() ) );

	/*
	 * Add editor style
	 */
	// Put editor styles file name into var
	$editor_css = 'editor.css';

	// Add editor styles
	wp_register_style(
		'one-icon-for-wp-single-icon-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	/*
	 * Frontend styles
	 */
	// Add frontend styles to var name
	$style_css = 'style.css';

	// Load frontend styles
	wp_register_style(
		'one-icon-for-wp-single-icon-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	/*
	 * Add the block type
	 */
	register_block_type( 'one-icon-for-wp/single-icon', array(
		'editor_script'   => 'one-icon-for-wp-single-icon-block-editor',
		'editor_style'    => 'one-icon-for-wp-single-icon-block-editor',
		'style'           => 'one-icon-for-wp-single-icon-block',
		'render_callback' => 'one_icon_for_wp_single_icon_block_render_callback',
		'attributes'      => array(
			'align'           => array(
				'type' => 'string',
			),
			'backgroundColor' => array(
				'type' => 'string',
			),
			'textColor'       => array(
				'type' => 'string',
			),
			'hasIcon'         => array(
				'type'    => 'string',
				'default' => 'font-awesome/brands/font-awesome-flag',
			),
		),
	) );

}
add_action( 'init', 'one_icon_for_wp_single_icon_block_init', 100 );

/**
 * Render callback for block.
 *
 * @param array $attributes
 * @param string $content
 *
 * @return string
 */
function one_icon_for_wp_single_icon_block_render_callback( array $attributes, string $content ): string {

	if ( ! isset( $attributes['hasIcon'] ) ) {
		return '';
	}

	// Collect classes
	$classes = array(
		'wp-block',
		'one-icon-for-wp-single-icon-block',
		'single-icon',
	);

	if ( isset( $attributes['align'] ) ) {
		$classes[] = esc_attr( 'has-text-align-' . $attributes['align'] );
	}

	if ( isset( $attributes['backgroundColor'] ) ) {
		$classes[] = 'has-background';
		$classes[] = esc_attr( 'has-' . $attributes['backgroundColor'] . '-background-color' );
	}

	if ( isset( $attributes['textColor'] ) ) {
		$classes[] = 'has-text-color';
		$classes[] = esc_attr( 'has-' . $attributes['textColor'] . '-color' );
	}

	$svg_path = dirname( dirname( dirname( __FILE__ ) ) ) . '/assets/svg/' . $attributes['hasIcon'] . '.svg';
	if ( ! file_exists( $svg_path ) ) {
		return '';
	}

	ob_start();
	?>

	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		Single Icon
	</div>

	<?php
	// Return the markup
	return ob_get_clean();
}
