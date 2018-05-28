<?php get_header(); ?>

    <div id="primary" <?php post_class( 'sunset-404 background-image' ); ?> style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/404.jpeg'; ?>)">
        <div class="overlay-404"></div>
        <main id="main" class="site-main" role="main">

            <div class="container">

                <div class="sunset-content-404 text-center">

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

                </div><!-- .sunset-content-404 -->

            </div>

            <div class="sunset-footer-404">

                <div class="col-xs-12">

                    <?php wp_nav_menu( array(
                        'theme_location'    => 'footer',
                        'container'         => false,
                        'menu_class'        => 'nav navbar-nav navbar-center sunset-menu-footer',
                        'walker'            => new Sunset_Walker_Nav_Primary()
                    ) ); ?>
                </div>
                <div class="col-xs-12">

                    <p class="copyright-404 text-center">Copyright © 2018 Sunset by Muhammad Gufron</p>

                </div>

            </div><!-- .sunset-footer-404 -->

        </main>
    </div><!-- #primary -->

<?php get_footer(); ?>
