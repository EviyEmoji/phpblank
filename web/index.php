<?phprequire('../vendor/autoload.php');?><h1>OdysseySoundtrack</h1><audio id="soundtrack" controls autoplay>	<source src="soundtrack.mp3" type="audio/mpeg">	Your browser does not support the audio element.</audio><br><button onclick="getTime()" type="button">Get Time</button><button onclick="setTime()" type="button">Go to Place</button><?php require("choiceDropdown.php") ?><script>var soundtrack = document.getElementById("soundtrack");function getTime() {	alert(soundtrack.currentTime);}function setTime() {	var choiceDropdown = document.getElementById("choice");	var choice = choiceDropdown.options[choiceDropdown.selectedIndex].value;	soundtrack.currentTime = choice;}</script>