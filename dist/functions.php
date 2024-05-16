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


// ACF Block rego
add_action( 'init', 'register_acf_blocks' );

function register_acf_blocks() {
	 /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
	register_block_type( __DIR__ . '/blocks/testimonial' );
}

// Used to add class to custom logo
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['class'] )  && 'custom-logo' === $attr['class'] )
        $attr['class'] = 'custom-logo img-logo';

    return $attr;
} );

/* // adds excerpts ability to pages
add_post_type_support( 'page', 'excerpt' );

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
        'post__in' => array(187, 195, 296, 352, 368) // Array of specific page IDs to include
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
