<?php 

# This page takes all of the information passed by the signup page
# and then stores that users information in singles.txt

include("common.php");

# I did this to make the file_put_contents a shorter statement
$name = $_POST["name"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$personality = $_POST["personality"];
$os = $_POST["os"];
$min_age = $_POST["min_target_age"];
$max_age = $_POST["max_target_age"];

file_put_contents("singles.txt", $name.",".$gender.",".$age.",".$personality.",".$os.",".$min_age.",".$max_age."\n", FILE_APPEND);

top_of_page(); ?>
<!-- page content -->
		<p><strong>Thank you!</strong></p>
		<p>Welcome to Nerdluv, <?=$name ?>!</p>

<? 
bottom_of_page(); ?>