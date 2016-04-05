<?php 
#Dyllon Maitland-Bowman
#CSE 154
#5/14/2014

# This is the homepage. From here you can either search for the movies an actor
# has been in or you can see which movies an actor has been in with Kevin Bacon.

include("common.php");
top_of_page(); ?>
<div id="main">
	<h1>The One Degree of Kevin Bacon</h1>
	<p>Type in an actor's name to see if he/she was ever in a movie with Kevin Bacon!</p>
	<p><img src="https://webster.cs.washington.edu/images/kevinbacon/kevin_bacon.jpg" alt="Kevin Bacon" /></p>

	<? forms(); ?>
</div> <!-- end of #main div -->	
<? bottom_of_page(); ?>
