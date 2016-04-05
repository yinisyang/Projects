(function(){

	// Dyllon Bowman
	// 6/4/2014
	// Homework 9: Baby Names
	// This page displays various information about names give a gender
	// like meaning, popularity, and celebrities with that name

	"use strict";

	window.onload = function(){
		document.getElementById("search").onclick = search;
		sendRequest("type=list", initializeList);
		var loading = document.querySelectorAll(".loading");
		for(var i = 0; i < loading.length; i++){
			loading[i].style.display = "none";
		}
		document.getElementById("loadingnames").style.display = "";
	};

	// Loads the names from the ajax request into the name selector box
	// Is disabled by default then enables itself once everything has been
	// loaded and sets the display of the loading gif to none when done
	// loading
	function initializeList(){
		if(this.status == 200){
			var names = this.responseText.split("\n");
			var list = document.getElementById("allnames");
			for(var i = 0; i < names.length; i++){
				// console.log(names[i]);
				var option = document.createElement("option");
				option.innerHTML = names[i];
				list.appendChild(option);
			}
			list.disabled = false;
			
		}else{
			document.getElementById("errors").innerHTML = this.responseText;
		}
		document.getElementById("loadingnames").style.display = "none";
	}

	// Shows the meaning of the name on the page. If there
	// is an error it displays en error message sets the display
	// of the loading gif to none when it is done loading
	function showMeaning(){
		var meaning = document.getElementById("meaning");
		if(this.status == 200){
			meaning.innerHTML = this.responseText;

		}else{
			document.getElementById("errors").innerHTML = this.responseText;
		}
		document.getElementById("loadingmeaning").style.display = "none";
		document.getElementById("resultsarea").style.display = "";
	}

	// Reads an XML file from the babynames webservice to create a
	// graph from the years and rankings of the names from those years
	// If no data for that name is found it displays an error message instead
	function showRanking(){
		var ranking = document.getElementById("graph");
		if(this.status == 200){
			var ranks = this.responseXML.getElementsByTagName("rank");
			var years = document.createElement("tr");
			var rankNumbers = document.createElement("tr");
			for(var i = 0; i < ranks.length; i++){
				var header = document.createElement("th");
				header.innerText = ranks[i].getAttribute("year");
				years.appendChild(header);
				var tempDiv = document.createElement("div");
				tempDiv.style.backgroundColor = "#FBB";
				tempDiv.style.width = "50px";
				tempDiv.style.textAlign = "center";
				var rankNumber = parseInt(ranks[i].textContent);
				// Only set the height above zero if the rankNumber is above 0
				if(rankNumber > 0){
					// If rank is between 1 and 10 make the text red
					if(rankNumber <= 10){
						tempDiv.style.color = "red";
					}
					tempDiv.style.height = Math.floor((1000 - rankNumber) / 4) + "px";
				}else{
					tempDiv.style.height = "0px";
				}
				tempDiv.innerText = rankNumber;
				var td = document.createElement("td");
				td.style.height = "250px";
				td.style.verticalAlign = "bottom";
				td.appendChild(tempDiv);
				rankNumbers.appendChild(td);
			}
			ranking.appendChild(years);
			ranking.appendChild(rankNumbers);
		}else if(this.status == 410){
			var norankdata = document.getElementById("norankdata"); 
			norankdata.style.display = "";
			norankdata.innerText = "There is no ranking data for that name/gender combination.";
		}else{
			document.getElementById("errors").innerHTML = this.responseText;
		}
		document.getElementById("loadinggraph").style.display = "none";
	}

	// Shows the names of celebrities that share the selected
	// name and how many films they have been in
	function showCelebs(){
		var celebList = document.getElementById("celebs");
		if(this.status == 200){
			var json = JSON.parse(this.responseText);
			for(var i = 0; i < json.actors.length; i++){
				var li = document.createElement("li");
				var actor = json.actors[i];
				li.innerText = actor.firstName + " " + actor.lastName + " (" + actor.filmCount + ")";
				celebList.appendChild(li);
			}
		}else{
			document.getElementById("errors").innerHTML = this.responseText;
		}
		document.getElementById("loadingcelebs").style.display = "none";
	}

	// Function to call the sendRequest function multiple times to get all of
	// the data the page needs
	function search(){
		// Clear everything in the relevant divs that contain the name information
		document.getElementById("meaning").innerHTML = "";
		document.getElementById("graph").innerHTML = "";
		document.getElementById("celebs").innerHTML = "";
		document.getElementById("norankdata").style.display = "none";

		// Call the function to send the ajax requests three times
		var name = document.getElementById("allnames").value;
		sendRequest("type=meaning&name=" + name, showMeaning);
		document.getElementById("loadingmeaning").style.display = "";
		var gender = "f";
		if(document.getElementById("genderm").checked){
			gender = "m";
		}
		console.log(gender);
		sendRequest("type=rank&name=" + name + "&gender=" + gender, showRanking);
		document.getElementById("loadinggraph").style.display = "";
		sendRequest("type=celebs&name=" + name + "&gender=" + gender, showCelebs);
		document.getElementById("loadingcelebs").style.display = "";
	}

	// Sends the ajax request. Takes the GET parameters and the function to call
	// when the request comes back. Sending a function as a parameter makes factoring
	// out code easier
	function sendRequest(params, loadFunction){
		var ajax = new XMLHttpRequest();
		ajax.onload = loadFunction;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/babynames.php?" + params, true);
		ajax.send();
	}
})();