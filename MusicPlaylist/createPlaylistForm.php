<?php
session_start();
require_once("Connect.php");

#Check if playlist exits
$name=$_SESSION['username'];
$sql = "SELECT playlistName FROM `userInfo` where username='$name'";
$result = mysqli_query($connection, $sql);
$result = $row= mysqli_fetch_array($result);

if(isset($_POST['playlist']) & !isset($result["playlistName"])){
  #if playlist does exit then run this
  $playlistName=$_POST['playlist'];
  //Create a playlist
  $sql = "UPDATE `userInfo` SET playlistName='$playlistName' WHERE username='$name'";
  $result = mysqli_query($connection, $sql);

  //Make songs available to add
  $sql = "UPDATE `availableSongs` SET addToPlaylist=0 WHERE id>=0";
  $result = mysqli_query($connection, $sql);
  $_SESSION['playlistName'] = $playlistName;
}
else if(!isset($result["playlistName"])) {
    echo "		<h4>Create Playlist</h4><br>";
    echo "		<div class='input-group form-group'>";
    echo "			<div class='input-group-prepend'>";
    echo "				<span class='input-group-text'><i class='fa fa-music'></i></span>";
    echo "			</div>";
    echo "			<input type='text' name='playlistName' class='form-control' placeholder='playlistName' required>";
    echo "		</div>";
    echo "		<button type='submit' onclick='createPlaylist()' class='btn btn-outline-primary'>Create</button>";
}

?>
