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
?>

<div class="row" style="background-color:#f0f0f0;<?php echo esc_attr($bgcolours); ?>">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
	<div class="row p-3">
            <?php if ($headings) : ?>
                <?php foreach ((array)$headings as $heading) : ?>
                    <div class="col-12">
                        <div class="h3"><?php echo esc_html($heading) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($contents) : ?>
                <?php foreach ((array)$contents as $content) : ?>
                    <div class="col-12">
                        <?php echo esc_html($content) ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
    <div class="col-sm-4">
	
        <div class="row pt-5 text-center">
            <?php if ($icons) : ?>
            <?php $size = 'thumbnail'; ?> 
            <div class="justify-content-end" style="background-color: primary;">
                <?php echo wp_get_attachment_image($icons, $size); ?>
            </div>
        <?php endif; ?>
		
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

 
    

