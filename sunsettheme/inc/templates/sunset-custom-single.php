<h1>Sunset Custom Single Page</h1>
<?php settings_errors(); ?>

<form action="options.php" method="post" class="sunset-general-form">
    <?php settings_fields( 'sunset-custom-single-options' ); ?>
    <?php do_settings_sections( 'mhgufron_sunset_single' ); ?>
    <?php submit_button(); ?>
</form>
