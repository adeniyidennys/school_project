<?php
session_start();
include '../include/db.php';


if(array_key_exists("submit",$_POST)){
	
	$error = array();
	
	if(empty($_POST['phone_number'])){
		$error['phone_number'] = "Please Enter Phone Number";
	}else{
		
		if(!is_numeric($_POST['phone_number'])){
		$error['phone_number'] ="Please Enter a Numeric Value";
		}
		
		}
	
	if(empty($error)){
		$statement = $conn->prepare("SELECT * FROM student WHERE phone_number = :num");
		$statement->bindParam(":num",$_POST['phone_number']);
		$statement->execute();
		
	if($statement->rowCount() > 0){
		//if record exist
		$row = $statement->fetch(PDO::FETCH_BOTH);
		$_SESSION['id'] = $row['student_id'];
		header("location:dashboard.php");
		exit();
	}else{
			
		header("location:login.php?error=Incorrect Phone Number");
		exit();	
			
			
			}	
		
		}
	
	
	}




?>










<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student login</title>
</head>

<body>
<h1>Ekiti State University</h1>
<hr/>
<form action="" method="post">

<?php
if(isset($error['phone_number'])){
	echo $error['phone_number'] ;
	}
?>

<p>Phone Number: <input type="text" name="phone_number"/></p>
<input type="submit" name="submit" value="Login"/>



</form


>






</body>
</html>