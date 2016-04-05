<?php 

# This page takes a name from the matches page and then shows all of the users who are
# compatible with the user with that name

include("common.php");

$users = file("singles.txt");

# Finds the specified user and stores his/her information
foreach($users as $user){
	$temp = explode(",", $user);
	if(strcmp($_GET["name"], $temp[0]) == 0){
		list($name, $gender, $age, $personality, $os, $min_age, $max_age) = $temp;
	}
}

top_of_page(); ?>
<!-- page content -->
<?php 

# Goes through every user, checks if they are compatible with the specified user,
# and displays their information if they are
foreach($users as $user) {
	# t_var refers to "target_var"
	list($t_name, $t_gender, $t_age, $t_personality, $t_os, $t_min_age, $t_max_age) = explode(",",  $user);
	#The only way I can think of to make this less then 100 characters is to split it into two if statements which seemed redundant so I kept it as one.
	if((($gender=="M"&&$t_gender=="F")||($gender=="F"&&$t_gender=="M"))&&($min_age<$t_age&&$max_age>$t_age)&&($os==$t_os)&&preg_match("/[$personality]/",$t_personality)){?>
		<div class="match">	
			<p>
				<img src="https://webster.cs.washington.edu/images/nerdluv/user.jpg" alt="photo">
				<?=$t_name ?>
			</p>
			<ul>
				<li><strong>gender:</strong>  <?=$t_gender ?></li>
				<li><strong>age:</strong>     <?=$t_age ?></li>
				<li><strong>type:</strong>    <?=$t_personality ?></li>
				<li><strong>OS:</strong>      <?=$t_os ?></li>
			</ul>
		</div>
<? 	} 
}
bottom_of_page(); ?>