/*
Dyllon Maitland-Bowman
5/28/2014
CSE 154 Homework 8 (Fifteen Puzzle)
This is the js file for fifteen.html and
it allows you to play a fifteen puzzle where you
can move the tiles to try and recreate the image
*/
(function(){
	"use strict";
	var blankX = 300;
	var blankY = 300;

	window.onload = function(){
		document.getElementById("shufflebutton").onclick = shuffle;
		var puzzleArea = document.getElementById("puzzlearea");
		for(var i = 0; i < 15; i++){
			var piece = document.createElement("div");
			piece.classList.add("piece");
			piece.innerHTML = i + 1;
			piece.style.top = (100 * Math.floor(i / 4)) + "px";
			piece.style.left = (100 * (i % 4)) + "px";
			piece.style.backgroundPosition = (-100 * i) + "px " + (-100 * Math.floor(i / 4)) + "px";
			piece.onmouseover = highlight;
			piece.onmouseleave = unhighlight;
			piece.onclick = clickTile;
			puzzleArea.appendChild(piece);
		}
	};

	// Shuffles the tiles
	function shuffle(){
		// I put this up here so it is only called once instead of
		// 1000 or 4000 times
		var board = document.querySelectorAll(".piece");
		for(var i = 0; i < 1000; i++){
			var tiles = tilesAdjacentToSpace(board);
			var random = Math.floor(Math.random() * tiles.length);
			moveTile(tiles[random]);
		}
	}

	// Called when a tile is clicked.
	// I put this in a separate function so the shuffle method
	// could also call this function
	function clickTile(){
		if(isNextToSpace(this)){
			moveTile(this);
		}
	}

	// Highlights the tile under the mouse
	// if it is adjacent to the empty tile
	function highlight(){
		if(isNextToSpace(this)){
			this.classList.add("highlight");
			this.style.cursor = "pointer";
		}
	}

	// Returns the tile back to normal when
	// the mouse leaves
	function unhighlight(){
		this.classList.remove("highlight");
		this.style.cursor = "default";
	}

	// This function swaps the position of the clicked tile
	// and the blank tile if they are adjacent
	function moveTile(tile){
		var tempX = window.getComputedStyle(tile).left;
		var tempY = window.getComputedStyle(tile).top;
		tile.style.left = blankX + "px";
		tile.style.top = blankY + "px";
		blankX = parseInt(tempX);
		blankY = parseInt(tempY);
	}

	// Returns true if the targetTile is adjacent to the empty tile
	// else returns false
	function isNextToSpace(targetTile){
		var x = parseInt(window.getComputedStyle(targetTile).left);
		var y = parseInt(window.getComputedStyle(targetTile).top);
		// Check to the left
		if(x - 100 == blankX && y == blankY){
			return true;
		} // Check to the top
		else if(x == blankX && y - 100 == blankY){
			return true;
		} // Check to the right
		else if(x + 100 == blankX && y == blankY){
			return true;
		} // Check to the bottom
		else if(x == blankX && y + 100 == blankY){
			return true;
		}
		return false;
	}

	// Returns an array of the tiles adjacent to
	// the blank space
	function tilesAdjacentToSpace(board){
		//var board = document.querySelectorAll(".piece");
		var tiles = [];
		tiles.push(getTile(-100, 0, board));
		tiles.push(getTile(0, -100, board));
		tiles.push(getTile(100, 0, board));
		tiles.push(getTile(0, 100, board));
		var validTiles = [];
		// The way I set mine up some elements of the array will be null so
		// I need to make a new array of all the elements of the old array
		// that are not null. I think this is faster then going through my getTile
		// function twice for every tile
		for(var i = 0; i < 4; i++){
			if(tiles[i]){
				validTiles.push(tiles[i]);
			}
		}
		return validTiles;
	}

	// Checks to see if there is a tile at the dx and dy relative the x and
	// y of the blank space then returns that tile
	// If there is not a tile there it returns null
	function getTile(dx, dy, board){
		for(var i = 0; i < board.length; i++){
			var tileX = parseInt(window.getComputedStyle(board[i]).left);
			var tileY = parseInt(window.getComputedStyle(board[i]).top);
			if(tileX + dx == blankX && tileY + dy == blankY){
				return board[i];
			}
		}
		return null;
	}
})();