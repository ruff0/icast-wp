<?php

define( 'REVEAL_VERSION', '2.6.2' );
define( 'REVEAL_PARENT_THEME_URI', get_template_directory_uri() );

function reveal_setup_theme() {
	add_action( 'init', 'reveal_post_types' );

	add_action( 'fm_post_slide', 'reveal_slides' );
	add_action( 'fm_submenu_reveal_settings', 'reveal_settings' );
	add_action( 'admin_menu', 'reveal_admin_menu' );
	add_action( 'wp_before_admin_bar_render', 'reveal_remove_admin_bar_links' );
	add_filter( 'wp_title', 'reveal_wp_title', 10, 2 );

	add_filter( 'show_admin_bar', '__return_false' );
	add_action( 'after_switch_theme', 'reveal_flush_rewrites' );
	add_action( 'switch_theme', 'reveal_flush_rewrites' );

	if ( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'reveal_enqueue_scripts_and_styles' );
		add_action( 'wp_footer', 'reveal_initialize_script', 20 );
		add_action( 'pre_get_posts', 'reveal_homepage_slides' );
	}

	if ( function_exists( 'fm_register_submenu_page' ) ) {
		fm_register_submenu_page( 'reveal_settings', 'themes.php', __( 'reveal.js Settings', 'reveal' ) );
	}
}
add_action( 'after_setup_theme', 'reveal_setup_theme' );

function reveal_flush_rewrites() {
	delete_option( 'rewrite_rules' );
}

function reveal_enqueue_scripts_and_styles() {
	$settings = reveal_get_settings();

	wp_enqueue_style( 'reveal-core-css', REVEAL_PARENT_THEME_URI . '/css/reveal.css', array(), REVEAL_VERSION );
	wp_enqueue_style( 'reveal-theme-css', apply_filters( 'reveal_theme_url', REVEAL_PARENT_THEME_URI . '/css/theme/' . $settings['theme'] . '.css' ), array(), REVEAL_VERSION );
	wp_enqueue_style( 'reveal-zenburn-css', REVEAL_PARENT_THEME_URI . '/lib/css/zenburn.css', array(), REVEAL_VERSION );
	wp_enqueue_style( 'animate-css', REVEAL_PARENT_THEME_URI . '/css/animate.css');

	wp_enqueue_script("jquery");

	wp_enqueue_script( 'reveal-head-js', REVEAL_PARENT_THEME_URI . '/lib/js/head.min.js', array(), REVEAL_VERSION, true );
	wp_enqueue_script( 'fittext', REVEAL_PARENT_THEME_URI . '/js/jquery.fittext.js' ,true);
	wp_enqueue_script( 'textfill', REVEAL_PARENT_THEME_URI . '/js/jquery.textfill.min.js',true);
	wp_enqueue_script( 'skycons', REVEAL_PARENT_THEME_URI . '/js/skycons.js',true);
	wp_enqueue_script( 'reveal-core-js', REVEAL_PARENT_THEME_URI . '/js/reveal.js', array(), REVEAL_VERSION, true );
	wp_enqueue_script( 'main', REVEAL_PARENT_THEME_URI . '/js/main.js',true);

}
function reveal_initialize_script() {
	$settings = reveal_get_settings();
	?>
	<script>
		// Full list of configuration options available here:
		// https://github.com/hakimel/reveal.js#configuration
		var reveal_config = {
			controls: <?php echo $settings['controls'] ?>,
			progress: <?php echo $settings['progress'] ?>,
			slideNumber: <?php echo $settings['slideNumber'] ?>,
			history: <?php echo $settings['history'] ?>,
			keyboard: <?php echo $settings['keyboard'] ?>,
			overview: <?php echo $settings['overview'] ?>,
			center: <?php echo $settings['center'] ?>,
			touch: <?php echo $settings['touch'] ?>,
			loop: <?php echo $settings['loop'] ?>,
			rtl: <?php echo $settings['rtl'] ?>,
			fragments: <?php echo $settings['fragments'] ?>,
			embedded: <?php echo $settings['embedded'] ?>,
			autoSlide: <?php echo $settings['autoSlide'] ?>,
			autoSlideStoppable: <?php echo $settings['autoSlideStoppable'] ?>,
			mouseWheel: <?php echo $settings['mouseWheel'] ?>,
			hideAddressBar: <?php echo $settings['hideAddressBar'] ?>,
			previewLinks: <?php echo $settings['previewLinks'] ?>,
			transition: <?php echo json_encode( $settings['transition'] ) ?>,
			//transitionSpeed: <?php //echo json_encode( $settings['transitionSpeed'] ) ?>,
			transitionSpeed: 100000 ,
			backgroundTransition: <?php echo json_encode( $settings['backgroundTransition'] ) ?>,
			viewDistance: <?php echo $settings['viewDistance'] ?>,
			parallaxBackgroundImage: <?php echo json_encode( $settings['parallaxBackgroundImage'] ) ?>,
			parallaxBackgroundSize: <?php echo json_encode( $settings['parallaxBackgroundSize'] ) ?>,
			width: <?php echo $settings['width'] ?>,
			showNotes : false,
			height: <?php echo $settings['height'] ?>,
			margin: <?php printf( '%0.1f', $settings['margin'] ) ?>,
			minScale: <?php printf( '%0.1f', $settings['minScale'] ) ?>,
			maxScale: <?php printf( '%0.1f', $settings['maxScale'] ) ?>,
			rollingLinks: <?php echo $settings['rollingLinks'] ?>,
			focusBodyOnPageVisiblityChange: <?php echo $settings['focusBodyOnPageVisiblityChange'] ?>,

			// Optional libraries used to extend on reveal.js
			dependencies: [
				<?php
				echo implode( ",\n", apply_filters( 'reveal_default_dependencies', array(
					'classList' => "{ src: '" . get_template_directory_uri() . "/lib/js/classList.js', condition: function() { return !document.body.classList; } }",
					'highlight' => "{ src: '" . get_template_directory_uri() . "/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } }",
					'zoom'      => "{ src: '" . get_template_directory_uri() . "/plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } }",
					// 'notes'     => "{ src: '" . get_template_directory_uri() . "/plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }",
				) ) );
				?>
			]
		};
		<?php do_action( 'reveal_initialize' ) ?>
		Reveal.initialize( reveal_config );
	</script>
	<?php
}

/**
 * Filters wp_title to add site name.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function reveal_wp_title( $title, $sep ) {
	return $title . get_bloginfo( 'name', 'display' );
}


/**
 * Boilerplate Reveal.js Theme stuff
 */
function reveal_post_types() {
	register_post_type( 'slide', array(
		'public'   => true,
		'supports' => array( 'title', 'page-attributes' ),
		'menu_position' => 1,
		'menu_icon' => 'dashicons-format-image',
		'labels'   => array(
			'name'               => __( 'Placas', 'reveal' ),
			'singular_name'      => __( 'Placa', 'reveal' ),
			'add_new'            => __( 'Agregar Nueva', 'reveal' ),
			'add_new_item'       => __( 'Agregar Nueva Placa', 'reveal' ),
			'edit_item'          => __( 'Editar Placa', 'reveal' ),
			'new_item'           => __( 'Nueva Placa', 'reveal' ),
			'view_item'          => __( 'Ver Placa', 'reveal' ),
			'search_items'       => __( 'Buscar Placas', 'reveal' ),
			'not_found'          => __( 'No se encontraron', 'reveal' ),
			'not_found_in_trash' => __( 'No se encontraron en Papelera', 'reveal' ),
			'parent_item_colon'  => __( 'Parent Placa:', 'reveal' ),
			'menu_name'          => __( 'Placas', 'reveal' ),
		),
	) );
}

function reveal_admin_menu() {
	// You can add `remove_action( 'admin_menu', 'reveal_admin_menu' );` to
	// your child theme if you don't want these removed

	remove_menu_page( 'edit.php' );
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	remove_menu_page( 'edit-comments.php' );
}

function reveal_remove_admin_bar_links() {
	// You can add `remove_action( 'wp_before_admin_bar_render', 'reveal_remove_admin_bar_links' );`
	// to your child theme if you don't want these removed

	global $wp_admin_bar;
	$wp_admin_bar->remove_node( 'new-post' );
}

function reveal_slides() {
	$attr_group = new Fieldmanager_Group( array(
		'label'          => __( 'Slide HTML Attribute', 'reveal' ),
		'limit'          => 0,
		'extra_elements' => 0,
		'collapsible'    => true,
		'collapsed'      => true,
		'add_more_label' => __( 'Add HTML attribute', 'reveal' ),
		'label_macro'    => array( __( '%s', 'reveal' ), 'key' ),
		'children'       => array(
			'key' => new Fieldmanager_TextField( __( 'Attribute Name', 'reveal' ) ),
			'value' => new Fieldmanager_TextField( __( 'Attribute Value', 'reveal' ) ),
		)
	) );
	$bg_group = new Fieldmanager_Media( array(
		'label' => __( 'Fondo', 'reveal' ),
		'preview_size'       => 'medium',
		'button_label'       => __( 'Agregar Imagen', 'reveal' ),
		'modal_button_label' => __( 'Seleccionar Imagen', 'reveal' ),
		'modal_title'        => __( 'Fondo Placa', 'reveal' ),
	) );


	$fm = new Fieldmanager_Group( array(
		'name'           => 'slides',
		'label'          => __( 'Placa', 'reveal' ),
		'limit'          => 0,
		'extra_elements' => 0,
		'starting_count' => 1,
		'add_more_label' => __( 'Agregar Placa', 'reveal' ),
		'label_macro'    => array( __( '%s', 'reveal' ), 'title' ),
		'sortable'       => true,
		'collapsible'    => true,
		'children'       => array(
			'title' => new Fieldmanager_TextField( __( 'Titulo', 'reveal' ) ),
			'content' => new Fieldmanager_RichTextArea( __( 'Contenido', 'reveal' ) ),
			'background' => $bg_group,
			// 'attr' => $attr_group,
			// 'notes' => new Fieldmanager_RichTextArea( __( 'Notes', 'reveal' ) ),
		)
	) );
	$fm->add_meta_box( __( 'Vertical Slides', 'reveal' ), 'slide' );

	$fm = new Fieldmanager_Group( array(
		'name'           => 'wrapper',
		'description'    => __( 'These options may be used if you have more than one vertical slide', 'reveal' ),
		'children'       => array(
			'background' => $bg_group,
			// 'attr' => $attr_group,
		)
	) );
	//$fm->add_meta_box( __( 'Wrapper Slide Options', 'reveal' ), 'slide' );
}

function reveal_settings() {
	$defaults = reveal_default_settings();

	$fm = new Fieldmanager_Group( array(
		'name' => 'reveal_settings',
		'children' => array(
			'theme' => new Fieldmanager_Select( array(
				'label' => __( 'Select Theme', 'reveal' ),
				'default_value' => $defaults['theme'],
				'options' => array(
					'default',
					'beige',
					'blood',
					'moon',
					'night',
					'serif',
					'simple',
					'sky',
					'solarized',
				)
			) ),
			'controls' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Display controls in the bottom right corner', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['controls'],
			) ),
			'progress' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Display a presentation progress bar', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['progress'],
			) ),
			'slideNumber' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Display the page number of the current slide', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['slideNumber'],
			) ),
			'history' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Push each slide change to the browser history', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['history'],
			) ),
			'keyboard' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Enable keyboard shortcuts for navigation', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['keyboard'],
			) ),
			'overview' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Enable the slide overview mode', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['overview'],
			) ),
			'center' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Vertically center slides', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['center'],
			) ),
			'touch' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Enable touch navigation on devices with touch input', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['touch'],
			) ),
			'loop' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Loop the presentation', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['loop'],
			) ),
			'rtl' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Change the presentation direction to be RTL', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['rtl'],
			) ),
			'fragments' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Enable fragments', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['fragments'],
			) ),
			'embedded' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Run in embed mode', 'reveal' ),
				'description' => __( 'Flags if the presentation is running in an embedded mode, i.e. contained within a limited portion of the screen', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['embedded'],
			) ),
			'autoSlide' => new Fieldmanager_TextField( array(
				'label' => __( 'Number of milliseconds between automatically proceeding to the next slide', 'reveal' ),
				'description' => __( 'Disabled when set to 0, this value can be overwritten by using a data-autoslide attribute on your slides', 'reveal' ),
				'sanitize' => 'absint',
				'attributes' => array( 'style' => 'width: 75px' ),
				'default_value' => $defaults['autoSlide'],
			) ),
			'autoSlideStoppable' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Stop auto-sliding after user input', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['autoSlideStoppable'],
			) ),
			'mouseWheel' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Enable slide navigation via mouse wheel', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['mouseWheel'],
			) ),
			'hideAddressBar' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Hide the address bar on mobile devices', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['hideAddressBar'],
			) ),
			'previewLinks' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Open links in an iframe preview overlay', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['previewLinks'],
			) ),
			'transition' => new Fieldmanager_Select( array(
				'label' => __( 'Transition style', 'reveal' ),
				'default_value' => $defaults['transition'],
				'options' => array(
					'default',
					'cube',
					'page',
					'concave',
					'zoom',
					'linear',
					'fade',
					'none',
				)
			) ),
			'transitionSpeed' => new Fieldmanager_Select( array(
				'label' => __( 'Transition speed', 'reveal' ),
				'default_value' => $defaults['transitionSpeed'],
				'options' => array(
					'default',
					'fast',
					'slow',
				)
			) ),
			'backgroundTransition' => new Fieldmanager_Select( array(
				'label' => __( 'Transition style for full page slide backgrounds', 'reveal' ),
				'default_value' => $defaults['backgroundTransition'],
				'options' => array(
					'default',
					'none',
					'slide',
					'concave',
					'convex',
					'zoom',
				)
			) ),
			'viewDistance' => new Fieldmanager_TextField( array(
				'label' => __( 'Number of slides away from the current that are visible', 'reveal' ),
				'default_value' => $defaults['viewDistance'],
				'sanitize' => 'absint',
				'attributes' => array( 'style' => 'width: 75px' ),
			) ),
			'parallaxBackgroundImage' => new Fieldmanager_Media( array(
				'label' => __( 'Parallax background image', 'reveal' ),
				'preview_size'       => 'medium',
				'button_label'       => __( 'Add Image', 'reveal' ),
				'modal_button_label' => __( 'Select Image', 'reveal' ),
				'modal_title'        => __( 'Parallax Background Image', 'reveal' ),
				'default_value' => $defaults['parallaxBackgroundImage'],
			) ),
			'parallaxBackgroundSize' => new Fieldmanager_TextField( array(
				'label' => __( 'Parallax background size', 'reveal' ),
				'description' => __( 'CSS syntax, e.g. "2100px 900px"', 'reveal' ),
				'attributes' => array( 'style' => 'width: 200px' ),
				'default_value' => $defaults['parallaxBackgroundSize'],
			) ),
			'width' => new Fieldmanager_TextField( array(
				'label' => __( 'Base Width', 'reveal' ),
				'description' => __( 'The "normal" width of the presentation; aspect ratio will be preserved when the presentation is scaled to fit different resolutions', 'reveal' ),
				'default_value' => $defaults['width'],
				'sanitize' => 'absint',
				'attributes' => array( 'style' => 'width: 75px' ),
			) ),
			'height' => new Fieldmanager_TextField( array(
				'label' => __( 'Base Height', 'reveal' ),
				'description' => __( 'The "normal" height of the presentation; aspect ratio will be preserved when the presentation is scaled to fit different resolutions', 'reveal' ),
				'default_value' => $defaults['height'],
				'sanitize' => 'absint',
				'attributes' => array( 'style' => 'width: 75px' ),
			) ),
			'margin' => new Fieldmanager_TextField( array(
				'label' => __( 'Margin', 'reveal' ),
				'description' => __( 'Factor of the display size that should remain empty around the content', 'reveal' ),
				'default_value' => $defaults['margin'],
				'sanitize' => 'floatval',
				'attributes' => array( 'style' => 'width: 75px' ),
			) ),
			'minScale' => new Fieldmanager_TextField( array(
				'label' => __( 'Bounds for smallest possible scale to apply to content', 'reveal' ),
				'default_value' => $defaults['minScale'],
				'sanitize' => 'floatval',
				'attributes' => array( 'style' => 'width: 75px' ),
			) ),
			'maxScale' => new Fieldmanager_TextField( array(
				'label' => __( 'Bounds for largest possible scale to apply to content', 'reveal' ),
				'default_value' => $defaults['maxScale'],
				'sanitize' => 'floatval',
				'attributes' => array( 'style' => 'width: 75px' ),
			) ),
			'rollingLinks' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Apply a 3D roll to links on hover', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['rollingLinks'],
			) ),
			'focusBodyOnPageVisiblityChange' => new Fieldmanager_Checkbox( array(
				'label' => __( 'Focus body when page changes visiblity to ensure keyboard shortcuts work', 'reveal' ),
				'checked_value' => 'true',
				'unchecked_value' => 'false',
				'default_value' => $defaults['focusBodyOnPageVisiblityChange'],
			) ),
		)
	) );
	$fm->activate_submenu_page();
}

function reveal_get_settings() {
	static $reveal_settings;
	if ( ! empty( $reveal_settings ) ) {
		return $reveal_settings;
	}

	$reveal_settings = get_option( 'reveal_settings', array() );

	$non_boolean_keys = array( 'theme',
		'autoSlide',
		'transition',
		'transitionSpeed',
		'backgroundTransition',
		'viewDistance',
		'parallaxBackgroundImage',
		'parallaxBackgroundSize',
		'width',
		'height',
		'margin',
		'minScale',
		'maxScale',
	);

	// Sanitize boolean values coming from the db
	foreach ( $reveal_settings as $key => $value ) {
		if ( ! in_array( $key, $non_boolean_keys ) && $value !== 'true' && $value !== 'false' ) {
			unset( $reveal_settings[ $key ] );
		}
	}

	// Fill all settings
	$reveal_settings = wp_parse_args( $reveal_settings, reveal_default_settings() );

	// Convert boolean values to string
	foreach ( $reveal_settings as $key => $value ) {
		if ( ! in_array( $key, $non_boolean_keys ) ) {
			if ( true === $value || 'true' === $value ) {
				$reveal_settings[ $key ] = 'true';
			} else {
				$reveal_settings[ $key ] = 'false';
			}
		}
	}

	// Sanitize numeric values
	if ( isset( $reveal_settings['autoSlide'] ) ) {
		$reveal_settings['autoSlide'] = absint( $reveal_settings['autoSlide'] );
	}
	if ( isset( $reveal_settings['viewDistance'] ) ) {
		$reveal_settings['viewDistance'] = absint( $reveal_settings['viewDistance'] );
	}
	if ( isset( $reveal_settings['width'] ) ) {
		$reveal_settings['width'] = absint( $reveal_settings['width'] );
	}
	if ( isset( $reveal_settings['height'] ) ) {
		$reveal_settings['height'] = absint( $reveal_settings['height'] );
	}
	if ( isset( $reveal_settings['margin'] ) ) {
		$reveal_settings['margin'] = floatval( $reveal_settings['margin'] );
	}
	if ( isset( $reveal_settings['minScale'] ) ) {
		$reveal_settings['minScale'] = floatval( $reveal_settings['minScale'] );
	}
	if ( isset( $reveal_settings['maxScale'] ) ) {
		$reveal_settings['maxScale'] = floatval( $reveal_settings['maxScale'] );
	}

	// Convert attachment id to attachment url
	if ( ! empty( $reveal_settings['parallaxBackgroundImage'] ) ) {
		$reveal_settings['parallaxBackgroundImage'] = esc_url( wp_get_attachment_url( $reveal_settings['parallaxBackgroundImage'] ) );
	}

	// Sanitize dropdown values
	if ( isset( $reveal_settings['transition'] ) && ! in_array( $reveal_settings['transition'], array( 'default', 'cube', 'page', 'concave', 'zoom', 'linear', 'fade', 'none' ) ) ) {
		$reveal_settings['transition'] = 'default';
	}
	if ( isset( $reveal_settings['transitionSpeed'] ) && ! in_array( $reveal_settings['transitionSpeed'], array( 'default', 'fast', 'slow' ) ) ) {
		$reveal_settings['transitionSpeed'] = 'default';
	}
	if ( isset( $reveal_settings['backgroundTransition'] ) && ! in_array( $reveal_settings['backgroundTransition'], array( 'default', 'none', 'slide', 'concave', 'convex', 'zoom' ) ) ) {
		$reveal_settings['backgroundTransition'] = 'default';
	}

	return $reveal_settings;
}

function reveal_default_settings() {
	return apply_filters( 'reveal_default_settings', array(
		'theme'                          => 'default',
		'controls'                       => true,
		'progress'                       => true,
		'slideNumber'                    => false,
		'history'                        => false,
		'keyboard'                       => true,
		'overview'                       => true,
		'center'                         => true,
		'touch'                          => true,
		'loop'                           => false,
		'rtl'                            => false,
		'fragments'                      => true,
		'embedded'                       => false,
		'autoSlide'                      => 0,
		'autoSlideStoppable'             => true,
		'mouseWheel'                     => false,
		'hideAddressBar'                 => true,
		'previewLinks'                   => false,
		'transition'                     => 'default',
		'transitionSpeed'                => 'slow',
		'backgroundTransition'           => 'default',
		'viewDistance'                   => 3,
		'parallaxBackgroundImage'        => '',
		'parallaxBackgroundSize'         => '',
		'width'                          => 1920,
		'height'                         => 960,
		'margin'                         => 0.1,
		'minScale'                       => 0.2,
		'maxScale'                       => 1.0,
		'rollingLinks'                   => false,
		'focusBodyOnPageVisiblityChange' => true,
	) );
}

function reveal_homepage_slides( &$query ) {
	if ( $query->is_main_query() && $query->is_home() ) {
		$query->set( 'post_type', 'slide' );
		$query->set( 'posts_per_page', -1 );
		$query->set( 'paged', 1 );
		$query->set( 'orderby', 'menu_order date' );
		$query->set( 'order', 'ASC' );
	}
}


/**
 * Template Tags
 */

function reveal_get_slides() {
	$slides = get_post_meta( get_the_ID(), 'slides', true );
	if ( empty( $slides ) ) {
		return array();
	}
	return (array) $slides;
}

function reveal_section_attr( $slide ) {
	if ( empty( $slide ) ) {
		return '';
	}

	if ( ! empty( $slide['background'] ) && $url = wp_get_attachment_url( $slide['background'] ) ) {
		$slide['attr'][] = array( 'key' => 'data-background', 'value' => $url );
	}
	if ( ! empty( $slide['attr'] ) ) {
		$return = array( '' );
		foreach ( $slide['attr'] as $attr ) {
			$return[] = sprintf( '%s="%s"', sanitize_key( $attr['key'] ), esc_attr( $attr['value'] ) );
		}
		return implode( ' ', $return );
	}
	return '';
}

/**
 * Process a block of content as the_content() does.
 *
 * @param  string $content Content.
 * @return string
 */
function reveal_process_html_field( $content ) {
	$content = apply_filters( 'the_content', $content );
	return str_replace( ']]>', ']]&gt;', $content );
}


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Info 3 Pantallas',
		'menu_title'	=> 'Info 3 Pantallas',
		'menu_slug' 	=> 'info-3-cast',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	

}


add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'placa',
    array(
      'labels' => array(
        'name' 				 => __( 'Placa' ),
        'singular_name' 	 => __( 'Placa' ),
        'menu_name'          => __( 'Placas'),
		'parent_item_colon'  => __( 'Parent Placa'),
		'all_items'          => __( 'Todas las Placas'),
		'view_item'          => __( 'Ver Placa'),
		'add_new_item'       => __( 'Nueva Placa'),
		'add_new'            => __( 'Nueva'),
		'edit_item'          => __( 'Editar Placa'),
		'update_item'        => __( 'Actualizar Placa'),
		'search_items'       => __( 'Buscar Placa'),
		'not_found'          => __( 'Not Found'),
		'not_found_in_trash' => __( 'Not found in Trash'),
      ),
      'public' => true,
      'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 1,
      'has_archive' => true,
      'rewrite' => array('slug' => 'placa'),
		'supports'           => array( 'editor' )

    )
  );
}



// ::::::::::::::::::::::::::: CHANGE TITLE CODE ::::::::::::::::::::::::::::::::::

add_action('save_post','fire_change_post_title');
function fire_change_post_title( $post_id ) {
    global $current_user;
    $current_user = wp_get_current_user();
    //Se fija si no es una rutina de auto-save
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    //El usuario tiene permisos? 
    if ( !current_user_can('edit_post', $post_id) ) return;
    //If calling wp_update_post, unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'fire_change_post_title');
        // CODIGO PARA FACTURAS
        
        // CODIGO PARA PROVEEDORES
        if($_POST['post_type'] == 'placa') {
            
            if (get_field('placa_titulo',$post_id)) {
            	$nuevo_titulo = get_field('placa_titulo',$post_id).' - '.mb_strimwidth(get_field('placa_texto',$post_id), 3, 35, "...");
            } else {
            	$nuevo_titulo = mb_strimwidth(get_field('placa_texto',$post_id), 3, 55, "...");
            }
            $nuevo_titulo_slug = sanitize_title_with_dashes ($nuevo_titulo,'','save');
            $nuevo_titulo_slug = sanitize_title($nuevo_titulo);
            wp_update_post(array('ID' => $post_id, 'post_title' => $nuevo_titulo ));
            wp_update_post(array('ID' => $post_id, 'post_name' => $nuevo_titulo_slug ));
            $the_post_permalink = get_the_permalink($post_id);

        }
  // re-hook this function
  add_action('save_post', 'fire_change_post_title');
}