<?php
/**
 * Page
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

get_header();?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <header class="sunset-page-header">

            <?php the_title( '<h1 class="page-title">', '</h1>'); ?>

            <p><?php esc_html_e( get_post_custom_values('sunset-subheader', get_the_ID())[0], 'sunsettheme' ); ?></p>

        </header>
    
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-md-10 col-lg-8 col-lg-offset-2 col-md-offset-1">

                    <?php

                        if ( have_posts() ) :

                            while ( have_posts() ): the_post();

                                get_template_part( 'template-parts/page' );

                            endwhile;

                        endif;

                     ?>

                </div><!-- .col-xs-12 -->

            </div><!-- .row -->

        </div><!-- .container -->

    </main><!-- .primary -->
</div>

<?php get_footer(); ?>
