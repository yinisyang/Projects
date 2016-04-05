<?php 

# Dyllon Maitland-Bowman
# CSE 154 Homework 5
# This file contains the common html between all of the files


# Html for the top of the pages
function top_of_page(){ ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Remember the Cow</title>
		<link href="cow-provided.css" type="text/css" rel="stylesheet">
		<link href="cow.css" type="text/css" rel="stylesheet">
		<link href="https://webster.cs.washington.edu/images/todolist/favicon.ico" type="image/ico" rel="shortcut icon">
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<img src="https://webster.cs.washington.edu/images/todolist/logo.gif" alt="logo">
				Remember<br>the Cow
			</h1>
		</div>
<? } 

# Html for the bottom of the pages
function bottom_of_page(){ ?>
<div class="headfoot">
	<p>
		"Remember The Cow is nice, but it's a total copy of another site." - PCWorld<br>
		All pages and content © Copyright CowPie Inc.
	</p>

	<div id="w3c">
		<a href="https://webster.cs.washington.edu/validate-html.php">
			<img src="https://webster.cs.washington.edu/w3c-html.png" alt="Valid HTML"></a>
		<a href="https://webster.cs.washington.edu/validate-css.php">
			<img src="https://webster.cs.washington.edu/w3c-css.png" alt="Valid CSS"></a>
	</div>
</div>
	
</body></html>
<? } ?>