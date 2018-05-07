<?php
/**
 * Wordpress Theme Support
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

/*
    ========================================================
        Theme Support
    ========================================================
*/

$options = get_option( 'post_formats' );
$formats = array( 'aside', 'galery', 'link', 'images', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach ($formats as $format) {
    $output[] = ( @$options[$format] == 1 ) ? $format : '';
}
if ( !empty( $options ) ) {
    add_theme_support( 'post-formats', $output );
}

$header = get_option( 'custom_header' );
if ( @$header == 1 ) {
    add_theme_support( 'custom-header' );
}

$background = get_option( 'custom_background' );
if ( @$background == 1 ) {
    add_theme_support( 'custom-background' );
}

add_theme_support('post-thumbnails');

/* Activate Nav Menu Option */
function sunset_register_nav_menu()
{
    register_nav_menu( 'primary', 'Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/*
    ========================================================
        Blog Loop custom Function
    ========================================================
*/

function sunset_posted_meta()
{
    $posted_on  = human_time_diff( get_the_time('U'), current_time( 'timestamp' ) );
    $categories = get_the_category();
    $separator  = ', ';
    $output     = '';
    $i = 1;

    if ( !empty( $categories ) ) :
        foreach ($categories as $category) :

            if ( $i > 1 ): $output .= $separator; endif;

            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( 'View all posts in%s', $category->name ) . '">' . esc_html( $category->name ) . '</a>';
            $i++;
        endforeach;
    endif;

    return '<span class="posted-on">Posted <a href="' . esc_url( get_permalink() ) . '">' . $posted_on . '</a> ago</span> / <span class="posted-in">' . $output . '</span>';
}

function sunset_posted_footer()
{
    $comments_num = get_comments_number();
    if ( comments_open() ) {
        if ( $comments_num == 0 ) {
            $comments = __( 'No Comments' );
        } elseif ( $comments_num > 1 ) {
            $comments = $comments_num . __( ' Comments' );
        } else {
            $comments = __( '1 Comment' );
        }

        $comments = '<a class="sunset-icon comments-link" href="' . get_comments_link() . '">' . $comments . ' <i class="sunset-icon icon-comment"></i></a>';

    } else {
        $comments = __( 'Comments are Closed' );
    }

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">' . get_the_tag_list('<div class="tags-list"><i class="sunset-icon icon-tag"></i> ', ' ', '</div>' ) . '</div><div class="col-xs-12 col-sm-6 text-right">' . $comments . '</div></div></div>';
}












/* test */
