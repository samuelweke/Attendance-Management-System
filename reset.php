<?php 
  
  include('connect.php');


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
        <p class="att pt-5">Attendance Management System</p>
        <!-- <p>Log in to your account</p> -->
      </div>

      <div class="card">
        <form method="post" class="form-horizontal">

          <div class="form-group">
              <div class="">
                  <input type="email" name="email"  class="form-control" id="input1" placeholder="Enter your Email" />
              </div>
          </div>

          <input type="submit" class="btn btn-block btn-primary btn-login " value="Recover your Password" name="reset" />
        </form>
      </div>

      <div class="login-footer">
        <p><a href="index.php">Login</a></p>
        <p><a href="signup.php">Don't have an account?</a></p>
      </div>

      <div style="margin-top: 20px;">
      <div>

        <?php

            if(isset($_POST['reset'])){

            $test = $_POST['email'];
            $row = 0;
            $query = mysqli_query($mysqli,"SELECT password FROM admininfo WHERE email = '$test'") or die(mysqli_error($mysqli));
            $row = mysqli_num_rows($query);

            if($row == 0){
        ?>

        <div><p>Sorry, this email is not associated with any account</p></div>

        <?php
            }

            else{

              $query = mysqli_query($mysqli, "SELECT password FROM admininfo WHERE email = '$test'") or die(mysqli_error($mysqli));
              $i =0;
              while($dat = mysqli_fetch_array($query)){
                  $i++;
        ?>
        
        <p >Hi <br>You requested for a password recovery. You may <a href="index.php">Login here</a> and enter this key as your password to login. Recovery key: <mark><?php echo $dat['password']; ?></mark><br>Regards,<br>Attendance Management System </p>
        <?php
          }
            }
    }


         ?>

    </div>
  </div>

    </div>
  </div>

  
</body>

</html>
