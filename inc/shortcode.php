<?php 
// The shortcode function
function wp_form_shortcode($atts, $content = null) { 
  $attributes = shortcode_atts( array(  
    'class' => 'custom-1',  
    'url' => '',
  ), $atts );

  $string .= '
    <form id="public_form" class="'.$attributes['class'].'" action="" method="post">
      <input type="text" name="first_name" placeholder="Name">
      <input type="text" name="email" placeholder="Email">
      <input type="text" name="phone_number" placeholder="Phone">
      <input type="text" name="best_time" placeholder="Time">
      <button type="button" id="public_submit">submit</button>
    </form>
  ';
    
  if($attributes['class'] == 'custom-1') {
    $string .= '
      <style>
        form.custom-1 {
          max-width: 600px;
          margin: 20px auto;
          padding: 20px;
          background: #f5f5f5;
          border-radius: 4px;
          box-shadow: 0 0 3px -1px #333;
        }
        
        form.custom-1 input {
          padding: 15px;
          margin: 10px 0;
          display: inline-block;
          border: 1px solid #333;
          height: 60px;
        }
        
        form.custom-1 button {
          padding: 10px 20px;
        }
      </style>
    ';
  }
  if($attributes['class'] == 'custom-2') {
    $string .= '
      <style>
        form.custom-2 {
          max-width: 600px;
          margin: 20px auto;
          padding: 20px;
          background: #6d6d6d;
          border-radius: 4px;
          box-shadow: 0 0 3px -1px #333;
          background-image: linear-gradient(to right, #9100ff , #d6d602);
        }
        
        form.custom-2 input {
          padding: 15px;
          margin: 10px 0;
          display: inline-block;
          border: 1px solid #000;
          height: 60px;
          background: #f1f1f1;
          border-radius: 10px;
        }
        
        form.custom-2 button {
          padding: 14px 50px;
          background: #d5d40d;
          text-transform: capitalize;
          border: 1px solid #333;
          border-radius: 10px;
          display: block;
          margin: auto;
        }
      </style>
    ';
  }
  if($attributes['class'] == 'custom-3') {
    $string .= '
      <style>
        form.custom-3 {
          max-width: 600px;
          margin: 20px auto;
          padding: 20px;
          border-radius: 4px;
        }
        
        form.custom-3 input {
          padding: 15px;
          margin: 10px 0;
          display: inline-block;
          border: 1px solid #333;
          height: 60px;
          width: 100%;
          box-sizing: border-box;
        }
        
        form.custom-3 button {
          padding: 10px 20px;
          width: 100%;
          height: 60px;
          background: #000;
          border: 1px solid #ccc;
          border-radius: 4px;
          font-size: 22px;
          color: #fff;
          text-transform: capitalize;
        }
      </style>
    ';
  }

  if($attributes['url']) {
    $string .= '
      <script type="text/javascript">
        jQuery(document).ready(function ($) {
          $("#public_submit").click(function (e) {
            var data = $("#public_form").serializeArray();
            console.log(data);
            e.preventDefault();
            var data = $("#form").serializeArray();
            $.ajax({
              type: "POST",
              url: "'.$attributes['url'].'",
              data: data,
              success: function (response) {
                console.log(response);
              },
              error: function (response) {
              }
            });
          });
        });
      </script>
    ';
  }

  return $string; 
}
/**
 * Central location to create all shortcodes.
 */
function wporg_shortcodes_init() {
  add_shortcode('markrting-leads', 'wp_form_shortcode'); 
}

add_action( 'init', 'wporg_shortcodes_init' );