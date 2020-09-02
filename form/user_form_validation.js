var $js = jQuery.noConflict();

$js().ready(function () {

    $js( "#user_login_form" ).validate({
           rules: {
            
              useremail: {
                      required: true,
                      email: true
                  },
               
              userpass: {
                      required: true,
                  }
              },
           messages: {

                useremail: {
                  required: "Email address is required.",
                  email: "Enter a valid email address."
                 },
                 userpass: {
                   required: "Please enter the password."
                 },
            },
            submitHandler: function (form) {

              $('#loginSubmit').attr('disabled', 'disabled'); 
              $(".login_loader").css('display', 'inline-block');
              $("#loginerror").css('display', 'none');

              loginemail = jQuery('input[name=useremail]').val();
              loginpass = jQuery('input[name=userpass]').val();

              var loginFormData = { type: 'login', email: loginemail, password: loginpass}
              
                  $.ajax({
                    type: "POST",
                    url: "/form/submit_form.php",
                    data: loginFormData,
                    cache: false,
                    success: function (data) {
                      
                      var response = JSON.parse(data);
                      if(response.msg){

                        $('#loginSubmit').removeAttr('disabled');
                        $(".login_loader").css('display', 'none');
                        localStorage.setItem( 'currentUser', JSON.stringify(response) );
                        $("#user_login_form").closest('form').find("input[type=text],input[type=email],input[type=password]").val("");
                        //window.location.href = 'http://spstaging.optisolbusiness.com/authentication/'+response.token;
                        window.location.href = 'https://student.tcglobal.com/authentication/'+response.token;

                      }
                      else if(response.errorMsg){
                        $('#loginSubmit').removeAttr('disabled');
                        $(".login_loader").css('display', 'none');
                        $("#loginerror").css('display', 'block');
                        //$("#loginerror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        
                        if(response.isInActive){
                          errorData = "Activate your account to login. Have problem? <a onClick='resendMail()' style='text-decoration: underline;color: #856404;'>click here</a> to resend activation link.</a>";
                          $("#loginerror").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+errorData+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        }
                        else{
                           errorData = response.errorMsg;
                           $("#loginerror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        }

                      }
                    },
                    error: function () {
                      $('#loginSubmit').removeAttr('disabled');
                      $(".login_loader").css('display', 'none'); 
                      $('#loginerror').text('An error occurred');
                    }

                  });

              return false;
            }
      }); 


  $js( "#user_singup_form" ).validate({

          ignore: "",

           rules: {
              firstname: {
                required: true,
                alphadot: true
              },
              lastname: {
                required: true,
                alphadot: true
              },
              custom_mail: {
                required: true,
                customid: true
              },
              telephone: {
                required: true,
                numfield: true,
                minlength: 8,
                maxlength: 13
              },
              userpass: {
                required: true,
                minlength: 7,
                maxlength: 15
              },
              confirm_pass: {
                required: true,
                equalTo : "#userpass"
              },

              userterms: {
                required: true
              }
          },    

           messages: {

                firstname: {
                  required: "First Name is required"
                  },
                lastname: {
                  required: "Last Name is required"
                  },
                custom_mail: {
                  required: "Email address is required."
                  
                 },
                 telephone: {
                  required: "Mobile Number is required"
                 },
                 userpass: {
                   required: "Password is required",
                   minlength: "Password shall be minimum 7 charecters long and shall have a combination of Alphabets and numbers.",
                   maxlength:"Password should not exceed 15 characters."
                 },
                 confirm_pass: {
                    required: "Confirm Password is required"
                 },
                 userterms: {
                    required: "Accept Terms & Conditions is required"
                 }
            },
            submitHandler: function (form) {

              $('#signupSubmit').attr('disabled', 'disabled'); // disable multiple time form submit 
              $(".signup_loader").css('display', 'inline-block');

              fname = jQuery('input[name=firstname]').val();
              lname = jQuery('input[name=lastname]').val();
              email = jQuery('input[name=custom_mail]').val();
              code = jQuery('input[name=country_code]').val();
              phone = jQuery('input[name=telephone]').val();
              pass = jQuery('input[name=userpass]').val();
              cnfpass = jQuery('input[name=confirm_pass]').val();

              dialCode = "+"+code;
              //console.log(dialCode);
              var signupFormData = { type: 'signup', firstname: fname, lastname: lname, email:email, code:dialCode, mobile:phone, password:pass, confirm_pass:cnfpass}
              //console.log(signupFormData);

              $.ajax({
                    type: "POST",
                    url: "/form/submit_form.php",
                    data: signupFormData,
                    cache: false,
                    success: function (data) {
                      //console.log(data);
                      var response = JSON.parse(data);
                      
                      if(response.msg){
                        $(".signup_loader").css('display', 'none');
                        $("#errorres").css('display', 'none');
                        $("#successres").css('display', 'block');
                        $("#successres").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                          '<strong class="alert-heading">Check Your Email</strong>'+
                          '<p>A confirmation email was sent to</p>'+email+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                          '<span aria-hidden="true">&times;</span></button></div>');

                        $("#user_singup_form").closest('form').find("input[type=text],input[type=email],input[type=tel],input[type=password]").val(""); 
                        $("#signupterm").prop('checked',false);
                        $('#signupSubmit').removeAttr('disabled');
                      }
                      else if(response.errorMsg){
                        $(".signup_loader").css('display', 'none');
                        $("#successres").css('display', 'none');
                        $("#errorres").css('display', 'block');
                        $('#signupSubmit').removeAttr('disabled');
                        $("#errorres").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Email id or phone number already exist.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                      }
                      
                    },
                    error: function () {
                      $(".signup_loader").css('display', 'none');
                      //console.log('error');
                      
                    }

                  });

            return false;
          }
  });

  $js( "#user_forgot_pass" ).validate({
           rules: {
            
              forgot_email: {
                      required: true,
                      email: true
                  }
            },
           messages: {
                forgot_email: {
                  required: "Email address is required.",
                  email: "Enter a valid email address."
                }
            },

            submitHandler: function (form) {

              $('#forgotSubmit').attr('disabled', 'disabled');
              $(".forgot_loader").css('display', 'inline-block');

              forgotemail = jQuery('input[name=forgot_email]').val();
              var forgotFormData = { type: 'forgotpass', email: forgotemail}
              //console.log(forgotFormData);

                $.ajax({
                    type: "POST",
                    url: "/form/submit_form.php",
                    data: forgotFormData,
                    cache: false,
                    success: function (data) {
                      
                      var response = JSON.parse(data);
                      if(response.msg){
                        
                        $(".forgot_loader").css('display', 'none');
                        $("#forgoterror").css('display', 'none');
                        $("#forgotsuccess").css('display', 'block');
                        $("#forgotsuccess").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                          '<p> We have sent you an email with a link to reset your password. Please follow the instructions in your email.</p>'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                          '<span aria-hidden="true">&times;</span></button></div>');

                        $("#user_forgot_pass").closest('form').find("input[type=email]").val(""); 
                        $('#forgotSubmit').removeAttr('disabled');

                      }
                      else if(response.errorMsg){
                       
                        $(".forgot_loader").css('display', 'none');
                        $("#forgotsuccess").css('display', 'none');
                        $("#forgoterror").css('display', 'block');
                        $('#forgotSubmit').removeAttr('disabled');
                        $("#forgoterror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                      }

                    },
                    error: function () {
                      console.log('error');
                      
                    }

                  });

              return false;
            }
      }); 


      $j( "#mobile_login_form" ).validate({
           rules: {
            phonelogin: {
                    required: true
                }
              },
           messages: {
            phonelogin: {
                  required: "Mobile number is required."
                }
              },

            submitHandler: function (form) {

              $('#mobileloginSubmit').attr('disabled', 'disabled');
              $(".phone_loader").css('display', 'inline-block');
              phonenum = jQuery('input[name=phonelogin]').val();
              jQuery('input[name=otpmobile]').val(phonenum);
              var otpFormData = {type: 'mobileOTP', phone: phonenum}
              
              $.ajax({
                    type: "POST",
                    url: "/form/submit_form.php",
                    data: otpFormData,
                    cache: false,
                    success: function (data) {
                      
                      var response = JSON.parse(data);

                      if(response.msg){
                        $(".phone_loader").css('display', 'none');
                        $("#otperror").css('display', 'none');
                        $("#otpsuccess").css('display', 'block');

                        $(".otpsection").css('display', 'none');
                        $(".otploginsection").css('display', 'block');
                        $("#otpsuccess").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                          '<strong class="alert-heading">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                          '<span aria-hidden="true">&times;</span></button></div>');
                        
                        $("#mobile_login_form").closest('form').find("input[type=text]").val("");
                        $('#mobileloginSubmit').removeAttr('disabled');
                        $("#otpsuccess").fadeOut(3000,"linear");
                      }
                      else if(response.errorMsg){
                       
                        $(".phone_loader").css('display', 'none');
                        $("#otpsuccess").css('display', 'none');
                        $("#otperror").css('display', 'block');
                        $('#mobileloginSubmit').removeAttr('disabled');

                        $("#otperror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $("#otperror").fadeOut(3000,"linear");
                      }

                    },
                    error: function () {
                      $("#otperror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Error occurred<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                      
                    }

                  }); 

              return false;
            }
        });

      $j( "#otp_login_form" ).validate({
           rules: {
            otpnum: {
                    required: true
                }
              },
           messages: {
            otpnum: {
                  required: "Otp is required.",
                  minlength:"Please enter 4 digit code."
                }
              },

              submitHandler: function (form) {

              $('#otploginSubmit').attr('disabled', 'disabled');
              $(".otp_loader").css('display', 'inline-block');
              userloginmobile = jQuery('input[name=otpmobile]').val();
              otpnum = jQuery('input[name=otpnum]').val();
              var otploginData = { type: 'OtpLogin', mobileNumber:userloginmobile,OTP:otpnum}

              $.ajax({
                    type: "POST",
                    url: "/form/submit_form.php",
                    data: otploginData,
                    cache: false,
                    success: function (data) {
                      var response = JSON.parse(data);

                      if(response.msg){
                        $(".otp_loader").css('display', 'none');
                        $("#otperror").css('display', 'none');
                        $('#otploginSubmit').removeAttr('disabled');
                        $("#otp_login_form").closest('form').find("input[type=text]").val(""); 
                        window.location.href = 'https://student.tcglobal.com/authentication/'+response.token;
                      }
                      else if(response.errorMsg){
                       
                        $(".otp_loader").css('display', 'none');
                        $("#otpsuccess").css('display', 'none');
                        $("#otperror").css('display', 'block');
                        $('#otploginSubmit').removeAttr('disabled');
                        $("#otperror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $("#otperror").fadeOut(3000,"linear");
                      }

                    },
                    error: function () {
                      $("#otperror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Error occurred<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }

                  }); 

              return false;
            }
          });






});



