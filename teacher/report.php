  <?php

  ob_start();
  session_start();

  if($_SESSION['name']!='oasis')
  {
    header('location: login.php');
  }
  ?>
  <?php include('connect.php');?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include("../includes/head-tag.php");?>
  </head>
  <body>
    <!-- Header Begins Here -->
    <?php include("../includes/header-teacher.php");?>
    <!-- Header Ends Here -->

    <center>

      <div class="row">

        <div class="content">
          <!-- Individual Report Form -->
          <h3>Individual Report</h3>
          <form method="post" action="">

            <label>Select Course</label>
            <select name="whichcourse_single">
              <?php   
              $query = "SELECT * FROM courses";
              $rs = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

              while ($row = mysqli_fetch_assoc($rs)){
                echo '<option name="'.$row['course_id'].'" value="'.$row['course_title'].'">'.$row['course_id'].' - '.$row['course_title'].'</option>';
              }
              ?>
            </select>

            <p>  </p>
            <label>Student ID</label>
            <input type="text" name="st_id">
            <input type="submit" name="sr_btn" value="Go!" >

          </form>
          <br/>
        <table class="table table-striped">
          <?php

          if(isset($_POST['sr_btn'])){
           $count_pre = 0;
           $i= 0;

            $st_id = $_POST['st_id'];
            $course = $_POST['whichcourse_single'];

            $single = mysqli_query($mysqli, "SELECT * FROM attendance WHERE attendance.stat_id='$st_id' AND attendance.course = '$course' ") or die(mysqli_error($mysqli));

            while ($row = mysqli_fetch_assoc($single)){

              $single1 = mysqli_query($mysqli, "SELECT * FROM students WHERE st_id = '".$row['stat_id']."' ") or die(mysqli_error($mysqli));

              $Total_Count = mysqli_num_rows($single);

          ?>
          <!--  Individual Form Ends -->
          <?php
           while ($data1 = mysqli_fetch_array($single1)) {
             $i++;
             if($row['st_status'] == "Present"){
              $count_pre++;
            }
            if($i <= 1){
              //echo $count_pre;;
             ?>


             <tbody>
              <tr>
                <td>Student ID: </td>
                <td><?php echo $data1['st_id']; ?></td>
              </tr>

              <tr>
                <td>Student Name: </td>
                <td><?php echo $data1['st_name']; ?></td>
              </tr>

              <tr>
                <td>Department: </td>
                <td><?php echo $data1['st_dept']; ?></td>
              </tr>

              <tr>
                <td>Batch: </td>
                <td><?php echo $data1['st_batch']; ?></td>
              </tr> 

          <tr>
            <td>Total Class (Days): </td>
            <td><?php echo $Total_Count; ?> </td>
          </tr>

          <tr>
            <td>Present (Days): </td>
            <td><?php echo $count_pre; ?> </td>
          </tr>

          <tr>
            <td>Absent (Days): </td>
            <td><?php echo $Total_Count -  $count_pre; ?> </td>
          </tr>

        </tbody>

              <?php
            }
        }
     }
  }
      ?>
      <!-- Single Php Code Ends -->

      <!-- Mass Report Form Starts -->
          <h3>Mass Report</h3>
          <form method="post" action="">

            <label>Select Course</label>
            <select name="whichcourse_mass">
             <?php   
             $query = "SELECT * FROM courses";
             $rs = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

             while ($row = mysqli_fetch_assoc($rs))
             {
              echo '<option name="'.$row['course_id'].'" value="'.$row['course_title'].'">'.$row['course_id'].' - '.$row['course_title'].'</option>';
            }
            ?>
          </select>
          <p>  </p>
          <label>Date ( yyyy-mm-dd )</label>
          <input type="text" name="date">
          <input type="submit" name="sr_date" value="Go!" >
        </form>
        <!-- Mass Report Ends -->

          <table class="table table-stripped">
            <thead>
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col">Batch</th>
                <th scope="col">Date</th>
                <th scope="col">Attendance Status</th>
              </tr>
            </thead>

        <?php
        if(isset($_POST['sr_date'])){

          $sdate = $_POST['date'];
          $course = $_POST['whichcourse_mass'];

          $mass = mysqli_query($mysqli, "SELECT * FROM attendance WHERE attendance.stat_date='$sdate' AND attendance.course = '$course'") or die(mysqli_error($mysqli));
            while ($row = mysqli_fetch_assoc($mass)){
              $mass1 = mysqli_query($mysqli, "SELECT * FROM students WHERE st_id = '".$row['stat_id']."' ") or die(mysqli_error($mysqli));
            while ($data = mysqli_fetch_array($mass1)) {

             //$i++;
             ?>
             <tbody>
               <tr>
                 <td><?php echo $data['st_id']; ?></td>
                 <td><?php echo $data['st_name']; ?></td>
                 <td><?php echo $data['st_dept']; ?></td>
                 <td><?php echo $data['st_batch']; ?></td>
                 <td><?php echo $row['stat_date']; ?></td>
                 <td><?php echo $row['st_status']; ?></td>
               </tr>
             </tbody>

             <?php 
         }
       }
     }
         ?>

       </table>


       <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    </table>
  </form>

  </div>

  </div>

  </center>

  </body>
  </html>