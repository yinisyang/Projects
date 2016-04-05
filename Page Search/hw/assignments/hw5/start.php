<?php 

# Dyllon Maitland-Bowman
# CSE 154 Homework 5
# This is the login page that the user sees. Here the user can enter a username and password
# and this page will pass the information to login.php. This page will also display the
# last login time if the user has been logged in before

session_start();
if(isset($_SESSION["username"])){
	header("Location: todolist.php");
	die();
}
include("common.php");
top_of_page();
?>
<div id="main">
	<p>
		The best way to manage your tasks. <br>
		Never forget the cow (or anything else) again!
	</p>

	<p>
		Log in now to manage your to-do list. <br>
		If you do not have an account, one will be created for you.
	</p>

	<form id="loginform" action="login.php" method="post">
		<div><input name="name" type="text" size="8" autofocus="autofocus"> <strong>User Name</strong></div>
		<div><input name="password" type="password" size="8"> <strong>Password</strong></div>
		<div><input type="submit" value="Log in"></div>
	</form>
	<?if(isset($_COOKIE["last_login"])){ ?>
	<p>
		<em>(last login from this computer was <?=$_COOKIE["last_login"] ?>)</em>
	</p>
	<? } ?>
</div>

<? 
bottom_of_page();
?>