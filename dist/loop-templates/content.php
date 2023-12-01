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
				// ACF - Flexible Content fields.
				$sections = get_field( 'cpp_sections' );
				
				if ( $sections ) :
					// wrap every sub column in a row
					echo '<div class="row container-fluid p-0">';
					foreach ( $sections as $section ) :
						$template = str_replace( '_', '-', $section['acf_fc_layout'] );
						
						get_template_part( 'flexible-content/cpp_sections/' . $template , '', $section );
						
					endforeach;
					echo '</div>';
				endif;
			
				?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<div class="mb-5">&nbsp;</div>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
