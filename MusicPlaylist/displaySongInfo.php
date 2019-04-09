<?php
session_start();
require_once("Connect.php");
$sql = 	$sql = "SELECT * FROM `songs` ORDER BY id";
$result = mysqli_query($connection, $sql);
if ($result->num_rows > 0) {
 // output data of each row
     while($row = $result->fetch_assoc()) {
       if($row["id"] == $_SESSION['songInfoID']){
        if(isset($_SESSION["songInfoID"])){
          echo "<div class='cardSongInfo'>";
          echo "<img src='Images/".$row["image"]."' />";
          echo "<div class='containerInfo'>";
          echo "			<h6 class='title'>Song Name:</h6>";
          echo "			<h6 class='songDetail'>". $row["songName"]."</h6>";

          echo "			<h6 class='title'>Artist:</h6>";
          echo "			<h6 class='songDetail'>". $row["artist"]."</h6>";

          echo "			<h6 class='title'>Genre:</h6>";
          echo "			<h6 class='songDetail'>". $row["genre"]."</h6>";

          echo "			<h6 class='title'>Length:</h6>";
          echo "			<h6 class='songDetail'>". $row["length"]."</h6>";
          echo "		</div>";
          echo "	</div>";
          break;
        }
      }
     }
}
?>
