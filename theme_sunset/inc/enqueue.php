<?php

/*
    @package sunsettheme
    =======================================
        ADMIN ENQUEUE FUNCTION
    =======================================
*/

function sunset_load_admin_scripts( $hook )
{
    // echo $hook;
    if ( 'toplevel_page_mhgufron_sunset' == $hook ) {

        wp_register_style( 'sunset_admin', get_template_directory_uri() . '/assets/css/sunset.admin.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'sunset_admin' );
        wp_register_style( 'font_awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
        wp_enqueue_style( 'font_awesome' );

        wp_enqueue_media();

        wp_register_script( 'sunset-admin-script', get_template_directory_uri() . '/assets/js/sunset.admin.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'sunset-admin-script' );
    } elseif ( 'sunset_page_mhgufron_sunset_css' == $hook ) {
        wp_enqueue_script( 'ace', get_template_directory_uri() . '/assets/js/ace/ace.js', array('jquery'), '1.3.3', true );
        wp_enqueue_script( 'sunset-custom-css-script', get_template_directory_uri() . '/assets/js/sunset.custom.js', array('jquery'), '1.0.0', true );
    } else {
        return;
    }
}
add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts');
