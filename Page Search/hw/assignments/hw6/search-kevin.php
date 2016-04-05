<?php 
#Dyllon Maitland-Bowman
#CSE 154
#5/14/2014

# This page displays all of the movies that a given actors has
# been in with Kevin Bacon

include("common.php");
top_of_page();

$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];

$database = db_setup();

$first_name = $database->quote($firstname);
$last_name = $database->quote($lastname);

# Query returns the name and year of release of all the movies that an
# actor has been in with Kevin Bacon
$rows = $database->query("SELECT m.name, m.year
							FROM movies m
							JOIN roles r on r.movie_id = m.id
							JOIN actors a on a.id = r.actor_id
							JOIN roles r2 on r2.movie_id = m.id
							JOIN actors a2 on a2.id = r2.actor_id
							WHERE a2.first_name = 'Kevin' 
								AND a2.last_name = 'Bacon'
								AND a.first_name = $first_name
								AND a.last_name = $last_name"); ?>
<div id="main" >
	<h1>Results for <?=$firstname." ".$lastname ?></h1>
	<p>Films with <?=$firstname." ".$lastname ?> and Kevin Bacon</p>
	<? display_results($rows, $firstname, $lastname);
	forms() ?>
</div>
<? bottom_of_page() ?>