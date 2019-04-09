<?php
session_start();
require_once("Connect.php");

if(!isset($_SESSION['username']))
	header("location: login.php")
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Admin</title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


		<!--Bootsrap 4 CDN-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

			<!--Fontawesome CDN-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

		<!--Custom styles-->
		<link rel="stylesheet" type="text/css" href="user.css">


		<script type="text/javascript">

			function Song() {
					  var song = document.getElementById("songs");
						var playlist = document.getElementById("playlist");

						song.style.display = "block";
						playlist.style.display = "none";

						document.getElementById("songBtn").style.background = "#FFC312";
						document.getElementById("playlistBtn").style.background = "white";
						loadSongs('#songDisplay','displayAvailableSongs.php');
		 }

		 function Playlist() {
					 var song = document.getElementById("songs");
					 var playlist = document.getElementById("playlist");

					 song.style.display = "none";
					 playlist.style.display = "block";

					 document.getElementById("playlistBtn").style.background = "#FFC312";
					 document.getElementById("songBtn").style.background = "white";
					 $("#playlistSongDisplay").load("displayPlaylistSong.php");
		}

		function createPlaylist(){
			var playlistName = document.forms["form"]["playlistName"].value;
			$.post('createPlaylistForm.php', {playlist:playlistName});
			$("#playlistSongDisplay").load("displayPlaylistSong.php");
		}

  document.addEventListener('DOMContentLoaded', function(){
    var add_infoBtn = document.querySelector("#songDisplay");
    add_infoBtn.addEventListener("click",add_infoAction, false);

		//This is for the playlist remove buttons
		var removeBtn = document.querySelector("#playlistSongDisplay");
		removeBtn.addEventListener("click",removeAction, false);

		var sortBtn = document.querySelector("#dropDownButton");
		sortBtn.addEventListener("click",sortSongs, false);

	});

	function removeAction(e){
		if(e.target !== e.currentTarget){
				var id = e.target.value;
				if(id.includes("remove")){
						e.target.disabled=true;
						id = id.substring(6);
						$.post('remove_from_playlist.php', {songId:id});
						loadSongs('#playlistSongDisplay','displayPlaylistSong.php');
						loadSongs("#playlistInfoContainer","displaySongInfo.php");
						//loadSongs('#songDisplay','displayAvailableSongs.php');
				}
				else if(id.includes("info")){
					id= id.substring(4);
					$.post('setSongInfoID.php', {songId:id});
					loadSongs("#playlistInfoContainer","displaySongInfo.php");
				}
		}
	}

	function sortSongs(e){
		if(e.target !== e.currentTarget){
				var sort = e.target.value;
				$.post('setSortID.php', {sortType:sort});
				loadSongs('#songDisplay','displayAvailableSongs.php');
			}
	}


	function add_infoAction(e){
    if(e.target !== e.currentTarget){
        var id = e.target.value;

				if(id.includes("add")){
					e.target.disabled = true;
					id = id.substring(3);
					$.post('add_to_playlist.php', {songId:id});
				}
				else if(id.includes("info")){
					id= id.substring(4);
					$.post('setSongInfoID.php', {songId:id});
					loadSongs("#infoContainer","displaySongInfo.php");
				}

    }
    e.stopPropagation();
	}



	function loadSongs(location,file){
			$(location).load(file);
			$("#createPlaylist").load("createPlaylistForm.php");
	}

		</script>


	</head>
	<body onload="loadSongs('#songDisplay','displayAvailableSongs.php')">
		<a href="logout.php" class="logout">logout</a>

		<div class="container">
			<div class="d-flex justify-content-center h-100">
				<!--CARD !-->
				<div class="card">

						<div class="welcomeBoard">
							<div class="welcomeHeader">
									<h3>Welcome <?php echo $_SESSION['username'];?></h3>
							</div>
						</div>

						<div class="option">
							<input type="submit" onclick="Song()"     id="songBtn"     value="Available Songs" class="btn nav_btn">

							<!-- <input type="submit" onclick="Setting()"  id="settingBtn"  value="Setting"         class="btn nav_btn" style="background: white"> -->

							<input type="submit" onclick="Playlist()" id="playlistBtn" value="Playlist"        class="btn nav_btn" style="background: white">
						</div>


						<div id="playlist">
							<h3 style="color:white;margin-left:30%;margin-bottom:-3%;">
								<?php
								$user = $_SESSION['username'];
								$query = "SELECT playlistName FROM `userInfo` WHERE username='$user'";
								$result = mysqli_fetch_array(mysqli_query($connection, $query));
							  echo $result["playlistName"];
								?>
						</h3>
							<div class="songDisplayContainer">
									<br>
									<div class="row" id="playlistSongDisplay"></div>
							</div>

							<!-- This is where the information of a song be displayed  -->
							<div class="infoPage" id="playlistInfoContainer"></div>

							<form id="createPlaylist" method="post" name="form"></form>
						</div>


						<!-- SONG PANEL -->
						<div id="songs" >
									<div class="songDisplayContainer">
											<!-- This is the dropdown sort button BOOTSTRAP CODE -->
											<div class="btn-group sortDropdown" id="dropDownButton">
													<button type="button" class="btn btn-outline-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort</button>
															<div class="dropdown-menu">
																	<form method="POST">
																			<button type="button" value="Name" class="btn btn-link btn-sm">Name</button><br>
																			<button type="button" value="Genre"  class="btn btn-link btn-sm">Genre</button><br>
																			<button type="button" value="Length"  class="btn btn-link btn-sm">Length</button><br>
																			<button type="button" value="Artist" class="btn btn-link btn-sm">Artist</button><br>
																			<button type="button" value="Default"  class="btn btn-link btn-sm">Default</button>
																	</form>
															</div>
											</div>
											   *Must create a playlist before adding songs*
											<!-- This is where all the song cards will be displays -->
											<div class="row" id="songDisplay"></div>
						</div>
											<!-- This is where the information of a song be displayed  -->
											<div class="infoPage" id="infoContainer"></div>
			</div>

		</div>

			<!-- jQuery first, then Bootstrap JS. -->
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</body>
</html>

<!-- <div class="cardSongInfo">
<img src="Images/Cover-1.jpg"/>
<div class="containerInfo">"
			<h6 class="songDetail">Ta13oo</h6>
			<h6 class="songDetail">Denzel Curry</h6>
			<h6 class="songDetail">3:18</h6>
		</div>
</div> -->

<!-- <form name="form" method="post">
		<h4>Create Playlist</h4><br>
		<div class="input-group form-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-music"></i></span>
			</div>
			<input type="text" name="playlistName" class="form-control" placeholder="playlistName" required>
		</div>
		<button type="submit" onclick="createPlaylist()" class="btn btn-outline-primary">Create</button>
</form> -->
