<?php
session_start();
$_SESSION['sort'] = $_POST['sortType'];
echo "Session = " .$_SESSION['sort'];
?>
