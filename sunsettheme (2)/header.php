<?php
/**
 * This is a template for the header
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <title><?php bloginfo( 'name' ); wp_title(); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link href="https://fonts.googleapis.com/css?family=Raleway: 200, 300, 500" rel="stylesheet">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class() ?> >
        <div class="container-fluid">

            <div class="row">

                <header class="header-container text-center background-image" style="background-image: url(<?php header_image(); ?>)">

                    <div class="header-content table">
                        <div class="table-cell">
                            <h1 class="site-title sunset-icon">
                                <i class="icon-logo"></i>
                                <span class="hide"><?php bloginfo( 'name' ); ?></span>
                            </h1>
                            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </div><!-- .table-cell -->
                    </div><!-- .header-content -->

                    <div class="nav-container">
                        <nav class="navbar navbar-sunset">
                            <?php wp_nav_menu( array(
                                'theme_location'    => 'primary',
                                'container'         => false,
                                'menu_class'        => 'nav navbar-nav',
                                'walker'            => new Sunset_Walker_Nav_Primary()
                            ) ); ?>
                        </nav>
                    </div><!-- .nav-container -->

                </header><!-- .header-container -->

            </div><!-- .row -->

        </div><!-- .container-fluid -->
