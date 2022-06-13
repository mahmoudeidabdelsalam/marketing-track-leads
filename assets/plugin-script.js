jQuery(document).ready(function ($) {
  // var url = "https://the-clinics.360-clinics.net/api/v1/plugin/create-single-form";

  $('button#submit').on('click', function () {
    var license = $('#license').val();
    var email = $('#email').val();
    $.ajax({
      url: 'https://360-clinics.net/api/get-domain',
      type: 'POST',
      contentType : 'application/json',
      dataType : 'json',
      headers: {
        "Accepts": "text/plain; charset=utf-8",
        "email": email,
        "apikey": license
      },
      success: function (response) {
        window.localStorage.setItem("subdomainURL", response.subdomain);
        window.localStorage.setItem("apikeyactive", license);
        window.localStorage.setItem("emailActive", email);
        $('.response').html('license done');
        var ajaxurl = backendajax.ajax_url;
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data:'action=get_action&license=1',
          success: function (response) {
            location.reload();
          },
        });
      },
      error: function (error) {
        $('.response').html('license error');
      }
    });
  }); 

  // get all data api by subdomain
  var subdomainURL  = 'https://' + window.localStorage.subdomainURL;
  var apikeyactive  = window.localStorage.apikeyactive;
  var emailActive   = window.localStorage.emailActive;

  
  $( window ).on( "load", function() {

    //load dep api
    $.ajax({
      type: 'GET',
      url: subdomainURL + '/api/v1/plugin/data',
      headers: {
        "email": emailActive,
        "apikey": apikeyactive,
        "lang": "en"
      },        
      success: function (response) {
        var data = response.data;
        var len = data.length;
        for (var i = 0; i < len; i++) {
          var dropdown = "<option value='"+ data[i].id +"'>" + data[i].name + "</option>";
          $("#kt_department").append(dropdown);
        }
      },
    });

    //load dep social media data
    $.ajax({
      type: 'GET',
      url: subdomainURL + '/api/v1/plugin/socials-data',
      headers: {
        "email": emailActive,
        "apikey": apikeyactive
      },        
      success: function (response) {
        var data = response;
        var len = data.length;

        
        for (var i = 0; i < len; i++) {
          var dropdown = "<option value='"+ data[i].id +"'>" + data[i].name + "</option>";
          $("#kt_socials").append(dropdown);
        }
      },
    });
  });

  // function get doctors by id dep
  $("#kt_department").change(function() {
    var department_id = $(this).find(":selected").val();
    $.ajax({
      type: 'GET',
      url: subdomainURL+'/api/v1/plugin/data',
      headers: {
        "email": emailActive,
        "apikey": apikeyactive,
        "lang": "en"
      },        
      success: function (response) {
        var data = response.data;
        var len = data.length;
        for (var i = 0; i < len; i++) {
          if(data[i].id == department_id) {
            $("#kt_doctor").html('');
            var doctor = data[i].doctors;
            var count = doctor.length;
            for (var j = 0; j < count; j++) {
              var doctors = "<option value='"+ doctor[j].id +"'>" + doctor[j].name + "</option>";
              $("#kt_doctor").append(doctors);
            }
            $("#kt_services").html('');
            var service = data[i].services;
            var counts = service.length;
            for (var g = 0; g < counts; g++) {
              var servicess = "<option value='"+ service[g].id +"'>" + service[g].name + "</option>";
              $("#kt_services").append(servicess);
            }
          }
        }
      },
    });
  });


  // caerte page and iframe form leads
  
  $("#submit_iframe").on('click', function() {
    var department_id = $("#kt_department").find(":selected").val();
    var service_id    = $("#kt_services").find(":selected").val();
    var doctor_id     = $("#kt_doctor").find(":selected").val();
    var social_id     = $("#kt_socials").find(":selected").val();
    var social_name   = $("#kt_socials").find(":selected").text();
    var name          = $("#kt_name").val();
    var kt_style      = $("#kt_style").find(":selected").val();

    $.ajax({
      type: 'POST',
      url: subdomainURL+'/api/v1/plugin/create-single-form',
      headers: {
        "email": emailActive,
        "apikey": apikeyactive,
        "lang": "en"
      },
      data: {
        "department_id": department_id,
        "service_id": service_id,
        "doctor_id": doctor_id,
        "social_id": social_id,
        "name": name
      },
      success: function (response) {
        var data = response.data;
        $('.review-form input').val('');

        var userLang = navigator.language || navigator.userLanguage; 
        // alert ("The language is: " + userLang);

        $.ajax({
          url: subdomainURL+'/api/v1/plugin/departments-inputs/'+department_id,
          type: 'GET',
          headers: {
            "email": emailActive,
            "apikey": apikeyactive,
            "lang": "en"
          },
          data: {},
          success: function (response) {
            let myArray = response.data

            console.log(myArray);

            var output = '[markrting-leads ';
            myArray.forEach(function(element) { 
              output += element.name+'="'+element.name+'" ';
              if(userLang === "en-US") {
                output += 'label_'+element.name+'="'+element.label.en+'" ';
              } else {
                output += 'label_'+element.name+'="'+element.label.ar+'" ';
              }
              output += 'options="'+element.options+'" ';
            });

            output += 'url="https//'+data+'" ';
            output += 'class="'+kt_style+'" ';
            output += ' /]';

            $.ajax({
              url: backendajax.ajax_url,
              type: 'POST',
              data: {
                action: 'get_page_template',
                form: output,
                name:name,
                social: social_name,
              },
              success: function (response) {
                $('.review-form').show();
                $('.review-form input').val(output);
                $('.review-form #page').html(response);
              },
            });
    
          },
        });
        
      },
    });
  });

  
}); 