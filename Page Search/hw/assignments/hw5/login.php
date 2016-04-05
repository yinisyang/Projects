<?php 

# Dyllon Maitland-Bowman
# CSE 154 Homework 5
# This page analyzes the username and password passed to it throught the POST array
# and it either logs the user in if the user already exists, redirects back to start.php
# if the login fails or creates a new user if the user does not exist

session_start();
# Redirects to todolist.php if the user already has a session
if(isset($_SESSION["username"])){
	header("Location: todolist.php");
	die();
}

# Redirects back to start.php if either field is not set
if(!isset($_POST["name"]) || !isset($_POST["password"])){
	header("Location: start.php");
	die();
}

$username = $_POST["name"];
$password = $_POST["password"];

$users = file("users.txt");
foreach($users as $user){
	list($temp_username, $temp_password) = explode(":", trim($user));
	# Successful login with already existing user
	if($username == $temp_username && $password == $temp_password){
		$_SESSION["username"] = $username;
		setcookie("last_login", date("D y M d, g:i:s a"), time() + 7 /*<-days*/ * 24 /*<-hours*/* 60 /*<-minutes*/* 60/*<-seconds*/); # Last login time cookie
		header("Location: todolist.php");
		die();
	# Unsucessful login because of wrong password
	}elseif($username = $temp_username && $password != $temp_password){
		header("Location: start.php");
		die();
	}
}

# Create new user and check that the username and password meet the restrictions
if(preg_match("/^[a-z](\d|[a-z]){4,8}$/", $username) && preg_match("/^\d.{4,10}[\W]$/", $password)){
	file_put_contents("users.txt", $username.":".$password);
	file_put_contents("todo_$username.txt", ""); # Create a todolist file for the new user
	$_SESSION["username"] = $username;
	setcookie("last_login", date("D y M d, g:i:s a"), time() + 7 /*<-days*/ * 24 /*<-hours*/* 60 /*<-minutes*/* 60/*<-seconds*/); # Last login time cookie
	header("Location: todolist.php");
	die();
}
header("Location: start.php");

?>