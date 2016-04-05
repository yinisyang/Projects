(function(){

	"use strict";
	window.onload = function(){
		document.getElementById("loading").style.display = "none";
		document.getElementById("lookup").onclick = lookup;
		
	}

	function lookup(){
		document.getElementById("result").removeChild(document.getElementById("results"));
		document.getElementById("loading").style.display = "";
		var param = document.getElementById("term").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = displayData;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/labs/9/urban.php?term=" + param + "&all=true", true);
		ajax.send();
	}

	function fetchAuthor(){
		var authorName = this.innerHTML.substring(2);
		var ajax = new XMLHttpRequest();
		ajax.onload = displayAuthor;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/labs/9/urban.php?author=" + authorName, true);
		ajax.send();
	}

	function displayData(){
		document.getElementById("loading").style.display = "none";
		var list = document.createElement("ol");
		list.id = "results";
		document.getElementById("result").appendChild(list);
		var entries = this.responseXML.getElementsByTagName("entry");
		var definitions = this.responseXML.getElementsByTagName("definition");
		var examples = this.responseXML.getElementsByTagName("example");
		for(var i = 0; i < examples.length; i++){
			var listItem = document.createElement("li");
			var definition = document.createElement("p");
			var example = document.createElement("p");
			var author = document.createElement("p");
			example.classList.add("example");
			definition.innerHTML = definitions[i].textContent;
			example.innerHTML = examples[i].textContent;
			author.innerHTML = "- " + entries[i].getAttribute("author");
			author.classList.add("author");
			author.onclick = fetchAuthor;
			listItem.appendChild(definition);
			listItem.appendChild(example);
			listItem.appendChild(author);
			list.appendChild(listItem);
		}
	}

	function displayAuthor(){
		var related = document.getElementById("related");
		var entries = this.responseXML.getElementsByTagName("word");
		var author = this.responseXML.getElementsByTagName("words");
		var authorName = author[0].getAttribute("author");
		var heading = document.createElement("h2");
		var authorParagraph = document.createElement("p");
		heading.innerHTML = "All entries by " + authorName;
		related.appendChild(heading);
		for(var i = 0; i < entries.length - 1; i++){
			authorParagraph.innerHTML += entries[i].getAttribute("entry") + ", ";
		}
		authorParagraph.innerHTML += entries[entries.length - 1].getAttribute("entry");
		related.appendChild(authorParagraph);
	}

})();