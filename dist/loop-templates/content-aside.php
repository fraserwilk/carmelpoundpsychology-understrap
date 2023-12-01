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
		<div class="row home-row-bg">
			<div class="col-2"></div>
			<div class="col-8">
        
				<?php
				// ACF - Flexible Content fields.
				$sections = get_field( 'cpp_sections' );

				if ( $sections ) :
					foreach ( $sections as $section ) :
						$template = str_replace( '_', '-', $section['acf_fc_layout'] );
						get_template_part( 'flexible-content/cpp_sections/' . $template, '', $section );
					endforeach;
				endif;
			
				?>
			</div>
            <div class="col-2"></div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<div class="mb-5">&nbsp;</div>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
