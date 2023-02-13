<?php
session_start();
include 'authenticate.php';
include '../include/db.php';

if(isset($_GET['id'])){
	
	$student_id = $_GET['id'];
	}else{
		header("location:student.php");
		}
		
$statement = $conn->prepare("SELECT * FROM student");
$statement->execute();
	$select= array();
	while($row=$statement->fetch(PDO::FETCH_BOTH)){
		$select[]=$row;
		
		}	
		
$stmt = $conn->prepare("SELECT * FROM student WHERE student_id=:sid");
$stmt->bindParam(":sid",$student_id);		
$stmt->execute();

$record = $stmt->fetch(PDO::FETCH_BOTH);

if($stmt ->rowCount()<1){
	
	header("location:student.php");
	
	exit();
	}
	
	
if(isset($_POST['submit'])){
	$error = array();
	
	
if(empty($_POST['name'])){
	$error['name'] = "Enter name";
	
	}	
if(empty($_POST['email'])){
	$error['email'] = "Enter email";
	
	}
if(empty($_POST['department'])){
	$error['department'] = "Enter Department";
	
	}
if(empty($_POST['course'])){
	$error['course'] = "Enter Course code and Title";
	
	}
if(empty($_POST['number'])){
	$error['number'] = "Enter Phone number";
	
	}					
if(empty($error)){
	
	$statement = $conn ->prepare("UPDATE student SET name=:nm,email=:em,department=:dp,course=:cc,phone_number=:num WHERE student_id=:sid");
	
	$statement->bindParam(":nm",$_POST['name']);
	$statement->bindParam(":em",$_POST['email']);
	$statement->bindParam(":dp",$_POST['department']);
	$statement->bindParam(":cc",$_POST['course']);
	$statement->bindParam(":num",$_POST['number']);
	$statement->bindParam(":sid",$student_id);
	
	$statement->execute();
	header("location:student.php");
	
	}	
		
	
	
	
	}	

?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student</title>
</head>

<body>
<h1>Edit Student Profile</h1>
<?php include "header.php";?>
<br/>

<form action="" method="post">
<p>Name: <input type="text" name="name" value="<?= $record['name']?>"/></p>
<p>Email: <input type="text" name="email" value="<?= $record['email']?>"/></p>
<p>Department: <input type="text" name="department" value="<?=$record['department']?>"/></p>
<p>Course code and Title: <textarea name="course" placeholder="<?= $record['course']?>" ></textarea></p>
<p>Phone number: <input type="text" name="number" value="<?= $record['phone_number']?>" /></p>
<br/>
<input type="submit" name="submit" value="Update Profile"/>
</form>





</body>
</html>