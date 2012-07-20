<?php
    SESSION_START();
	
 	if ($_SESSION["login"] == 1) {
		# mit Datenbank verbinden
		include("conect_db.php");

		# Ueberpruefen ob Daten per POST gekommen sind
		if (!empty($_POST["submit"])) {
 			# MySQL Injections vorbeugen
			$_username = mysql_real_escape_string($_POST["username"]);
			$_password = mysql_real_escape_string($_POST["password"]);
			$_password2 = mysql_real_escape_string($_POST["password2"]);
			$_mail = mysql_real_escape_string($_POST["mail"]);

			$_checkifuserexists = mysql_query("SELECT * FROM users WHERE
						username='$_username'
			 		LIMIT 1");

			 		$_anzahl = @mysql_num_rows($_checkifuserexists);
			if ($_password != $_password2)	{
				echo "<h1>Die Passw&ouml;rter stimmen nicht &uuml;berein!</h1>";
			} elseif ($_anzahl > 0) {
				echo "<h1>Der User existiert bereits!</h1>";				
			} else {
				# Befehl für die MySQL Datenbank
				mysql_query("INSERT INTO `d0149a8f`.`users` (`id`, `username`, `password`, `email`, `active`, `last_login`)
								VALUES (NULL, '$_username', md5('$_password'), '$_mail', '1', '')");
				echo "<h1>User " . $_username . " wurde angelegt.</h1>";
			}
 		 }
 		 echo '<form method="POST" action="create_user.php">';
			echo 'Username: <input name="username"><br>';
			echo 'Passwort: <input name="password" type=password><br>';
			echo 'Passwort wiederholen: <input name="password2" type=password><br>';
			echo 'eMail: <input name="mail"><br>';
			echo '<input type=submit name=submit value="User erstellen">';
		echo '</form>';
		mysql_close($link);

		echo '<a href="index.php">zur&uuml;ck</a></br>';
	} else {
		echo "Du bist nicht eingelogt!";
	}
?>