<?php
/**
 * Sidebar section
 *
 * @package sunset
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sunset-sidebar' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area">

    <?php dynamic_sidebar( 'sunset-sidebar' ); ?>

</aside>
