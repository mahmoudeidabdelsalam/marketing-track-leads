<?php
/**
  * Template Name: Track Form
  * Template By : Marketing Track leads
 */

 get_header();
?>


<?php
  if ( have_posts() ) :
    while (have_posts() ) : the_post(); 
      $design =  get_post_meta(get_the_ID(), 'desgin');
      $date   =  get_post_meta(get_the_ID(), 'date');
    ?>
    <div id="TemplatePage" class="full-width-page <?= ($design[0])? $design[0]:''; ?>">
      <form id="form">
        <div class="card-body">
          <div class="fields-custom">
            <input type="text" name="first_name" class="form-control" aria-describedby="first_name" placeholder="<?php _e('Name', 'marketing'); ?>" autocomplete="first_name" required="required">
            <label for="first_name" class="form-label"><?php _e('Name', 'marketing'); ?></label>
            <span class="text-danger" id="first_name"></span>
          </div>
          <div class="fields-custom">
            <input type="email" name="email" class="form-control" aria-describedby="email" placeholder="<?php _e('Email', 'marketing'); ?>" autocomplete="email" required="required">
            <label for="email" class="form-label"><?php _e('Email', 'marketing'); ?></label>
            <span class="text-danger" id="email"></span>
          </div>
          <div class="fields-custom">
            <input type="text" name="phone_number" class="form-control" aria-describedby="phone_number" placeholder="<?php _e('Phone', 'marketing'); ?>" autocomplete="phone_number" required="required">
            <label for="phone_number" class="form-label"><?php _e('Phone', 'marketing'); ?></label>
            <span class="text-danger" id="phone_number"></span>
          </div>
          <?php if($date[0]): ?>
          <div class="fields-custom">
            <select name="best_time" class="form-control" aria-describedby="best_time" required="required">
              <option value="1"><?php _e('From 9 AM to 12 PM', 'marketing'); ?></option>
              <option value="2"><?php _e('From 12 PM to 4 PM', 'marketing'); ?></option>
              <option value="3"><?php _e('From 4 pM to 7 PM', 'marketing'); ?></option>
            </select>
            <label for="best_time" class="form-label"><?php _e('The right time to contact you', 'marketing'); ?></label>
            <span class="text-danger" id="best_time"></span>
          </div>
          <?php endif; ?>
          <div class="text-center footer-form">
            <button type="submit" class="btn btn-submit">
              <?php _e('submit', 'marketing'); ?>
            </button>
          </div>
        </div>
      </form>

      <div class="success-response" style="display: none;">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.5163 8.93451L11.0597 14.7023L8.0959 11.8984" stroke="black" stroke-width="2"></path>
          <path
            d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
            stroke="black" stroke-width="2"></path>
        </svg>
        <p id="message"></p>
        <p id="offers" style="display: none;"><?php _e('To get offers', 'marketing'); ?> <a href="#" target="_blank"><?php _e('from here', 'marketing'); ?></a></p>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"> </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

      <script type="text/javascript">
        $(document).ready(function() {
          document.cookie = 'ultimoUrl=' + window.location.href;
        });

        $(".btn-submit").click(function (e) {
          e.preventDefault();
          var data = $("#form").serializeArray();
          $.ajax({
            type: 'POST',
            url: "https://the-clinics.360-clinics.net/api/departments/public-form/c082d317-81f9-4474-b2e3-59073ccd58c6",
            data: data,
            success: function (data) {
              $(".success-response").show("slow");
              $("#form").slideUp("slow");
              if (data.offer_status == true) {
                $('#offers').show();
                $('#offers a').attr("href", data.url);
              }
              $('#message').text(data.message);
            },
            error: function (response) {
              console.log(response.responseJSON.errors);
              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'هناك خطأ بالبيانات رجاء المحاولة مره اخري',
                showConfirmButton: false,
                timer: 2500,
              });
              $('#first_name').text(response.responseJSON.errors.first_name);
              $('#last_name').text(response.responseJSON.errors.last_name);
              $('#email').text(response.responseJSON.errors.email);
              $('#phone_number').text(response.responseJSON.errors.phone_number);
              $('#best_time').text(response.responseJSON.errors.best_time);
            }
          });

        });
      </script>
    </div>
    <?php
    endwhile;
  endif;
?>

<style>
  div#TemplatePage {
    background: -webkit-linear-gradient(#1e5f77, #d29531);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 120px 0;
  }
  form#form {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  form#form .fields-custom input, form#form .fields-custom select {
      padding: 15px;
      width: 100%;
      max-width: 320px;
      box-sizing: border-box;
  }

  form#form .fields-custom label.form-label {
      display: none;
  }

  form#form .fields-custom {
      display: inline-block;
      width: 100%;
      max-width: 320px;
      margin-bottom: 15px;
  }

  .card-body {
      display: inline-block;
      max-width: 320px;
  }  

  .footer-form .btn {
    width: 60%;
    height: 50px;
    background: #3598da;
    border: 1px solid #eee;
    color: #fff;
    font-size: 22px;
    margin: 0 auto;
    display: block;
    cursor: pointer;
  }

  .success-response {
    text-align: center;
    font-size: 22px;
  }
</style>
<?php get_footer(); ?>
