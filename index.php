<?php
/*
    Plugin Name: Marketing Track Leads
    Plugin URI: https://itdirections.com
    Description: Custom Track Leads Form
    Version: 1.0
    Author: itdirections 
    Author URI: https://itdirections.com
*/

class MarketingCustomTemplate {

	private $source;
	private $dest;

	public function __construct() {
		$theme = wp_get_theme();
		$this->source = dirname(__FILE__) . '/templates/blank-page.php';
		$this->dest = $theme->get_template_directory() . '/blank-page.php';

		add_action( 'init', array( $this, 'marketing_custom_sidebar_init') );

		register_deactivation_hook( __FILE__, array( $this, 'marketing_custom_sidebar_deactivate' ) );
	}

	// Init plugin
	public function marketing_custom_sidebar_init() {
		if( !file_exists( $this->dest ) ) {
			copy( $this->source, $this->dest );
		}
	}

	//Deactivate plugin
	public function marketing_custom_sidebar_deactivate(){
		if( file_exists( $this->dest ) ) {
			unlink($this->dest);
      $page_id = get_option( 'template_page_id' );
      wp_delete_post($page_id);
      update_option( 'ct_license_code', 0 );
      delete_option('template_page_id');
		}
	}

}

//Initialize plugin
new MarketingCustomTemplate();

add_action( 'admin_menu', 'marketing_register' );

function marketing_register() {
  add_menu_page(
    'Track Leads',     // page title
    'Track Leads',     // menu title
    'manage_options',   // capability
    'track-leads',     // menu slug
    'marketing_render', // callback function
    'dashicons-networking',
  );
}

function marketing_render() {
  global $title;

  print '<div class="wrap">';
  print "<h1>$title</h1>";

  $file = plugin_dir_path( __FILE__ ) . "included.php";

  if ( file_exists( $file ) )
      require $file;

  print '</div>';
}

function load_style_script() {
  wp_enqueue_script( 'ajax-script', plugins_url( 'assets/ajax-script.js', __FILE__ ), '1.4', true );
  wp_enqueue_style('custom-style', plugins_url('assets/style.css', __FILE__ ) ,array());
  wp_localize_script( 'ajax-save-page', 'savePage', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action("admin_init", "load_style_script");


require plugin_dir_path( __FILE__ ) . "inc/active-license.php";
require plugin_dir_path( __FILE__ ) . "inc/cearte-page.php";
?>
