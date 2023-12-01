<?php
/**
 * Template Name: Front Page - CPP
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 *
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>



<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Opens the primary div -->


			<main class="site-main px-0" id="main">

				<?php
				$args = array(
                    'post_type' => 'post',       	// Post type
                    'category_name' => 'xxx',  // Only show Posts with 'homepage' category
                    'orderby' => 'date',         	// Order by date
                    'order' => 'ASC',           	// Descending order (newest to oldest)
                    'posts_per_page' => -1,      	// Display all posts
                );
                
                $sortorder = new WP_Query($args);
                
                if ( $sortorder->have_posts() ) {
					// Start the Loop.
					while ( $sortorder->have_posts() ) {
						$sortorder->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						 get_template_part( 'loop-templates/content', get_post_format() );
					}
				} else {
					
					get_template_part( 'loop-templates/content', 'frontpage' );
				}
				?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
