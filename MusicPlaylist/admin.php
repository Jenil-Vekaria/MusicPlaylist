<?php
require_once("Connect.php");
session_start();

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
		<link rel="stylesheet" type="text/css" href="admin.css">


		<script src="admin.js"></script>


	</head>
	<body onload="loadSongs('#songDisplay','displaySong.php')">
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
							<input type="submit" onclick="Song()" id="songBtn" value="Songs" class="btn nav_btn">

							<input type="submit" onclick="Setting()" value="Settings" id="settingBtn" class="btn nav_btn" style="background: white">

							<!-- <input type="submit" onclick="Playlist()" id="playlistBtn" value="Playlist"  class="btn nav_btn" style="background: white"> -->
						</div>
<!--
						<div id="playlist">
										<div class="row" id="play_list"></div>
										<div class="infoPage" id="infoContainerPlaylist"></div>
						</div> -->

						<div id="setting" style="display:none">
							<h1 style="color:white;margin-left: 40%;margin-top:20%;">No Setting</h1>
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

											<!-- This is where all the song cards will be displays -->
											<div class="row" id="songDisplay"></div>
									</div>

									<!-- This is where the information of a song be displayed  -->
									<div class="infoPage" id="infoContainer"></div>
						</div>




			</div>
		</div>

			<!-- jQuery first, then Bootstrap JS. -->
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</body>
</html>
