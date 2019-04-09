<?php
session_start();
require_once("Connect.php");
$sortType = $_SESSION['sort'];

if($sortType == 'Name')
  $sql = "SELECT * FROM `availableSongs` ORDER BY songName";
else if($sortType == 'Genre')
  $sql = "SELECT * FROM `availableSongs` ORDER BY genre";
else if($sortType == 'Artist')
  $sql = "SELECT * FROM `availableSongs` ORDER BY artist";
else if($sortType == 'Length')
  $sql = "SELECT * FROM `availableSongs` ORDER BY length";
else if($sortType == 'Default')
  $sql = "SELECT * FROM `availableSongs` ORDER BY id";
else
  $sql = "SELECT id, songName, artist, genre, length, image, addToPlaylist FROM `availableSongs` ";

$_SESSION['sort'] = "";
$result = mysqli_query($connection, $sql);
if ($result->num_rows > 0) {
 // output data of each row
     while($row = $result->fetch_assoc()) {
       $id = $row["id"];
       echo "<div class='cardSong'>";
       echo "<img src='Images/" . $row["image"] . "'/>";
       echo "<div class='containerSong'>";
       echo "<h6><b>" . $row["songName"] . "</b></h6>";
       echo "<h6>" . $row["artist"] . "</h6>";
       echo "<h6>" . $row["length"] . "</h6>";
             echo "<div id='info_addBtn'>";
                 echo "<form method='POST'>";
                 if($row["addToPlaylist"] == 1)
                    echo "<button type='button' value='add" . $id."' class='btn btn-outline-success btn-block float-left' disabled>Add</button>";
                 else
                    echo "<button type='button' value='add" . $id."' class='btn btn-outline-success btn-block float-left'>Add</button>";
                 echo "<button type='button' value='info" . $id."'class='info btn btn-outline-info btn-block float-right'>Info</button>";

                 echo "</form>";
             echo "</div>";
       echo "</div>";
       echo "</div>";
     }
}
else
   echo "<h1 style='color:white;margin-left: 47%;margin-top:23%;font-size:auto'>No Available Songs</h1>";
?>
