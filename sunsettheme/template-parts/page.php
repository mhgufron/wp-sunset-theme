<?php
/**
 * Single Post Format
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-page' ); ?>>

    <div class="entry-content clearfix">

        <?php the_content(); ?>

    </div><!-- .entry-content -->

</article>
