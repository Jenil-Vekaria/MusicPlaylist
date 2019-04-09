<?php
require_once("Connect.php");

if(isset($_POST) & !empty($_POST)){
  $songName = $_POST['songName'];
  $artist = $_POST['artist'];
  $genre = $_POST['genre'];
  $length = $_POST['length'];
  $image = $_POST['image'];

  $sql = "INSERT INTO `songs` (songName,artist,genre,length,image,addSong,removeSong) VALUES ('$songName', '$artist', '$genre','$length','$image',0,1)";
  $result = mysqli_query($connection, $sql);

  if($result)
    echo "Succesfully Added";
  else
    echo "Unsucessful Contact Jenil";
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Adding songs</title>
  </head>
  <body>
      	<form method="POST">
          SongName
          <input type="text" name="songName" class="form-control" placeholder="songName" required><br><br>
          Artist
          <input type="text" name="artist" class="form-control" placeholder="artist" required><br><br>
          Genre
          <input type="text" name="genre" class="form-control" placeholder="genre" required><br><br>
          Length
          <input type="text" name="length" class="form-control" placeholder="length" required><br><br>
          Image
          <input type="file" name="image" class="form-control" placeholder="image" required><br><br>
          <input type="submit" value="Add">
        </form>
  </body>
</html>
