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
  <p>Here is where a form would go if I actually had options</p>
</div>
