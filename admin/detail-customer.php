<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$id  =$_POST['id_customer'];
$ret=mysqli_query($con,"select * from  tblcustomer where id_customer ='$id' ");
$row=mysqli_fetch_array($ret);

?>
   