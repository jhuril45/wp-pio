<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cgb-carousel
 * @since      1.0.0
 *
 * @package    Cgb_Carousel
 * @subpackage Cgb_Carousel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cgb_Carousel
 * @subpackage Cgb_Carousel/admin
 * @author     Jhuril Bandola <jhuril45@gmail.com>
 */
class Cgb_Carousel_Admin {

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
    add_action('admin_init', array( $this, 'registerAndBuildFields' ));
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
		 * defined in Cgb_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cgb_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cgb-carousel-admin.css', array(), $this->version, 'all' );

    wp_register_style('quasar-css', plugin_dir_url( __FILE__ ) . 'css/quasar.min.css', false,'1.1','all');
    wp_enqueue_style( 'quasar-css');

    wp_register_style('animate', plugin_dir_url( __FILE__ ) . 'css/animate.min.css', false,'1.1','all');
    wp_enqueue_style( 'animate');

    wp_register_style('material_icons', plugin_dir_url( __FILE__ ) . 'css/materials_icons.css', false,'1.1','all');
    wp_enqueue_style( 'material_icons');

    wp_register_style('fontawesome5', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', false,'1.1','all');
    wp_enqueue_style( 'fontawesome5');
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
		 * defined in Cgb_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cgb_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cgb-carousel-admin.js', array( 'jquery' ), $this->version, true );
    
    // wp_register_script( 'vue-script', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
    wp_register_script('vue-script', plugin_dir_url( __FILE__ ) . 'js/vue.min.js',array ( 'jquery' ), 1.1, true);
    wp_register_script('quasar-script', plugin_dir_url( __FILE__ ) . 'js/quasar.min.js',array ( 'jquery' ), 1.1, true);
    wp_register_script('vue-main', plugin_dir_url( __FILE__ ) . 'js/main.js',array ( 'jquery' ), 1.1, true);

    wp_enqueue_script( 'vue-script');
    wp_enqueue_script( 'quasar-script');
    wp_enqueue_script( 'vue-main');

    // wp_enqueue_script( $this->plugin_name, 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
    // wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . '/js/quasar.min.js',array ( 'jquery' ), 1.1, true);
    // wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . '/js/main.js',array ( 'jquery' ), 1.1, true);

  }

  public function addPluginAdminMenu() {
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page(  $this->plugin_name, 'CGB Carousel', 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'dashicons-chart-area', 26 );
    
    //add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    // add_submenu_page( $this->plugin_name, 'CGB Carousel Settings', 'Settings', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayPluginAdminSettings' ));
  }

  public function displayPluginAdminDashboard() {
		require_once 'partials/'.$this->plugin_name.'-admin-display.php';
  }

  public function displayPluginAdminSettings() {
    // set this var to be used in the settings-display view
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
    if(isset($_GET['error_message'])){
        add_action('admin_notices', array($this,'pluginNameSettingsMessages'));
        do_action( 'admin_notices', $_GET['error_message'] );
    }
    require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
  }

  public function pluginNameSettingsMessages($error_message){
    switch ($error_message) {
        case '1':
            $message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );                 
            $err_code = esc_attr( 'plugin_name_example_setting' );                 
            $setting_field = 'plugin_name_example_setting';                 
            break;
    }
    $type = 'error';
    add_settings_error(
      $setting_field,
      $err_code,
      $message,
      $type
    );
  }

  public function registerAndBuildFields() {
      /**
     * First, we add_settings_section. This is necessary since all future settings must belong to one.
     * Second, add_settings_field
     * Third, register_setting
     */     
    add_settings_section(
      // ID used to identify this section and with which to register options
      'plugin_name_general_section', 
      // Title to be displayed on the administration page
      '',
      // Callback used to render the description of the section
      array( $this, 'plugin_name_display_general_account' ),    
      // Page on which to add this section of options
      'plugin_name_general_settings'                   
    );
    unset($args);
    $args = array (
      'type'      => 'input',
      'subtype'   => 'text',
      'id'    => 'plugin_name_example_setting',
      'name'      => 'plugin_name_example_setting',
      'required' => 'true',
      'get_options_list' => '',
      'value_type'=>'normal',
      'wp_data' => 'option'
    );
    add_settings_field(
      'plugin_name_example_setting',
      'Example Setting',
      array( $this, 'plugin_name_render_settings_field' ),
      'plugin_name_general_settings',
      'plugin_name_general_section',
      $args
    );
    


    register_setting(
      'plugin_name_general_settings',
      'plugin_name_example_setting'
    );

  }

  public function plugin_name_display_general_account() {
	  echo '<p>These settings apply to all Plugin Name functionality.</p>';
	}

  public function plugin_name_render_settings_field($args) {
    /* EXAMPLE INPUT
              'type'      => 'input',
              'subtype'   => '',
              'id'    => $this->plugin_name.'_example_setting',
              'name'      => $this->plugin_name.'_example_setting',
              'required' => 'required="required"',
              'get_option_list' => "",
                'value_type' = serialized OR normal,
    'wp_data'=>(option or post_meta),
    'post_id' =>
    */     
    if($args['wp_data'] == 'option'){
      $wp_data_value = get_option($args['name']);
    } elseif($args['wp_data'] == 'post_meta'){
      $wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
    }

    switch ($args['type']) {

      case 'input':
          $value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
          if($args['subtype'] != 'checkbox'){
              $prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
              $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
              $step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
              $min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
              $max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
              if(isset($args['disabled'])){
                  // hide the actual input bc if it was just a disabled input the informaiton saved in the database would be wrong - bc it would pass empty values and wipe the actual information
                  echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
              } else {
                  echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
              }
              /*<input required="required" '.$disabled.' type="number" step="any" id="'.$this->plugin_name.'_cost2" name="'.$this->plugin_name.'_cost2" value="' . esc_attr( $cost ) . '" size="25" /><input type="hidden" id="'.$this->plugin_name.'_cost" step="any" name="'.$this->plugin_name.'_cost" value="' . esc_attr( $cost ) . '" />*/

          } else {
              $checked = ($value) ? 'checked' : '';
              echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
          }
          break;
      default:
          # code...
          break;
    }
  }


}