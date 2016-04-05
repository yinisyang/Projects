<?php

# Dyllon Maitland-Bowman
# CSE 154 Homework 5
# This file either deletes or adds items to/from the todo_$username.txt file
# depending on whether $_POST["action"] is set to "delete" or "add"

session_start();
if(!isset($_SESSION["username"])){
	header("Location: start.php");
	die();
}

$username = $_SESSION["username"];

if($_POST["action"] == "delete"){
	$index = $_POST["index"];
	$list = file("todo_$username.txt");
	if($index < 0 || $index >= count($list)){
		print "Index out of bounds";
		header("Location: todolist.php");
		die();
	}
	$list[$index] = "";
	file_put_contents("todo_$username.txt", $list);
}else{
	if($_POST["item"] == ""){
		header("Location: todolist.php");
		die();
	}
	file_put_contents("todo_$username.txt", $_POST["item"]."\n", FILE_APPEND);
}
header("Location: todolist.php");
?>