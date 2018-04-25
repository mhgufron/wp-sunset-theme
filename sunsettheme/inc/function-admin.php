<?php

/*
@package sunsettheme
    =========================
        ADMIN PAGE
    =========================
 */

function sunset_add_admin_page()
{
    // Generate Sunset Admin Page
    add_menu_page( 'Sunset Theme Option', 'Sunset', 'manage_options', 'mhgufron_sunset', 'sunset_theme_create_page', get_template_directory_uri() . '/assets/img/sunset-icon.png', '110' );

    // Generate Sunset Admin Sub Pages
    add_submenu_page(  );

}
add_action('admin_menu', 'sunset_add_admin_page');

function sunset_theme_create_page()
{
    // generation of our adimn page
    echo "<h1>Sunset Theme Options</h1>";
}
