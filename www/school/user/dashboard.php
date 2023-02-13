<?php
session_start();

include 'authenticate.php';
include '../include/db.php';

include 'user_info.php';

?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ekiti State University</title>
</head>

<body style="background-color:#09F">
<h1>Ekiti State University</h1>

<h2 style="text-decoration:underline">Student Information</h2>
<h2>Name: <?= $current_user_data['name']?></h2>
<h2>Phone Number: <?= $current_user_data['phone_number']?></h2>
<h3>Email: <?= $current_user_data['email']?></h3>
<h3>Department: <?= $current_user_data['department']?></h3>
<h3>Course Registered: <?= $current_user_data['course']?></h3>

<a href="logout.php">Logout</a>



</body>
</html>