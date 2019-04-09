function Song() {
		  var song = document.getElementById("songs");
			var setting = document.getElementById("setting");

			song.style.display = "block";
	  	setting.style.display = "none";

			document.getElementById("songBtn").style.background = "#FFC312";
		  document.getElementById("settingBtn").style.background = "white";
}

function Setting() {
			var song = document.getElementById("songs");
			var setting = document.getElementById("setting");

			song.style.display = "none";
			setting.style.display = "block";

			document.getElementById("songBtn").style.background = "white";
			document.getElementById("settingBtn").style.background = "#FFC312";
}


document.addEventListener('DOMContentLoaded', function(){
	var add_remove_infoBtn = document.querySelector("#songDisplay");
  add_remove_infoBtn.addEventListener("click",add_remove_infoAction, false);

	var sortBtn = document.querySelector("#dropDownButton");
	sortBtn.addEventListener("click",sortSongs, false);
});


function sortSongs(e){
	if(e.target !== e.currentTarget){
			var sort = e.target.value;
			$.post('setSortID.php', {sortType:sort});
			loadSongs('#songDisplay','displaySong.php');
	}
}


function add_remove_infoAction(e){
    if(e.target !== e.currentTarget){
        var id = e.target.value;

				if(id.includes("remove")){
					id = id.substring(6);
					e.target.disabled=true;
					$.post('remove_from_available_song.php', {songId:id});
					loadSongs('#songDisplay','displaySong.php');
				}
				else if(id.includes("add")){
					e.target.disabled = true;
					id = id.substring(3);
					$.post('add_to_available_song.php', {songId:id});
					loadSongs('#songDisplay','displaySong.php');
				}
				else if(id.includes("info")){
					id= id.substring(4);
					$.post('setSongInfoID.php', {songId:id});
					loadSongs("#infoContainer","displaySongInfo.php");
				}
    }
    e.stopPropagation();
}

function loadSongs(location,file){	$(location).load(file);}
