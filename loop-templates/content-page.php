<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">
		<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="row">
				<?php
					if ( ! is_page_template( 'page-templates/no-title.php' ) ) {
						the_title(
							'<header class="entry-header"><h1 class="entry-title">',
							'</h1></header><!-- .entry-header -->'
						);
					}
				?>
				<?php
				the_content();
				understrap_link_pages();
				?>
			</div>
		</div>
		<div class="col-sm-2"></div>
		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
