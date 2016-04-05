// CSE 154 ASCIIMation
// Dyllon Maitland-Bowman
// 5/21/2014

(function(){
	"use strict";

	window.onload = function(){
		var sizeSelector = document.getElementById("size");
		sizeSelector.onchange = sizeSelect;

		var animationSelector = document.getElementById("animation");
		animationSelector.onchange = animationSelect;

		var startButton = document.getElementById("start");
		startButton.onclick = start;

		var stopButton = document.getElementById("stop");
		stopButton.disabled = true; // Make the stop button disabled by default when the page loads
		stopButton.onclick = stop;

		var turboButton = document.getElementById("turbo");
		turboButton.onclick = changeSpeed;

		var normalButton = document.getElementById("normal");
		normalButton.onclick = changeSpeed;

		var slomoButton = document.getElementById("slo-mo");
		slomoButton.onclick = changeSpeed;
	};

	function sizeSelect(){
		var textArea = document.getElementById("textarea");
		var sizeSelector = document.getElementById("size");
		textArea.style.fontSize = sizeSelector.options[sizeSelector.selectedIndex].value;
	}

	function animationSelect(){
		var animationSelector = document.getElementById("animation");
		var textArea = document.getElementById("textarea");
		var animation = animationSelector.options[animationSelector.selectedIndex].value;
		textArea.value = ANIMATIONS[animation];
	}

	var timerID;
	var animationString;

	// Sets up the animation so it is ready to be played and 
	// creates the timer to begin the animation
	function start(){
		document.getElementById("stop").disabled = false;
		document.getElementById("animation").disabled = true;
		this.disabled = true;
		var interval = parseInt(document.querySelector("input[type=radio]:checked").value);
		animationString = document.getElementById("textarea").value;
		timerID = setInterval(playAnimation, interval);
	}

	var frame = 0;

	// Steps the animation forward every time it is called
	function playAnimation(){
		var animation = animationString.split("=====\n");
		if(frame == animation.length){ // This loops the frame once its reached the end of the animation
			frame = 0;
		}
		document.getElementById("textarea").value = animation[frame];
		frame++;
	}

	// Sets the disabled properties of the start, stop, and animation fields
	// to their appropriate values and sets the text of the text area back to
	// the entire animation string
	function stop(){
		clearInterval(timerID);
		document.getElementById("start").disabled = false;
		document.getElementById("animation").disabled = false;
		this.disabled = true;
		frame = 0; // reset the frame so the next animation plays correctly
		document.getElementById("textarea").value = animationString;
	}

	// If a timer already exists it will create a new one with a different delay
	// and continue the animation where it left off with the new timer
	function changeSpeed(){
		if(timerID !== null){
			clearInterval(timerID);
			var interval = parseInt(document.querySelector("input[type=radio]:checked").value);
			timerID = setInterval(playAnimation, interval);
		}
	}
})();