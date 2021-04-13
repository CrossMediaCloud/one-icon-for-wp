<?php

/**
 * Class ONE_ICON_FOR_WP_TERM_ICON
 */
class ONE_ICON_FOR_WP_TERM_ICON {

	/**
	 * ONE_ICON_FOR_WP_TERM_ICON constructor.
	 */
	public function __construct() {

		if ( ! is_admin() ) {
			return;
		}

		// Add default taxonomies to list.
		add_action( 'one_icon_for_wp_taxonomies_with_term_icon', array( __CLASS__, 'add_icons_to_taxonomies' ) );

		// Get taxonomies to add term icons to
		$taxonomies = apply_filters( 'one_icon_for_wp_taxonomies_with_term_icon', array() );
		// Check value
		if ( ! is_array( $taxonomies ) ) {
			return;
		}
		//  Loop taxonomies
		foreach ( $taxonomies as $taxonomy ) {

			// Sanitize value
			$taxonomy = sanitize_title( $taxonomy );

			add_action( $taxonomy . '_add_form_fields', array( $this, 'create_screen_fields' ), 10, 1 );
			add_action( $taxonomy . '_edit_form_fields', array( $this, 'edit_screen_fields' ), 10, 2 );

			add_action( 'created_' . $taxonomy, array( $this, 'save_data' ), 10, 1 );
			add_action( 'edited_' . $taxonomy, array( $this, 'save_data' ), 10, 1 );

		}

	}

	/**
	 * Add WP and WooCommerce Core Taxonomies to list of term to get term icons.
	 *
	 * @param array $taxonomies
	 *
	 * @return array
	 */
	public static function add_icons_to_taxonomies( array $taxonomies ): array {

		return array_merge( $taxonomies, array(
			'category',
			'post_tag',
			'product_cat',
			'product_tag',
		) );

	}

	/	 **
	 * Helper to render form label.
	 */
	private function render_label() { ?>
		<label for="term-icon">
			<?php esc_html_e( 'Term Icon', 'one-icon-for-wp' ); ?>
		</label>
	<?php }

	/**
	 * Helper to render icon form field.
	 *
	 * @param string $term_icon
	 */
	private function render_icon_select( string $term_icon ) { ?>
		<select id="term-icon" name="term-icon">
			<option value="" <?php selected( $term_icon, '', true ); ?>>
				<?php esc_attr_e( '-- None --', 'one-icon-for-wp' ); ?>
			</option>
			<?php
			foreach ( apply_filters( 'one-icon-for-wp-icon-list', array() ) as $icon ) { ?>
				<option value="<?php echo esc_attr( $icon['value'] ); ?>" <?php selected( $term_icon, $icon['value'], true ); ?>>
					<?php echo esc_html( $icon['label'] ); ?>
				</option>
			<?php } ?>
		</select>
	<?php }

	/**
	 * Helper to render description.
	 */
	private function render_icon_description() { ?>
		<p class="description">
			<?php _e( 'Select an icon to represent the term.', 'one-icon-for-wp' ); ?>
		</p>
	<?php }

	/**
	 * Add term icon setting to new term screen.
	 *
	 * @param $taxonomy
	 */
	public function create_screen_fields( $taxonomy ) {

		// Set default values.
		$term_icon = '';

		// Form fields. ?>
		<div class="form-field term-one-icon-for-wp-term-icon-wrap">
			<?php
			// Display label
			$this->render_label();
			// Display tge select form field
			$this->render_icon_select( $term_icon );
			// Display a description
			$this->render_icon_description();
			?>

		</div>

	<?php }

	/**
	 * Add term icon setting to term edit screen.
	 *
	 * @param $term
	 * @param $taxonomy
	 */
	public function edit_screen_fields( $term, $taxonomy ) {

		// Retrieve an existing value from the database.
		$term_icon = get_term_meta( $term->term_id, 'term-icon', true );

		// Set default values.
		if ( empty( $term_icon ) ) {
			$term_icon = '';
		}

		// Form fields. ?>
		<tr class="form-field term-one-icon-for-wp-term-icon-wrap">
			<th scope="row">
				<?php
				// Display label
				$this->render_label();
				?>
			</th>
			<td>
				<?php
				// Display tge select form field
				$this->render_icon_select( $term_icon );
				// Display a description
				$this->render_icon_description();
				?>
			</td>
		</tr>

	<?php }

	/**
	 * Save data.
	 *
	 * @param $term_id
	 */
	public function save_data( $term_id ) {

		// Sanitize user input.
		$term_icon = isset( $_POST['term-icon'] ) ? $_POST['term-icon'] : '';

		// Update the meta field in the database.
		update_term_meta( $term_id, 'term-icon', $term_icon );

	}

}

new ONE_ICON_FOR_WP_TERM_ICON;
