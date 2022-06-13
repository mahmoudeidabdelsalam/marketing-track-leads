<?php 
if( !function_exists('get_ct_license') ) {
  function ct_license_code() {
    $license = sanitize_text_field($_POST['license']);
    update_option( 'get_ct_license', $license );
    echo "active done";
    die();
  }
}
add_action('wp_ajax_nopriv_get_action', 'get_ct_license');
add_action('wp_ajax_get_action', 'get_ct_license');