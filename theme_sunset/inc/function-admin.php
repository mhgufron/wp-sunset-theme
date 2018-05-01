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
    add_submenu_page( 'mhgufron_sunset', 'Sunset Sidebar Option', 'Sidebar', 'manage_options', 'mhgufron_sunset', 'sunset_theme_create_page' );
    add_submenu_page( 'mhgufron_sunset', 'Sunset Theme Options', 'Theme Options', 'manage_options', 'mhgufron_sunset_theme', 'sunset_theme_support_page' );
    add_submenu_page( 'mhgufron_sunset', 'Sunset Contact Form', 'Contact Form', 'manage_options', 'mhgufron_sunset_theme_contact', 'sunset_contact_form_page' );
    add_submenu_page( 'mhgufron_sunset', 'Sunset CSS Option', 'Custom CSS', 'manage_options', 'mhgufron_sunset_css', 'sunset_theme_settings_page' );

    // Activate custom settings
    add_action( 'admin_init', 'sunset_custom_settings');

}
add_action('admin_menu', 'sunset_add_admin_page');

// Activate custom settings
function sunset_custom_settings()
{
    // Sidebar Option
    register_setting( 'sunset-settings-group', 'profile_picture');
    register_setting( 'sunset-settings-group', 'first_name');
    register_setting( 'sunset-settings-group', 'last_name');
    register_setting( 'sunset-settings-group', 'user_desciption');
    register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
    register_setting( 'sunset-settings-group', 'facebook_handler');
    register_setting( 'sunset-settings-group', 'github_handler');

    add_settings_section( 'sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'mhgufron_sunset' );

    // add_settings_field( 'id', 'title', 'callback', 'page', 'section', $args);
    add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-desscription', 'Description', 'sunset_sidebar_description', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'sunset_sidebar_twitter', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'sunset_sidebar_facebook', 'mhgufron_sunset', 'sunset-sidebar-options' );
    add_settings_field( 'sidebar-github', 'Github Handler', 'sunset_sidebar_github', 'mhgufron_sunset', 'sunset-sidebar-options' );

    // Theme Support Options
    // register_setting( 'option_group', 'option_name', 'function');
    register_setting( 'sunset-theme-support', 'post_formats');
    register_setting( 'sunset-theme-support', 'custom_header');
    register_setting( 'sunset-theme-support', 'custom_background');

    add_settings_section( 'sunset-theme-options', 'Theme Options', 'sunset_theme_options', 'mhgufron_sunset_theme');

    // add_settings_field( 'id', 'title', 'callback', 'page', 'section', $args);
    add_settings_field( 'post-formats', 'Post Formats', 'sunset_post_formats', 'mhgufron_sunset_theme', 'sunset-theme-options' );
    add_settings_field( 'custom-header', 'Custom Header', 'sunset_custom_header', 'mhgufron_sunset_theme', 'sunset-theme-options' );
    add_settings_field( 'custom-background', 'Custom Background', 'sunset_custom_background', 'mhgufron_sunset_theme', 'sunset-theme-options' );

    // Contact Form Options
    register_setting( 'sunset-contact-options', 'activate_contact' );

    add_settings_section( 'sunset-contact-options', 'Contact Form', 'sunset_contact_section', 'mhgufron_sunset_theme_contact');

    add_settings_field( 'activate-form', 'Activate Contact Form', 'sunset_activate_contact', 'mhgufron_sunset_theme_contact', 'sunset-contact-options' );

    // Custom CSS Options
    register_setting( 'sunset-custom-css-options', 'sunset_css' );

    add_settings_section( 'sunset-custom-css-section', 'Custom CSS', 'sunset_custom_css_section_callback', 'mhgufron_sunset_css' );

    add_settings_field( 'custom-css', 'Insert Your Custom CSS', 'sunset_custom_css_callback', 'mhgufron_sunset_css', 'sunset-custom-css-section' );
}

// Post Formats Callback Function
function sunset_custom_css_section_callback()
{
    echo "Customize Sunset Theme with your own CSS";
}

function sunset_custom_css_callback() {
    $css = get_option( 'sunset_css' );
    $css = ( empty( $css ) ) ? '/* Sunset Theme Custom CSS */' : $css; 
    echo '<textarea placeholder="Sunset Custom CSS">' . $css . '</textarea>' ;
}

function sunset_theme_options()
{
    echo "Activate and Deactivate specific Theme Support Options";
}

function sunset_contact_section()
{
    echo "Activate and Deactivate the Built-in Contact Form";
}

function sunset_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ) ? 'checked' : '';
    echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" ' . $checked . ' ></label>' ;
}

function sunset_post_formats(){
    $options = get_option( 'post_formats' );
    $formats = array( 'aside', 'galery', 'link', 'images', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach ($formats as $format) {
        $checked = ( @$options[$format] == 1 ) ? 'checked' : '';
        $output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats[' . $format . ']" value="1" ' . $checked . ' >' . $format . '</label><br />' ;
    }
    echo $output;
}

function sunset_custom_header() {
    $options = get_option( 'custom_header' );
    $checked = ( @$options == 1 ) ? 'checked' : '';
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" ' . $checked . ' >Activate Custom Header</label>' ;
}

function sunset_custom_background() {
    $options = get_option( 'custom_background' );
    $checked = ( @$options == 1 ) ? 'checked' : '';
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" ' . $checked . ' >Activate Custom Background</label>' ;
}

// Sidebar Option Function
function sunset_sidebar_options()
{
    echo "Customize your Sidebar Information";
}

function sunset_sidebar_profile()
{
    $picture = esc_attr( get_option('profile_picture') );
    if ( empty( $picture ) ) {
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"/><input type="hidden" id="profile-picture" name="profile_picture" value=""/>';
    } else {
        echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"/><input type="hidden" id="profile-picture" name="profile_picture" value="' . $picture . '"/> <input type="button"  class="button button-secondary" value="Remove Profile Picture" id="remove-picture" />';
    }
}

function sunset_sidebar_name()
{
    $firstName = esc_attr( get_option('first_name') );
    $lastName = esc_attr( get_option('last_name') );
    echo '<input type="text" id="first_name" name="first_name" value="' . $firstName . '" placeholder="Last Name" /> <input type="text" id="last_name" name="last_name" value="' . $lastName . '" placeholder="Last Name" /><p class="description">Input your first name and last name.</p>';
}

function sunset_sidebar_description()
{
    $desrciption = esc_attr( get_option('user_desciption') );
    echo '<input type="text" id="user_desciption" name="user_desciption" value="' . $desrciption . '" placeholder="User Description" /><p class="description">Write something smart.</p>';
}

function sunset_sidebar_twitter()
{
    $twitter = esc_attr( get_option('twitter_handler') );
    echo '<input type="text" id="twitter_handler" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter Handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}

function sunset_sidebar_facebook()
{
    $facebook = esc_attr( get_option('facebook_handler') );
    echo '<input type="text" id="facebook_handler" name="facebook_handler" value="' . $facebook . '" placeholder="Facebook Handler" />';
}

function sunset_sidebar_github()
{
    $github = esc_attr( get_option('github_handler') );
    echo '<input type="text" id="github_handler" name="github_handler" value="' . $github . '" placeholder="Github Handler" />';
}

//  Sanizatization settings
function sunset_sanitize_twitter_handler($input)
{
    $output = sanitize_text_field( $input );
    $output = str_replace('@', '', $output);
    return $output;
}

// Template submenu function
function sunset_theme_create_page()
{
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php' );
}

function sunset_theme_support_page()
{
    require_once( get_template_directory() . '/inc/templates/sunset-theme-support.php' );
}

function sunset_contact_form_page()
{
    require_once( get_template_directory() . '/inc/templates/sunset-contact-form.php' );
}

function sunset_theme_settings_page()
{
    require_once( get_template_directory() . '/inc/templates/sunset-custom-css.php' );
}
