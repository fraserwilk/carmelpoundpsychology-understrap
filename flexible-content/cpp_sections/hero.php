<?php
/**
 * ACF: Flexible Content > Layouts > Hero
 *
 * @package WordPress
 * @subpackage CPP
 */

$heading = $args['hero_heading'];
$content = $args['hero_content'];
$buttontext = $args['hero_buttons'];
$bgcolour = $args['background_colour'];
$image = $args['hero_image'];

// Not used yet
$bg_img     = get_template_directory_uri() . '/assets/images/cta-bg.png';
$bg_img_css = 'background-image: url(' . esc_url( $bg_img ) . '); background-size: cover; background-repeat: no-repeat; background-position: center center;';
?>

<div class="row" style="background-color:<?php echo $bgcolour; ?>">
	<div class="col-2"></div>
		<div class="col-8">
			<div class="row align-items-center">
				<div class="col py-3">
					<?php if ( $heading ) : ?>
						<h2 class=""><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>
					<?php if ( $content ) : ?>
						<div class=""><?php echo $content; ?></div>
					<?php endif; ?>
					<?php if ( $buttontext) : ?>
						<button class="btn btn-outline-primary">
						<a href="<?php echo esc_html( $buttontext ); ?>" class="btn btn-link text-dark" ><?php echo esc_html( $buttontext ); ?></a>
						</button>
					<?php endif; ?>
				</div>
					
				<div class="col-6 img-fluid order-first order-sm-1 py-3">
					<?php if ( $image ) : 
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						echo wp_get_attachment_image( $image, $size ) ?> 
					<?php endif; ?>
				</div>
			</div>
		</div>

	<div class="col-2"></div>
</div>

