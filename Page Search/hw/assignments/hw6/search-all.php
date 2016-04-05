<?php 
#Dyllon Maitland-Bowman
#CSE 154
#5/14/2014

# This page displays all of the movies that a given actor has been in
include("common.php");
top_of_page();

$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];

$database = db_setup();

$first_name = $database->quote($firstname);
$last_name = $database->quote($lastname);

# Query returns the name and year of release of all
# the movies an actor has been in
$rows = $database->query("SELECT m.name, m.year
							FROM movies m
							JOIN roles r on r.movie_id = m.id
							JOIN actors a on a.id = r.actor_id
							WHERE a.first_name = $first_name AND a.last_name = $last_name
							ORDER BY m.year DESC"); ?>
<div id="main" >
	<h1>Results for <?=$firstname." ".$lastname ?></h1>
	<? display_results($rows, $firstname, $lastname);
	forms() ?>
</div>
<? bottom_of_page() ?>