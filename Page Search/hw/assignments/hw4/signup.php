<?php 

# This page takes a name, gender, age, personality type, favorite OS,
# and seeking age and passes them to the signup-submit page

include("common.php");
top_of_page(); ?>
<!-- page content -->
<form action="signup-submit.php" method="post">
	<fieldset>
		<legend>New User Signup:</legend>
		<strong class="column">Name:</strong> 
		<input type="text" size="16" name="name"/>
		<br/>
		<strong class="column">Gender:</strong> 
		<input type="radio" name="gender" value="M">Male
		<input type="radio" name="gender" value="F">Female
		<br/>
		<strong class="column">Age:</strong>
		<input type="text" name="age" size="6" /><br/>
		<strong class="column">Personality type:</strong>
		<input type="text" name="personality" size="6" maxlength="4"/>
		(<a href="http://www.humanmetrics.com/cgi-win/jtypes2.asp">Don't know your type?</a>)
		<br/>
		<strong class="column">Favorite OS:</strong>
		<select name="os">
			<option selected="selected">Windows</option>
			<option>Mac OS X</option>
			<option>Linux</option>
		</select>
		<br/>
		<strong class="column">Seeking Age:</strong>
		<input type="text" name="min_target_age" placeholder="min" size="6"/>
		to
		<input type="text" name="max_target_age" placeholder="max" size="6"/>
		<br/>
		<input type="submit" value="Sign Up" />
	</fieldset>
</form>
<? 
bottom_of_page(); ?>