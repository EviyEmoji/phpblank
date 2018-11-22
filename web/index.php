<div id="page"><title id="title">Odyssey Soundtrack Section Picker</title><link rel="stylesheet" type="text/css" href="styles.css"><link rel="stylesheet" type="text/css" href="popups.css"><script>	if(navigator.userAgent.includes("Chrome")){		var isChrome = true;	}	if(navigator.userAgent.includes("Safari")){		var isSafari = true;	}	if(navigator.userAgent.includes("Mobile") && navigator.userAgent.includes("Safari")){		var isMobileSafari = true;	}</script><div id="main">	<meta name="viewport" content="width=device-width, initial-scale=1.0"><h1>Odyssey Soundtrack Section Picker</h1><?require('../vendor/autoload.php');if(strpos($_SERVER['HTTP_USER_AGENT'], "Mobile")){	$mobile = true;}else{	$mobile = false;}?><div id='interactive'><div id="interactive-container"><br><audio id="soundtrack" onloadstart="onBeginLoad();" oncanplaythrough="onEndLoad();" preload="auto">	<source src="soundtrack.mp3" type="audio/mpeg">	Your browser does not support the audio element.</audio><div id='play-div'>	<div id='play-container'>		<img src="images/backBtn.png" height="30" onclick="goBack()">		<div id="playBtn">			<img src="images/playBtn.png" height="30" onclick="play()">		</div>		<img src="images/fwdBtn.png" height="30" onclick="goForward()">	</div>	<div class="popup" id="popupDiv">  		<span class="popuptext hide" id="loadingPopup">Loading soundtrack</span>	</div></div><br><div id="sectionNameDiv">	<span id="sectionName"></span></div><br><br>	<?	require_once("namesDropdown.php");	echo "<br><span class='font-10'> or </span><br>";	require_once("sectionsDropdown.php");	?><br><br></div></div><p>This website was created by Everest Oreizy. The score was created by Ben Moore, and the libretto by Kelly Rourke. Only for use by Seattle Opera. Depending on your browser and internet speed, loading times may vary, so please be patient. <i class="font-10">iPhone users using Safari must click play for the soundtrack to load. Sadly, the audio preload attribute does not work on iOS devices.</i> If you have any feedback, reccomendations, or comments, please don't hesitate to fill out this short <a href='https://docs.google.com/forms/d/e/1FAIpQLSfbI4U3nVygCzuWD4j4vlo19TFPMKU1y9C18fCKqbVRE2gZhQ/viewform?usp=sf_link'>feedback form</a>. It will really help me make this site better.</p><script type="text/javascript">	var developerDiv = document.getElementById("developer");	var soundtrack = document.getElementById("soundtrack");	var playDiv = document.getElementById("playBtn");	var sectionsDropdownDefault = document.getElementById('sectionsDefault');	var namesDropdownDefault = document.getElementById('namesDefault');	var sectionNameSpan = document.getElementById('sectionName');	var title = document.getElementById("title");	var popup = document.getElementById("loadingPopup");	var popupDiv = document.getElementById("popupDiv");	var allSectionNames = [		"", 		"A0", "B0", "C0", "D0", "E0", 		"A1", "B1", "C1", "D1", "E1", "F1", "G1", "H1", "I1", "J1", "K1", "L1", 		"A2", "B2", "C2", "D2", "E2", "F2", "G2", "H2", "I2", "J2", "K2", "L2", "M2", "N2", "O2", "P2", 		"A3", "B3", "C3", "D3", "E3", "F3", "G3", 		"A4", "B4", "C4", "D4", "E4", "F4", "G4", "H4", "I4", "J4", "K4", "L4", "M4", "N4", "O4", "P4", 		"A5", "B5", "C5", "D5", "E5", "F5", "G5", "H5", "I5", "J5", "K5", "L5", "M5", "N5", "O5", "P5", "Q5", "R5", "S5", "T5", 		"A6", "B6", "C6", "D6", "E6", "F6", "G6", "H6", "I6", "J6", "K6"];	var allSectionTimes = [		0,		6, 		36, 85, 131, 163, 196, 		167, 267, 295, 345, 400, 447, 471, 525, 574, 599, 610, 647, 		680, 710, 722, 762, 777, 808, 873, 895, 922, 953, 966, 985, 999, 1037, 1069, 1124, 		1148, 1168, 1181, 1197, 1232, 1269, 1316, 		1365, 1383, 1412, 1434, 1459, 1728, 1516, 1531, 1552, 1565, 1577, 1588, 1621, 1649, 1664, 		1697, 1725, 1775, 1783, 1817, 1826, 1843, 1879, 1912, 1955, 1972, 1991, 2020, 2040, 2070, 2085, 2117, 2133, 2166, 2191, 		2216, 2274, 2336, 2366, 2382, 2409, 2474, 2515, 2559, 2581, 2632];	var allSongTimes = [		0, 85, 		196, 		267,400, 525, 647, 722, 922, 999, 1124, 1232, 1269, 1316, 1434, 1531, 1725, 1826, 1991, 2216, 2366, 2515, 2632];		var allSongNames = [		"Prologue", 		"Opening Chorus", 		"Ithaca",		"Isle of the Lotus Eaters",		"Shipwrecked Sailor",		"First Ballad Interlude",		"Hymn to Athena",		"Cyclops",		"Second Ballad Interlude",		"Master of the Winds",		"Sailor Song",		"The First Mate Gets Greedy",		"Storm Scene",		"Seasick Sailor Song",		"Circes Tango",		"The Piggies Progress","Sailor Song Reprise",		"Sirens Song",		"Third Ballad Interlude",		"Homecoming Quartet",		"Recognition",		"Finale",		"Bow Music"		];	function setTime(id) {		var choiceDropdown = document.getElementById(id);		var choice = choiceDropdown.options[choiceDropdown.selectedIndex].value;				if(isChrome == true){			soundtrack.currentTime = choice - 2;		}		else{			soundtrack.currentTime = choice;		}		if(id == 'names') {			sectionsDropdownDefault.selected = true;		}		if(id == 'sections') {			namesDropdownDefault.selected = true;		}	}	var currentSectionStartingTime;	var currentSectionIndex;	var nextSectionTime;	var previousSectionTime	function updateSectionName(time){		var sectionTimesLessThan = allSectionTimes.filter(function(x) {return x <= time;} );		currentSectionStartingTime = Math.max(...sectionTimesLessThan);		currentSectionIndex = allSectionTimes.indexOf(currentSectionStartingTime);		var currentSectionName = allSectionNames[currentSectionIndex];		var songTimesLessThan = allSongTimes.filter(function(y) {return y <= time;} );		var currentSongStartingTime = Math.max(...songTimesLessThan);		var currentSongIndex = allSongTimes.indexOf(currentSongStartingTime);		var currentSongName = allSongNames[currentSongIndex];		nextSectionTime = allSectionTimes[currentSectionIndex +1 ];		previousSectionTime = allSectionTimes[currentSectionIndex -1];		sectionNameSpan.innerHTML = "&nbsp;" + currentSectionName + " " + currentSongName + "&nbsp;";		title.innerHTML = currentSectionName + " " + currentSongName + " - Odyssey Soundtrack Section Picker";		if(soundtrack.currentTime == 0){			sectionNameSpan.innerHTML = "&nbsp;Not Playing&nbsp;";			title.innerHTML = "Odyssey Soundtrack Section Picker";		}	}	function checkTime() {		var time = soundtrack.currentTime;		updateSectionName(time);		setTimeout(checkTime, 500);	}	checkTime();	function play(){		soundtrack.play();		playDiv.innerHTML = "<img src='images/pauseBtn.jpg' height='30' onclick='pause()'>";	}	function pause(){		soundtrack.pause();		playDiv.innerHTML = "<img src='images/playBtn.png' height='30' onclick='play()'>";	}	function goBack(){		if(soundtrack.currentTime - currentSectionStartingTime <= 3){			soundtrack.currentTime = previousSectionTime;		}		else{			soundtrack.currentTime = currentSectionStartingTime;		}	}	function goForward(){		soundtrack.currentTime = nextSectionTime;	}	function onBeginLoad(){		if(!isMobileSafari){			popupDiv.innerHTML = "<span class='popuptext show' id='loadingPopup'>Loading soundtrack</span>";		}	}	function onEndLoad(){		popupDiv.innerHTML = "<span class='popuptext hide' id='loadingPopup'>Loading soundtrack</span>";	}</script></div><div id="debug"></div></div>