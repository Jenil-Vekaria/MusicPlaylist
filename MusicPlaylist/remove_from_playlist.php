<?php
session_start();
require_once("Connect.php");

$_SESSION['songInfoID'] = null;

$songID = $_POST['songId'];
$user = $_SESSION['username'];
$query = "SELECT playlistSongs FROM `userInfo` WHERE username='$user'";
$result = mysqli_fetch_array(mysqli_query($connection, $query));
$playlistIDs = explode(" ",trim($result["playlistSongs"]));

$newPlaylistIDs = "";
foreach ($playlistIDs as $id){
  if($songID != $id)
    $newPlaylistIDs = $newPlaylistIDs." ".$id;
}

$query = "UPDATE `userInfo` SET playlistSongs='$newPlaylistIDs' WHERE username='$user'";
$result = mysqli_query($connection, $query);

$delete = "DELETE FROM `myPlaylist` WHERE id=$id";
$result = mysqli_query($connection, $delete);

$update = "UPDATE `availableSongs` SET addToPlaylist=0 WHERE id=$songID";
$result = mysqli_query($connection, $update);
?>
