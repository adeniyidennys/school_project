<?php  

session_start();
include 'authenticate.php';
include '../include/db.php';
if(!isset($_GET['id'])){
	
	header("location:student.php");
	exit();
	}

$statement = $conn->prepare("DELETE FROM student WHERE student_id=:sid");
$statement->bindParam(":sid",$_GET['id']);
$statement->execute();

header("location:student.php");
exit();





?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>