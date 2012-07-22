<?php
    SESSION_START();
	
 	if ($_SESSION["login"] == 1) {
		# mit Datenbank verbinden
		include("conect_db.php");

		# Überprüfen ob ein Setting gewählt wurde
		$_setting = mysql_real_escape_string($_POST["setting"]);
		if ($_setting != NULL) {
			if ($_setting != $_SESSION["selectAdventure"]["setting"]) {
				$_SESSION["selectAdventure"]["campaign"] = NULL;
				$_SESSION["selectAdventure"]["adventure"] = NULL;
			}
			$_SESSION["selectAdventure"]["setting"] = $_setting;
		} else {
			$_setting = $_SESSION["selectAdventure"]["setting"];
		}

		# Überprüfen ob eine Kampagne gewählt wurde
		$_campaign = mysql_real_escape_string($_POST["campaign"]);
		if ($_campaign != NULL) {
			if ($_campaign != $_SESSION["selectAdventure"]["campaign"]) {
				$_SESSION["selectAdventure"]["adventure"] = NULL;
			}
			$_SESSION["selectAdventure"]["setting"] = $_setting;
			$_SESSION["selectAdventure"]["campaign"] = $_campaign;
		} else {
			$_campaign = $_SESSION["selectAdventure"]["campaign"];
		}

		# Überprüfen ob ein Abenteuer gewählt wurde
		$_adventure = mysql_real_escape_string($_POST["adventure"]);
		if ($_adventure != NULL) {
			$_SESSION["selectAdventure"]["setting"] = $_setting;
			$_SESSION["selectAdventure"]["campaign"] = $_campaign;
			$_SESSION["selectAdventure"]["adventure"] = $_adventure;
		} else {
			$_adventure = $_SESSION["selectAdventure"]["adventure"];
		}

		# Auswahl erstellen
		$query = "SELECT DISTINCT setting FROM adventures";
		$result_s = mysql_query($query) or die(mysql_error());
		$query = "SELECT DISTINCT campaign FROM adventures WHERE setting='$_setting'";
		$result_c = mysql_query($query) or die(mysql_error());
		$query = "SELECT adventure FROM adventures WHERE campaign='$_campaign'";
		$result_a = mysql_query($query) or die(mysql_error());
		?>
		<table width="100%">
			<tr>
				<td width="32%">
					<strong>Setting:</strong>
					<form method="POST" action="index.php">
		
		<?php
			$dropdown = '<select name="setting" size=10 style="width:100%;" onchange="this.form.submit();">';
			while($row = mysql_fetch_assoc($result_s)) {
				$dropdown .= "\r\n<option value='{$row['setting']}'>{$row['setting']}</option>";
			}
			$dropdown .= "\r\n</select>";
			echo $dropdown;
		?>
		</td>
		<td>
		<strong>Kampagne:</strong>
			
		<?php
			$dropdown = '<select name="campaign" size=10 style="width:98%;" onchange="this.form.submit();">';
			while($row = mysql_fetch_assoc($result_c)) {
				$dropdown .= "\r\n<option value='{$row['campaign']}'>{$row['campaign']}</option>";
			}
			$dropdown .= "\r\n</select>";
			echo $dropdown;
		?>
		</td>
		<td width="32%">
		<strong>Abenteuer:</strong>
			
		<?php
			$dropdown = '<select name="adventure" size=10 style="width:100%;" onchange="this.form.submit();">';
			while($row = mysql_fetch_assoc($result_a)) {
				$dropdown .= "\r\n<option value='{$row['adventure']}'>{$row['adventure']}</option>";
			}
			$dropdown .= "\r\n</select>";
			echo $dropdown;
		?>
		</td>
		</tr>
		</table>
		</form>
		
		<?php
		if ($_SESSION["selectAdventure"]["adventure"] != NULL) {
			echo '<a href="#">' . $_SESSION["selectAdventure"]["adventure"] . ' beitreten</a> oder <a href="#">Neues Abenteuer erstellen</a>.';
		} else {
			echo 'Ein bestehendes Abenteuer ausw&auml;hlen oder <a href="#">Neues Abenteuer erstellen</a>.';	
		}
	} else {
		echo "Du bist nicht eingelogt!";
	}
?>