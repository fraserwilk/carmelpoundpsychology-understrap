<?php
/**
 * Two Column Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$heading             = !empty(get_field( 'heading' )) ? get_field( 'heading' ) : 'Your heading here...';
$content            = get_field( 'content' );
$image              = get_field( 'image' );
$background_color  = get_field( 'background_color' ); // ACF's color picker.
$text_color        = get_field( 'text_color' ); // ACF's color picker.


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'two-column';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
if ( $background_color || $text_color ) {
    $class_name .= ' has-custom-acf-color';
}

// Build a valid style attribute for background and text colors.
$styles = array( 'background-color: ' . $background_color, 'color: ' . $text_color );
$style  = implode( '; ', $styles );
?>

    

<div <?php echo wp_kses_post( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $style ); ?>"">
    
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="h2">
                <?php echo esc_html( $heading ); ?>
            </div>
            <div class="">
                <?php if ( !empty( $content ) ) : ?>
                    <?php echo wp_kses_post( $content ); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-6">
            <?php if ( $image ) : ?>
                <div class="">
                    <figure class="figure">
                        <?php echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'figure-img img-fluid' ) ); ?>
                    </figure>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>


