<?php 
function custom_page_template() {    

  $form = $_POST['form'];
  $social = $_POST['social'];
  $name = $_POST['name'];

  $page = array(
    'post_title'    => $name . '-' . $social,
    'post_content'  => $form,
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'     => 'page',
    'page_template' => 'template-page-marketing.php'
  );
  $the_page_id = wp_insert_post( $page );

  echo "Page cearte done <a href=".get_permalink($the_page_id).">view page</a>";
  echo "<p style='color: red;'>If you want to use a second design page default, you can take a copy of the short code and place it on any page you want</p>";

  die();
}

add_action('wp_ajax_nopriv_get_page_template', 'custom_page_template');
add_action('wp_ajax_get_page_template', 'custom_page_template');