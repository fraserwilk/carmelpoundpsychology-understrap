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

	
	<div class="entry-content">
		
	<?php 
		if(is_page('185')) {
			echo '<div class="container">'; // Services page
		}
		else {
		echo '<div class="container full-height" style="padding-top: var(--space-mega);">';
		}
		?>
				<?php
				the_content();
				understrap_link_pages();
				?>		

		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
