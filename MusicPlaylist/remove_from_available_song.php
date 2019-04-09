<?php
session_start();
require_once("Connect.php");
echo $id = $_POST['songId'];
/*			$sql = "INSERT INTO `login` (username, password) VALUES ('$username', '$password')";*/
$delete = "DELETE FROM `availableSongs` WHERE id=$id";
$result = mysqli_query($connection, $delete);
// 
// $delete = "DELETE FROM `myPlaylist` WHERE id=$id";
// $result = mysqli_query($connection, $delete);

$update = "UPDATE `songs` SET addSong=0,removeSong=1 WHERE id=$id";
$result = mysqli_query($connection, $update);
?>
