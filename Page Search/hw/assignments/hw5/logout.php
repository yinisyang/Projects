<?php

# Dyllon Maitland-Bowman
# CSE 154 Homework 5
# This page destroys the session if one exists then redirects to start.php
# and if the session does not exist if just redirects to start.php

session_start();
if(!isset($_SESSION["username"])){
	header("Location: start.php");
	die();
}
session_destroy();
header("Location: start.php");
?>