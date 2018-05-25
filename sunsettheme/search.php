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

        <header class="archive-header text-center">
            <?php

                if ( is_search() ) {
                    $title = sprintf( __( 'Search Results for &#8220;%s&#8221;' ), get_search_query() );
                    _e( '<h1>' . $title . '</h1>', 'sunsettheme' );
                }

            ?>
        </header>

        <?php if ( is_paged() ): ?>
            <div class="container text-center container-load-previous">
                <a class="btn-sunset-load sunset-load-more" data-prev="1" data-searchd="<?php echo get_search_query(); ?>" data-page="<?php echo sunset_check_paged(1); ?>" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
                    <span class="sunset-icon icon-loading"></span>
                    <span class="text">Load Previous</span>
                </a>
            </div><!-- .container -->
        <?php endif; ?>

        <div class="container sunset-post-container">

            <?php

                if ( have_posts() ) :

                    echo '<div class="page-limit" data-page="/' . sunset_check_paged() . '?s=' . get_search_query() . '" >';

                    while ( have_posts() ): the_post();

                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    echo '</div>';

                endif;

             ?>

        </div><!-- .container -->

        <div class="container text-center">
            <a class="btn-sunset-load sunset-load-more" data-searchd="<?php echo get_search_query(); ?>" data-page="<?php echo sunset_check_paged(1); ?>" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
                <span class="sunset-icon icon-loading"></span>
                <span class="text">Load More</span>
            </a>
        </div><!-- .container -->

    </main><!-- .primary -->
</div>

<?php get_footer(); ?>
