<?php
session_start();
require_once("Connect.php");

$user = $_SESSION['username'];
$query = "SELECT playlistName,playlistSongs FROM `userInfo` WHERE username='$user'";
$result = mysqli_fetch_array(mysqli_query($connection, $query)); #convert to array
$playlistIDs = explode(" ", trim($result["playlistSongs"]));

$_SESSION['playlistName'] = $result["playlistName"];

for($index = 0; $index < count($playlistIDs); $index++){
  $songID = $playlistIDs[$index];
  $query = "SELECT * FROM `songs` WHERE id='$songID'";
  $row = mysqli_fetch_array(mysqli_query($connection, $query));
  if(isset($row)){
  echo "<div class='cardSong'>";
  echo "<img src='Images/" . $row["image"] . "'/>";

  echo "<div class='containerSong'>";
  echo "<h6><b>" . $row["songName"] . "</b></h6>";
  echo "<h6>" . $row["artist"] . "</h6>";
  echo "<h6>" . $row["length"] . "</h6>";
         echo "<div id='info_addBtn'>";
             echo "<form method='POST'>";
             echo "<button type='button' value='remove" . $songID."' class='btn btn-outline-danger btn-block float-right'>remove</button>";
             echo "<button type='button' value='info" . $songID."'class='info btn btn-outline-info btn-block float-right'>Info</button>";
             echo "</form>";
         echo "</div>";
   echo "</div>";
   echo "</div>";
 }
}
// if ($result->num_rows > 0) {
//  // output data of each row
//      while($row = $result->fetch_assoc()) {
//        $id = $row["id"];
//        echo "<div class='cardSong'>";
//        echo "<img src='Images/" . $row["image"] . "'/>";
//
//        echo "<div class='containerSong'>";
//        echo "<h6><b>" . $row["songName"] . "</b></h6>";
//        echo "<h6>" . $row["artist"] . "</h6>";
//        echo "<h6>" . $row["length"] . "</h6>";
//              echo "<div id='info_addBtn'>";
//                  echo "<form method='POST'>";
//                  echo "<button type='button' value='remove" . $id."' class='btn btn-outline-danger btn-block float-right'>remove</button>";
//                  echo "<button type='button' value='info" . $id."'class='info btn btn-outline-info btn-block float-right'>Info</button>";
//                  echo "</form>";
//              echo "</div>";
//        echo "</div>";
//        echo "</div>";
//      }
// }
// else{
//
// }
?>
