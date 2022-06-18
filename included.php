<?php if(get_option( 'ct_license_code' ) != 1): ?>
  <p><?php esc_html_e('Please complete the activation process', 'public-form-leads'); ?></p>
  <div class="response"></div>
  <form method="POST" id="active">
    <input type="email" id="email" name="email" placeholder="entry your email ">
    <input type="text" id="license" name="license" placeholder="entry your license ">
    <button type="button" id="submit"><?php esc_html_e('Active', 'public-form-leads'); ?></button>
  </form>
<?php else: ?>
  <?php require plugin_dir_path( __FILE__ ) . "inc/create-single-form.php"; ?>
<?php endif; ?>
