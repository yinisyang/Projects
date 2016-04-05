<?php 

#This page takes a name and passes it to the matches-submit page

include("common.php");
top_of_page(); ?>
<!-- page content -->
		<form action="matches-submit.php" method="get">
			<fieldset>
				<legend>Returning User:</legend>
				<strong class="column">Name:</strong>
				<input type="text" name="name" />
				<br/>
				<input type="submit" value="View My Matches" />
			</fieldset>
		</form>
<? 
bottom_of_page(); ?>