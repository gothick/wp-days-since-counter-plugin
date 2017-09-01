<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/gothick/wp-days-since-plugin
 * @since      1.0.0
 *
 * @package    Days_Since_Counter
 * @subpackage Days_Since_Counter/admin/partials
 */
?>

<?php
if (!current_user_can('manage_options')) {
	wp_die(__('You do not have sufficient permissions to access this page.'));
}
?>

<div class="wrap">
  <h1><?php _e('Days Since Counter Options', 'days-since-counter') ?></h1>
  <form method="post" action="options.php">
    <?php settings_fields('days-since-main-option-group'); ?>
    <?php do_settings_sections('days-since-main-option-group'); ?>
    <table class="form-table">
      <tr valign="top">
        <th scope="row"><?php _e('Start Date', 'days-since-counter'); ?></th>
        <td><input type="text" name="days_since_plugin_start_date" value="<?php echo esc_attr( get_option('days_since_plugin_start_date') ); ?>" /></td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
