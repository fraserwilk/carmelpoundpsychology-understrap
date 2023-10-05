<?php
/**
 * ACF: Flexible Content > Layouts > Therapy
 *
 * @package WordPress
 * @subpackage CPP
 */


 
 $heading = $args['therapy_heading'];
 $icon = $args['therapy_icon'];
 $content = $args['therapy_content'];
 $link = $args['therapy_link'];
 $bgcolour = $args['background_colour'];

?>

<div class="row border" style="background-color:<?php echo $bgcolour; ?>">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="row">
			<div class="col-4 col-sm-4" style="cursor: pointer;" onclick="window.location='<?php echo esc_url( $link ); ?>';">
				<?php if ( $icon ) : 
					$size = array(48, 48); // (thumbnail, medium, large, full or custom size)
					$attr = array(
						'class' => '', // Add CSS classes to the image
						'style' => 'background-color: primary;' ,  // Add inline CSS styles to the image
					); 
					echo wp_get_attachment_image( $icon, $size, false, $attr ) ?> 
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h3 class="pt-4"><?php echo esc_html( $heading ); ?></h3>
				<?php endif; ?>
				<?php if ( $content ) : ?>
					<div class="pt-2"><?php echo esc_html( $content ); ?></div>
				<?php endif; ?>
			</div>
			<div class="col-4 col-sm-4">col-4 col-sm-4</div>
			<div class="col-4 col-sm-4">col-4 col-sm-4</div>
		</div>
	</div>
	<div class="col-sm-2">Top Col 2</div>
</div>



