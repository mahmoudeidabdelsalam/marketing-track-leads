<?php 
function custom_page_template() {    

  $form = $_POST['form'];

  $date             = $form['field_date'];
  $template_page    = $form['template_page'];

  $page_id = get_option( 'template_page_id' );

  if($page_id && get_page($page_id)) {
    echo 'The page already exists - ' . $page_id;

    update_post_meta($page_id, 'desgin', $template_page);
    update_post_meta($page_id, 'date', $date);
  } else {
    $page = array(
      'post_title'    => wp_strip_all_tags( 'Track Leads' ),
      'post_name' => 'front-track-leads',
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
      'page_template'  => 'blank-page.php'
    );
    $the_page_id = wp_insert_post( $page );
      delete_option( 'template_page_id' );
      add_option( 'template_page_id', $the_page_id );
      add_option( 'template_page_option', 'page-standard-template' );
      update_post_meta($the_page_id, 'desgin', $template_page);
      update_post_meta($the_page_id, 'date', $date);
      
    echo "page cearte done - " . $the_page_id;
  }
  die();
}

add_action('wp_ajax_nopriv_get_page_template', 'custom_page_template');
add_action('wp_ajax_get_page_template', 'custom_page_template');