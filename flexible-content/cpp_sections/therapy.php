<?php
/**
 * ACF: Flexible Content > Layouts > Therapy
 *
 * @package WordPress
 * @subpackage CPP
 */

 
 $headings = $args['therapy_heading'];
 $icons = $args['therapy_icon'];
 $contents = $args['therapy_content'];
 $links = $args['therapy_link'];
 $bgcolours = $args['background_colour'];

// var_dump ($headings) ;
 ?>




 <div class="row" style="background-color:<?php echo esc_attr($bgcolours); ?>">
	 <div class="col-sm-2">col-sm-2</div>
	 <div class="col-sm-8">
		 <div class="row border border-primary">
			
		 		<?php if ( $icons ) : 
					$size = array(48, 48); // (thumbnail, medium, large, full or custom size)
					$attr = array(
						'class' => '', // Add CSS classes to the image
						'style' => 'background-color: primary;' ,  // Add inline CSS styles to the image
					); 
					echo wp_get_attachment_image( $icons, $size, false, $attr ) ?> 
				<?php endif; ?>
				<?php if ( $headings ) : ?>
					<?php foreach ( (array) $headings as $heading ) : ?>
						<div class="col-4 col-sm-4">
						<div class="h3"><?php echo esc_html( $heading )?></div>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php if ( $contents ) : ?>
					<?php foreach ( (array) $contents as $content ) : ?>
						<div class=""><?php echo esc_html( $content )?></div>
					<?php endforeach; ?>	
				<?php endif; ?>	
				
			</div>
			
			
			
		</div>
	 
 </div>
 </div>
 
    

