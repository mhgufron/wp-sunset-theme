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
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
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
    register_nav_menu( 'footer', 'Footer Navigation Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/* Activate html5 features */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/*
    ========================================================
        Sidebar Function
    ========================================================
*/
function sunset_sidebar_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sunset Sidebar', 'sunsettheme' ),
            'id'            => 'sunset-sidebar',
            'description'   => 'Dynamic Right Sidebar',
            'before_widget' => '<section id="%1$s" class="sunset-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="sunset-widget-title">',
            'after_title'   => '</h2>'
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sunset Sidebar Template Right', 'sunsettheme' ),
            'id'            => 'sunset-sidebar-template',
            'description'   => 'Dynamic Right Sidebar Page Template',
            'before_widget' => '<section id="%1$s" class="sunset-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="sunset-widget-title">',
            'after_title'   => '</h2>'
        )
    );
}
add_action( 'widgets_init', 'sunset_sidebar_init' );


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

function sunset_get_post_comment()
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
    return $comments;
}

function sunset_posted_footer()
{
    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">' . get_the_tag_list('<div class="tags-list"><i class="sunset-icon icon-tag"></i> ', ' ', '</div>' ) . '</div><div class="col-xs-12 col-sm-6 text-right">' . sunset_get_post_comment() . '</div></div></div>';
}

function sunset_get_attachment( $num = 1 )
{
    $output = '';
    if ( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) && $num == 1 ) {
        $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    } else {
        $attachments = get_posts( array(
            'post_type'         => 'attachment',
            'posts_per_pages'   => $num,
            'post_parent'       => get_the_ID()
        ) );
        if ( $attachments && $num == 1 ) {
            foreach ( $attachments as $attachment ) {
                $output = wp_get_attachment_url( $attachment->ID );
            }
        } elseif ( $attachments && $num > 1 ) {
            $output = $attachments;
        }

        // wp_reset_post_data();
    }

    return $output;
    echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

}

function sunset_get_embedded_media( $type = array() )
{
    $content    = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed      = get_media_embedded_in_content( $content, $type );

    $output = str_replace( '?visual=true', '?visual=false', $embed[0]);
    // if (in_array( 'audio', $type )) {
    // } else {
    //     $output = $embed[0];
    // }

    return $output;
}

function sunset_get_bs_slides( $attachments )
{
    $output     = array();
    $count      = count($attachments)-1;

    for ( $i = 0; $i <= $count; $i++ ) :

        $active     = ($i == 0 ? ' active' : '');
        $n          = ( $i == $count ? 0 : $i+1 );
        $nextImg    = wp_get_attachment_thumb_url( $attachments[$n]->ID );
        $p          = ( $i == 0 ? $count : $i-1 );
        $prevImg    = wp_get_attachment_thumb_url( $attachments[$p]->ID );

        $output[]   = array(
            'class'     => $active,
            'url'       => wp_get_attachment_url( $attachments[$i]->ID ),
            'next_img'  => $nextImg,
            'prev_img'  => $prevImg,
            'caption'   => $attachments[$i]->post_excerpt
        );
    endfor;

    return $output;
}

function sunset_grab_url()
{
    if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links) ) {
        return false;
    }
    return esc_url_raw( $links[1] );
}

function sunset_grab_current_uri()
{
    $http = ( isset( $_SERVER[ 'HTTP_HTTPS' ] ) ? 'https://' : 'http://' );
    $referer = $http . $_SERVER[ 'HTTP_HOST' ];
    $archive_url =  $referer . $_SERVER[ 'REQUEST_URI' ];

    return  $archive_url;

}

/*
    ========================================================
        Single Post Custom Function
    ========================================================
*/

function sunset_post_navigation()
{
    $nav    = '<div class="row">';

    $prev   = get_previous_post_link( '<div class="post-link-nav"><span class="sunset-icon icon-chevron-left" aria-hidden="true"></span> %link</div>', '%title' );
    $nav    .= '<div class="col-xs-12 col-sm-6">' . $prev . '</div>';

    $next   = get_next_post_link( '<div class="post-link-nav">%link <span class="sunset-icon icon-chevron-right" aria-hidden="true"></span></div>', '%title' );
    $nav    .= '<div class="col-xs-12 col-sm-6 text-right">' . $next . '</div>';

    $nav    .= '</div>';

    return $nav;
}

function sunset_share_this( $content )
{
    if ( is_single() ) {
        $content    .= '<div class="sunset-shareThis"> <h4>Share This</h4>';

        $title      = get_the_title();
        $permalink  = get_permalink();

        $twitterHandler = ( get_option( 'twitter_handler' ) ? '&amp;via=' . esc_attr( get_option( 'twitter_handler' ) ) : '' );

        $twitter    = 'https://twitter.com/intent/tweet?text=Hey! Read this: ' . $title . '&amp;url=' . $permalink . $twitterHandler;
        $facebook   = 'https://www.facebook.com/sharer.php?u=' . $permalink;
        $google     = 'https://plus.google.com/share?url=' . $permalink . '&text=' . $title;



        $content    .= '<ul>';
        $content    .= '<li><a href="' . $twitter . '" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>';
        $content    .= '<li><a href="' . $facebook . '" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>';
        $content    .= '<li><a href="' . $google . '" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a></li>';
        $content    .= '</ul></div><!-- .sunset-share -->';

    }

    return $content;

}

add_filter( 'the_content', 'sunset_share_this' );

function sunset_get_post_navigation()
{
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):

        require( get_template_directory() . '/inc/templates/sunset-comment-nav.php' );

    endif;
}



function sunset_subheader() {
    add_meta_box( 'sunset-meta-subheader', __( 'Sub Header' ), 'sunset_meta_subheader', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'sunset_subheader' );

function sunset_meta_subheader() {
	wp_nonce_field( basename( __FILE__ ), 'sunset_subheader_meta_box_nonce' );
	$value = get_post_meta(get_the_ID(), 'sunset-subheader', true);
	$html = '<textarea rows="4" style="width:100%;" type="text" id="sunset-subheader" name="sunset-subheader">'.$value.'</textarea>';
	echo $html;
}

add_action( 'save_post', 'sunset_subheader_meta_box_save' );
function sunset_subheader_meta_box_save( $post_id ){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( !isset( $_POST['sunset_subheader_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['sunset_subheader_meta_box_nonce'], basename( __FILE__ ) ) ) return;
   	if( !current_user_can( 'edit_post' ) ) return;
    if( isset( $_POST['sunset-subheader'] ) )
        update_post_meta( $post_id, 'sunset-subheader', esc_attr( $_POST['sunset-subheader'], $allowed ) );
}

/**
 * Modify the page part of the document title for the search page
 */
add_filter( 'document_title_parts', function( $title ) use( &$page, &$paged )
{
    if ( is_search() && ( $paged >= 2 || $page >= 2 ) && ! is_404() )
        $title['page'] = sprintf(
            esc_html__( 'This is %s page', 'my-theme-domain' ),
            max( $paged, $page )
        );

    return $title;
} );










/* test */
