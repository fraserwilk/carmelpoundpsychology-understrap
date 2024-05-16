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
				
					get_template_part( 'loop-templates/content', 'frontpage' );
				
				?>


			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
