<?php
session_start();
require_once("Connect.php");
$songID = $_POST['songId'];
$user = $_SESSION['username'];
#If playlist created
$sql = "SELECT playlistName,playlistSongs FROM `userInfo` where username='$user' ";
$result = mysqli_query($connection, $sql);
$result = mysqli_fetch_array($result);

#check if playlist exits
if($result["playlistName"] != ""){
  $userPlaylist = $result["playlistSongs"].$songID." ";
  $sql = "UPDATE `userInfo` SET playlistSongs='$userPlaylist' WHERE username='$user'";
  $result = mysqli_query($connection, $sql);

  $sql = "UPDATE `availableSongs` SET addToPlaylist=1 WHERE id='$songID'";
  $result = mysqli_query($connection, $sql);
}
else {
  echo $result["playlistName"];
}

// $sql = 	$sql = "SELECT * FROM `availableSongs` ORDER BY id";
// $result = mysqli_query($connection, $sql);
// if ($result->num_rows > 0) {
//  // output data of each row
//      while($row = $result->fetch_assoc()) {
//        if($row["id"] == $id){
//         if(isset($id)){
//           $id = $row["id"];
//           $songName = $row["songName"];
//           $genre = $row["genre"];
//           $artist = $row["artist"];
//           $length = $row["length"];
//           $image = $row["image"];
//           //You dont need removeSong, make sure u delete it in the DATABASE
//           $sql = "INSERT INTO `myPlaylist` (id,songName,artist,genre,length,image,removeSong) VALUES ('$id','$songName', '$artist', '$genre','$length','$image',0)";
//           $result = mysqli_query($connection, $sql);
//           $sql = "UPDATE `availableSongs` SET addToPlaylist=1 WHERE id=$id";
//           $result = mysqli_query($connection, $sql);
//           break;
//         }
//       }
//      }
// }
?>
