<?php
	# mit Datenbank verbinden
	include("conect_db.php");
    SESSION_START();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>MS Projekt A</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
    	<div class="content">
    	
			<?php
				include("login.php");
				if ($_SESSION["login"] == 1) {
					echo '<table width="100%" border="1"><tr>';
					echo '<td><a href="index.php?menu=change_password">Passwort &auml;ndern</a></td>';
					if ($_SESSION[user][admin] == 1) {
						echo '<td><a href="index.php?menu=create_user">Neuen User anlegen</a></td>';
						echo '<td><a href="index.php?menu=delete_user">User l&ouml;schen</a></td>';
					}
					
					echo '<td><a href="logout.php">Logout</a></td>';
					echo '</tr>';
					echo '<tr><td colspan="4">';
					if ($_GET["menu"] == NULL) {
						include("select_adventure.php");
					} elseif ($_GET["menu"] == "change_password") {
						include("change_password.php");
					} elseif ($_GET["menu"] == "create_user") {
						include("create_user.php");
					} elseif ($_GET["menu"] == "delete_user") {
						include("delete_user.php");
					}
					echo '</tr>';
					#echo '<tr><td colspan="4"><strong>Inhalt von Session: </strong>';
					#print_r($_SESSION);
					echo '</tr></table>';
				} else {
					echo "Du bist nicht eingelogt!";
				}
				mysql_close($link);
			?>

        </div>
	</body>
</html>