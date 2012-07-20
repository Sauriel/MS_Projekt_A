<?php
	if ($_SESSION["login"] == 1) {
		echo '<h1>Sie wurden eingeloggt.</h1>';
		echo "Inhalt von Session: ";
		print_r($_SESSION);
		echo '</br>';
		echo '<a href="create_user.php">Neuen User anlegen</a></br>';
		echo '<a href="change_password.php">Passwort &auml;ndern</a></br>';
		echo '<a href="delete_user.php">User l&ouml;schen</a></br>';
		echo '<a href="logout.php">Logout</a></br>';
	} else {
		echo "Du bist nicht eingelogt!";
	}
?>