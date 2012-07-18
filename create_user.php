<?php
	# mit Datenbank verbinden
	include("conect_db.php");

	# Ueberpruefen ob Daten per POST gekommen sind
	if (!empty($_POST["submit"])) {
 		# MySQL Injections vorbeugen
		$_username = mysql_real_escape_string($_POST["username"]);
		$_password = mysql_real_escape_string($_POST["password"]);
		$_mail = mysql_real_escape_string($_POST["mail"]);

		# Befehl für die MySQL Datenbank
		mysql_query("INSERT INTO `d0149a8f`.`users` (`id`, `username`, `password`, `email`, `active`, `last_login`)
						VALUES (NULL, '$_username', md5('$_password'), '$_mail', '1', '')");
 	 }

	include("test.html");
	mysql_close($link);
?>