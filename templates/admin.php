<div class="wrap">
    <h1>DeLvoy plugin</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php  
            settings_fields('delvoy_options_group');
            do_settings_sections('delvoy_plugin');
            submit_button();
        ?> 
    </form>
</div>