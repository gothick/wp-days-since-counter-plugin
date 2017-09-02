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

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Days_Since_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/days-since-counter-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/days-since-counter-admin.js', array( 'jquery' ), $this->version, false );

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

     add_meta_box('days-since-counter-count-meta-box', __('Day Counter', 'days-since-counter'), array($this, 'counter_meta_box'), 'post', 'side', 'high', null);
	}

  /**
	 * Show our meta box
	 *
	 * @since    1.0.0
	 */
	public function counter_meta_box($post) {
  	$this_post_date = new DateTime($post->post_date);
  	$this_post_date->setTime(0, 0, 0);
    //   	echo $this_post_date->format(DateTime::RFC2822);
  	// Hardcode for now
  	$first_post_date = new DateTime('2016-10-22');
    $interval = $this_post_date->diff($first_post_date, true);
    printf( esc_html__( 'Days from start date: %d.', 'days-since-counter' ), $interval->days + 1);
	}
  /**
	 * Add submenu under Settings
	 *
	 * @since    1.0.0
	 */
	public function add_settings_menu() {
  	add_options_page( 
  	  __('Days Since Counter Options', 'days-since-counter'),   // page title
  	  __('Days Since Counter', 'days-since-counter'),  // menu title
  	  'manage_options',             // capability
  	  'days-since-counter-options', // menu slug
  	  array($this, 'options_page')  // callback
    );
	}
	
	/**
   * Output our settings admin page
   *
   * @since 1.0.0
   */
	public function options_page() {
    require_once plugin_dir_path( __FILE__ ). 'partials/days-since-counter-admin-display.php';
	}


	/**
   * All our admin settings
   *
   * @since 1.0.0
   */
	public function register_settings() {
    register_setting( 'days-since-main-option-group', 'days_since_plugin_start_date' );
    add_settings_section(
      'days-since-main-option-section', 
      '', 
      array($this, 'render_main_option_group'), 
      'days-since-counter-options' // page
    );
    
    add_settings_field( 
      'days_since_plugin_start_date',  // id
      __('Start Date', 'days-since-counter'), // title
      array($this, 'render_start_date_option'),  // callback
      'days-since-counter-options', // page
      'days-since-main-option-section'
    );
	}	

  public function render_main_option_group() {
    // TODO 
  }
  
  public function render_start_date_option() {
    require_once plugin_dir_path( __FILE__ ). 'partials/start-date.php';
  }
	
}
