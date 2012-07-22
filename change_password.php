<?php
    SESSION_START();
	
 	if ($_SESSION["login"] == 1) {
		# mit Datenbank verbinden
		include("conect_db.php");

		# Ueberpruefen ob Daten per POST gekommen sind
		if (!empty($_POST["submit"])) {
 			# MySQL Injections vorbeugen
			$_password = mysql_real_escape_string($_POST["password"]);
			$_password2 = mysql_real_escape_string($_POST["password2"]);

			if ($_password != $_password2)	{
				echo "<h1>Die Passw&ouml;rter stimmen nicht &uuml;berein!</h1>";
			} else {
				# Befehl für die MySQL Datenbank
				$_change = "UPDATE users SET password=md5('$_password')
						WHERE id=".$_SESSION["user"]["id"];
				mysql_query($_change);
				echo "<h1>Das Passwort f&uuml;r user " . $_username . " wurde ge&auml;ndert.</h1>";
			}
 		 }
 		echo '<table>';
 		 echo '<form method="POST" action="change_password.php">';
			echo '<tr><td>neues Passwort:</td>';
			echo '<td><input name="password" type=password></td></tr>';
			echo '<tr><td>neues Passwort wiederholen:</td>';
			echo '<td><input name="password2" type=password></td></tr>';
			echo '<tr><td colspan="2" align="center"><input type=submit name=submit value="Passwort &auml;ndern"></td></tr>';
		echo '</form>';
		echo '</table>';

		echo '<a href="index.php">zur&uuml;ck</a></br>';
	} else {
		echo "Du bist nicht eingelogt!";
	}
?>