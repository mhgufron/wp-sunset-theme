<?php
/**
 * Widget Class
 *
 * @package sunset
 * @since 1.0
 * @version 1.0
 */

/**
 * Sunset Profile Widget
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
