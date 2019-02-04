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
      $att_msg = "Attendance Recorded Successfully!";

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
      <title>Attendance Management System </title>
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
      <style type="text/css">
        a:hover{
    text-decoration: none;
}
        .attendance{
            margin-top: 50px ;
            margin-bottom: 60px;
        }

        .attendance > p:first-of-type{
          font-size: 22px;
          font-weight: 600;
        }

        .attendance > p:nth-of-type(2){
          font-size: 16px;
          font-weight: 500;
          background-color: #3da822;
          max-width: 260px;
          text-align: center;
        }

        .show-form{
          max-width: 260px; 
        }

        .mark-att select{
          max-width: 260px;
        }

        .att-table{
          margin-top: 80px;
        }

        .att-table button{
          max-width: 200px;
          margin:auto;
        }

      </style>
  </head>

  <body>
    <!-- Header Begins Here -->
    <?php include("../includes/header-teacher.php");?>
    <!-- Header Begins Here -->
    
    
    <div class="container">
      <div class="attendance">
          <p>Attendance of <?php echo date('Y-m-d'); ?></p>
          <p><?php if(isset($att_msg)) echo $att_msg; if(isset($error_msg)) echo $error_msg; ?></p>

          <div class="show-form">
            <form action="" method="post" class="form-group">
              <div class="form-group">
                <div>
                  <input type="text" name="whichbatch" class="form-control" placeholder="Enter the batch to continue" />
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="batch">Show</button>
            </form>
          </div>

          <div class="mark-att">
            <form action="" method="post">
              <div class="form-group">
                <select name="whichcourse" id="input1" class="form-control">
                  <option>Select Course</option>
                <?php   

                    $query = "SELECT * FROM courses";
                    $rs = mysqli_query($mysqli, $query) or die(mysql_error($mysqli));

                    while ($row = mysqli_fetch_assoc($rs))
                    {
                      echo '<option name="'.$row['course_code'].'" value="'.$row['course_title'].'">'.$row['course_code'].' - '.$row['course_title'].'</option>';
                    }
                ?>
               </select>
              </div>

              <div class="att-table">
                <table class="table table-striped table-bordered table-responsive-md">
                  <thead>
                    <tr>
                      <th scope="col">Matric No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Department</th>
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
                         <td><?php echo $data['st_email']; ?></td>
                         <td>
                           <div >
                             <label>Present</label>
                           <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present"  checked>
                           <label>Absent </label>
                           <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent" >
                           </div>
                         </td>
                       </tr>
                     </body>

                     <?php

                     $radio++;
                   } 
                 }
                 ?>
              </table>
              <button type="submit" class="btn btn-primary btn-block" name="att">Save</button>
              </div>

          
            
          

            </form>
          </div>
      </div>
    </div>

  </body>
</html>
