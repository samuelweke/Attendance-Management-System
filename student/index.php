<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ..//index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
    <?php include("../includes/head-tag.php");?>
</head>
<!-- head ended -->

<!-- body started -->
<body>
	
<!-- Header Begins Here -->
<?php include("../includes/header-student.php");?>
<!-- Header Ends Here -->

<!-- Menus ended -->

<center>


</center>

</body>
<!-- Body ended  -->

</html>
