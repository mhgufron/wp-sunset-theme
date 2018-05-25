<?php get_header(); ?>

    <div id="primary" <?php post_class( 'sunset-404 background-image' ); ?> style="background-image: url(<?php echo get_template_directory_uri() . '/images/404.jpeg'; ?>)">
        <div class="overlay-404"></div>
        <main id="main" class="site-main" role="main">

            <div class="container">

                <div class="sunset-error-404 text-center">

                    <header class="page-header">
                        <h1 class="page-title">404</h1>
                        <h2 class="page-sub-title">Sorry, page not found!!</h2>
                    </header>

                    <div class="page-content">

                        <div class="row">

                            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                                <?php get_search_form() ?>
                            </div>

                        </div><!-- .row -->

                    </div><!-- .page-content -->

                </div><!-- .error-404 -->

            </div>

        </main>
    </div><!-- #primary -->

<?php get_footer(); ?>
