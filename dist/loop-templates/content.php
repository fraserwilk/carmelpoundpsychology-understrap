<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">
		
        
	<?php
                        the_content();
                        understrap_link_pages();
                        ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<div class="mb-5">&nbsp;</div>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
