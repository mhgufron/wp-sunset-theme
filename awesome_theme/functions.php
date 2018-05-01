<?php
/*
    ==========================================
     Include scripts
    ==========================================
*/
function awesome_script_enqueue() {
    //css
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/awesome.css', array(), '1.0.0', 'all');
    //js
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);

}

add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

/*
    ==========================================
     Activate menus
    ==========================================
*/
function awesome_theme_setup() {

    add_theme_support('menus');

    register_nav_menu('primary', 'Primary Header Navigation');
    register_nav_menu('secondary', 'Footer Navigation');

}

add_action('init', 'awesome_theme_setup');

/*
    ==========================================
     Theme support function
    ==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));
add_theme_support('html5',array('search-form'));

/*
    ==========================================
     Sidebar function
    ==========================================
*/
function awesome_widget_setup() {

    register_sidebar(
        array(
            'name'    => 'Sidebar',
            'id'    => 'sidebar-1',
            'class'    => 'custom',
            'description' => 'Standard Sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        )
    );

}
add_action('widgets_init','awesome_widget_setup');

/*
    ==========================================
     Include file
    ==========================================
*/

require get_template_directory() . '/inc/walker.php';

/*
    ==========================================
    Head Function
    ==========================================
*/
function awesome_remove_version()
{
    return '';
}
add_filter('the_generator', 'awesome_remove_version');

/*
    ==========================================
    Custom Post Type
    ==========================================
*/
function awesome_custom_post_type()
{

    $labels = array(
        'name'          => 'Portfolio',
        'singular_name' => 'Portfolio',
        'add_new'       => 'Add Item',
        'all_items'     => 'All Items',
        'add_new_item'  => 'Add Item',
        'edit_item'     => 'Edit Item',
        'new_item'      => 'New Item',
        'view_item'     => 'View Item',
        'search_item'   => 'Search Portfolio',
        'not_found'     => 'No Item Found',
        'not_found_in_trash' => 'No Item Found In Trash',
        'parent_item_colon'  => 'Parent Item'
    );
    $args = array(
        'labels'    => $labels,
        'public'    => true,
        'query_var' => true,
        'rewrite'   => true,
        'has_archive'   => true,
        'hieararchical' => false,
        'menu_position' => 5,
        'capability_type'       => 'post',
        'publicly_queryable'    => true,
        'exclude_form_search'   => false,
        // 'taxonomies' => array( 'category', 'post_tag', ),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
    );
    register_post_type('portfolio', $args);
}
add_action('init', 'awesome_custom_post_type');

function awesome_custom_taxonomies()
{
    // add new taxonomy hieararchical
    $labels = array(
        'name'          => 'Fields',
        'singular_name' => 'Field',
        'search_items'  => 'Search Fields',
        'all_items'     => 'All Fields',
        'edit_item'     => 'Edit Field',
        'update_item'   => 'Update Field',
        'add_new_item'  => 'Add New Field',
        'new_item_name' => 'New Field Name',
        'menu_name'     => 'Fields',
        'parent_item'   => 'Parent Field',
        'parent_item_colon' => 'Parent Field:',
    );

    $args = array(
        'hierarchical'  => true,
        'labels'        => $labels,
        'show_ui'       => true,
        'query_var'     => true,
        'rewrite'       => array( 'slug' => 'field' ),
        'show_admin_column' => true,
    );

    register_taxonomy('field', array('portfolio'), $args);

    // add new taxonomy NOT hierarchical

    register_taxonomy('software', 'portfolio', array(
        'label'         => 'Software',
        'rewrite'       => array( 'slug' => 'software' ),
        'hierarchical'  => false,
    ) );
}

add_action( 'init', 'awesome_custom_taxonomies' );

/*
    ==========================================
    Custom Term Function
    ==========================================
*/
function awesome_post_terms($postID, $term)
{
    $terms_list = wp_get_post_terms($postID, $term);
    $output     = '';

    $i = 0;
    foreach ($terms_list as $term) { $i++;
        if ($i > 1) { $output .= ', '; }
        $output .= '<a href="' . get_term_link( $term ) . '">' .$term->name. '</a>';
    }

    return $output;
}
