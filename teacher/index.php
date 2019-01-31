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

<?php include("../includes/header-teacher.php");?>



</body>
</html>
