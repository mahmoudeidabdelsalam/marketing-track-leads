<?php 
function get_action() {
  $license = $_POST['license'];
  update_option( 'ct_license_code', $license );
  echo "active done";
  die();
}

add_action('wp_ajax_nopriv_get_action', 'get_action');
add_action('wp_ajax_get_action', 'get_action');