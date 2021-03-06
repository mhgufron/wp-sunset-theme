<h1>Sunset Sidebar Option</h1>
<?php settings_errors(); ?>
<?php

$picture = esc_attr( get_option('profile_picture') );
$firstName = esc_attr( get_option('first_name') );
$lastName = esc_attr( get_option('last_name') );
$fullName = $firstName . ' ' . $lastName;
$desrciption = esc_attr( get_option('user_desciption') );
$twitter = esc_attr( get_option('twitter_handler') );
$facebook = esc_attr( get_option('facebook_handler') );
$github = esc_attr( get_option('github_handler') );
 ?>
 
<div class="sunset-sidebar-preview">
    <div class="sunset-sidebar">
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
</div>

<form action="options.php" method="post" class="sunset-general-form">
    <?php settings_fields( 'sunset-settings-group' ); ?>
    <?php do_settings_sections( 'mhgufron_sunset' ); ?>
    <?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>
