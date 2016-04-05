<?php
$MAX_GUESSES  = 6; # max guesses that can be made before game ends
if(isset($_COOKIE["guesses"])){
  $guesses = $_COOKIE["guesses"]; # number of guesses the player has left
}else{
  $guesses = $MAX_GUESSES;
  setcookie("guesses", $guesses);
}



if(isset($_COOKIE["available"])){
  $available = $_COOKIE["available"];
}else{
  $available = "abcdefghijklmnopqrstuvwxyz";
  setcookie("available", $available);   # letters available to be guessed
}

# pick a random word from the dictionary file
if(isset($_COOKIE["word"])){
  $word = $_COOKIE["word"];
}else{
  $words = file("/www/html/cse154/labs/5/words.txt", FILE_IGNORE_NEW_LINES);
  $word  = $words[rand(0, count($words))];
  setcookie("word", $word);
}	

if(isset($_GET["guess"])){
  $guess = $_GET["guess"];
  if(preg_match("/[a-z]/i", $guess) && $guesses > 0 && preg_match("/$guess/", $available)){
    if(!preg_match("/$guess/", $word)){
      setcookie("guesses", $guesses - 1);
    }
    setcookie("available", preg_replace("/$guess/", "", $available));
  }
}

$clue = "???";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hangman</title>
    <link href="https://webster.cs.washington.edu/cse154/labs/5/hangman.css" type="text/css" rel="stylesheet" />
  </head>
  
  <body>
    <h1>Hangman Step by Step</h1>
    
    <div>
      <img src="https://webster.cs.washington.edu/cse154/labs/5/hangman<?= $guesses ?>.gif" alt="hangman" /> <br />
      (<?= $guesses ?> guesses remaining)
    </div>
    
    <div id="clue"> <?= $clue ?> </div>
    
		<form action="hangman.php">
			<input name="guess" type="text" size="1" maxlength="1" autofocus="autofocus" />
			<input type="submit" value="Guess" />
		</form>
    
		<form action="hangman.php" method="post">
			<input name="newgame" type="hidden" value="true" />
      <? if($guesses == 0){ ?>
        <div id="lose">Game Over! You Lost!</div>
      <? } ?>
			<input type="submit" value="New Game" />
		</form>

    <div id="hint">
    	HINT: The word is: <code>"<?= $word ?>"</code> <br />
    	The letters available are: <code>"<?= $available ?>"</code>
    </div>
  </body>
</html>
