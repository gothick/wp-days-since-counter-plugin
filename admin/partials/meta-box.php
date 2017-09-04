<?php
  $start_date = $params['start_date'];

  $from_post = false;

  if ($params['post'] != null) {
  	$target_date = new DateTime($params['post']->post_date);
  	$from_post = true;
  } else {
    $target_date = new DateTime();
  }
	$target_date->setTime(0, 0, 0);
?>

<?php if ($start_date == null): ?>
  <?php _e('Please configure the Days Since Counter plugin with a Start Date', 'days-since-counter'); ?>
<?php else: ?>
  <?php $interval = $target_date->diff($start_date, false); ?>
  
  <div class="days-since-counter-number-line">
    <span class="days-since-counter-number"><?php esc_html_e($interval->days + 1); ?></span>
    <?php if ($from_post): ?>
      <?php _e("days from start date to this post") ?>
    <?php else: ?>
      <?php _e("days from start date to today's date") ?>
    <?php endif; ?>
  </div>
  <div class="days-since-counter-subtext">
    <?php printf( esc_html__('Start date: %s', 'days-since-counter'),  $start_date->format(get_option('date_format'))); ?>
    <br />
    <?php if ($from_post): ?>
      <?php printf( esc_html__( 'Post date: %s', 'days-since-counter' ), $target_date->format(get_option('date_format'))); ?>
    <?php else: ?>
      <?php printf( esc_html__( "Today's date: %s", 'days-since-counter' ), $target_date->format(get_option('date_format'))); ?>
    <?php endif; ?>
  </div>
<?php endif; ?>
