<?php
	include("config.php");						# Konfiguration mit einbinden
	SESSION_START();

	# Verbindung zur Datenbank herstellen
	$link = mysql_connect($_db_host, $_db_username, $_db_password);

	# Konnte keine Verbindung hergestellt werden?
	if (!$link) {
		die("Keine Datenbankverbindung möglich: " . mysql_error());
	}

	# Verbindung zur Datenbank herstellen
	$database = mysql_select_db($_db_database, $link);
	mysql_query("SET NAMES 'utf8'");

	if (!$database) {
 		echo "Kann die Datenbank nicht benutzen: " . mysql_error();
 		mysql_close($link); 						# Datenbank schliessen
 		exit; 										# Programm beenden !
 	}
 ?>