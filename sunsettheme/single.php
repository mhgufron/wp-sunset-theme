<?php
/**
 * Single page
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

get_header();?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <div class="container">

            <?php

                if ( have_posts() ) :

                    while ( have_posts() ): the_post();

                        get_template_part( 'template-parts/single', get_post_format() );

                        the_post_navigation();

                        if ( comments_open() ) :
                            comments_template();
                        endif;

                    endwhile;

                endif;

             ?>

        </div><!-- .container -->

    </main><!-- .primary -->
</div>

<?php get_footer(); ?>
