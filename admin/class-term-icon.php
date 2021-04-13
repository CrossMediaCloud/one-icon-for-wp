<?php

/**
 * Class ONE_ICON_FOR_WP_TERM_ICON
 */
class ONE_ICON_FOR_WP_TERM_ICON {

	/**
	 * ONE_ICON_FOR_WP_TERM_ICON constructor.
	 */
	public function __construct() {

		if ( is_admin() ) {

			add_action( 'kategorie_add_form_fields', array( $this, 'create_screen_fields' ), 10, 1 );
			add_action( 'kategorie_edit_form_fields', array( $this, 'edit_screen_fields' ), 10, 2 );

			add_action( 'created_kategorie', array( $this, 'save_data' ), 10, 1 );
			add_action( 'edited_kategorie', array( $this, 'save_data' ), 10, 1 );

		}

	}

	/**
	 * @param $taxonomy
	 */
	public function create_screen_fields( $taxonomy ) {

		// Set default values.
		$term_icon = '';

		// Form fields.
		echo '<div class="form-field term-one-icon-for-wp-term-icon-wrap">';
		echo '	<label for="one_icon_for_wp_term_icon">' . __( 'Term Icon', 'one-icon-for-wp' ) . '</label>';
		echo '	<select id="one_icon_for_wp_term_icon" name="one_icon_for_wp_term_icon">';
		echo '		<option value="value" ' . selected( $term_icon, 'value', false ) . '> ' . __( 'label', 'one-icon-for-wp' ) . '</option>';
		echo '	</select>';
		echo '	<p class="description">' . __( 'Select an icon to represent the term', 'one-icon-for-wp' ) . '</p>';
		echo '</div>';

	}

	/**
	 * @param $term
	 * @param $taxonomy
	 */
	public function edit_screen_fields( $term, $taxonomy ) {

		// Retrieve an existing value from the database.
		$term_icon = get_term_meta( $term->term_id, 'one_icon_for_wp_term_icon', true );

		// Set default values.
		if ( empty( $term_icon ) ) {
			$term_icon = '';
		}

		// Form fields.?>
		<tr class="form-field term-one-icon-for-wp-term-icon-wrap">
			<th scope="row">
				<label for="one_icon_for_wp_term_icon">
					<?php _e( 'Term Icon', 'one-icon-for-wp' ); ?>
				</label>
			</th>
			<td>
				<select id="one_icon_for_wp_term_icon" name="one_icon_for_wp_term_icon">
					<option value="" <?php selected( $term_icon, 'value', true ); ?>>
						<?php _e( '-- None --', 'one-icon-for-wp' ); ?>
					</option>
					<option value="value" <?php selected( $term_icon, 'value', true ); ?>>
						<?php _e( 'Label', 'one-icon-for-wp' ); ?>
					</option>
				</select>
				<p class="description">';
					<?php _e( 'Select an icon to represent the term.', 'one-icon-for-wp' ); ?>
				</p>
			</td>
		</tr>

	<?php }

	/**
	 * @param $term_id
	 */
	public function save_data( $term_id ) {

		// Sanitize user input.
		$term_icon = isset( $_POST['one_icon_for_wp_term_icon'] ) ? $_POST['one_icon_for_wp_term_icon'] : '';

		// Update the meta field in the database.
		update_term_meta( $term_id, 'one_icon_for_wp_term_icon', $term_icon );

	}

}

new ONE_ICON_FOR_WP_TERM_ICON;
