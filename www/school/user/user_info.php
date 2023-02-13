<?php

$statement = $conn->prepare("SELECT * FROM student WHERE student_id = :sid");

$statement->bindParam(":sid",$_SESSION['id']);
$statement->execute();


if($statement->rowCount() < 1){
	header("location:login.php?error=This record does not exists");
	exit();
	}

$current_user_data = $statement->fetch(PDO::FETCH_BOTH);


?>