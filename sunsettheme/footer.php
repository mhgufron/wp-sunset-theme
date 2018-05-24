<?php
/**
 * This is a template for the footer
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

 ?>
<footer class="sunset-footer">
    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-4">
                <div class="site-title sunset-icon-footer">
                    <i class="icon-logo"></i>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 ">
                <?php wp_nav_menu( array(
                    'theme_location'    => 'footer',
                    'container'         => false,
                    'menu_class'        => 'nav navbar-nav navbar-right sunset-menu-footer',
                    'walker'            => new Sunset_Walker_Nav_Primary()
                ) ); ?>
            </div>

        </div><!-- .row -->
        <hr>

        <p class="copyright text-center">Copyright © 2018 Sunset by Muhammad Gufron</p>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
