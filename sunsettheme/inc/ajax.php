<?php
/**
 * Ajax function
 *
 * @package sunsettheme
 * @since 1.0
 * @version 1.0
 */

add_action( 'wp_ajax_nopriv_sunset_load_more', 'sunset_load_more' );
add_action( 'wp_ajax_sunset_load_more', 'sunset_load_more' );

add_action( 'wp_ajax_nopriv_sunset_save_user_contact_form', 'sunset_save_contact' );
add_action( 'wp_ajax_sunset_save_user_contact_form', 'sunset_save_contact' );

function sunset_load_more()
{

    $paged      = $_POST['page'] + 1;
    $prev       = $_POST['prev'];
    $archive    = $_POST['archive'];
    $searchd    = $_POST['tester'];

    if ( $prev == 1 && $_POST['page'] != 1 ) {
        $paged = $_POST['page'] - 1;
    }

    $args   = array(
        'past_type'     => 'post',
        'post_status'   => 'publish',
        'paged'         => $paged
    );


    if ( $archive != '0' ) {

        $archVal    = explode( '/', $archive );
        $fliped     = array_flip( $archVal );

        switch ( isset( $fliped ) ) {
            case $fliped['category']:
                $type   = 'category_name';
                $key    = 'category';
            break;

            case $fliped['tag']:
                $type   = 'tag';
                $key    = $type;
            break;

            case $fliped['author']:
                $type   = 'author';
                $key    = $type;
            break;
        }

        $curKey     = array_keys( $archVal, $key );
        $nextKey    = $curKey[0]+1;
        $value      = $archVal[ $nextKey ];

        $args[ $type ] = $value;

        /* Check page trail and remove "page" value */
        if ( isset( $fliped['page'] ) ) {
            $pageVal = explode( 'page', $archive );
            $page_trail = $pageVal[0];
        } else {
            $page_trail = $archive;
        }

    } else {
        $page_trail = '/';
    }

    if ( $searchd != '0' ) {
        $args['s'] = $searchd;
        $searchd = '?s=' . $searchd;
    } else {
        $searchd = '';
    }

    $query  = new WP_Query( $args );

    if ( $query->have_posts() ) :

        echo '<div class="page-limit" data-page="' . $page_trail . 'page/' . $paged . '/' . $searchd . '" >';

        while ( $query->have_posts() ): $query->the_post();

            get_template_part( 'template-parts/content', get_post_format() );

        endwhile;

        echo '</div>';

    else:

        echo 0;

    endif;

    wp_reset_postdata();

    die();

}

function sunset_check_paged( $num = null )
{
    $output = '';

    if ( is_paged() ) { $output = 'page/' . get_query_var( 'paged' ); }

    if ( $num == 1 ) {
        $paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) );
        return $paged;
    } else {
        return $output;
    }
}

function sunset_save_contact()
{
    $title      = wp_strip_all_tags( $_POST["name"] );
    $email      = wp_strip_all_tags( $_POST["email"] );
    $message    = wp_strip_all_tags( $_POST["message"] );

    $args       = array(
        'post_title'        => $title,
        'post_content'      => $message,
        'post_author'       => 1,
        'post_status'       => 'publish',
        'post_type'         => 'sunset-contact',
        'meta_input'        => array(
            '_contact_email_value_key'  => $email
        )
    );

    $postID = wp_insert_post( $args, $wp_error );

    echo $postID;

    die();
}


















#
