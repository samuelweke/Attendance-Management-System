<?php

include('connect.php');

  try{
    
      if(isset($_POST['signup'])){     

        $result = mysqli_query($mysqli, "INSERT INTO admin(email,username,password,fname,type) VALUES('$_POST[email]','$_POST[uname]','$_POST[pass]','$_POST[fname]','$_POST[type]')") or die(mysqli_error($mysqli));
        $success_msg="Signup Successfully!";

  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
  }

?>



<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Attendance Management System </title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

<body>
  <div class="container">
      <div class="card-center" style="margin-top: 20px; margin-bottom: 0;">

        <div class="text-center">
          <p class="att py-0">Attendance Management System</p>
          <!-- <p>Log in to your account</p> -->
        </div>

        <div class="card">
          <form method="post" class="form-horizontal">

            <div class="form-group">
                <div>
                    <input type="text" name="email"  class="form-control" id="input1" placeholder="Email" required />
                </div>
            </div>

            <div class="form-group">
                <div>
                    <input type="text" name="uname"  class="form-control" id="input1" placeholder="Username" required />
                </div>
            </div>

            <div class="form-group">
                <div>
                    <input type="password" name="pass"  class="form-control" id="input1" placeholder="Password" required />
                </div>
            </div>

            <div class="form-group">
                <div>
                    <input type="text" name="fname"  class="form-control" id="input1" placeholder="Full Name" required />
                </div>
            </div>

            <div class="form-group">
              <div class="login-label">
                <label>
                  <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
                </label>
                  <label>
                    <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
                </label>
                  <label>
                    <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
                  </label>
              </div>
            </div>

            <input type="submit" class="btn btn-block btn-primary btn-login " value="Sign Up" name="signup" />
          </form>
        </div>

        <div class="login-footer">
          <p class="mb-0"><a href="index.php">Already have an account?</a></p>
        </div>

      </div>
    </div>

    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>


</body>
</html>
