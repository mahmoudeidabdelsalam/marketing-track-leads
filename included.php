
<?php if(get_option('template_page_id')): ?>
  <div id="editForm">
    <button>edit form</button>
    <p class="text-copy">Have you already clicked?</p>
  </div>
<?php endif; ?>

<?php if(get_option( 'ct_license_code' ) == 1): ?>
  <div class="box-create">
    <form method="get" id="create_iframe" <?= (get_option('template_page_id'))? "style='display:none'":""; ?>>
      <h3 class="headline-form">choose fields</h3>
      <p class="description">Choose the time if you want to show it in the form</p>
      <div class="col-12">
        <div class="custom-field">
          <label for="field_date">Field date</label>
          <div class="switch">        
            <input type="checkbox" name="field_date" id="field_date"/>
            <div></div>
          </div>
        </div>
        <div class="custom-field">
          <label for="field_date">Departments</label>
          <select name="department" id="kt_department"></select>
        </div>
      </div>
      <div class="col-12">
        <div class="custom-field">
          <label for="field_date">doctor</label>
          <select name="department" id="kt_doctor"></select>
        </div>
        <div class="custom-field">
          <label for="field_date">services</label>
          <select name="department" id="kt_services"></select>
        </div>
      </div>
      <h3 class="headline-form">choose template</h3>
      <div class="col-12">
        <div class="template-page-choose">
          <div class="template-item">
            <input type="radio" id="template_1" name="template_page" value="template_1">
            <label for="template_1"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/template_1.jpg'; ?>" alt="template_1"></label>
          </div>
          <div class="template-item">
            <input type="radio" id="template_2" name="template_page" value="template_2">
            <label for="template_2"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/template_2.jpg'; ?>" alt="template_2"></label>
          </div>
          <div class="template-item">
            <input type="radio" id="template_3" name="template_page" value="template_3">
            <label for="template_3"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/template_3.jpg'; ?>" alt="template_3"></label>
          </div>          
        </div>
      </div>
      <div class="col-12">
        <button type="button" id="create_page">next</button>
      </div>
    </form>

    <?php if(get_option('template_page_id')): ?>
      <div id="linkPage" class="links">
        <div class="copies"> 
          <button class="clipboard" data-url="<?php echo esc_attr( esc_url( get_page_link( get_option('template_page_id') ) ) ) ?>?therapy=facebook">Click me to copy facebook Url</button> 
        </div>
        <div class="copies"> 
          <button class="clipboard" data-url="<?php echo esc_attr( esc_url( get_page_link( get_option('template_page_id') ) ) ) ?>?therapy=instagram">Click me to copy instagram Url</button> 
        </div>
        <div class="copies"> 
          <button class="clipboard" data-url="<?php echo esc_attr( esc_url( get_page_link( get_option('template_page_id') ) ) ) ?>?therapy=twitter">Click me to copy twitter Url</button> 
        </div>
        <div class="copies"> 
          <button class="clipboard" data-url="<?php echo esc_attr( esc_url( get_page_link( get_option('template_page_id') ) ) ) ?>?therapy=snapchat">Click me to copy snapchat Url</button> 
        </div>
        <div class="copies"> 
          <button class="clipboard" data-url="<?php echo esc_attr( esc_url( get_page_link( get_option('template_page_id') ) ) ) ?>?therapy=email">Click me to copy email Url</button> 
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="response"></div>

  
<script>
  jQuery(document).ready(function ($) {
    
    //load dep api
    $( window ).on( "load", function() {
      $.ajax({
        type: 'GET',
        url: '<?php echo plugin_dir_url( __FILE__ ) . 'api/departments-reports.json'; ?>',
        contentType: 'application/json',
        beforeSend: function () {
        },  
        success: function (response) {
          var data = response.data;
          var len = data.length;
          for (var i = 0; i < len; i++) {
            var dropdown = "<option value='"+ data[i].id +"'>" + data[i].name + "</option>";
            $("#kt_department").append(dropdown);
            $('.loaders-page').hide();
          }

        },
        error: function () {
        }
      });
    });

    // function get doctors by id dep
    $("#kt_department").change(function() {
      var value = parseInt($("option:selected", this).val());
      $.ajax({
        type: 'GET',
        url: '<?php echo plugin_dir_url( __FILE__ ) . 'api/departments-reports.json'; ?>',
        contentType: 'application/json',
        beforeSend: function () {
          $('.loaders-page').show();
          $("#kt_doctor").html('<option value="0">select doctor</option>');
          $("#kt_services").html('<option value="0">select services</option>');
        },
        success: function (response) {
          var data = response.data;
          var len = data.length;
          for (var i = 0; i < len; i++) {
            if(data[i].id === value) {
              if(data[i].doctors) {
                  var doctors = data[i].doctors;
                  var number = doctors.length;
                  for (var j = 0; j < number; j++) {
                    var dropdown = "<option value='"+ doctors[j].id +"'>" + doctors[j].name + "</option>";
                    $("#kt_doctor").append(dropdown);
                  }
              }
            }
          }
          $('.loaders-page').hide();
        },
        error: function () {
          $('.loaders-page').hide();
          console.log('test');
        }
      });
    });

    $("#kt_department").change(function() {
      var value = parseInt($("option:selected", this).val());

      $.ajax({
        type: 'GET',
        url: '<?php echo plugin_dir_url( __FILE__ ) . 'api/departments-reports.json'; ?>',
        contentType: 'application/json',
        beforeSend: function () {
          $('.loaders-page').show();
          $("#kt_doctor").html('<option value="0">select doctor</option>');
          $("#kt_services").html('<option value="0">select services</option>');
        },
        success: function (response) {
          var data = response.data;
          var len = data.length;
          for (var i = 0; i < len; i++) {
            if(data[i].id === value) {
              if(data[i].services) {
                var services = data[i].services;
                var num = services.length;
                for (var y = 0; y < num; y++) {
                  var dropdown_s = "<option value='"+ services[y].id +"'>" + services[y].name + "</option>";
                  $("#kt_services").append(dropdown_s);
                }
              }

            }
          }
          $('.loaders-page').hide();
        },
        error: function () {
          $('.loaders-page').hide();
          console.log('test');
        }
      });
    });

    $('button#create_page').on('click', function () {
      var form = {
        field_date    :   $('#field_date').val(),
        template_page :   $('input[name="template_page"]:checked').val(),
        departments :   $('input[name="template_page"]:checked').val(),
        template_page :   $('input[name="template_page"]:checked').val(),
        template_page :   $('input[name="template_page"]:checked').val(),
      };
      console.log($('input[name="template_page"]:checked').val());
      $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: {
          action: 'get_page_template',
          form: form,
        },
        success: function (response) {
          location.reload();
        },
      });
    }); 

    var button = $('.button');

    button.on('mouseenter', function() {
      $(this).addClass('hover');
    });

    button.on('mouseleave', function() {
      $(this).removeClass('hover');
    });

    button.on('click', function() {
      var target = $(this);
      target.addClass('copied');
      window.setTimeout(function() {
        target.removeClass('copied');
      }, 2000);
    });

    $('div#editForm button').on('click', function () {
      $('form#create_iframe').show();
      $(this).hide();
    });
    var $temp = $("<input>");
    $('.clipboard').on('click', function() {
      var $url = $(this).attr('data-url');
      $("body").append($temp);
      $temp.val($url).select();
      document.execCommand("copy");
      $temp.remove();
      $("p.text-copy").text("URL copied!");
    })
  }); 
</script>




<?php else: ?>
  <p>Please complete the activation process</p>
  <div class="response"></div>
  <form method="POST" id="active">
    <input type="email" id="email" name="email" placeholder="entry your email ">
    <input type="text" id="license" name="license" placeholder="entry your license ">
    <button type="button" id="submit">Active</button>
  </form>

  <script>
    jQuery(document).ready(function ($) {
      $('button#submit').on('click', function () {
        var license = $('#license').val();
        var email = $('#email').val();
        $.ajax({
          url: 'https://marketing.test/wp-json/wp/api/trackleads/active',
          type: 'POST',
          data: {
            license: license,
            home_url : '<?= get_home_url(); ?>',
            email: email
          },
          success: function (response) {
            if(response.success === true) {
              $('.response').html(response.success);
              var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
              $.ajax({
                url: ajaxurl,
                type: 'POST',
                data:'action=get_action&license=1',
                success: function (response) {
                  $('.response').html(response);
                  location.reload();
                },
              });
            } else {
              $('.response').html('license is not available');
            }
          },
        });
      });     
    });
  </script>
<?php endif; ?>
