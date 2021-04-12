/**
 * Block Main JS file
 */
( function () {
	let __ = wp.i18n.__; // The __() function for internationalization.
	let createElement = wp.element.createElement; // The wp.element.createElement() function to create elements.
	let registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
	let ServerSideRender = wp.serverSideRender; // For displaying server rendered elements.
	let InspectorControls = wp.blockEditor.InspectorControls; // For adding block controls.
	let ToggleControl     = wp.components.ToggleControl; // For adding toggle controls to block settings panels.
	let RangeControl      = wp.components.RangeControl;
	let SelectControl     = wp.components.SelectControl;

	/**
	 * Register block
	 *
	 * @param  {string}   name     Block name.
	 * @param  {Object}   settings Block settings.
	 * @return {?WPBlock}          Block itself, if registered successfully,
	 *                             otherwise "undefined".
	 */
	registerBlockType(
		'one-icon-for-wp/single-icon', // Block name. Must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
		{
			title: __( 'Single Icon' ), // Block title.
			icon: 'art', // Block icon from Dashicons. https://developer.wordpress.org/resource/dashicons/.
			category: 'common', // Block category. Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
			keywords: [ __( 'icon' ), __( 'graphic' ), __( 'decoration' ) ],

			supports: {
				html: false,
				align: ['left', 'center', 'right'],
				color: {
					'background': true,
					'text': true,
					'gradient': false
				},
			},

			attributes: {
				align: {
					type: 'string',
				},
				backgroundColor: {
					'type': 'string',
				},
				textColor: {
					'type': 'string',
				},
				hasIcon: {
					'type': 'string',
					'default': 'font-awesome/brands/font-awesome-flag',
				},
			},

			// Defines the block within the editor.
			edit: function ( {attributes, setAttributes} ) {

				const {
					align,
					backgroundColor,
					textColor,
					hasIcon
				} = attributes;

				function onChangeIcon( value ) {
					if ( value ) {
						setAttributes( { hasIcon: value } );
					} else {
						setAttributes( { hasIcon: 'font-awesome/brands/font-awesome-flag' } );
					}
				}

				const controls = [
					createElement(
						InspectorControls,
						{},
						createElement(
							SelectControl,
							{
								label: __( 'Icon' ),
								onChange: onChangeIcon,
								value: hasIcon,
								options: window.one_icon_for_wp_icon_list,
							}
						),
					),

				];

				return [
					controls,
					createElement(
						ServerSideRender,
						{
							block: 'one-icon-for-wp/single-icon',
							attributes: attributes,
						}
					),
				];
			},

			// Defines the saved block.
			save: function ( {attributes} ) {
				return null;
			},
		}
	);
} )();
