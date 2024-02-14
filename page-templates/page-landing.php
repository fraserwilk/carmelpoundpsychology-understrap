<?php
/**
 * Template Name: Landing Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}

$wrapper_id = 'full-width-page-wrapper';
if ( is_page_template( 'page-templates/no-title.php' ) ) {
	$wrapper_id = 'no-title-page-wrapper';
}
?>

<div class="wrapper bg-secondary" id="<?php echo $wrapper_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ok. ?>">

	<div class="<?php echo esc_attr( $container ); ?> p-0" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

				<?php if( have_rows('content') ):  ?>
					<?php while( have_rows('content') ): the_row(); ?>
						<?php if( get_row_layout() == 'hero_section' ): 
						
							$hero_image = get_sub_field('hero_image');
							$size = 'full'; // (thumbnail, medium, large, full or custom size)
							$hero_title = get_sub_field('hero_title');
						?>

						<?php
						if( $hero_image ) : ?>
							<div class="hero-section">
								<img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" class="hero-image"; />
								<div class="hero-overlay">
									<?php echo esc_html($hero_title); ?>
								</div>
							</div>
						<?php endif; ?>
							

						<?php elseif( get_row_layout() == 'textarea_with_image' ): 
							$text_content = get_sub_field('content');
							$text_image = get_sub_field('image');
							$image_side = get_sub_field('image_side');
							?>
							<div class="home-section-wrapper">
								<div class="home-section-container border">
									<div class="col-md-6">
										<?php echo esc_html($text_content); ?><br>
										<?php echo esc_html($image_side); ?><br>
									</div>
									<div class="col-md-6">
										<figure class="text-image">
										<?php if( $text_image ) {echo wp_get_attachment_image( $text_image, 'medium' ); } ?>
											
										</figure>
									</div>
								</div>
							</div>
							
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #<?php echo $wrapper_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ok. ?> -->

<?php
get_footer();
