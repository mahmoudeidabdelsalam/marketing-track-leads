<?php 
if( !function_exists('cp_marketing_form') ) {
  function cp_marketing_form() {    

    $form   = sanitize_text_field($_POST['form']);
    $social = sanitize_title($_POST['social']);
    $name   = sanitize_title($_POST['name']);

    $page = array(
      'post_title'    => $name . '-' . $social,
      'post_content'  => $form,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
      'page_template' => 'template-page-marketing.php'
    );
    $the_page_id = wp_insert_post( $page );

    echo "Page cearte done <a href=".esc_url(get_permalink($the_page_id))."> view page</a>";
    echo "<p style='color: red;'>".esc_html_e( 'If you want to use a second design page default, you can take a copy of the short code and place it on any page you want', 'mtl' )."</p>";

    die();
  }

  add_action('wp_ajax_nopriv_get_page_template', 'cp_marketing_form');
  add_action('wp_ajax_get_page_template', 'cp_marketing_form');
}