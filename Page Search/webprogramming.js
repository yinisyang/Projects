(function(){

	var walkTimerID = null;
	//var frames = new Array(new Image(16, 32), new Image(16, 32), new Image(16, 32), new Image(16, 32));
	var marioFrames;

	window.onload = function(){
		marioFrames = document.querySelectorAll(".mario");


		// Setting the position of the 'screws' on the main header
		var header = document.getElementById("header");
		var headerwidth = parseInt(window.getComputedStyle(header).width);
		var headerheight = parseInt(window.getComputedStyle(header).height);
		var screws = document.querySelectorAll(".screw");
		screws[0].style.top = "5px";
		screws[0].style.left = "5px";
		screws[1].style.top = "5px";
		screws[1].style.left = (headerwidth - 10) + "px";
		screws[2].style.top = (headerheight - 10) + "px";
		screws[2].style.left = "5px";
		screws[3].style.top = (headerheight - 10) + "px";
		screws[3].style.left = (headerwidth - 10) + "px";

		// Start walking animation
		document.onkeypress = startTick;
		document.onkeyup = endTick;
	}

	function startTick(){
		if(!walkTimerID){
			walkTimerID = setInterval(tick, 5);
		}
	}

	function endTick(){
		clearInterval(walkTimerID);
		walkTimerID = null;
		count = 0;
		for(var i = 0; i < marioFrames.length; i++){
			marioFrames[i].style.display = "none";
		}
		marioFrames[0].style.display = "block";
	}

	var count = 3;

	// Mario walking animation
	function tick() {
		if(Math.floor(count) === 0){
			count = 3;
		}
		for(var i = 0; i < marioFrames.length; i++){
			marioFrames[i].style.display = "none";
		}
		marioFrames[Math.ceil(count)].style.display = "block";
		count -= 0.1;
		console.log(count);
		var frames = document.getElementById("frames");
		frames.style.left = parseInt(window.getComputedStyle(frames).left) + 2 + "px";
		//console.log(frames.style.left);
	}
})();