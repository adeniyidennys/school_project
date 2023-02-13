<?php
session_start();
include "../include/db.php";
include "authenticate.php";

if(array_key_exists('submit',$_POST)){
   $error = array();	
	if(empty($_POST['title'])){
		$error['title'] = "Enter Title";
		}
	if(empty($_POST['name'])){
		$error['name'] = "Enter Full Name";
		}
	if(empty($_POST['email'])){
		$error['email'] = "Enter Email";
		}
	if(empty($_POST['department'])){
		$error['department'] = "Enter Department";
		}
	if(empty($_POST['course'])){
		$error['course'] = "Enter Course Code and Course Title";
		}
	if(empty($_POST['number'])){
		$error['number'] = "Enter Phone Number";
		}
							
	if(empty($error)){
		
		$stmt = $conn->prepare("INSERT INTO teacher VALUES(NULL,:tt,:nm,:em,:dp,:cc,:num,NOW(),NOW())");
		$stmt->bindParam(":tt",$_POST['title']);
		$stmt->bindParam(":nm",$_POST['name']);
		$stmt->bindParam(":em",$_POST['email']);
		$stmt->bindParam(":dp",$_POST['department']);
		$stmt->bindParam(":cc",$_POST['course']);
		$stmt->bindParam(":num",$_POST['number']);
		$stmt->execute();
		
		header("location:teacher.php");
		exit();
		
		
		}else{
			foreach($error as $err){
				echo "<p style='color:red'>" .$err."</p>" ;
				}
			}	
	
	
	
	
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Teacher Profile</title>
</head>

<body>
<?php include "header.php";?>
<form action="" method="post">
<p>Title: <input type="text" name="title"/></p>
<p>Name: <input type="text" name="name"/></p>
<p>Email: <input type="text" name="email"/></p>
<p>Department: <input type="text" name="department"/></p>
<p>Course code and Title: <textarea name="course"></textarea></p>
<p>Phone number: <input type="text" name="number" /></p>
<br/>
<input type="submit" name="submit" value="Create profile"/>
</form>
<hr/>


<table border="2">
<tr>
   <th>Title</th>
   <th>Name</th>
   <th>Email</th>
   <th>Department</th>
   <th>Course Code:Title</th>
   <th>Phone number</th>    
   <th>Date Created</th>
   <th>Edit</th>
   <th>Delete Profile</th>
     

</tr>

<?php 
$select = $conn->prepare("SELECT * FROM teacher");
$select->execute();

while($row = $select->fetch(PDO::FETCH_BOTH)){
	echo "<tr>";
	echo"<td>".$row['title']."</td>";
	echo"<td>".$row['name']."</td>";
	echo"<td>".$row['email']."</td>";
	echo"<td>".$row['department']."</td>";
	echo"<td>".$row['course']."</td>";
	echo"<td>".$row['phone_number']."</td>";
	echo"<td>".$row['date_created']."</td>";
	echo"<td> <a href='edit_teacher.php?id=".$row['teacher_id']."'> Edit</a></td>";
	echo"<td> <a href='delete_teacher.php?id=".$row['teacher_id']."'> Delete</a></td>";
	
	echo "</tr>";
	
	}
?>

</table>




</body>
</html>