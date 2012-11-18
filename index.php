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
		<div class="bggradient">&nbsp;</div>
		<div class="logo"><img src="images/logo.png" alt="J.A.R.V.I.S. - just a roleplaying valued information system" /></div>
		
    	<div class="content">
    	
			<?php
				echo '<table width="100%"><tr><td align="center">';
				include("login.php");
				if ($_SESSION["login"] == 1) {
					if ($_GET["menu"] == NULL) {
						include("select_adventure.php");
					} elseif ($_GET["menu"] == "change_password") {
						include("change_password.php");
					} elseif ($_GET["menu"] == "create_user") {
						include("create_user.php");
					} elseif ($_GET["menu"] == "delete_user") {
						include("delete_user.php");
					} elseif ($_GET["menu"] == "adventuretime") {
						include("adventure.php"); 
					} elseif ($_GET["menu"] == "create_story") {
						include("create_story.php");
					}
				} else {
					echo "Du bist nicht eingelogt!";
				}
				echo '</td></tr></table>';
				mysql_close($link);
			?>

        </div>
        <?php
			if ($_SESSION["login"] == 1) {
       		echo '<div class="menu">';
        			echo '<table width="100%" ><tr><td></td><td width="100px">';
					echo '<ul>';
  						echo '<li><img src="images/user.png" />&nbsp;<strong>' . $_SESSION[user][username] . '</strong>';
   							echo ' <ul>';
								echo '<li><a href="index.php?menu=change_password">Passwort &auml;ndern</a</li>';
								if ($_SESSION[user][admin] == 1) {
      								echo '<li><a href="index.php?menu=create_user">Neuen User anlegen</a></li>';
      								echo '<li><a href="index.php?menu=delete_user">User l&ouml;schen</a></li>';
      							}
      							echo '<li><a href="logout.php">Logout</a></li>';
							echo '</ul>';
						echo '</li>';
					echo '</ul>';
					echo '</td></tr></table>';
				echo '</div>';
			}
		?>
	</body>
</html>