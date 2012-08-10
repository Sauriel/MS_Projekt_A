<?php 
SESSION_START();

	if ($_SESSION["login"] == 1) {
		
		echo '<html>';
		echo '<body>';
		echo 	'<table border="1" align="center">';
		echo 		'<tr>';
		echo			'<td>';
		echo				'<iframe src="http://lightirc.com/start/?host=irc.lightirc.com';
		echo				'&autojoin=%23rpg_irc&language=de';
		echo				'&showNickSelection=true&nick='.$_SESSION["user"]["username"].'&showIdentifySelection=false"';
		echo				'style="width:800px; height:400px;">';
		echo				'</iframe>';
		echo			'</td>';
		echo		'</tr>';
		echo		'<tr>';
		echo			'<td align="left" height="100">';
		echo				'<form action="irc_bot.php">';
		echo					'<input type=submit name=submit value="IRC Log Aufzeichen">';
		echo				'</form>';
		echo				'<form action="index.php">';
		echo					'<input type=submit name=submit value="Zurück">';
		echo				'</form>';
		echo			'</td>';
		echo		'</tr>';
		echo 	'</table>';
		echo '</body>';
		echo '</html>';
		

	} else {
		echo '<html>';
		echo 	'<body>';
		echo 		'<p> Sie sind nicht eingeloggt! Klicken Sie <a href="index.php">hier</a> um sich anzumelden. <p>';
		echo 	'</body>';
		echo '</html>';
	}
?>