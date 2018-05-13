<?php
/**
 * Index page
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

get_header();?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <div class="container sunset-post-container">

            <?php

                if ( have_posts() ) :

                    while ( have_posts() ): the_post();

                        $class = 'reveal';
                        set_query_var( 'post-class', $class );
                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                endif;

             ?>

        </div><!-- .container -->

        </form>

        <div class="container text-center">
            <a class="btn-sunset-load sunset-load-more" data-page="1" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
                <span class="sunset-icon icon-loading"></span>
                <span class="text">Load More</span>
            </a>
        </div><!-- .container -->

    </main><!-- .primary -->
</div>

<?php get_footer(); ?>
