<?php
	SESSION_START();

	set_time_limit(0);
	include ("config.php");
	$_todaysdateFix = date('d-m-y');
		
		$_server = array();
		// fsockopen stellt eine Verbindung zu einem host her, hier der IRC-Server.
		$_server["SOCKET"] = @fsockopen($_server_host, $_server_port, $_errno, $_errstr, 2);
		if ($_server["SOCKET"]) {
			SendCommand ("NICK recordBOT\r\n");
			SendCommand ("USER recordBOT USING PHP IRC\r\n");
			/* Da schlecht absehbar ist, wie lange die while-Schleife laufen soll, ist
				sie endlos initialisiert, sie wird spaeter durch "break" abgebrochen. */
			while (true) {
			
				/* Der IRC-Server sendet Text, der hier mit jedem Schleifendurchlauf
					in $_server["READ_BUFFER"] eingelesen wird. */
				$_server["READ_BUFFER"] = fgets($_server["SOCKET"], 1024);
				
				// Der empfangene Text wird hier gleich wieder sichtbar ausgegeben.
				echo "[RECIVE] ".$_server["READ_BUFFER"]."<br>\r\n";
				
				/* Der letzte Sting der "message of the day" lautet "End of /MOTD command.".
					Wird dieser String empfangen, soll sich der Bot auf den IRC-Channel verbinden. */
				if (strpos($_server["READ_BUFFER"], "End of /MOTD command.")) {
					SendCommand ("JOIN $_server_channel\r\n");
				}
				
				/* Wurde sich erfolgreich verbunden, gibt der Server den String
					"End of /NAMES list." aus. Wird dieser empfangen, wurde sich
					erfolgreich verbunden und der Bot begruesst den Chat.
					Daraufhin wird die while-Schleife abgebrochen. */
				if (strpos($_server["READ_BUFFER"], "End of /NAMES list.")) {
					SendCommand("PRIVMSG #rpg_irc :Hallo alle!\r\n");
					break;
				}
			
			// flush leert den Buffer des Servers (?).
			flush();
			}
			
			// Eine erneute Endlosschleife, da der Bot vom User manuell beendet werden soll.
			while(true) {
			
				/* Erneut wird die erste Zeile eingelesen. Dieses mal sind es direkt Strings die von
					Usern an den Chat gesendet wurden. */
				$_server["READ_BUFFER"] = fgets($_server["SOCKET"], 1024);
				echo $_server["READ_BUFFER"];
				
				/* Hier wird das Log erstellt, eine .txt die den Names des aktuellen Datums traegt.
					Ist sie nicht vorhanden, wird sie angelegt.
					Ist sie vorhanden, wird am Ende der Datei weitergeschieben.
					Sie wird mit empfangenen Zeilen des Buffers beschrieben. */
				$_todaysdate = date('d-m-y');
				
				/* hier wird verhindert, dass bei einem Datumsuebergang waehrend einer Sitzung
					die Datei mit dem alten Datum nicht geschlossen wird. */
				if ($_todaysdate == $_todaysdateFix) {
					$_openeddata = fopen("$_todaysdateFix.txt", "a");
					fwrite($_openeddata, $_server["READ_BUFFER"]."\r\n");
				} else {
					fclose($_openeddata);
					$_todaysdateFix = $_todaysdate;
					$_openeddata = fopen("$_todaysdate.txt", "a");
					fwrite($_openeddata, $_server["READ_BUFFER"]."\r\n");
				}
				
				/* Gibt der User "ENDRECORD" ein, wird die Schleife und somit der Bot beendet.
					WICHTIG: wird der Bot auf andere Art beendet, z.b. duch schlieﬂen des Konsolenfensers
					wird die geoeffnete Datei nicht via fclose geschlossen und sie kann nicht mehr vom Bot
					geoeffent werden.*/
				if (strpos($_server["READ_BUFFER"], "ENDRECORD")) {
					SendCommand("Bye!");
					fclose($_openeddata);
					flush();
					break;
				}
				
				/* Der Server sendet in regelmaessigen Abstaenden ein command namens "PING" dieses muss
					mit "PONG" und einem vorgegebenen String zurueck an den Server gesendet werden.
					Dieses Verfahren dient zur ueberpruefung der Latenz des Bots zum Server.
					Da der String sich, zumindest auf diesem Server, nicht veraendert, wird dieser "hart"
					zurueckgegeben. In der Regel ist dieser String eine Zufallszahl, hier ist es
					"Jolly.GeekShed.net". Wird kein PONG zurueckgegeben, bekommt der Bot ein timeout und
					fliegt vom Server. */
				if (strpos($_server["READ_BUFFER"], "GeekShed")) {
					SendCommand("PONG :Jolly.GeekShed.net");
				}
			}
		}
		
	// SendCommand ist eine Funktion, die einen String an den IRC-Server sendet.
	function SendCommand ($cmd) {
		global $_server;
		@fwrite($_server["SOCKET"], $cmd, strlen($cmd));
		echo "[SEND] $cmd <br>";
	}

?>