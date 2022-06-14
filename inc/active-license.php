<?php 
if( !function_exists('pfl_is_active') ) {
  function pfl_is_active() {
    $license = sanitize_text_field($_POST['license']);
    update_option( 'ct_license_code', $license );
    echo "active done";
    die();
  }
}
add_action('wp_ajax_nopriv_get_action', 'pfl_is_active');
add_action('wp_ajax_get_action', 'pfl_is_active');