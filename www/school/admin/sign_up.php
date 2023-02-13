<?php

include "../include/db.php";


if(isset($_POST['submit'])){
	$error = array();
	
	if(empty($_POST['fullname'])){
		$error['fullname'] = "Please enter Full name";
		}
	if(empty($_POST['username'])){
		$error['username'] = "Please enter username";
		}	
	if(empty($_POST['email'])){
		$error['email'] = "Enter email";
		}else{
	$statement = $conn->prepare("SELECT * FROM admin WHERE email = :em");
	$statement->bindParam(":em",$_POST['email']);
	$statement->execute();	
	if($statement->rowCount() > 0){
		$error['email'] = "Email already exists";
		}
		}	
	if(empty($_POST['hash'])){
		$error['hash'] = "Enter Password";
		}
	if(empty($_POST['confirm_hash'])){
		$error['confirm_hash'] = "Confirm Password";
		
	}elseif($_POST['confirm_hash'] !== $_POST['hash']){
		$error['confirm_hash'] = "Password mismatched";
		}
	if(empty($error)){
		$hash = password_hash($_POST['hash'],PASSWORD_BCRYPT);
		
		$stmt = $conn->prepare("INSERT INTO admin VALUES(NULL,:fn,:us,:em,:hsh,NOW(),NOW())");
    $stmt->bindParam(":fn",$_POST['fullname']);
	$stmt->bindParam(":us",$_POST['username']);
	$stmt->bindParam(":em",$_POST['email']);
	$stmt->bindParam(":hsh",$hash);
	
	$stmt->execute();
	
	header("Location:login.php?message=Dear ". $_POST['username'].", your account has been created, you can now log in");


		
		}			
	
	
	}




?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form action="" method="post">
<?php if(isset($error['fullname'])){
	echo $error['fullname'];
	}

?>
<p>Fullname: <input type="text" name="fullname" /></p>
<?php if(isset($error['username'])){
	echo $error['username'];
	}
?>
<p>Username: <input type="text" name="username"/></p>
<?php if(isset($error['email'])){
	echo $error['email'];
	}
?>
<p>Email: <input type="text" name="email"/></p>
<?php if(isset($error['hash'])){
	echo $error['hash'];
	}
?>
<p>Password: <input type="password" name="hash"/></p>
<?php if(isset($error['confirm_hash'])){
	echo $error['confirm_hash'];
	}
?>
<p>Confirm Password: <input type="password" name="confirm_hash" /></p>
<br/>
<input type="submit" name="submit" value="Create Account"/>


</form>
</body>
</html>