<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       jhuril45@gmail.com
 * @since      1.0.0
 *
 * @package    Add_Post
 * @subpackage Add_Post/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Add_Post
 * @subpackage Add_Post/admin
 * @author     Jhuril Bandola <jhuril45@gmail.com>
 */
class Add_Post_Admin {

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
    add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);
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
		 * defined in Add_Post_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Add_Post_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-post-admin.css', array(), $this->version, 'all' );

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
		 * defined in Add_Post_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Add_Post_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/add-post-admin.js', array( 'jquery' ), $this->version, false );

	}

  public function addPluginAdminMenu() {
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page($this->plugin_name, 'Add Post', 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'dashicons-insert', 26 );
    
    // $this->my_save_custom_form();
    //add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
  }

  public function displayPluginAdminDashboard() {
    wp_register_style('quasar-css', plugin_dir_url( __FILE__ ) . 'css/quasar.min.css', false,'1.1','all');
    wp_enqueue_style( 'quasar-css');

    wp_register_style('animate', plugin_dir_url( __FILE__ ) . 'css/animate.min.css', false,'1.1','all');
    wp_enqueue_style( 'animate');

    wp_register_style('material_icons', plugin_dir_url( __FILE__ ) . 'css/materials_icons.css', false,'1.1','all');
    wp_enqueue_style( 'material_icons');

    wp_register_style('fontawesome5', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', false,'1.1','all');
    wp_enqueue_style( 'fontawesome5');

    wp_register_script('vue-script', plugin_dir_url( __FILE__ ) . 'js/vue.min.js',array ( 'jquery' ), 1.1, true);
    wp_register_script('quasar-script', plugin_dir_url( __FILE__ ) . 'js/quasar.min.js',array ( 'jquery' ), 1.1, true);
    wp_register_script('axios', plugin_dir_url( __FILE__ ) . 'js/axios.min.js',array ( 'jquery' ), 1.1, true);
    wp_register_script('vue-main', plugin_dir_url( __FILE__ ) . 'js/main.js',array ( 'jquery' ), 1.1, true);

    wp_enqueue_script( 'vue-script');
    wp_enqueue_script( 'quasar-script');
    wp_enqueue_script( 'axios');
    wp_enqueue_script( 'vue-main');

    wp_localize_script('vue-main', 'Rest', [
      'nonce' => wp_create_nonce('wp_rest'),
    ]);
		require_once 'partials/'.$this->plugin_name.'-admin-display.php';
  }

}
