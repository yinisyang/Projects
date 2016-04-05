<!DOCTYPE html>
<html>
	<!-- This is a test page that you can use to make sure you're able to
	     perform queries in MySQL properly on the server. -->
	
	<head>
		<title>CSE 154 Database Query Test</title>
	</head>

	<body>
		<table>
		<?php
		# connect to the imdb_small database
		$db = new PDO("mysql:dbname=imdb", "dyllonb", "YFcBd2YWtg");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		# query the database to see the movie names
		$rows = $db->query("SELECT first_name, last_name, role
							FROM actors a
							JOIN roles r ON r.actor_id = a.id
							JOIN movies m ON m.id = r.movie_id
							WHERE m.name = 'PI'; ");
		foreach ($rows as $row) {
			?>
			<tr>
				<td>
					<?= $row["first_name"] ?>
				</td>
				<td>
					<?= $row["last_name"] ?>
				</td>
				<td>
					<?= $row["role"] ?>
				</td>
			</tr>
			<?php
		}
		?>
		</table>
	</body>
</html>
