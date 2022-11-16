<?php
include 'connection.php';
$slot = $_POST['slot'];
$doc_id = $_POST['doc_id'];
$date = date("d/m/Y");
$query = "select * from appointment_info where slot='$slot' and doc_id='$doc_id' and (slot_status='selected' or slot_status='booked') ";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    echo json_encode(array("statusCode" => 201));
} else {
    $query = "INSERT INTO `appointment_info` (slot,doc_id,slot_status,date) Values ('$slot','$doc_id','selected','$date')";
    $result = mysqli_query($con, $query);
    echo json_encode(array("statusCode" => 200));
}
