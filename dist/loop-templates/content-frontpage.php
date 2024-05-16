<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div <?php post_class(); ?> >

	
	<div class="entry-content">
		
		<div class="container">
			
				<?php
				the_content();
				understrap_link_pages();
				?>
			
		</div>


	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</div><!-- #post-## -->
