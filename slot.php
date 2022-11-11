<?php 
include 'connection.php';
$slot=$_POST['slot'];
$doc_id=$_POST['doc_id'];
$check=mysqli_query($con,"select * from appointment_info where slot='$slot' and doc_id='$doc_id'");
if (mysqli_num_rows($check)>0)
{
    echo json_encode(array("statusCode"=>201));
}else{
$query="INSERT INTO `appointment_info` (slot,doc_id) Values ('$slot','$doc_id')";
$result = mysqli_query($con,$query);
echo json_encode(array("statusCode"=>200));
}
?>