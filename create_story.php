
<?php
  SESSION_START();
	

include("conect_db.php");

		# Ueberpruefen ob Daten per POST gekommen sind
		if (!empty($_POST["submit"])) {
 			# MySQL Injections vorbeugen
			$_nsetting = mysql_real_escape_string($_POST["nsetting"]);
			$_ncampaign = mysql_real_escape_string($_POST["ncampaign"]);
			$_nadventure = mysql_real_escape_string($_POST["nadventure"]);
			$_nshort = mysql_real_escape_string($_POST["nshort"]);
			$_nlong = mysql_real_escape_string($_POST["elm1"]);
			$_ngamemaster = $_SESSION[user][id];
				# Befehl für die MySQL Datenbank
				if ( ($_nsetting != NULL) && ($_ncampaign != NULL) &&($_nadventure != NULL) &&($_nshort != NULL) &&($_nlong != NULL)) {
					mysql_query("INSERT INTO `adventures`(`id`, `adventure`, `campaign`, `setting`, `gamemaster`, `short_info`, `long_info`) 
							VALUES ('','$_nadventure','$_ncampaign','$_nsetting','$_ngamemaster','$_nshort','$_nlong')");
							echo 'Abenteuer wurde erfolgreich erstellt.';
							
				} else{ echo "F&uuml;ll alles aus!";
				}
			}
		
			
?>


	


<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,charmap,emotions,iespell,media,advhr,",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>	
	<div>
			
	<form method="POST" action="index.php?menu=create_story" >
		<table align="center">
			<tr><td>Setting? <br /><input name="nsetting" size="40"></td></tr>
			<tr><td>Kampagne? <br /><input name="ncampaign" size="40"></td></tr>	
			<tr><td>Abenteuer? <br /><input name="nadventure" size="40"></td></tr>					

			<tr><td>Kurzbeschreibung? <br /><textarea name="nshort" cols="40" rows="3" maxlength="150"></textarea>
			
		
		</table>
		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div>
			<textarea id="elm1" name="elm1" rows="15" cols="40" style="width: 80%">
			</textarea>
		</div>	
		<input type="submit" name="submit" value="Erstellen" />
		
	</form>
	<form action="index.php" method="post">
	<input type="submit" value="Zur&uuml;ck">
	</form>

	

		<br />
	</div>


<script type="text/javascript" >
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>
<br /></td></tr>


