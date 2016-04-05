<?php 
# Name: Dyllon Maitland-Bowman
# Course: CSE 154
# TA: Cava, Zachary M.
# Description: Displays a rotten tomatoes page of different movies dependent
#              on what "film" parameter you pass

		$film = "tmnt";
		if(isset($_GET["film"])){
			$film = $_GET["film"];
		} 
		$info = file("$film/info.txt");
		$overview = file("$film/overview.txt");
		$overview_image = "$film/overview.png";
		$reviews = glob("$film/review*.txt");
		?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=strtoupper($film) ?> - Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<div class="banner">
			<div class="bannerimage">
				<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
			</div>
		</div>
		
			<h1 id="heading"><?=$info[0] ?> (<?=$info[1] ?>)</h1>

			<div id="content">
				<div id="overview">
					<div>
						<img src="<?=$overview_image ?>" alt="general overview" />
					</div>

					<dl id="details">
						<?php 
						foreach($overview as $detail){
							$temp = explode(":", $detail); ?>
							<dt class="details-heading"><?=$temp[0] ?></dt>
							<dd><?=$temp[1] ?></dd>
						<? } ?>
					</dl>
				</div>
			<div class="rating">
				<img class="rating-image" src="https://webster.cs.washington.edu/images/<?=get_overall_score_image($info) ?>large.png" alt="<?=get_overall_score_image($info) ?>" />
				<span class="percent"><?=$info[2] ?>%</span>
			</div>
			
			<div id="reviews">
				<div id="first-column">
					<?php 
					# Goes through 1/2 of the reviews and puts them in the first column
					for($i = 0; $i < round(count($reviews) / 2); $i++){ 
						$review_details = file($reviews[$i]);
						?>
						<div class="review">
							<p class="quote">
								<img src="https://webster.cs.washington.edu/images/<?=strtolower(substr($review_details[1], 0, -1)) ?>.gif" alt="Rotten" />
								<span class="quote-text"><q><?=$review_details[0] ?></q></span>
							</p>
							<p class="reviewer">
								<img src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic" />
								<?=$review_details[2] ?> <br />
								<?=$review_details[3] ?>
							</p>
						</div>
					<? } ?>
				</div>

				<div id="second-column">
					<?php 
					# Goes through the second half the the reviews and puts them in the second column
					for($i = round(count($reviews)) / 2; $i < count($reviews); $i++){ 
						$review_details = file($reviews[$i]); ?>
						<div class="review">
							<p class="quote">
								<img src="https://webster.cs.washington.edu/images/<?=strtolower(substr($review_details[1], 0, -1)) ?>.gif" alt="Rotten" />
								<span class="quote-text"><q><?=$review_details[0] ?></q></span>
							</p>
							<p class="reviewer">
								<img src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic" />
								<?=$review_details[2] ?> <br />
								<?=$review_details[3] ?>
							</p>
						</div>
					<? } ?>
				</div>
			</div>
		</div>
		<div id="page">(1-<?=count($reviews) ?>) of <?=count($reviews) ?>
			<div class="rating">
				<img class="rating-image" src="https://webster.cs.washington.edu/images/<?=get_overall_score_image($info) ?>large.png" alt="<?=get_overall_score_image($info) ?>" />
				<span class="percent"><?=$info[2] ?>%</span>
			</div>
		</div>


		<div id="validators">
			<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
			<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
		</div>

		<div class="banner">
			<div class="bannerimage">
				<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
			</div>
		</div>
	</body>
</html>
<?php
# Returns "rotten" or "fresh" depending on the percentage the movie has.
# This is used to get the correct image to display next to the percentage.
function get_overall_score_image($info){ 
	$image = "rotten";
	if($info[2] >= 60){
		$image = "fresh";
	}
	return $image;
}?>
