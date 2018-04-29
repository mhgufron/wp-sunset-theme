<h1>Sunset Theme Option</h1>
<?php settings_errors(); ?>
<?php

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
        <h1 class="sunset-username"><?php echo $fullName ?></h1>
        <h2 class="sunset-description"><?php echo $desrciption ?></h2>
        <div class="icon-wrapper"></div>
    </div>
</div>

<form action="options.php" method="post" class="sunset-general-form">
    <?php settings_fields( 'sunset-settings-group' ); ?>
    <?php do_settings_sections( 'mhgufron_sunset' ); ?>
    <?php submit_button(); ?>
</form>
