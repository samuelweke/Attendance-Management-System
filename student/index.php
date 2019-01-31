<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
	    <?php include("../includes/head-tag.php");?>
	</head>
	
	<body>

	<!-- Header Begins Here -->
	<?php include("../includes/header-student.php");?>
	<!-- Header Ends Here -->

	</body>

</html>
