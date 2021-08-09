<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/abdullah-sajjad/tarot-spinner/
 * @since      1.0.0
 *
 * @package    Tarot_Spinner
 * @subpackage Tarot_Spinner/admin/partials
 */
?>
<h1><span class="dashicons dashicons-controls-pause"></span>Tarot Spinner</h1>
<div style="display: none;" class="tarot-notice notice notice-success is-dismissible"><p>Saved!</p></div>
<span class="ff-description">Add Image URL's <strong>( Press ENTER or , to add a new URL )</strong></span>
<div class="ff-wrap">
    <div class="ff-form-container">
        <form class="ff-form ff-form" method="POST">
            <div class="field-control">
                <input type="text" placeholder="Add word" name="ff_tags_area" class="ff_tags_area" required/>
                <button  name="ff-button" id="ff-button" class="button">Save</button>
            </div>
        </form>
    </div>
</div>
<?php
echo '<form method="post" action="options.php">';
settings_fields( 'tarot_settings' );
do_settings_sections( 'tarot-spinner' );
submit_button();
echo '</form>';