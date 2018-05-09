<?php
/**
 * Link Post Format
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('sunset-format-link'); ?>>
    <header class="entry-header text-center">

        <?php

            $link = sunset_grab_url();
            the_title( '<h1 class="entry-title">', '<div class="link-icon"><span class="sunset-icon icon-link"></span></div></h1>');

        ?>

    </header>

</article>
