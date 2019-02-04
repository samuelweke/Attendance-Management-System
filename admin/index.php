<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{

  header('location: ../index.php');
}
?>

<?php

include('connect.php');

//data insertion
  try{

    //checking if the data comes from students form
   
    if(isset($_POST['std'])){

      //students data insertion to database table "students"

        $sql = "INSERT into students(st_id,st_name,st_dept,st_batch,st_sem,st_email)
        VALUES ('".$_POST["st_id"]."','".$_POST["st_name"]."','".$_POST["st_dept"]."', 
        '".$_POST["st_batch"]."', '".$_POST["st_sem"]."', '".$_POST["st_email"]."')";

        $result = mysqli_query($mysqli, $sql) or die(mysql_error($mysqli));
        $success_msg = "Student added successfully.";

    }

        //checking if the data comes from teachers form
  

    if(isset($_POST['tcr'])){

          //teachers data insertion to the database table "teachers"

          $sql = "INSERT into teachers(tc_name,tc_dept,tc_email, tc_course)
        VALUES ('".$_POST["tc_name"]."','".$_POST["tc_dept"]."', 
        '".$_POST["tc_email"]."', '".$_POST["tc_course"]."')";

        $result = mysqli_query($mysqli, $sql);
        $success_msg = "Teacher added successfully.";
    }

  }
  catch(Execption $e){
    $error_msg =$e->getMessage();
  }

 ?>



<!DOCTYPE html>
<html lang="en">

  <head>
  <title>Attendance Management System </title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" href="../css/bootstrap.css">

  <style type="text/css">
    a:hover{
    text-decoration: none;
}
    .message{
      padding: 10px;
      font-size: 15px;
      font-style: bold;
      color: black;
    }
    h4{
      padding-left: 15px;
      padding-right: 15px;
      font-size: 22px;
      font-weight: 600;
      padding-bottom: 20px;
    }
    .btn{
      margin-left: 15px;
    }
  </style>
  </head>

<!-- body started -->
<body>

    <!-- Menus started-->
    <header>

      <h1>Attendance Management System </h1>
      <div class="navbar">
      <a href="index.php">Add Data</a>
      <a href="../logout.php">Logout</a>

    </div>

    </header>
    <!-- Menus ended -->

<div class="container">
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->

  <div class="row" style="margin-top: 40px; margin-bottom: 50px;">
    <div class="col-md-6" id="student">
      <form method="post" class="form-horizontal">

        <h4>Add Student's Information</h4>
        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Student ID</label>
            <div class="col-sm-7">
              <input type="text" name="st_id"  class="form-control" id="input1" placeholder="Matric No" required />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-7">
              <input type="text" name="st_name"  class="form-control" id="input1" placeholder="Full Name" required />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Department</label>
            <div class="col-sm-7">
              <input type="text" name="st_dept"  class="form-control" id="input1" placeholder="Department" required />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Batch</label>
            <div class="col-sm-7">
              <input type="text" name="st_batch"  class="form-control" id="input1" placeholder="Batch" required />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-7">
              <input type="email" name="st_email"  class="form-control" id="input1" placeholder="Email" required />
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="std">Add Student</button>

    </form>
  </div>

  <div class="col-md-6" id="teacher">
    <form method="post" class="form-horizontal">

      <h4>Add Teacher's Information</h4>


      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-7">
            <input type="text" name="tc_dept"  class="form-control" id="input1" placeholder="Department" required />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="tc_email"  class="form-control" id="input1" placeholder="Email" required />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Course Name</label>
          <div class="col-sm-7">
            <input type="text" name="tc_course"  class="form-control" id="input1" placeholder="Course" required />
          </div>
      </div>

      <button type="submit" class="btn btn-primary" name="tcr">Add Teacher</button>

    </form>
  </div>
  </div>


</div>
</body>
<!-- Body ended  -->
</html>
