<?php 

# Dyllon Maitland-Bowman
# CSE 154 Homework 5
# This page displays the todo list of the particular user
# and allows them to add new items and delete items from the list

session_start();
include("common.php");
if(!isset($_SESSION["username"])){
	header("Location: start.php");
	die();
}

$username = $_SESSION["username"];

$list = file("todo_$username.txt");

top_of_page();
?>
		<div id="main">
			<h2><?=$_SESSION["username"] ?>'s To-Do List</h2>

			<ul id="todolist">
				<?php 
				for($i = 0; $i < count($list); $i++){ ?>
					<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="delete" />
						<input type="hidden" name="index" value="<?=$i ?>" />
						<input type="submit" value="Delete" />
					</form>
					<?=htmlspecialchars($list[$i]) ?>
				</li>
				<? } ?>
				
				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="25" autofocus="autofocus" />
						<input type="submit" value="Add" />
					</form>
				</li> 
			</ul>

			<div>
				<a href="logout.php"><strong>Log Out</strong></a>
				<?if(isset($_COOKIE["last_login"])){ ?>
					<em>(logged in since <?=$_COOKIE["last_login"] ?>)</em>
				<? } ?>
			</div>

		</div>

<?
bottom_of_page();
?>
