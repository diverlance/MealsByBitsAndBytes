<?php
  include('login.php');
  if(isset($_SESSION['login_user']))
  {
    header("location: profile.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Meal Planner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type = "text/javascript">
      function validateLogin()
      {
          email = document.getElementById("email").value;
          password  = document.getElementById("password").value;

          errors = "";

          emailRE = /^.+@.+\..{2,4}$/;
          if (!email.match(emailRE)){
              errors += "Invalid email address. " +
                        "Should be xxxxx@xxxxx.xxx\n";
          }

          if (password == "")
          {
              errors += "Password is missing.\n";
          }

          if (errors != "")
          {
            alert(errors);
          }
      }
  </script>
</head>
<body>
  <div class="login-box">
  <h1><b>Meal Planner</b></h1>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Home</a></li>
    <li class=""><a href="#signup" data-toggle="tab" aria-expanded="false">Sign-Up</a></li>
  </ul>
  <div id="myTabContent" class="tab-content login-box-body">
    <div class="tab-pane fade active in" id="home">
      <div>
        <p class="login-box-msg"> Sign in to start your Planner </p>
        <form class="loginForm" method="post" action="">
          <!-- Input E-mail -->
          <div class="form-group has-feedback">
            <input class="form-control" name="email" id="email" required="true" placeholder="E-Mail"/><br/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"/>
          </div> <!-- /.Input E-mail -->
          <!-- Input Password -->
          <div class="form-group has-feedback">
            <input class="form-control" type="password" name="password" id="password" required="true" placeholder="Password" /><br/>
            <span class="glyphicon glyphicon-lock form-control-feedback"/>
          </div> <!-- /.Input Password -->
          <!-- Login Button -->
          <div class="row">
            <div class="col-xs-8">
              <!-- Message -->
              <?php
                echo $error;
              ?>
            </div>
            <div class="col-xs-4">
              <button class="btn btn-primary btn-block btn-flat" id="Login" name="submit" type="submit" onclick="validateLogin()">Submit</button>
            </div>
          </div> <!-- /.Login Button -->
        </form> <!-- /.loginForm -->
      </div>
    </div>

    <!-- Sign-Up Form -->
    <div class="tab-pane fade" id="signup">
      <div>
        <div>
          <p class="login-box-msg"> Sign Up to Create Your Planner </p>
          <form class="signupForm" method="post" action="signup.php">
            <!-- Input First Name -->
            <div class="form-group has-feedback">
              <input class="form-control" id="first" name="first" required="true" placeholder="First Name"/><br/>
              <span class="glyphicon glyphicon-user form-control-feedback"/>
            </div> <!-- /.Input First Name -->

            <!-- Input Last Name -->
            <div class="form-group has-feedback">
              <input class="form-control" id="last" name="last" required="true" placeholder="Last Name"/><br/>
              <span class="glyphicon glyphicon-user form-control-feedback"/>
            </div> <!-- /.Input Last Name -->

            <!-- Input E-mail -->
            <div class="form-group has-feedback">
              <input class="form-control" id="email" name="email" required="true" placeholder="E-Mail"/><br/>
              <span class="glyphicon glyphicon-envelope form-control-feedback"/>
            </div> <!-- /.Input E-mail -->

            <!-- Input Password -->
            <div class="form-group has-feedback">
              <input class="form-control" type="password" id="password" name="password" required="true" placeholder="Password" /><br/>
              <span class="glyphicon glyphicon-lock form-control-feedback"/>
            </div> <!-- /.Input Password -->

            <!-- Input re-Password -->
            <div class="form-group has-feedback">
              <input class="form-control" type="password" id="repassword" name="repassword" required="true" placeholder="Re-Password" /><br/>
              <span class="glyphicon glyphicon-lock form-control-feedback"/>
            </div> <!-- /.Input re-Password -->
            <!-- Sign-Up Button -->
            <div class="row">
              <div class="col-xs-8">
              </div>
              <div class="col-xs-4">
                <input class="btn btn-primary btn-block btn-flat" id="submit" name="submit" type="submit"/>
              </div>
            </div> <!-- /.Sign-Up Button -->
          </form> <!-- /.Sign-Up Form -->
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
