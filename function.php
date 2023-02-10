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

if (($_POST['type'] == "apnt_date")) {
	$apnt_date = $_POST['app_date'];
	$_SESSION['apnt_date'] = date('d/m/Y', strtotime($apnt_date));
}

if (($_POST['type'] == "select")) {
	$slot = $_POST['slot'];
	$app_type = $_POST['app_type'];
	$doc_id = $_POST['doc_id'];
	$date = $_SESSION['apnt_date'];
	$query = "select * from appointment_info where slot='$slot' and date='$date' and doc_id='$doc_id' and appointment_type='$app_type' and (slot_status='selected' or slot_status='booked') ";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
		echo json_encode(array("statusCode" => 201));
	} else {
		$query = "INSERT INTO `appointment_info` (slot,doc_id,slot_status,date,time,appointment_type) Values ('$slot','$doc_id','selected','$date',now(),'$app_type')";
		$result = mysqli_query($con, $query);
		echo json_encode(array("statusCode" => 200));
	}
}

if (($_POST['type'] == "uncheck")) {
	$slot = $_POST['slot'];
	$date = $_SESSION['apnt_date'];
	$app_type = $_POST['app_type'];
	$doc_id = $_POST['doc_id'];
	$query = "DELETE FROM appointment_info WHERE slot='$slot' and date='$date' and slot_status='selected' and appointment_type='$app_type'  and doc_id='$doc_id'";
	$result = mysqli_query($con, $query);
	echo json_encode(array("statusCode" => 200));
}

if (($_POST['type'] == "book")) {
	$app_type = $_POST['app_type'];
	$slot = $_POST['slot'];
	$date = $_SESSION['apnt_date'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$doc_id = $_POST['doc_id'];
	if ($app_type == "Report Check") {
		$query = "UPDATE `appointment_info` SET `slot_status` = 'booked' , `date` = '" . $date . "' , `patient_name` = '" . $name . "', `patient_age` = '" . $age . "', `appointment_type`= '" . $app_type . "' , `patient_phone` = '" . $phone . "' , `patient_address` = '" . $address . "' WHERE slot= '$slot' AND doc_id= '$doc_id'";
	} else {
		$query = "UPDATE `appointment_info` SET `slot_status` = 'booked' , `date` = '" . $date . "' , `patient_name` = '" . $name . "', `patient_age` = '" . $age . "', `appointment_type`= '" . $app_type . "' , `patient_phone` = '" . $phone . "' , `patient_address` = '" . $address . "' WHERE slot= '$slot' AND doc_id= '$doc_id'";
	}
	if (mysqli_query($con, $query)) {
		echo json_encode(array("statusCode" => 200));
	} else {
		echo json_encode(array("statusCode" => 201));
	}
}

if (($_POST['type'] == "table")) {
	$app_type = $_POST['app_type'];
	$doc_id = $_SESSION['doc_id'];
	$date = $_SESSION['apnt_date'];
	$query = "SELECT slot,patient_name FROM appointment_info WHERE date='$date' AND doc_id='$doc_id' AND appointment_type='$app_type'";
	$result = mysqli_query($con, $query);
	while ($res = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?= $res['slot']; ?></td>
			<td><?php echo $res['patient_name']; ?></td>
			<td>Action</td>
		</tr>
<?php
	}
}




if (isset($_GET["logout"])) {
	session_unset();
	session_destroy();
}
