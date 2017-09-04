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

<?php 
// Meta boxes aren't normally added to settings pages, so we hook in manually.
do_action('add_meta_boxes', $this->admin_page_hook_suffix);
?>

<div class="wrap">
  <h1><?php _e('Days Since Counter Options', 'days-since-counter') ?></h1>
  <form method="post" action="options.php">
    <?php settings_fields('days-since-main-option-group'); ?>
    <?php do_settings_sections('days-since-counter-options'); ?>
    <?php submit_button(); ?>
  </form>
  <h2><?php _e('Preview', 'days-since-counter'); ?></h2>
  <div class="days-since-preview-box">
    <div class="wrap metabox-holder">
      <?php do_meta_boxes('foo', 'side' , NULL); ?>
    </div>
  </div>
</div>
