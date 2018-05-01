<?php

/*
@package sunsettheme
    =========================
        Theme Custom Post Type
    =========================
 */

$contact = get_option( 'activate_contact' );
if ( @$contact == 1 ) {

    add_action( 'init', 'sunset_contact_custom_post_type' );

    add_filter( 'manage_sunset-contact_posts_columns', 'sunset_set_contact_columns' );
    add_action( 'manage_sunset-contact_posts_custom_column', 'sunset_contact_custom_column', 10, 2 );
}
/* CONTACT CPT */
function sunset_contact_custom_post_type()
{
    $label = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message',
    );

    $args = array(
        'labels'            => $label,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => array( 'title', 'editor', 'author' ),
    );

    register_post_type( 'sunset-contact', $args );
}

function sunset_set_contact_columns( $columns )
{
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['messages'] = 'Messages';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';
    return $newColumns;
}

function sunset_contact_custom_column( $column, $post_id )
{
    switch( $column ) {
        case 'messages':
            // Message column
            echo get_the_excerpt();
            break;
        case 'email':
            // Email column

            break;
    }
}
