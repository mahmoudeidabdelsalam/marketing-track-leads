<div class="box-create">
  <h3 class="headline-form">available template</h3>
  <div class="col-12">
    <div class="template-page-choose">
      <div class="template-item">
        <span>design light</span>
        <label for="template_1"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/custom-1.png'; ?>" alt="template_1"></label>
      </div>
      <div class="template-item">
        <span>design colors</span>
        <label for="template_2"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/custom-2.png'; ?>" alt="template_2"></label>
      </div>
      <div class="template-item">
        <span>design full width</span>
        <label for="template_3"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/custom-3.png'; ?>" alt="template_3"></label>
      </div>          
    </div>
  </div>

  <form method="get" id="create_iframe">
    <div class="group-forms">
      <div class="custom-form">
        <label for="kt_department"><?php esc_html_e('Department', 'mtl'); ?></label>
        <select id="kt_department">
          <option value="0"><?php esc_html_e('select department', 'mtl'); ?></option>
        </select>
      </div>

      <div class="custom-form">
        <label for="kt_doctor"><?php esc_html_e('Doctors', 'mtl'); ?></label>
        <select id="kt_doctor">
          <option value="0"><?php esc_html_e('select doctor', 'mtl'); ?></option>
        </select>
      </div>

      <div class="custom-form">
        <label for="kt_services"><?php esc_html_e('Services', 'mtl'); ?></label>
        <select id="kt_services">
          <option value="0"><?php esc_html_e('select service', 'mtl'); ?></option>
        </select>
      </div>
    </div>

    <div class="group-forms">
      <div class="custom-form">
        <label for="kt_name"><?php esc_html_e('Form Name', 'mtl'); ?></label>
        <input id="kt_name" type="text">
      </div>
      <div class="custom-form">
        <label for="kt_socials"><?php esc_html_e('Social Media (option)', 'mtl'); ?></label>
        <select id="kt_socials">
          <option value="0" selected><?php _e('select social', 'mtl'); ?></option>
        </select>
      </div>
      <div class="custom-form">
        <label for="kt_style"><?php esc_html_e('Select Design', 'mtl'); ?></label>
        <select id="kt_style">
          <option value="custom-1"><?php esc_html_e('design light', 'mtl'); ?></option>
          <option value="custom-2"><?php esc_html_e('design colors', 'mtl'); ?></option>
          <option value="custom-3"><?php esc_html_e('design full width', 'mtl'); ?></option>
        </select>
      </div>
    </div>

    <div class="footer-form">
      <button type="button" id="submit_iframe"><?php esc_html_e('create iframe', 'mtl'); ?></button>
    </div>
  </form>


  <div class="review-form" style='display:none'>
    <span id="page"></span>
    <input type="text">
  </div>
</div>

<style>
  .wp-core-ui select {
    height: 50px;
    font-size: 16px;
    text-transform: capitalize;
    width: 100%;
  }

  .group-forms {
    display: flex;
    justify-content: space-between;
    width: 100%;
  }

  .group-forms .custom-form label {
    display: block;
    font-size: 18px;
    margin: 10px 0;
  }
  
  .custom-form {
    width: 100%;
    padding: 15px;
  }  

  .template-item span {
    display: block;
    text-transform: capitalize;
    font-size: 12px;
    font-weight: bold;
  }  
</style>