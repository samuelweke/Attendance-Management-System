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
        .stu-det select{
          margin-bottom: 10px;
        }
      </style>
  </head>

  <body>
    
  <!-- Header Begins Here -->
  <?php include("../includes/header-student.php");?>
  <!-- Header Ends Here -->

  <div class="container">
    <h3>My Report</h3>
    <div class="form-group stu-det">
      <form method="post" action="">
        <select class="form-control" name="whichcourse" id="input1">
           <?php   
            $query = "SELECT * FROM courses";
            $rs = mysqli_query($mysqli, $query) or die(mysql_error($mysqli));

            while ($row = mysqli_fetch_assoc($rs))
            {
              echo '<option name="'.$row['course_code'].'" value="'.$row['course_title'].'">'.$row['course_code'].' - '.$row['course_title'].'</option>';
            }
            ?>
        </select>

        <div class="form-group">
          <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="Enter your Matric No"/>
          <button type="submit" class="btn btn-primary btn-block" name="sr_btn">Show</button>
        </div>  
      </form>
    </div>
      

      <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
      <table class="table table-striped">

     <?php

      //checking the form for ID
      if(isset($_POST['sr_btn'])){

      //initializing ID 
       $sr_id = $_POST['sr_id'];
       $course = $_POST['whichcourse'];

       $i=0;
       $count_pre = 0;
       
       //query for searching respective ID
       $all_query = mysqli_query($mysqli, "SELECT * FROM attendance WHERE attendance.stat_id='$sr_id' AND attendance.course = '$course'") or die(mysqli_error($mysqli));
       $Total_Count = mysqli_num_rows($all_query);

       while ($data = mysqli_fetch_array($all_query)) {
         $i++;
         if($data['st_status'] == "Present"){
            $count_pre++;
         }
         if($i <= 1){
       ?>


       <tbody>
             <?php
           }
          
          }

        ?>
        
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
     
       ?>
      </table>
    </form>
      </div>


  </body>

</html>
