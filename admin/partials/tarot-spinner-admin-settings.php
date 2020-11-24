<?php

    global $ff_active_tab;
    $ff_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general'; ?>
    <h1>
	    <span class="dashicons dashicons-lock"></span>
	    <?php echo __('Tarot Spinner', 'tarot-spinner');
	    do_action( 'ff_settings_error' );
	    ?>
    </h1>
    <form method="post" action="options.php">
    <h2 class="nav-tab-wrapper">
        <?php
        do_action( 'ff_settings_tab' );
        ?>
    </h2>
    <div class="ff-settings-content wrap">
        <?php
        do_action( 'ff_settings_content' );
        ?>
    </div>
        <?php submit_button();?>
    </form>