<?php
/**
 * Archive page
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

get_header();?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

    <header class="archive-header text-center">
        <?php the_archive_title('<h1 class="page-title">', '</h1>') ?>
    </header>

        <?php if ( is_paged() ): ?>
            <div class="container text-center container-load-previous">
                <a class="btn-sunset-load sunset-load-more" data-prev="1" data-archive="<?php echo $_SERVER[ 'HTTP_REFERER' ] . $_SERVER[ 'REQUEST_URI' ]; ?>" data-page="<?php echo sunset_check_paged(1); ?>" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
                    <span class="sunset-icon icon-loading"></span>
                    <span class="text">Load Previous</span>
                </a>
            </div><!-- .container -->
        <?php endif; ?>

        <div class="container sunset-post-container">

            <?php

                if ( have_posts() ) :

                    echo '<div class="page-limit" data-page="' . $_SERVER[ 'REQUEST_URI' ] . '" >';

                    while ( have_posts() ): the_post();

                        // $class = 'reveal';
                        // set_query_var( 'post-class', $class );
                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    echo '</div>';

                endif;

             ?>

        </div><!-- .container -->

        <?php

            $http = ( isset( $_SERVER[ 'HTTP_HTTPS' ] ) ? 'https://' : 'http://' );
            $referer = ( isset( $_SERVER[ 'HTTP_REFERER' ] ) ? rtrim( $_SERVER[ 'HTTP_REFERER' ], '/' ) : $http . $_SERVER[ 'HTTP_HOST' ] );
            $archive_url =  $referer . $_SERVER[ 'REQUEST_URI' ];

        ?>

        <div class="container text-center">
            <a class="btn-sunset-load sunset-load-more" data-page="<?php echo sunset_check_paged(1); ?>" data-archive="<?php echo $archive_url; ?>" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
                <span class="sunset-icon icon-loading"></span>
                <span class="text">Load More</span>
            </a>
        </div><!-- .container -->

    </main><!-- .primary -->
</div>

<?php get_footer(); ?>
