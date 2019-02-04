  <?php

  ob_start();
  session_start();

  //checking if the session is valid
  if($_SESSION['name']!='oasis')
  {
    header('location: am/login.php');
  }
  ?>

  <?php include('connect.php');?>


<?php 
try{

         //checking form data and empty fields
          if(isset($_POST['done'])){

          if (empty($_POST['name'])) {
            throw new Exception("Name cannot be empty");
            
          }
              if (empty($_POST['dept'])) {
               
                throw new Exception("Department cannot be empty");
                
              }
                  if(empty($_POST['batch']))
                  {
                    throw new Exception("Batch cannot be empty");
                    
                  }
                      if(empty($_POST['email']))
                      {
                        throw new Exception("Email cannot be empty");
                        
                      }

  //initializing the student id
  $sid = $_POST['id'];

  //udating students information to database table "students"
  $result = mysqli_query($mysqli, "UPDATE students SET st_name='$_POST[name]',st_dept='$_POST[dept]',st_batch='$_POST[batch]',st_sem='$_POST[semester]', st_email = '$_POST[email]' WHERE st_id='$sid'") or die(mysqli_error($mysqli));
  $success_msg = 'Updated  successfully';
  
  }

}
catch(Exception $e){

  $error_msg =$e->getMessage();
}


?>



<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
    <?php include("../includes/head-tag.php");?>
    <style type="text/css">
      a:hover{
    text-decoration: none;
}
    </style>
</head>
<!-- head ended -->


<!-- body started -->
<body>
  
<!-- Header Begins Here -->
<?php include("../includes/header-student.php");?>
<!-- Header Ends Here -->

<!-- Content, Tables, Forms, Texts, Images started -->
<center>
<div class="content">
  <div class="row">
    <div class="content">

          <h3>Update Account</h3>
          <br>
          
          <!-- Error or Success Message printint started --><p>
      <?php

          if(isset($success_msg))
          {
            echo $success_msg;
          }
          if(isset($error_msg))
          {
            echo $error_msg;
          }

        ?>
          </p><!-- Error or Success Message printint ended -->

          <br>
   
          <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Student ID</label>
                <div class="col-sm-7">
                  <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="Enter you Matric No " />
                </div>
            </div>
            <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Show" name="sr_btn" />
          </form>
          <div class="content"></div>


      <?php

      if(isset($_POST['sr_btn'])){

      //initializing student ID from form data
       $sr_id = $_POST['sr_id'];

       $i=0;

       //searching students information respected to the particular ID
       $all_query = mysqli_query($mysqli, "SELECT * FROM students WHERE students.st_id='$sr_id'") or die(mysqli_error($mysqli));
       while ($data = mysqli_fetch_array($all_query)) {
         $i++;
       
       ?>
<form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
   <table class="table table-striped">
  
          <tr>
            <td>Student ID:</td>
            <td><?php echo $data['st_id']; ?></td>
          </tr>

          <tr>
              <td>Student's Name:</td>
              <td><input type="text" name="name" value="<?php echo $data['st_name']; ?>"></input></td>
          </tr>

          <tr>
              <td>Department:</td>
              <td><input type="text" name="dept" value="<?php echo $data['st_dept']; ?>"></input></td>
          </tr>

          <tr>
              <td>Batch:</td>
              <td><input type="text" name="batch" value="<?php echo $data['st_batch']; ?>"></input></td>
          </tr>
          
          <tr>
              <td>Semester:</td>
              <td><input type="text" name="semester" value="<?php echo $data['st_sem']; ?>"></input></td>
          </tr>

          <tr>
              <td>Email:</td>
              <td><input type="text" name="email" value="<?php echo $data['st_email']; ?>"></input></td>
          </tr>
          <input type="hidden" name="id" value="<?php echo $sr_id; ?>">
          
          <tr>
                <td></td>
                <td><input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Update" name="done" /></td>
          </tr>

    </table>
</form>
     <?php 
   } 
     }  
     ?>


      </div>

  </div>
</div>

  </center>
<!-- Contents, Tables, Forms, Images ended -->

</body>
<!-- Menus ended -->

</html>
