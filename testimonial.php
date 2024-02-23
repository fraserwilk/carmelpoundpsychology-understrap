<?php
/**
 * Template Name: Testimonial - CPP
 *
 * Template for displaying testimonials.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="index-wrapper">

    <!-- Move the hero section outside of the container div -->
    <?php if ( have_rows( 'content' ) ) : ?>
        <?php while ( have_rows( 'content' ) ) : the_row(); ?>

            <?php if ( get_row_layout() == 'hero_section' ) :
                $title = get_sub_field( 'title' );
                $subtitle = get_sub_field( 'sub_title' );
                $buttonlabel = get_sub_field( 'button_label' );
                $buttonlink = get_sub_field ('button_link');
                $image = wp_get_attachment_image( get_sub_field( 'hero_image' ), 'full' );
                $side = get_sub_field( 'image_side' );
                $bg = get_sub_field( 'background_colour' );
            ?>
                <div class="row align-items-center" style="background-color: <?php echo $bg ?>;">

                    <?php if ( $side === 'left' ) : ?>
                        <div class="col-md-4 offset-md-2 pt-5">
                            <?php echo $image; ?>
                        </div>

                        <div class="col-md-5">
                            <h1 class="display-3 fw-bold text-primary"><?php echo $title; ?></h1>
                            <div class="fs-3 py-3"><?php echo $subtitle; ?></div>
                            <div class="mt-2"><a href="<?php echo esc_url($buttonlink); ?>"><button class="btn btn-primary text-uppercase" type="submit"><?php echo $buttonlabel; ?></button></a></div>
                        </div>
                    <?php elseif ( $side === 'right' ) : ?>
                        <div class="col-md-5 offset-md-2">
                            <h1 class="display-3 fw-bold text-primary"><?php echo $title; ?></h1>
                            <div class="fs-3 py-3"><?php echo $subtitle; ?></div>
                            <div class="mt-2"><a href="<?php echo esc_url($buttonlink); ?>"><button class="btn btn-primary text-uppercase" type="submit"><?php echo $buttonlabel; ?></button></a></div>
                        </div>

                        <div class="col-md-4 pt-5">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Opens the primary div -->

            <main class="site-main" id="main">
                <div class="container">
                    <!-- ACF Two Column Layout -->

                    <?php if ( have_rows( 'content' ) ) : ?>
                        <?php while ( have_rows( 'content' ) ) : the_row(); ?>

                            <?php if ( get_row_layout() == 'two_columns') :
                                $introtitle = get_sub_field('intro_title');
                                $title = get_sub_field('title');
                                $content = get_sub_field('content');
                                $titleside = get_sub_field( 'title_side');
                            ?>

                            <div class="row align-items-center" style="height: 600px;">
                            <?php if ( $titleside === 'left' ) : ?>

                                <div class="col-md-6">
                                    <div class="has-small-font-size text-uppercase fw-bold">
                                        <?php echo $introtitle; ?>
                                    </div>
                                    <div>
                                        <h2 class="fw-bold display-3"><?php echo $title; ?></h2>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                
                                    <?php echo wp_kses($content, 'post'); ?>
                                
                                </div>

                            <?php endif; ?>
                            </div>

                    <?php endif; ?>












                            <!-- ACF Columns Section (3 Cols) -->

                            <?php if ( get_row_layout() == 'columns_section' ) :
                                $columns = get_sub_field( 'columns' );
                            ?>
                                <div class="row">
                                    <?php foreach ( $columns as $column ) : ?>
                                        <div class="col-lg-4 card">
                                                <div class="card-body">

                                                    <img src="..." class="card-img-top" alt="...">
                                                    <div class="display-1"><?php echo $column['icon']; ?></div>
                                                    <h3 class="card-title"><?php echo $column['title']; ?></h3>
                                                    <div class="card-text"><?php echo $column['content']; ?></div>
                                                    <div class="card-link"><a href="#" class="btn btn-primary"><?php echo $column['name']; ?></a></div>
                                                </div>
                                            </div>
                                        
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>


                            
                            <?php if ( get_row_layout() == 'textarea_with_image' ) : ?>
                            <!-- ACF Text Area with Image Section -->
                            <?php 
                                $title = get_sub_field( 'title' );
                                $content = get_sub_field( 'content' );
                                $image = wp_get_attachment_image( get_sub_field( 'image' ), 'full' );
                                $side = get_sub_field( 'image_side' );
                            ?>
                                <div class="row">
                                    <?php if ( $side == 'left' ) : ?>
                                        <div class="col-lg-6">
                                            <?php echo $image; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="h3"><?php echo $title; ?></div>
                                            <div class=""><?php echo $content; ?></div>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-lg-6">
                                            <div class="h3"><?php echo $title; ?></div>
                                            <div class=""><?php echo $content; ?></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </main><!-- #main -->

            <!-- The pagination component -->
            <?php understrap_pagination(); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>
