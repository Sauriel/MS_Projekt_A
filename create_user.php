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
			$_admin = mysql_real_escape_string($_POST["admin"]);

			$_checkifuserexists = mysql_query("SELECT * FROM users WHERE
						username='$_username'
			 		LIMIT 1");

			 		$_anzahl = @mysql_num_rows($_checkifuserexists);
			if ($_password != $_password2)	{
				echo "<h1>Die Passw&ouml;rter stimmen nicht &uuml;berein!</h1>";
			} elseif ($_anzahl > 0) {
				echo "<h1>Der User existiert bereits!</h1>";
			} elseif (empty($_username)) {
				echo "<h1>Du hast keinen Usernamen eingegeben!</h1>";
			} elseif (empty($_password)) {
				echo "<h1>Du hast kein Passwort eingegeben!</h1>";
			} else {
				# Befehl für die MySQL Datenbank
				mysql_query("INSERT INTO `users` (`id`, `username`, `password`, `email`, `active`, `last_login`, `admin`)
								VALUES (NULL, '$_username', md5('$_password'), '$_mail', '1', '', '$_admin')");
				echo "<h1>User " . $_username . " wurde angelegt.</h1>";
			}
 		 }
 		echo '<table>';
 		 echo '<form method="POST" action="index.php?menu=create_user">';
			echo '<tr><td>Username:</td>';
			echo '<td><input name="username"></td></tr>';
			echo '<tr><td>Passwort:</td>';
			echo '<td><input name="password" type=password></td></tr>';
			echo '<tr><td>Passwort wiederholen:</td>';
			echo '<td><input name="password2" type=password></td></tr>';
			echo '<tr><td>eMail:</td>';
			echo '<td><input name="mail"></td></tr>';
			echo '<tr><td colspan="2" align="center"><select name="admin">';
			echo '<option value="0">User</option>';
			echo '<option value="1">Admin</option>';
			echo '</select></td></tr>';
			echo '<tr><td colspan="2" align="center"><input type=submit name=submit value="User erstellen"></td></tr>';
		echo '</form>';
		echo '</table>';

		echo '<a href="index.php">zur&uuml;ck</a></br>';
	} else {
		echo "Du bist nicht eingelogt!";
	}
?>