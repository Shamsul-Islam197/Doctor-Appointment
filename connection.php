<?php

    $con=mysqli_connect('localhost','root','','appointment');

    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>
