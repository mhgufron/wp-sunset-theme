<?php
/**
 * Single Post Format
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 *
 * Template Name: Custom Page Right Sidebar
 */

get_header();?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <header class="sunset-page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-10 col-sm-offset-1 text-center">

                    <?php the_title( '<h1 class="page-title">', '</h1>'); ?>

                    <p><?php esc_html_e( get_post_custom_values('sunset-subheader', get_the_ID())[0], 'sunsettheme' ); ?></p>

                </div>

            </div><!-- .row -->
        </header>

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-10 col-md-8">

                    <?php

                    if ( have_posts() ) :

                        while ( have_posts() ): the_post();

                            get_template_part( 'template-parts/page' );

                        endwhile;

                    endif;

                    ?>

                </div><!-- .col-md-8 -->

                <div class="col-xs-12 col-sm-2 col-md-4">
                    <div class="sunset-page-template-sidebar">
                        <?php dynamic_sidebar( 'sunset-sidebar-template' ); ?>
                    </div><!-- .sunset-page-template-sidebar -->
                </div><!-- .col-md-4 -->

            </div><!-- .row -->

        </div><!-- .container -->

    </main><!-- .primary -->

</div><!-- #primary -->

<?php get_footer(); ?>
