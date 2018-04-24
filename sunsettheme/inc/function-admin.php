<?php

/*
@package sunsettheme
    =========================
        ADMIN PAGE
    =========================
 */

function sunset_add_admin_page()
{
    /* add_menu_page(
      Title admin page,
      Label menu,
      role/yang boleh dilakukan,
      slug unique url,
      function yang dipanggil,
      icon menu,
      urutan index
     )
     */
    add_menu_page( 'Sunset Theme Option', 'Sunset', 'manage_options', 'mhgufron-sunset', 'sunset_theme_create_page', get_template_directory_uri() . '/assets/img/sunset-icon.png', '110' );

}
add_action('admin_menu', 'sunset_add_admin_page');

function sunset_theme_create_page()
{
    // generation of our adimn page
    echo "<h1>Sunset Theme Options</h1>";
}
