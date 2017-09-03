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

  if ($start_date == null) {
    _e('Please configure the Days Since Counter plugin with a Start Date', 'days-since-counter');
  } else {
    $interval = $target_date->diff($start_date, false);
    if ($from_post) {
      printf( esc_html__( 'Days from start date to this post: %d.', 'days-since-counter' ), $interval->days + 1);      
    } else {
      printf( esc_html__( "Days from start date to today's date: %d.", 'days-since-counter' ), $interval->days + 1);            
    }
    
    // For debugging, or perhaps just clarity
    echo '<br /><small>';
    printf( esc_html__('Start date: %s', 'days-since-counter'),  $start_date->format(get_option('date_format')));
    echo '</small>';

    echo '<br /><small>';
    if ($from_post) {
      printf( esc_html__( 'Post date: %s', 'days-since-counter' ), $target_date->format(get_option('date_format')));      
    } else {
      printf( esc_html__( "Today's date: %s", 'days-since-counter' ), $target_date->format(get_option('date_format')));
    }
    echo '</small>';

    
  }

