<?php
    SESSION_START();
	
 	if ($_SESSION["login"] == 1) {
		# mit Datenbank verbinden
		include("conect_db.php");

		# Ueberpruefen ob Daten per POST gekommen sind
		if (!empty($_POST["submit"])) {
 			# MySQL Injections vorbeugen
			$_user = mysql_real_escape_string($_POST["users"]);

			if ($_user == $_SESSION["user"]["username"])	{
				echo "<h1>Du kannst dich nicht selbst l&ouml;schen!</h1>";
			} else {
				# Befehl für die MySQL Datenbank
				$_change = "UPDATE users SET active='0'
						WHERE username='$_user'";
				mysql_query($_change);
				echo "<h1>User " . $_user . " wurde gel&ouml;scht.</h1>";
			}
 		 }
 		 // Write out our query.
		$query = "SELECT username FROM users WHERE active=1";
		// Execute it, or return the error message if there's a problem.
		$result = mysql_query($query) or die(mysql_error());
		
		echo '<form method="POST" action="delete_user.php">';
			$dropdown = "<select name='users'>";
			while($row = mysql_fetch_assoc($result)) {
				if ($row['username'] != 'admin') {
					$dropdown .= "\r\n<option value='{$row['username']}'>{$row['username']}</option>";
				}
			}
			$dropdown .= "\r\n</select>";
			echo $dropdown;
			echo '<input type=submit name=submit value="User l&ouml;schen">';
		echo '</form>';

		echo '<a href="index.php">zur&uuml;ck</a></br>';
	} else {
		echo "Du bist nicht eingelogt!";
	}
?>