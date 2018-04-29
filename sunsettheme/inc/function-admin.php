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
    add_submenu_page( 'mhgufron_sunset', 'Sunset Theme Option', 'General', 'manage_options', 'mhgufron_sunset', 'sunset_theme_create_page' );
    add_submenu_page( 'mhgufron_sunset', 'Sunset CSS Option', 'Custom CSS', 'manage_options', 'mhgufron_sunset_css', 'sunset_theme_settings_page' );

    // Activate custom settings
    add_action( 'admin_init', 'sunset_custom_settings');

}
add_action('admin_menu', 'sunset_add_admin_page');

// Activate custom settings
function sunset_custom_settings()
{
    register_setting( 'sunset-settings-group', 'first_name');
    register_setting( 'sunset-settings-group', 'last_name');
    register_setting( 'sunset-settings-group', 'user_desciption');
    register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
    register_setting( 'sunset-settings-group', 'facebook_handler');
    register_setting( 'sunset-settings-group', 'github_handler');

    add_settings_section( 'sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'mhgufron_sunset' );

    add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-desscription', 'Description', 'sunset_sidebar_description', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'sunset_sidebar_twitter', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'sunset_sidebar_facebook', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-github', 'Github Handler', 'sunset_sidebar_github', 'mhgufron_sunset', 'sunset-sidebar-options' );
}

function sunset_sidebar_options()
{
    echo "Customize your Sidebar Information";
}

function sunset_sidebar_name()
{
    $firstName = esc_attr( get_option('first_name') );
    $lastName = esc_attr( get_option('last_name') );
    echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="Last Name" /> <input type="text" name="last_name" value="' . $lastName . '" placeholder="Last Name" /><p class="description">Input your first name and last name.</p>';
}

function sunset_sidebar_description()
{
    $desrciption = esc_attr( get_option('user_desciption') );
    echo '<input type="text" name="user_desciption" value="' . $desrciption . '" placeholder="User Description" /><p class="description">Write something smart.</p>';
}

function sunset_sidebar_twitter()
{
    $twitter = esc_attr( get_option('twitter_handler') );
    echo '<input type="text" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter Handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}

function sunset_sidebar_facebook()
{
    $facebook = esc_attr( get_option('facebook_handler') );
    echo '<input type="text" name="facebook_handler" value="' . $facebook . '" placeholder="Facebook Handler" />';
}

function sunset_sidebar_github()
{
    $github = esc_attr( get_option('github_handler') );
    echo '<input type="text" name="github_handler" value="' . $github . '" placeholder="Github Handler" />';
}

function sunset_theme_create_page()
{
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php' );
}

//  Sanizatization settings
function sunset_sanitize_twitter_handler($input)
{
    $output = sanitize_text_field( $input );
    $output =   str_replace('@', '', $output);
    return $output;
}

function sunset_theme_settings_page()
{
    echo "<h1>Sunset Custom CSS</h1>";
}
