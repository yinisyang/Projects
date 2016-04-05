(function(){
	"use strict";
	var isHit;
	var hasStarted;
	var konamiCode = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65]
	var codeIndex = 0;

	window.onload = function(){
		isHit = false;
		hasStarted = false;
		var boundary = document.querySelectorAll(".boundary");
		for(var i = 0; i < boundary.length; i++){
			boundary[i].onmouseover = wallMouseOver;
		}	

		var endBox = document.getElementById("end");
		endBox.onmouseover = winOrLose;

		var startBox = document.getElementById("start");
		startBox.onclick = resetGame;

		var maze = document.getElementById("maze");
		maze.onmouseleave = cheater;

		document.body.onkeypress = checkCode;
	};

	function checkCode(event){
		if(event.keyCode == konamiCode[codeIndex] && codeIndex < konamiCode.length){
			codeIndex++;
		}else{
			codeIndex = 0;
		}
		if(codeIndex == konamiCode.length){
			alert("Booyah");
		}
	}
	

	function tickTimer(){
		time++;
		document.getElementById("timer").innerHTML = time;
	}

	function lose(){
		isHit = true;
		if(hasStarted){
			var boundary = document.querySelectorAll(".boundary");
			for(var i = 0; i < boundary.length; i++){
				boundary[i].classList.add("youlose");
			}
		}
	}

	function cheater(){
		if(hasStarted){
			lose();
		}
	}

	function wallMouseOver(){
		lose();
	}

	var time;
	var timerID;

	function resetGame(){
		isHit = false;
		var boundary = document.querySelectorAll(".boundary");
		for(var i = 0; i < boundary.length; i++){
			boundary[i].classList.remove("youlose");
		}
		var status = document.getElementById("status");
		status.innerHTML = "Move your mouse over the \"S\" to begin.";
		if(hasStarted === false){
			timerID = setInterval(tickTimer, 1000);
		}
		time = 0;
		hasStarted = true;
	}

	function winOrLose(){
		var status = document.getElementById("status");
		if(isHit){
			status.innerHTML = "Sorry, you lost. :[";
			var lives = document.getElementById("lives");
			var numberOfLives = parseInt(lives.innerHTML);
			if(numberOfLives > 0 && hasStarted){
				lives.innerHTML = (numberOfLives - 1) + " Lives Remaining";
			}
		}else{
			status.innerHTML = "You win! :]";
		}
		hasStarted = false;
		clearInterval(timerID);
	}
})();