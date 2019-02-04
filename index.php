<?php

if(isset($_POST['login']))
{
	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		
		//establishing connection with db and things
		include ('connect.php');
		
		//checking login info into database
		
		$result=mysqli_query($mysqli, "SELECT COUNT(*) as 'c' FROM admininfo WHERE username = '".$_POST['username']."' AND password='".$_POST['password']."' and type='".$_POST['type']."' ") or die(mysqli_error($mysqli));

		$row = mysqli_fetch_assoc($result);

		if($row['c'] > 0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/students.php');
		}

		else if($row['c'] > 0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/report.php');
		}

		else if($row['c'] > 0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username or Password is wrong!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}

?>



<!DOCTYPE html>
<html>

	<head>
		<title>Attendance Management System </title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>

		<?php
		//printing error message
		if(isset($error_msg))
		{
			echo $error_msg;
		}
		?>

		<div class="container">
			<div class="card-center">

				<div class="text-center">
					<p class="att">Attendance Management System</p>
					<!-- <p>Log in to your account</p> -->
				</div>

				<div class="card">
					<form method="post" class="form-horizontal">

						<div class="form-group">
						   <div>
						      	<input type="text" name="username"  class="form-control" id="input1" placeholder="Username" />
						    </div>
						</div>

						<div class="form-group">
						   <div>
						      	<input type="password" name="password"  class="form-control" id="input1" placeholder="Password" />
						    </div>
						</div>

						<div class="form-group">
							<div class="login-label">
								<label>
									<input type="radio" class="custom-radio" name="type" id="optionsRadios1" value="student" checked> Student
								</label>
							  	<label>
							    	<input type="radio" class="custom-radio" name="type" id="optionsRadios1" value="teacher"> Teacher
							 	</label>
							    <label>
							    	<input type="radio" class="custom-radio" name="type" id="optionsRadios1" value="admin"> Admin
							    </label>
							</div>
						</div>

						<input type="submit" class="btn btn-block btn-primary btn-login " value="Login" name="login" />
					</form>
				</div>

				<div class="login-footer">
					<p><a href="reset.php">Forgot your password?</a></p>
					<p><a href="signup.php">Don't have an account?</a></p>
				</div>

			</div>
		</div>

	</body>
</html>