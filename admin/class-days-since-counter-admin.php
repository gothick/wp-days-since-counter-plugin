<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/gothick/wp-days-since-counter-plugin
 * @since      1.0.0
 *
 * @package    Days_Since_Counter
 * @subpackage Days_Since_Counter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Days_Since_Counter
 * @subpackage Days_Since_Counter/admin
 * @author     Matt Gibson <gothick@gothick.org.uk>
 */
class Days_Since_Counter_Admin {
  const START_DATE_OPTION_NAME = 'days_since_plugin_start_date';

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

  private $admin_page_hook_suffix;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
  	// Our main admin stylesheet imports any others necessary, including the jQuery UI date picker CSS.
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/days-since-counter-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/days-since-counter-admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), $this->version, false );
	}
	

  /**
	 * All the hooks we want for the New/Edit Post screen
	 *
	 * @since    1.0.0
	 */
	public function define_post_editing_hooks() {
    add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') ); 
	}

	
  /**
	 * Hook up our meta box
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Days_Since_Counter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Days_Since_Counter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
     add_meta_box('days-since-counter-count-meta-box', __('Days Since Counter', 'days-since-counter'), array($this, 'render_counter_meta_box'), array('post', 'foo'), 'side', 'high', null);
	}

  /**
	 * Show our meta box
	 *
	 * @since    1.0.0
	 */
	public function render_counter_meta_box($post) {
  	$params = array(
    	'post' => $post,
    	'start_date' => get_option(self::START_DATE_OPTION_NAME, null)
  	);
    require_once plugin_dir_path( __FILE__ ). 'partials/meta-box.php';
	}
  /**
	 * Add submenu under Settings
	 *
	 * @since    1.0.0
	 */
	public function add_settings_menu() {
  	$this->admin_page_hook_suffix = add_options_page( 
  	  __('Days Since Counter Options', 'days-since-counter'),   // page title
  	  __('Days Since Counter', 'days-since-counter'),  // menu title
  	  'manage_options',             // capability
  	  'days-since-counter-options', // menu slug
  	  array($this, 'render_options_page')  // callback
    );
	}
	
	/**
   * Output our settings admin page
   *
   * @since 1.0.0
   */
	public function render_options_page() {
    require_once plugin_dir_path( __FILE__ ). 'partials/days-since-counter-admin-display.php';
	}


	/**
   * All our admin settings
   *
   * @since 1.0.0
   */
	public function register_settings() {
    register_setting( 
      'days-since-main-option-group', 
      self::START_DATE_OPTION_NAME,
      array($this, 'sanitise_start_date')
    );

    add_settings_section(
      'days-since-main-option-section', 
      __('Date Settings', 'days-since-counter'), 
      null, // No callback. Our options are rendered automatically through add_settings_field
      'days-since-counter-options' // page
    );
    
    add_settings_field( 
      self::START_DATE_OPTION_NAME,  // id
      __('Start Date', 'days-since-counter'), // title
      array($this, 'render_start_date_option'),  // callback
      'days-since-counter-options', // page
      'days-since-main-option-section'
    );
	}	

  public function sanitise_start_date($input) {
    $output = null;

    if (!is_a($input, 'DateTime')) {
      try {
        $output = new DateTime($input);
      }
      catch(\Exception $e) {
        // We'll just return null. That's fine.
        add_settings_error(self::START_DATE_OPTION_NAME, self::START_DATE_OPTION_NAME, __('Invalid date specified.', 'days-since-counter'), 'error');
      }
    } else {
      // It's already a DateTime. Can't go too far wrong there.
      $output = $input;
    }
    return $output;
  }

  public function render_start_date_option() {
    $start_date = get_option(self::START_DATE_OPTION_NAME, null);
    $params = array();
    if ($start_date != NULL && is_a($start_date, 'DateTime')) {
      $params['start_date'] = $start_date->format(get_option('date_format'));
    } else {
      $params['start_date'] = '';
    }
    require_once plugin_dir_path( __FILE__ ). 'partials/start-date.php';
  }
	
}
