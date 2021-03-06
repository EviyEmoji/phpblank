function setTime(id) {
	var choiceDropdown = document.getElementById(id);
	var choice = choiceDropdown.options[choiceDropdown.selectedIndex].value;
	
	if(isChrome == true){
		soundtrack.currentTime = choice - 2;
	}
	else{
		soundtrack.currentTime = choice;
	}

	if(id == 'names') {
		sectionsDropdownDefault.selected = true;
	}
	if(id == 'sections') {
		namesDropdownDefault.selected = true;
	}
}


var currentSectionStartingTime;
var currentSectionIndex;
var nextSectionTime;
var previousSectionTime

function updateSectionName(time){
	var sectionTimesLessThan = allSectionTimes.filter(function(x) {return x <= time;} );
	currentSectionStartingTime = Math.max(...sectionTimesLessThan);
	currentSectionIndex = allSectionTimes.indexOf(currentSectionStartingTime);
	var currentSectionName = allSectionNames[currentSectionIndex];

	var songTimesLessThan = allSongTimes.filter(function(y) {return y <= time;} );
	var currentSongStartingTime = Math.max(...songTimesLessThan);
	var currentSongIndex = allSongTimes.indexOf(currentSongStartingTime);
	var currentSongName = allSongNames[currentSongIndex];

	nextSectionTime = allSectionTimes[currentSectionIndex +1 ];
	previousSectionTime = allSectionTimes[currentSectionIndex -1];

	sectionNameSpan.style.borderStyle = "solid";
	sectionNameSpan.innerHTML = "&nbsp;" + currentSectionName + "&nbsp;";
	songNameSpan.innerHTML = currentSongName;
	title.innerHTML = currentSectionName + " " + currentSongName + " - " + SITENAME;

	if(soundtrack.currentTime == 0){
		songNameSpan.innerHTML = "Not Playing";
		sectionNameSpan.innerHTML = "";
		sectionNameSpan.style.borderStyle = "none";
		title.innerHTML = SITENAME;
	}

}

function checkTime() {
	var time = soundtrack.currentTime;
	updateSectionName(time);
	setTimeout(checkTime, 500);
}
checkTime();



function play(){
	soundtrack.play();
	playDiv.innerHTML = "<img src='images/buttons/pauseBtn.jpg' height='30' onclick='pause()'>";
}

function pause(){
	soundtrack.pause();
	playDiv.innerHTML = "<img src='images/buttons/playBtn.png' height='30' onclick='play()'>";
}

function goBack(){
	if(soundtrack.currentTime - currentSectionStartingTime <= 3){
		soundtrack.currentTime = previousSectionTime;
	}
	else{
		soundtrack.currentTime = currentSectionStartingTime;
	}
}

function goForward(){
	soundtrack.currentTime = nextSectionTime;
}

if(isBadIE){
	window.location.href="nosupport_ie.html";
}

function isInViewport(element){
var bounding = element.getBoundingClientRect();
return(
	bounding.top >= 0 &&
	bounding.left >= 0 &&
	bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
	bounding.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
};

if(isInAppForm){
	if(isInViewport(viewportCheckerDiv)){
		pageBody.style.overflow = "hidden";
		pageBody.style.position = "fixed";
	}else{
		pageBody.style.overflow = "scroll";
		pageBody.style.positon = "";
	}
}

if(isInAppForm){
	pageMain.style.borderStyle = "none";
	sitenameHeadingH1.style.fontFamily = "Futura-CondensedExtraBold";
	songNameSpan.style.fontSize = "16px";
	sectionNameSpan.style.fontSize = "16px";
}

if(isMobileSafari || isInAppForm){
	browserMessageDiv.innerHTML = "Because Safari on iOS prefers to use smaller amounts of cellular data, you must click play for the soundtrack to load. You may have to wait after you click play for the soundtrack to start playing.";
}

if(isMobileSafari && !isInAppForm){
	browserMessageDiv.innerHTML = browserMessageDiv.innerHTML + "<br><br>";
}

if (!isInAppForm) {
	browserMessageDiv.innerHTML = browserMessageDiv.innerHTML + "<span class='normal-text'>To use " + SITENAME + " in a full-screen app-like form, tap <span class='code'>Share</span> and then <span class='code'>Add&nbsp;to&nbsp;Home&nbsp;Screen</span> on your iPhone or iOS device.</span> "
}