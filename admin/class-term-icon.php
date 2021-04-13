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

		// Form fields. ?>
		<div class="form-field term-one-icon-for-wp-term-icon-wrap">
			<label for="term-icon">
				<?php _e( 'Term Icon', 'one-icon-for-wp' ); ?>
			</label>
			<select id="term-icon" name="term-icon">
				<option value="value" <?php selected( $term_icon, 'value', false ); ?>>
					<?php _e( 'Label', 'one-icon-for-wp' ); ?>
				</option>
			</select>
			<p class="description">
				<?php _e( 'Select an icon to represent the term', 'one-icon-for-wp' ); ?>
			</p>
		</div>

	<?php }

	/**
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
				<label for="term-icon">
					<?php _e( 'Term Icon', 'one-icon-for-wp' ); ?>
				</label>
			</th>
			<td>
				<select id="term-icon" name="term-icon">
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
		$term_icon = isset( $_POST['term-icon'] ) ? $_POST['term-icon'] : '';

		// Update the meta field in the database.
		update_term_meta( $term_id, 'term-icon', $term_icon );

	}

}

new ONE_ICON_FOR_WP_TERM_ICON;
