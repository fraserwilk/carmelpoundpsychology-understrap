<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function cppchild_register_acf_blocks() {
    /**
     * We register our blocks with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    
	 if( ! function_exists( 'cppchild_register_acf_blocks' ) )
	 	return;

	 register_block_type( __DIR__ . '/blocks/two-column' );
	 register_block_type( __DIR__ . '/blocks/three-column' );
     register_block_type( __DIR__ . '/blocks/testimonial' );
}
// Here we call our cppchild_register_acf_block() function on init.
add_action( 'init', 'cppchild_register_acf_blocks' );




/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


// Add shortcode to insert PHP date() in any widget
// Just add: [current_date] to display the current year.
function current_date_shortcode( ) {
    
    return date('Y');
}
add_shortcode( 'current_date', 'current_date_shortcode' );

// Add shortcode to insert Site Name in any widget
// Just add: [site_name] to display the site name.
function site_name_shortcode( ) {
    $site_title = get_bloginfo( 'name');

    return $site_title;
}
add_shortcode( 'site_name', 'site_name_shortcode' );


// Used to add class to custom logo
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['class'] )  && 'custom-logo' === $attr['class'] )
        $attr['class'] = 'custom-logo img-logo';

    return $attr;
} );

 // adds excerpts ability to pages
add_post_type_support( 'page', 'excerpt' );

/*
// Changing excerpt more
function new_excerpt_more($more) {
	global $post;
	remove_filter('excerpt_more', 'new_excerpt_more'); 
	return ' <a class="read_more" href="'. get_permalink($post->ID) . '">' . ' do whatever you want to update' . '</a>';
  }
  add_filter('excerpt_more','new_excerpt_more',11); */


remove_filter('get_the_excerpt', 'wp_trim_excerpt');

// builds a list of pages and displays with a shortcode
 function display_subset_of_pages() {
    // Define the query arguments
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 6, // Number of pages to display
        'orderby' => 'date',   // Order by date
        'order' => 'DESC',     // Order descending
        'post__in' => array(187, 189, 195, 296, 352, 368) // Array of specific page IDs to include
    );

    // Custom query
    $query = new WP_Query($args);

    // Check if the query has pages
    if ($query->have_posts()) {
        $output = '<div class="page-subset">';
        
        // Loop through the pages
        while ($query->have_posts()) {
            $query->the_post();
            
            $output .= '<div class="page-item">';
			if (has_post_thumbnail()) {
                $output .= '<div class="featured-image">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
            }
            $output .= '<p class="title">' . get_the_title() . '</p>';
            $output .= '<div class="page-content">' . get_the_excerpt() . '</div>';
            $output .= '<a href="' . get_permalink() . '" class="read-more"><i class="fa fa-arrow-circle-right"><span class="read-more-text">Read more</span></i></a>';
            $output .= '</div>';
        }

        $output .= '</div>';
        
        // Restore original Post Data
        wp_reset_postdata();
    } else {
        $output = '<p>No pages found.</p>';
    }

    return $output;
}

// Register the shortcode
add_shortcode('subset_of_pages', 'display_subset_of_pages');


// Two Column Block start

// Register ACF block type
function acf_two_column_block_register_block() {
    // Check if function exists.
    if( function_exists('acf_register_block_type') ) {
        // Register a two-column block.
        acf_register_block_type(array(
            'name'              => 'two-column-block',
            'title'             => __('Two Column Block'),
            'description'       => __('A custom two-column block.'),
            'render_callback'   => 'acf_two_column_block_render_callback',
            'category'          => 'formatting',
            'icon'              => 'columns',
            'keywords'          => array( 'columns', 'two columns' ),
            'enqueue_assets'    => function(){
                wp_enqueue_style( 'acf-two-column-block-style', plugin_dir_url( __FILE__ ) . 'style.css' );
            }
        ));
    }
}
add_action('acf/init', 'acf_two_column_block_register_block');

// Render callback function
function acf_two_column_block_render_callback( $block ) {
    // Get field values
    $column_1_content = get_field('column_1_content') ?: '';
    $column_1_background_image = get_field('column_1_background_image');
    $column_1_background_color = get_field('column_1_background_color') ?: '';
    $column_1_button_text = get_field('column_1_button_text') ?: '';
    $column_1_button_link = get_field('column_1_button_link') ?: '';

    $column_2_content = get_field('column_2_content') ?: '';
    $column_2_background_image = get_field('column_2_background_image');
    $column_2_background_color = get_field('column_2_background_color') ?: '';
    $column_2_button_text = get_field('column_2_button_text') ?: '';
    $column_2_button_link = get_field('column_2_button_link') ?: '';

    $image_side = get_field('image_side') ?: 'right';

    // Prepare column content
    $column_1_style = '';
    if ($column_1_background_image) {
        $column_1_style .= "background-image: url(" . esc_url($column_1_background_image) . ");";
    }
    if ($column_1_background_color) {
        $column_1_style .= "background-color: " . esc_attr($column_1_background_color) . ";";
    }

    $column_2_style = '';
    if ($column_2_background_image) {
        $column_2_style .= "background-image: url(" . esc_url($column_2_background_image) . ");";
    }
    if ($column_2_background_color) {
        $column_2_style .= "background-color: " . esc_attr($column_2_background_color) . ";";
    }

    $column_with_image = sprintf(
        '<div class="wp-block-column" style="%s">
            %s
            %s
        </div>',
        esc_attr($column_2_style),
        $column_2_content,
        $column_2_button_text ? sprintf('<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></div>
        </div>', esc_url($column_2_button_link), esc_html($column_2_button_text)) : ''
    );

    $column_without_image = sprintf(
        '<div class="wp-block-column" style="%s">
            %s
            %s
        </div>',
        esc_attr($column_1_style),
        $column_1_content,
        $column_1_button_text ? sprintf('<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></div>
        </div>', esc_url($column_1_button_link), esc_html($column_1_button_text)) : ''
    );

    // Render columns based on image side
    if ($image_side === 'left') {
        echo '<div class="full-width-two-column">' . $column_with_image . $column_without_image . '</div>';
    } else {
        echo '<div class="full-width-two-column">' . $column_without_image . $column_with_image . '</div>';
    }
}

// ACF fields
function acf_two_column_block_fields() {
    if( function_exists('acf_add_local_field_group') ) {
        acf_add_local_field_group(array(
            'key' => 'group_two_column_block',
            'title' => 'Two Column Block',
            'fields' => array(
                // Tab for Column 1
                array(
                    'key' => 'field_tab_column_1',
                    'label' => 'Column 1',
                    'type' => 'tab',
                    'placement' => 'top',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_column_1_content',
                    'label' => 'Column 1 Content',
                    'name' => 'column_1_content',
                    'type' => 'wysiwyg',
                    'instructions' => 'Add content for the first column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_1_background_image',
                    'label' => 'Column 1 Background Image',
                    'name' => 'column_1_background_image',
                    'type' => 'image',
                    'instructions' => 'Select a background image for the first column.',
                    'return_format' => 'url',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_1_background_color',
                    'label' => 'Column 1 Background Color',
                    'name' => 'column_1_background_color',
                    'type' => 'color_picker',
                    'instructions' => 'Select a background color for the first column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_1_button_text',
                    'label' => 'Column 1 Button Text',
                    'name' => 'column_1_button_text',
                    'type' => 'text',
                    'instructions' => 'Add text for the button in the first column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_1_button_link',
                    'label' => 'Column 1 Button Link',
                    'name' => 'column_1_button_link',
                    'type' => 'url',
                    'instructions' => 'Add the link for the button in the first column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                // Tab for Column 2
                array(
                    'key' => 'field_tab_column_2',
                    'label' => 'Column 2',
                    'type' => 'tab',
                    'placement' => 'top',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_column_2_content',
                    'label' => 'Column 2 Content',
                    'name' => 'column_2_content',
                    'type' => 'wysiwyg',
                    'instructions' => 'Add content for the second column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_2_background_image',
                    'label' => 'Column 2 Background Image',
                    'name' => 'column_2_background_image',
                    'type' => 'image',
                    'instructions' => 'Select a background image for the second column.',
                    'return_format' => 'url',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_2_background_color',
                    'label' => 'Column 2 Background Color',
                    'name' => 'column_2_background_color',
                    'type' => 'color_picker',
                    'instructions' => 'Select a background color for the second column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_2_button_text',
                    'label' => 'Column 2 Button Text',
                    'name' => 'column_2_button_text',
                    'type' => 'text',
                    'instructions' => 'Add text for the button in the second column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                array(
                    'key' => 'field_column_2_button_link',
                    'label' => 'Column 2 Button Link',
                    'name' => 'column_2_button_link',
                    'type' => 'url',
                    'instructions' => 'Add the link for the button in the second column.',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
                // Image Side Field
                array(
                    'key' => 'field_image_side',
                    'label' => 'Image Side',
                    'name' => 'image_side',
                    'type' => 'select',
                    'instructions' => 'Choose which side the background image will be on.',
                    'choices' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                    ),
                    'default_value' => 'right',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'return_format' => 'value',
                    'wrapper' => array(
                        'width' => '100',
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/two-column-block',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'acf_two_column_block_fields');


// Two Column Block end