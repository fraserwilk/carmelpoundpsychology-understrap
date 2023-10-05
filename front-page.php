<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>



<div class="wrapper pt-0" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Opens the primary div -->


			<main class="site-main px-0" id="main">

				<?php
				$args = array(
                    'post_type' => 'post',       // Post type
                    'category_name' => 'homepage',  // Only show Posts with 'homepage' category
                    'orderby' => 'date',         // Order by date
                    'order' => 'ASC',           // Descending order (newest to oldest)
                    'posts_per_page' => -1,      // Display all posts
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
					
					get_template_part( 'loop-templates/content', 'none' );
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
