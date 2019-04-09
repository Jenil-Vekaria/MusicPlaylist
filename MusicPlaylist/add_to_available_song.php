<?php
session_start();
require_once("Connect.php");
$id = $_POST['songId'];
$songName = "";
$genre = "";
$artist = "";
$length = "";
$image = "";

/*			$sql = "INSERT INTO `login` (username, password) VALUES ('$username', '$password')";*/
$sql = 	$sql = "SELECT * FROM `songs` ORDER BY id";
$result = mysqli_query($connection, $sql);
if ($result->num_rows > 0) {
 // output data of each row
     while($row = $result->fetch_assoc()) {
       if($row["id"] == $id){
        if(isset($id)){
          $id = $row["id"];
          $songName = $row["songName"];
          $genre = $row["genre"];
          $artist = $row["artist"];
          $length = $row["length"];
          $image = $row["image"];
          $sql = "INSERT INTO `availableSongs` (id,songName,artist,genre,length,image,addToPlaylist) VALUES ('$id','$songName', '$artist', '$genre','$length','$image',0)";
          $result = mysqli_query($connection, $sql);

          $sql = "UPDATE `songs` SET addSong=1,removeSong=0 WHERE id=$id";
          $result = mysqli_query($connection, $sql);
          break;
        }
      }
     }
}
?>
