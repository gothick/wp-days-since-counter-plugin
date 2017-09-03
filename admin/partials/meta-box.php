<?php
  $start_date = $params['start_date'];

  if ($params['post'] != null) {
  	$target_date = new DateTime($params['post']->post_date);
  } else {
    $target_date = new DateTime();
  }
	$target_date->setTime(0, 0, 0);

  if ($start_date == null) {
    _e('Please configure the Days Since Counter plugin with a Start Date', 'days-since-counter');
  } else {
    $interval = $target_date->diff($start_date, false);
    printf( esc_html__( 'Days from start date: %d.', 'days-since-counter' ), $interval->days + 1);
  }
