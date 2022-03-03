<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    session_start();
    include_once "includes/head.php";
    ?>
  </head>
  <body>
    
	  <?php
    include_once "includes/nav.php";
    ?>
    
    <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          </div>
          <div class="col-lg-8">
            <h1 class="registerNaslov">Registration</h1>
            <form action="#" class="contact-form">
              <label for="firstName" class="labelLogin">First Name: </label>
              <div class="form-group">
                <input type="text" id="name" name="firstName">
                <div id="imeError"></div>
              </div>
              <label for="lastName" class="labelLogin">Last Name: </label>
              <div class="form-group">
                <input type="text" id="lastname" name="lastName">
                <div id="prezimeError"></div>
              </div>
			  <label for="email" class="labelLogin">Email: </label>
			  <div class="form-group">
				  <input type="email" id="mail" name="email">
          <div id="emailError"></div>
			  </div>
			  <label for="usernameR" class="labelLogin">Username: </label>
			  <div class="form-group">
				  <input type="text" id="userR" name="usernameR">
          <div id="userError"></div>
			  </div>
			  <label for="passwordR" class="labelLogin">Password: </label>
			  <div class="form-group">
				  <input type="password" id="passR" name="passwordR">
          <div id="passError"></div>
			  </div>
			  <label for="passwordConf" class="labelLogin">Confirm Password: </label>
			  <div class="form-group">
				  <input type="password" id="passConf" name="passwordConf">
          <div id="passConfError"></div>
			  </div>
              <div class="form-group">
                <input type="button" id="registerButton" value="Register">
				<input type="reset" id="resetButton" name="resetButton" value="Reset">
              </div>
			  <h5 class="text-white">You already have an account? Log in <a href="index.php">here</a></h5>
            </form>
            <div id="odgovor"></div>
          </div>
        </div>
      </div>
    </div>

    
    <?php
      include_once "includes/footer.php";
      include_once "includes/loader.php";
      include_once "includes/scripts.php";
    ?>    
  </body>
</html>