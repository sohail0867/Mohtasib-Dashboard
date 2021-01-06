<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Log In</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">     
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/elephant.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/login-3.min.css">
  </head>
  <body>
    <div id="login" class="login">
      <div  class="login-body">
        <a class="login-brand" href="index.html">
         <!--<img class="img-responsive" src="assets/pnd-logo.png" alt="Elephant">-->
       </a>
       <h3 class="login-heading">Sign in</h3>
       <div class="login-form">
        <?php  
          if ($this->session->flashdata("invalid")) {?>
           <label class="label label-danger"><?php echo $this->session->flashdata("invalid"); ?></label>
        <?php }?>
         <form data-toggle="md-validator" method="post" action="<?php echo base_url();?>/auth/login">
           <div class="md-form-group md-label-floating has-value has-success">
             <input class="md-form-control" type="text" name="username" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." required="" aria-required="true" aria-invalid="false">
           </div>
           <div class="md-form-group md-label-floating has-value has-success">
             <input class="md-form-control" type="password" name="password" minlength="1" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required="" aria-required="true" aria-invalid="false">

           </div>
           <button class="btn btn-primary btn-block" name="login" type="submit">Sign in</button><br><br>
           <div class="md-form-group md-custom-controls">
             <span aria-hidden="true">  </span>
             <a href="#" onclick="showForgotPassword()">Forgot password?</a>
           </div>
           <!-- <div class="md-form-group md-custom-controls">
             <span class="btn btn-block"><a href="passwordReset.php">Recover Your Account</a></span>
           </div> -->

         </form>
       </div>
     </div>
    </div>

    <div id="forgotPassword" class="login" style="display: none;">
      <div class="login-body">
        <a class="login-brand">
          <!-- <img class="img-responsive" src="img/logo.svg" alt="Elephant"> -->
        </a>
        <div class="login-form" >
          <form data-toggle="md-validator" id="logArea">
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="email" id="email" name="email" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." required>
              <label class="md-control-label">Email address</label>
              <span class="md-help-block" id="label">We'll send you an email to reset your password.</span>
            </div>
            <button class="btn btn-primary btn-block" id="myPasswordResetform" type="submit">
              Send password reset email
            </button>
          </form>
          <br>
          <div class="md-form-group md-custom-controls">
             <span aria-hidden="true">  </span>
             <a href="#" onclick="showLogin()">Back Login Form</a>
          </div>
        </div>
      </div>
      <div class="login-footer">
        <!-- Don't have an account? <a href="signup-3.html">Sign Up</a> -->
      </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/elephant.min.js"></script>
     <script type="text/javascript">
      function showForgotPassword(){
        document.getElementById('forgotPassword').style="display:block;";
        document.getElementById('login').style="display:none;";
      }
      function showLogin(){
        document.getElementById('forgotPassword').style="display:none;";
        document.getElementById('login').style="display:block;";
      }

      document.getElementById("myPasswordResetform").addEventListener("click", function(event){
        event.preventDefault();
        var em = document.getElementById('email').value;
        if (em == null || em.length === 0) {
          document.getElementById('label').innerHTML = "<p class='text text-danger'>Please Enter Your Email Address</p>";
        }else{
          document.getElementById('label').innerHTML = "<p class='text text-success'>We'll send you an email to reset your password</p>";

          $.ajax({
            type:'GET',
            url :'<?php echo base_url();?>Auth/passwordReset',
            data:{email:em},
            contentType:'application/json',
            dataType:'json',
            success:function(res){
              if (res.success == '1') {
                document.getElementById('logArea').innerHTML = "<h4 class='text text-success'>Please Check Your Email inbox</h>";
              }else{
                alert('invalid email address');
              }
            }
          });
        }
      });

    </script>
  </body>
</html>
