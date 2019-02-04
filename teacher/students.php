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

    <div class="container">
      <div class="view-stu">
        <p>View Students</p>
      </div>

      <form method="post" action="">
        <div class="form-group">
            <div class="dept-form">
              <!-- <input type="text" name="sr_batch"  class="form-control" placeholder="Enter Department" /> -->
              <select name="sr_batch" class="form-control">
                  <option value>Enter Department</option>
                 <?php   
                 $query = "SELECT * FROM students";
                 $rs = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

                 while ($row = mysqli_fetch_assoc($rs))
                 {
                  echo '<option name="'.$row['st_dept'].'" >'.$row['st_dept'].' </option>';
                }
                ?>
              </select>

              <div class="form-group">
                <div>
                  <button type="submit" class="btn btn-primary  btn-block" name="sr_btn">Enter</button>
                </div>
              </div>  
            </div>

        </div>
      </form>

      <div class="stu-table">
        <table class="table table-striped table-bordered ">
          <thead>
            <tr>
              <th scope="col">Matric No</th>
              <th scope="col">Name</th>
              <th scope="col">Department</th>
              <th scope="col">Batch</th>
              <th scope="col">Email</th>
            </tr>
          </thead>

         <?php

          if(isset($_POST['sr_btn'])){
           
           $srdept = $_POST['sr_batch'];
           $i=0;
           
           $all_query = mysqli_query($mysqli, "SELECT * FROM students WHERE students.st_dept = '$srdept' ORDER BY st_id ASC ") or die(mysqli_error($mysqli));
           
           while ($data = mysqli_fetch_array($all_query)) {
             $i++;
           
           ?>

          <tbody>
             <tr>
               <td><?php echo $data['st_id']; ?></td>
               <td><?php echo $data['st_name']; ?></td>
               <td><?php echo $data['st_dept']; ?></td>
               <td><?php echo $data['st_batch']; ?></td>
               <td><?php echo $data['st_email']; ?></td>
             </tr>
          </tbody>

         <?php 
              } 
                  }
          ?>
          
        </table>
      </div>

    </div>

  </body>
</html>
