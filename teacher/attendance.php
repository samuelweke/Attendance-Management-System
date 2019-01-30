<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: login.php');
}
?>

<?php
include('connect.php');
try{

  if(isset($_POST['att'])){

    $course = $_POST['whichcourse'];

    foreach ($_POST['st_status'] as $i => $st_status) {

      $stat_id = $_POST['stat_id'][$i];
      $dp = date('Y-m-d');
      $course = $_POST['whichcourse'];

      $stat = "INSERT into attendance(stat_id,course,st_status,stat_date)
      VALUES ('$stat_id','$course','$st_status', '$dp')" ;

      $result = mysqli_query($mysqli, $stat) or die(mysqli_error($mysqli));
      $att_msg = "Attendance Recorded.";

    }

  }
}
catch(Execption $e){
  $error_msg = $e->$getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Attendance Management System </title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

  <link rel="stylesheet" href="styles.css" >

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <style type="text/css">
  .status{
    font-size: 10px;
  }

</style>

</head>
<body>

  <header>

    <h1>Online Attendance Management System </h1>
    <div class="navbar">
      <a href="index.php">Home</a>
      <a href="students.php">Students</a>
      <a href="teachers.php">Faculties</a>
      <a href="attendance.php">Attendance</a>
      <a href="report.php">Report</a>
      <a href="..//logout.php">Logout</a>

    </div>

  </header>

  <center>

    <div class="row">

      <div class="content">
        <h3>Attendance of <?php echo date('Y-m-d'); ?></h3>
        <br>

        <center><p><?php if(isset($att_msg)) echo $att_msg; if(isset($error_msg)) echo $error_msg; ?></p></center> 

        <form action="" method="post" class="form-horizontal ">

         <div class="form-group">

           <label for="input1" class="col-sm-3 control-label">Select Batch</label>
           <div class="col-sm-7">
            <input type="text" name="whichbatch"  class="form-control" id="input1" placeholder="enter your batch to continue" />

          </div>


          <input type="submit" class="btn btn-primary col-md-2 " value="Show!" name="batch" />

        </form>

        <div class="content"></div>
        <form action="" method="post">

          <div class="form-group">
            <label >Select Course</label>
            <select name="whichcourse" id="input1">

            <?php   

                $query = "SELECT * FROM courses";
                $rs = mysqli_query($mysqli, $query) or die(mysql_error($mysqli));

                while ($row = mysqli_fetch_assoc($rs))
                {
                  echo '<option name="'.$row['course_id'].'" value="'.$row['course_title'].'">'.$row['course_id'].' - '.$row['course_title'].'</option>';
                }
            ?>

           </select>
         </div>

         <table class="table table-stripped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Department</th>
              <th scope="col">Batch</th>
              <th scope="col">Semester</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <?php

          if(isset($_POST['batch'])){

           $i=0;
           $radio = 0;
           $batch = $_POST['whichbatch'];
           $all_query = mysqli_query($mysqli, "SELECT * FROM students WHERE st_batch='$batch' ORDER BY st_id ASC") or die(mysqli_error($mysqli));

           while ($data = mysqli_fetch_array($all_query)) {
             $i++;
             ?>
             <body>
               <tr>
                 <td><?php echo $data['st_id']; ?> <input type="hidden" name="stat_id[]" value="<?php echo $data['st_id']; ?>"> </td>
                 <td><?php echo $data['st_name']; ?></td>
                 <td><?php echo $data['st_dept']; ?></td>
                 <td><?php echo $data['st_batch']; ?></td>
                 <td><?php echo $data['st_sem']; ?></td>
                 <td><?php echo $data['st_email']; ?></td>
                 <td>
                   <label>Present</label>
                   <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present" checked>
                   <label>Absent </label>
                   <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent">
                 </td>
               </tr>
             </body>

             <?php

             $radio++;
           } 
         }
         ?>
       </table>

       <center><br>
        <input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Save!" name="att" />
      </center>

    </form>
  </div>

</div>

</center>

</body>
</html>
