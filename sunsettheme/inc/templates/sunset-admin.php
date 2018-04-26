<h1>Sunset Theme Option</h1>

<?php settings_errors(); ?>

<form action="options.php" method="post">
    <?php settings_fields( 'sunset-settings-group' ); ?>
    <?php do_settings_sections( 'mhgufron_sunset' ); ?>
    <?php submit_button(); ?>
</form>
