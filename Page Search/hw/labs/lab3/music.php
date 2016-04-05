<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="https://www.cs.washington.edu/education/courses/cse190m/12sp/labs/3/viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
		<!-- Number of Songs (Variables) -->
		<?php  $numberOfSongs=5678 ?>
		<p>
			I love music.
			I have <?=$numberOfSongs ?> total songs,
			which is over <?=$numberOfSongs / 10 ?> hours of music!
		</p>

		<!-- Music Results Pages (Loops) -->
		<div class="section">
			<h2>Google's Music Results</h2>
		
			<ol>
				<?php  for($i = 1; $i <=5; $i++) { ?>
					<li><a href="https://www.google.com/search?tbm=nws&amp;q=Music&amp;start=<?=($i - 1) * 10 ?>">Page <?=$i ?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Favorite Artists (Arrays) -->
		<?php $artists = file("favorite.txt") ?>
		<!-- Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php foreach($artists as $artist) {?>
					<a href="https://www.vevo.com/artist/<?=$artist ?>"><li><?=$artist ?></li></a>
				<?php } ?>
			</ol>
		</div>
		
		<!-- Music (Multiple Files) -->
		<!-- MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php $songs = glob("/www/html/cse154/songs/*.mp3");
				$playlists = glob("/www/html/cse154/songs/*.m3u");
				foreach($songs as $song) { ?>
				<li class="mp3item">
					<a href="http://webster.cs.washington.edu/cse154/songs/<?=basename($song) ?>"><?=basename($song) ?>  (<?=round(filesize($song) / 1024)?> KB)</a>
				</li>
				<?php } 
				foreach($playlists as $playlist) { ?>

				<?php } ?>
				<!--<li class="mp3item">
					<a href="http://webster.cs.washington.edu/cse154/songs/Be More.mp3">Be More.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="http://webster.cs.washington.edu/cse154/songs/Just Because.mp3">Just Because.mp3</a>
				</li>

				<li class="mp3item">
					<a href="http://webster.cs.washington.edu/cse154/songs/Drift Away.mp3">Drift Away.mp3</a>
				</li> -->

				<!-- Exercise 8: Playlists (Files) -->

				
				<li class="playlistitem">154-mix.m3u:
					<ul>
						<li>Hello.mp3</li>
						<li>Be More.mp3</li>
						<li>Drift Away.mp3</li>
						<li>Panda Sneeze.mp3</li>
					</ul>
				</li>
			</ul>
		</div>

		<div>
			<a href="https://webster.cs.washington.edu/validate-html.php">
				<img src="http://webster.cs.washington.edu/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://webster.cs.washington.edu/validate-css.php">
				<img src="http://webster.cs.washington.edu/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
