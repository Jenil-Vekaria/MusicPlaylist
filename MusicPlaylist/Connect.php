<?php
$connection = mysqli_connect("localhost","jvekaria",":OfPaquo","jvekaria");
if(!$connection)
  die("Database Connection Failed" . mysqli_error($connection));

$select_db = mysqli_select_db($connection,"jvekaria");
if(!$select_db)
  die("Database Selection Failed" . mysqli_error($connection));

?>