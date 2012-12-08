<?php 
SESSION_START();

	// Check, ob User eingeloggt ist.
	if ($_SESSION["login"] == 1) {
		
		echo '<html>';
		echo '<body>';
		echo 	'<table border="0" align="center">';
		echo 		'<tr>';
		echo			'<td>';
							// iframe ist eine Methode um z.B. einen IRC in eine Website einzubetten.
							
		echo				'<iframe src="http://webchat.quakenet.org/?nick='.$_SESSION["user"]["username"].'&channels=' . $_server_channel . '&uio=MTE9MjE131" width="550" height="600"></iframe>';
		
		/*echo				'<iframe src="http://lightirc.com/start/?host=irc.lightirc.com';
		echo				'&autojoin=%23rpg_irc&language=de';
		echo				'&showNickSelection=true&nick='.$_SESSION["user"]["username"].'&showIdentifySelection=false"';
		echo				'style="width:550px; height:400px;">';
		echo				'</iframe>'; */
		echo			'</td>';
		echo		'</tr>';
		echo		'<tr>';
		echo			'<td align="left" height="100">';
							// Ein button laesst den IRC-Bot auf den Server connecten.
		echo				'<form target="_blank" action="irc_bot.php">';
		echo					'<input type=submit name=submit value="IRC Log Aufzeichen">';
		echo				'</form>';
		echo				'<form action="index.php">';
		echo					'<input type=submit name=submit value="Zur&uuml;ck">';
		echo				'</form>';
		echo			'</td>';
		echo		'</tr>';
		echo 	'</table>';
		echo '</body>';
		echo '</html>';
		

	//Ist der User nicht eingeloggt, kommt lediglich eine kurze Meldung und ein Link zur mainpage.
	} else {
		echo '<html>';
		echo 	'<body>';
		echo 		'<p> Sie sind nicht eingeloggt! Klicken Sie <a href="index.php">hier</a> um sich anzumelden. <p>';
		echo 	'</body>';
		echo '</html>';
	}
?>