<?php

include('connect.php');

  try{
    
      if(isset($_POST['signup'])){

        if(empty($_POST['email'])){
          throw new Exception("Email can't be empty.");
        }

        if(empty($_POST['uname'])){
           throw new Exception("Username can't be empty.");
        }

        if(empty($_POST['pass'])){
           throw new Exception("Password can't be empty.");
        }
        
        if(empty($_POST['fname'])){
           throw new Exception("Username can't be empty.");
        }
        if(empty($_POST['phone'])){
           throw new Exception("Username can't be empty.");
        }
        if(empty($_POST['type'])){
           throw new Exception("Username can't be empty.");
        }

        $result = mysqli_query($mysqli, "INSERT INTO admininfo(username,password,email,fname,phone,type) VALUES('$_POST[uname]','$_POST[pass]','$_POST[email]','$_POST[fname]','$_POST[phone]','$_POST[type]')") or die(mysqli_error($mysqli));
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
      <div class="card-center">

        <div class="text-center">
          <p class="att py-0">Attendance Management System</p>
          <!-- <p>Log in to your account</p> -->
        </div>

        <div class="card">
          <form method="post" class="form-horizontal">

            <div class="form-group">
                <div class="">
                    <input type="text" name="email"  class="form-control" id="input1" placeholder="Email" />
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <input type="text" name="uname"  class="form-control" id="input1" placeholder="Username" />
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <input type="password" name="password"  class="form-control" id="input1" placeholder="Password" />
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <input type="text" name="fname"  class="form-control" id="input1" placeholder="Full Name" />
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <input type="text" name="phone"  class="form-control" id="input1" placeholder="Phone Number" />
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
          <p><a href="index.php">Already have an account?</a></p>
        </div>

      </div>
    </div>

    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>


</body>
</html>
