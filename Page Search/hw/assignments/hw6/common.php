<?php 
#Dyllon Maitland-Bowman
#CSE 154
#5/14/2014

#Contains all of the content the pages share

#displays the top of the page
function top_of_page(){ ?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>
<? }

#displays the bottom of the page
function bottom_of_page(){ ?>
			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div> <!-- end of #frame div -->
	</body>
</html>
<? } 

#displays the search fields that are common to every page
function forms() { ?>
<!-- form to search for every movie by a given actor -->
<form action="search-all.php" method="get">
		<fieldset>
			<legend>All movies</legend>
			<div>
				<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
				<input name="lastname" type="text" size="12" placeholder="last name" /> 
				<input type="submit" value="go" />
			</div>
		</fieldset>
	</form>

	<!-- form to search for movies where a given actor was with Kevin Bacon -->
	<form action="search-kevin.php" method="get">
		<fieldset>
			<legend>Movies with Kevin Bacon</legend>
			<div>
				<input name="firstname" type="text" size="12" placeholder="first name" /> 
				<input name="lastname" type="text" size="12" placeholder="last name" /> 
				<input type="submit" value="go" />
			</div>
		</fieldset>
	</form>
<? }

#displays the results of the query, rows. Needs first and last name
#in case the actors is not found.
function display_results($rows, $firstname, $lastname) { ?>
<table>
	<tr>
		<td class="table-header">#</td>
		<td class="table-header">Title</td>
		<td class="table-header">Year</td>
	</tr>	
	<?
	$count = 1; 
	foreach($rows as $row){ ?>
		<tr>
			<td><?=$count ?></td>
			<td><?=$row["name"] ?></td>
			<td><?=$row["year"] ?></td>
		</tr>
	<? 
	$count++;
	} 
	if($count == 1){ ?>
	<h2>Actor <?=$firstname." ".$lastname ?> not found.</h2>
	<? } ?>
</table>
<? } 

# Sets up the server connection then returns the PDO object
function db_setup(){
	$database = new PDO("mysql:dbname=imdb;host=localhost", "dyllonb", "YFcBd2YWtg");
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $database;
}
?> 
