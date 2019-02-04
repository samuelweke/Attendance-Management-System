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
    <style>
      .report{
        margin-top: 50px;
        margin-bottom: 60px;
      }
      .ind-report, .mass-report, .overall-report{
        max-width: 260px;
      }
      .report p {
        font-size: 22px;
        font-weight: 600;
      }
      .form-group select{
        margin-bottom: 1rem;
      }
      .form-group input{
        margin-bottom: 1rem;
      }
      .ind-table, .mass-table, .overall-table{
        margin-top: 50px;
        margin-bottom: 50px;
      }
    </style>
  </head>

<body>
  <!-- Header Begins Here -->
  <?php include("../includes/header-teacher.php");?>
  <!-- Header Ends Here -->

 
  <div class="container">
    <div class="report">
      <p>Individual Report</p>

      <div class="ind-report">
        <form class="form-group" method="post" action="">
          <select name="whichcourse_single" class="form-control">
            <?php   
            $query = "SELECT * FROM courses";
            $rs = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

            while ($row = mysqli_fetch_assoc($rs)){
              echo '<option name="'.$row['course_code'].'" value="'.$row['course_title'].'">'.$row['course_code'].' - '.$row['course_title'].'</option>';
            }
            ?>
          </select>
          <input class="form-control" type="text" name="st_id" placeholder="Enter Matric No">
          <button type="submit" class="btn btn-primary btn-block" name="sr_btn">Enter</button>
      </form>
    </div>

      <div class="ind-table">
        <table class="table table-striped table-responsive">
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
              <td>Matric No: </td>
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
              <td>Course Title: </td>
              <td><?php echo $course; ?></td>
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
            <tr>
              <td>Percentage Present</td>
              <td><?php echo ($count_pre / $Total_Count) * 100 , "%" ?> </td>
            </tr>
          </tbody>

          <?php
              }
          
            }     }
            }
          ?>
        </table>
      </div>
      <!-- Single Php Code Ends -->

      <!-- Mass Report Form Starts -->
          <p>Date Report</p>
          <div class="mass-report">
            <form class="form-group" method="post" action="">
              <select class="form-control" name="whichcourse_mass" >
                <option>Select Course</option>
                <?php   
                  $query = "SELECT * FROM courses";
                  $rs = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

                  while ($row = mysqli_fetch_assoc($rs))
                  {
                    echo '<option name="'.$row['course_code'].'" value="'.$row['course_title'].'">'.$row['course_code'].' - '.$row['course_title'].'</option>';
                  }
                ?>
              </select>
              <input class="form-control" type="date" name="date" placeholder="Date (yyyy-mm-dd)">
              <button type="submit" class="btn btn-primary btn-block" name="sr_date">Enter</button>
            </form>
          </div>
        <!-- Mass Report Ends -->

          <div class="mass-table" id="mass">
            <table class="table table-striped table-bordered table-responsive-md">
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
          </div>

            <!-- Third Report Form Starts -->            
        <p>Overall Report</p>
      <div class="overall-report">
          <form class="form-group" method="post" action="">
            <select name="whichcourse_3" id="whichcourse_3" class="form-control">
              <option>Select Course</option>
             <?php   
             $query = "SELECT * FROM courses";
             $rs = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

             while ($row = mysqli_fetch_assoc($rs))
             {
              echo '<option name="'.$row['course_code'].'" value="'.$row['course_title'].'">'.$row['course_code'].' - '.$row['course_title'].'</option>';
            }
            ?>
          </select>
          <button type="submit" class="btn btn-primary btn-block" name="bt_third">Enter</button>
        </form>
      </div>
        <!-- Third Report Ends -->

          <table class="table table-stripped table-bordered table-responsive-md overall-table">
            <thead>
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col">Batch</th>
                <th scope="col">Total Class Days</th>
                <th scope="col">Days Present</th>
                <th scope="col">Days Absent</th>
                <th scope="col">Percentage Present</th>
              </tr>
            </thead>
        <?php
        if(isset($_POST['bt_third'])){

          $course = $_POST['whichcourse_3'];
          $i = 0;
          $third = mysqli_query($mysqli, "SELECT * FROM attendance WHERE attendance.course = '$course' ") or die(mysqli_error($mysqli));
            while ($row = mysqli_fetch_assoc($third)){
              $third1 = mysqli_query($mysqli, "SELECT * FROM students WHERE st_id = '".$row['stat_id']."' ") or die(mysqli_error($mysqli));
              $Total_Classes = mysqli_num_rows($third);
            while ($data = mysqli_fetch_array($third1)) {
              if (($row['st_status']) == "Present") {
                $i++;
              }
             ?>
             <tbody>
               <tr>
                 <td><?php echo $data['st_id']; ?></td>
                 <td><?php echo $data['st_name']; ?></td>
                 <td><?php echo $data['st_dept']; ?></td>
                 <td><?php echo $data['st_batch']; ?></td>
                 <td><?php echo $Total_Classes ?></td>
                 <td><?php echo $i ?></td>
                 <td><?php echo $Total_Classes - $i ?></td>
                 <td><?php echo ($i / $Total_Classes) *100 , "%" ?></td>
               </tr>
             </tbody>

             <?php 
         }
       }
     }
         ?>


      
    </table>

    </div>
  </div>
</body>
<script>
  
</script>
</html>