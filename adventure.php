<?php

$_adventure = $_SESSION["selectAdventure"]["adventure"];
$_campaign = $_SESSION["selectAdventure"]["campaign"]; 
$_setting = $_SESSION["selectAdventure"]["setting"]; 


		$_quer = "SELECT long_info FROM adventures WHERE adventure ='$_adventure' AND campaign = '$_campaign' AND setting = '$_setting' ";
		$_quer = mysql_query($_quer) or die(mysql_error());
		$_linfo = mysql_fetch_assoc($_quer, MYSQL_ASSOC);

echo $_linfo[long_info];
?>
</form>
	<form action="index.php" method="post">
	<input type="submit" value="Zur&uuml;ck">
	</form>
	</br>
	<a href="index.php?menu=chars">Charaktere</a>
	</br>
	<a href="index.php?menu=irc">Chat beitreten</a>
