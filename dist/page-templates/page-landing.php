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

// Display hero section if it's the front page
if ( is_front_page() ) {
    get_template_part( 'global-templates/hero' );
}

$wrapper_id = 'full-width-page-wrapper';

// Check for specific page template to adjust wrapper ID
if ( is_page_template( 'page-templates/no-title.php' ) ) {
    $wrapper_id = 'no-title-page-wrapper';
}
?>

<div class="wrapper" id="<?php echo esc_attr( $wrapper_id ); ?>">

    <div class="<?php echo esc_attr( $container ); ?> p-0" id="content">

        <div class="row">

            <div class="col-md-12 content-area" id="primary">

                <main class="site-main" id="main" role="main">

                <?php if ( have_rows( 'content' ) ) : ?>
                    <?php while ( have_rows( 'content' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'hero_section' ) : ?>
                            <?php
                            $hero_image = get_sub_field( 'hero_image' );
                            $hero_title = get_sub_field( 'hero_title' );
                            ?>

                            <?php if ( $hero_image ) : ?>
                                <div class="hero-section">
                                    <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>" class="hero-image" />
                                    <div class="hero-overlay">
                                        <?php echo esc_html( $hero_title ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php elseif ( get_row_layout() == 'textarea_with_image' ) : ?>
                            <?php
                            $title = get_sub_field( 'title' );
                            $text_content = get_sub_field( 'content' );
                            $text_image = get_sub_field( 'image' );
                            ?>

                            <div class="home-section-wrapper">
                                <div class="home-section-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2><?php echo esc_html( $title ); ?></h2>
                                            <?php echo apply_filters( 'the_content', $text_content ); ?>
                                            <?php if ( get_sub_field( 'button_link' ) ) : ?>
                                                <a href="<?php the_sub_field( 'button_link' ); ?>" class="btn btn-primary btn-lg" type="button"><?php the_sub_field( 'button_label' ); ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <figure class="text-image img-fluid">
                                                <?php if ( $text_image ) { echo wp_get_attachment_image( $text_image, 'full' ); } ?>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php elseif ( get_row_layout() == 'two_columns' ) : ?>
                            <?php
                            $intro_title = get_sub_field( 'intro_title' );
                            $title = get_sub_field( 'title' );
                            $content = get_sub_field( 'content' );
                            ?>

                            <div class="home-section-wrapper" style="background-color:<?php the_sub_field( 'background_color' ); ?>">
                                <div class="home-section-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="subtitle"><?php echo esc_html( $intro_title ); ?></div>
                                            <h2><?php echo esc_html( $title ); ?></h2>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="content"><?php echo apply_filters( 'the_content', $content ); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php elseif ( get_row_layout() == 'columns_section' ) : ?>
                            <?php if ( have_rows( 'columns' ) ) : ?>
                                <div class="home-section-wrapper">
                                    <div class="home-section-container">
                                        <div class="row gx-5">
                                            <?php while ( have_rows( 'columns' ) ) : the_row(); ?>
                                                <div class="col servicebox">
                                                    <div class="box">
                                                        <?php
                                                        $icon = get_sub_field( 'icon' );
                                                        $size = array( 64, 64 ); // (thumbnail, medium, large, full or custom size)
                                                        
                                                        if ( $icon ) {
                                                            echo wp_get_attachment_image( $icon, $size, '', array( 'class' => 'icon' ) );
                                                        }
                                                        ?>

                                                        <div class="title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></div>
                                                        <div class="content"><?php echo apply_filters( 'the_content', get_sub_field( 'content' ) ); ?></div>
                                                        <div class="button">
                                                            <?php if ( get_sub_field( 'button_link' ) ) : ?>
                                                                <a href="<?php the_sub_field( 'button_link' ); ?>" class="btn btn-outline-primary btn-lg w-100" type="button"><?php the_sub_field( 'button_label' ); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php elseif ( get_row_layout() == 'testimonial' ) : ?>
							<?php
								// Load values and assign defaults.
								$quote = get_sub_field( 'quote' ) ?: 'Your quote here...';
								$author = get_sub_field( 'author' );
								$role = get_sub_field( 'role' );
								$image = get_sub_field( 'image' );
								$background_color = get_sub_field( 'background_color' ); // ACF's color picker.
								$text_color = get_sub_field( 'text_color' ); // ACF's color picker.
							?>
							<div class="home-section-wrapper" style="<?php echo $background_color; ?>">
                                    <div class="home-section-container">
                                        <div class="row">


							<?php

							// Create class attribute allowing for custom "className" and "align" values.
							$class_name = 'testimonial';
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
							$styles = array();
							if ( $background_color ) {
								$styles[] = 'background-color: ' . $background_color;
							}
							if ( $text_color ) {
								$styles[] = 'color: ' . $text_color;
							}
							$style = implode( '; ', $styles );
							?>

							<div class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $style ); ?>">
								<div class="testimonial__col">
									<blockquote class="testimonial__blockquote">
										<?php echo esc_html( $quote ); ?>
										<?php if ( $author ) : ?>
											<footer class="testimonial__attribution">
												<cite class="testimonial__author"><?php echo esc_html( $author ); ?></cite>
												<?php if ( $role ) : ?>
													<span class="testimonial__role"><?php echo esc_html( $role ); ?></span>
												<?php endif; ?>
											</footer>
										<?php endif; ?>
									</blockquote>
								</div>
								<?php if ( $image ) : ?>
									<div class="testimonial__col">
										<figure class="testimonial__image">
											<?php echo wp_get_attachment_image( $image, 'full', '', array( 'class' => 'testimonial__img' ) ); ?>
										</figure>
									</div>
								<?php endif; ?>
							</div>
										</div>
									</div>
							</div>
							
                            <!-- End Testimonial block template  -->

                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>

                </main>

            </div><!-- #primary -->

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #<?php echo esc_attr( $wrapper_id ); ?> -->

<?php
get_footer();
?>