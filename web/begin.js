if(navigator.userAgent.includes("Chrome")){
	var isChrome = true;
}
if(navigator.userAgent.includes("Safari")){
	var isSafari = true;
}
if(navigator.userAgent.includes("Mobile") && navigator.userAgent.includes("Safari")){
	var isMobileSafari = true;
}
if(navigator.appName.indexOf("Internet Explorer")!=-1){     //yeah, s/he's using IE
	var isBadIE=(
    	navigator.appVersion.indexOf("MSIE 9")==-1 &&   //v9 is ok
    	navigator.appVersion.indexOf("MSIE 1")==-1  //v10, 11, 12, etc. is fine too
	);
}
if('standalone' in navigator && 
		navigator.standalone && 
		(/iphone|ipod|ipad/gi).test(navigator.platform) && 
		(/Safari/i).test(navigator.appVersion)){
	var isInAppForm = true;
}

function onBeginLoad(){
	if(!isMobileSafari){
		popupDiv.innerHTML = "<span class='popuptext show' id='loadingPopup'>Loading soundtrack</span>";
		
		/*
		var rect = document.getElementById("popup-locator").getBoundingClientRect();
		var popupText = document.getElementById("loadingPopup");
		popupText.style.position = "absolute;";
		popupText.style.top = rect.top;
		popupText.style.left = rect.left;
		var playRect = document.getElementById("play-container").getBoundingClientRect();
		popupText.style.width = playRect.width;
		popupText.style.height = playRect.height;
		*/

	}
}

function onEndLoad(){
	popupDiv.innerHTML = "<span class='popuptext hide' id='loadingPopup'>Loading soundtrack</span>";
}