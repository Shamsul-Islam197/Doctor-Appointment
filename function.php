<?php
include 'connection.php';
session_start();

if ($_POST['type'] == 1) {
	$name = $_POST['name'];
	$designation = $_POST['designation'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$username = $_POST['username'];

	$check = mysqli_query($con, "select * from user_info where user_name='$username'");
	if (mysqli_num_rows($check) > 0) {
		echo json_encode(array("statusCode" => 201));
	} else {
		$sql = "insert into user_info (name, designation, phone, password, user_name) values ('$name','$designation','$phone','$password','$username')";

		if (mysqli_query($con, $sql)) {
			echo json_encode(array("statusCode" => 200));
		} else {
			echo json_encode(array("statusCode" => 201));
		}
	}
	mysqli_close($con);
}

if ($_POST['type'] == 2) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$check = mysqli_query($con, "select * from user_info where user_name='$username' and password='$password'");
	if (mysqli_num_rows($check) > 0) {
		$_SESSION['username'] = $username;
		echo json_encode(array("statusCode" => 200));
	} else {
		echo json_encode(array("statusCode" => 201));
	}
	mysqli_close($con);
}


if (isset($_GET["logout"])) {
	session_unset();
	session_destroy();
}
