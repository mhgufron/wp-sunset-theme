<?php
/**
 * Widget Class
 *
 * @package sunset
 * @since 1.0
 * @version 1.0
 */

/*
    ========================================================
        Sunset Profile Widget
    ========================================================
*/

class Sunset_Profile_Widget extends WP_Widget
{
    // Setup the widget name, description, etc...
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'sunset-profile-widget',
            'description'   => 'Custom Sunset Profile Widget',
        );
        parent::__construct( 'sunset_profile', 'Sunset Profile', $widget_ops );
    }

    // Back-end display of widget
    public function form( $instance )
    {
        echo '<p><strong>No options for this Widget!</strong><br/>You can control the fields of widget from <a href="./admin.php?page=mhgufron_sunset">This Page</a></p>';
    }

    // Front-end display of widget
    public function widget( $args, $instance )
    {
        $picture = esc_attr( get_option('profile_picture') );
        $firstName = esc_attr( get_option('first_name') );
        $lastName = esc_attr( get_option('last_name') );
        $fullName = $firstName . ' ' . $lastName;
        $desrciption = esc_attr( get_option('user_desciption') );
        $twitter = esc_attr( get_option('twitter_handler') );
        $facebook = esc_attr( get_option('facebook_handler') );
        $github = esc_attr( get_option('github_handler') );

        echo $args['before_widget'];
        ?>

        <div class="text-center">
            <div class="image-container">
                <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);">
                </div>
            </div>
            <h1 id="full_name_preview" class="sunset-username"><?php echo $fullName ?></h1>
            <h2 id="description_preview" class="sunset-description"><?php echo $desrciption ?></h2>
            <div class="icon-wrapper">
                <?php if ( ! empty( $twitter ) ): ?>
                    <a id="twitter_preview" href="https://twitter.com/<?php print $twitter; ?>" target="_blark"><i class="fa fa-twitter"></i></a>
                <?php endif; ?>
                <?php if ( ! empty( $facebook ) ): ?>
                    <a id="facebook_preview" href="https://www.facebook.com/<?php print $facebook; ?>" target="_blark"><i class="fa fa-facebook"></i></a>
                <?php endif; ?>
                <?php if ( ! empty( $github ) ): ?>
                    <a id="github_preview" href="https://github.com/<?php print $github; ?>" target="_blark"><i class="fa fa-github"></i></a>
                <?php endif; ?>
            </div>
        </div>

        <?php
        echo $args['after_widget'];
    }

}

add_action( 'widgets_init', function() {
    register_widget( 'Sunset_Profile_Widget' );
} );

/*
    ========================================================
        Edit Default Wordpress widgets
    ========================================================
*/
function sunset_tag_cloud_font_change( $args )
{
    $args['smallest'] = 8;
    $args['largest'] = 8;

    return $args;
}
add_filter( 'widget_tag_cloud_args', 'sunset_tag_cloud_font_change' );


function sunset_list_categories_output_change( $links ) {

    $links = str_replace('</a> (', '</a> <span>', $links);
    $links = str_replace(')', '</span>', $links);

    return $links;

}
add_filter( 'wp_list_categories', 'sunset_list_categories_output_change' );

/*
    ========================================================
        Save Post View
    ========================================================
*/
function sunset_save_post_views( $postID ) {

    $metaKey   = 'sunset_post_views';
    $views     = get_post_meta( $postID, $metaKey, true );

    $count     = ( empty( $views ) ? 0 : $views );
    $count++;

    update_post_meta( $postID, $metaKey, $count );

    return $views;

}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/*
    ========================================================
        Popular Post Widget
    ========================================================
*/
class Sunset_Popular_Post_Widget extends WP_Widget
{
    // Setup the widget name, description, etc...
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'sunset-popular-posts-widget',
            'description'   => 'Popular Posts Widget',
        );
        parent::__construct( 'sunset_popular_posts', 'Sunset Popular Post', $widget_ops );
    }

    // Back-end display of widget
    public function form( $instance )
    {
        $title  = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Popular Posts' );
        $tot    = ( !empty( $instance[ 'tot' ] ) ? absint( $instance[ 'tot' ] ) : 4 );

        $output = '<p>';
        $output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
        $output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '"';
        $output .= '</p>';

        $output .= '<p>';
        $output .= '<label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Post:</label>';
        $output .= '<input type="number" class="widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tot' ) ) . '" value="' . esc_attr( $tot ) . '"';
        $output .= '</p>';

        echo $output;
    }

    // Update Widget
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
        $instance[ 'tot' ] = ( !empty( $new_instance[ 'tot' ] ) ? absint( strip_tags( $new_instance[ 'tot' ] ) ) : 0 );

        return $instance;

    }

    // Front-end display of widget
    public function widget( $args, $instance )
    {
        $tot = absint( $instance[ 'tot' ] );

        $posts_args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $tot,
            'meta_key'          => 'sunset_post_views',
            'orderby'           => 'meta_value_num',
            'order'             => 'DESC'
        );

        $posts_query = new WP_Query( $posts_args );

        echo $args[ 'before_widget' ];

        if ( !empty( $instance[ 'title' ] ) ) :

            echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];

        endif;

        if( $posts_query->have_posts() ):

            // echo '<ul>';

                while( $posts_query->have_posts() ): $posts_query->the_post();

                    $post_format = ( empty( get_post_format() ) ? 'standard' : get_post_format() );
                    echo '<div class="media" >';
                    echo '<div class="media-left"><img class="media-object" src="' . get_template_directory_uri() . '/assets/img/post-' . esc_attr( $post_format, 'sunsettheme' ) . '.png" alt="' . get_the_title() . '" /></div>';
                    echo '<div class="media-body">';
                    echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
                    echo '<div class="row"><div class="col-xs-12">'. sunset_get_post_comment() .'</div></div>';
                    echo '</div>';
                    echo '</div>';

                endwhile;

            // echo '</ul>';

        endif;

        wp_reset_postdata();
        echo $args[ 'after_widget' ];

    }
}
add_action( 'widgets_init', function() {
    register_widget( 'Sunset_Popular_Post_Widget' );
} );






















/* My Subcomment */
