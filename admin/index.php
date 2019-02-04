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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">

    .message{
      padding: 10px;
      font-size: 15px;
      font-style: bold;
      color: black;
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

<div class="text-center">
  <center>
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->

<div class="content">

  <div class="text-center">
    Select: <a href="#teacher">Teacher</a> | <a href="">Student</a> 
  </div>

  <div class="row" id="student">
      <form method="post" class="form-horizontal col-md-6 col-md-offset-3">

        <h4>Add Student's Information</h4>
        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Student ID</label>
            <div class="col-sm-7">
              <input type="text" name="st_id"  class="form-control" id="input1" placeholder="student id" />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-7">
              <input type="text" name="st_name"  class="form-control" id="input1" placeholder="student full name" />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Department</label>
            <div class="col-sm-7">
              <input type="text" name="st_dept"  class="form-control" id="input1" placeholder="department ex. CSE" />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Batch</label>
            <div class="col-sm-7">
              <input type="text" name="st_batch"  class="form-control" id="input1" placeholder="batch e.x 38" />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Semester</label>
            <div class="col-sm-7">
              <input type="text" name="st_sem"  class="form-control" id="input1" placeholder="semester ex. Fall-15" />
            </div>
        </div>

        <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-7">
              <input type="email" name="st_email"  class="form-control" id="input1" placeholder="valid email" />
            </div>
        </div>

        <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add Student" name="std" />

    </form>
  </div>

  <div class="rowtwo" id="teacher">
    <form method="post" class="form-horizontal col-md-6 col-md-offset-3">

      <h4>Add Teacher's Information</h4>


      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-7">
            <input type="text" name="tc_dept"  class="form-control" id="input1" placeholder="department ex. CSE" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="tc_email"  class="form-control" id="input1" placeholder="valid email" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Course Name</label>
          <div class="col-sm-7">
            <input type="text" name="tc_course"  class="form-control" id="input1" placeholder="course ex. Software Engineering" />
          </div>
      </div>

      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add Teacher" name="tcr" />

    </form>
  </div>


</div>
<!-- Contents, Tables, Forms, Images ended -->

</center>
</div>
</body>
<!-- Body ended  -->
</html>
