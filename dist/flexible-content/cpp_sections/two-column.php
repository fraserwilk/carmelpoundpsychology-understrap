<?php
/**
 * ACF: Flexible Content > Layouts > Two Column
 *
 * @package WordPress
 * @subpackage CPP
 */

$col1_eyebrow = $args['column_1_eyebrow'];
$col1_icon = $args['column_1_icon'];
$col1_heading = $args['column_1_heading'];
$col1_content = $args['column_1_content'];
$col1_image = $args['column_1_image'];
$col1_buttontext = $args['column_1_button_text'];
$col1_buttonlink = $args['column_1_button_link'];

$col2_heading = $args['column_2_heading'];
$col2_content = $args['column_2_content'];
$col2_image = $args['column_2_image'];

$bgcolour = $args['background_colour'];

// Not used yet
$bg_img     = get_template_directory_uri() . '/assets/images/cta-bg.png';
$bg_img_css = 'background-image: url(' . esc_url( $bg_img ) . '); background-size: cover; background-repeat: no-repeat; background-position: center center;';
?>

<div class="row" style="background-color:<?php echo $bgcolour; ?>">
	<div class="col-2"></div>
		<div class="col-8">
			<div class="row align-items-center">
				<div class="col">
				<?php if ($col1_image) : 
					$size = 'full'; // (thumbnail, medium, large, full or custom size eg: array(48, 48) )
					$attr = array(
						'class' => '', // Add CSS classes to the image
						'style' => 'background-color: primary;' ,  // Add inline CSS styles to the image
					); 
					echo wp_get_attachment_image( $col1_image, $size, false, $attr ) ?> 
				<?php endif; ?>
				<?php if ($col1_icon) : 
					$size = array(48, 48); // (thumbnail, medium, large, full or custom size)
					$attr = array(
						'class' => '', // Add CSS classes to the image
						'style' => 'background-color: primary;' ,  // Add inline CSS styles to the image
					); 
					echo wp_get_attachment_image( $col1_icon, $size, false, $attr ) ?> 
				<?php endif; ?>
				<?php if ( $col1_eyebrow ) : ?>
					<div class=""><?php echo esc_html( $col1_eyebrow ); ?></div>
				<?php endif; ?>
				<?php if ( $col1_heading ) : ?>
					<h2 class="py-3"><?php echo esc_html( $col1_heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $col1_content ) : ?>
					<div class=""><?php echo $col1_content; ?></div>
				<?php endif; ?>
				<?php if ( $col1_buttonlink AND $col1_buttontext) : ?>
					<button class="btn btn-outline-primary">
					<a href="<?php echo esc_html( $col1_buttonlink ); ?>" class="btn btn-link text-dark" ><?php echo esc_html( $col1_buttontext ); ?></a>
					</button>
				<?php endif; ?>
			</div>
				
			<div class="col-6 py-5">
				<?php if ( $col2_heading ) : ?>
					<h2 class=""><?php echo esc_html( $col2_heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $col2_content ) : ?>
					<div class=""><?php echo $col2_content; ?></div>
				<?php endif; ?>
				<?php if ( $col2_image ) : 
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					echo wp_get_attachment_image( $col2_image, $size ) ?> 
				<?php endif; ?>
			</div>
		</div>
	</div>
		
				

				
					
</div><!-- .wp-block-buttons -->

			
		</div>
	</div>
</div><!-- .cpp-layouts .cpp-layouts-cta -->