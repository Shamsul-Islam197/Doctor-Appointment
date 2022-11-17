<?php session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first!!!');</script>";
    echo "<script>window.location='login.php'</script>";
}
