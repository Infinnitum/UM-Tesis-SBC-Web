<?phprequire 'global.php';$KB_LIST="";$query = $_SERVER['PHP_SELF'];$path = pathinfo( $query );$basename = $path['basename'];$dirFiles = array();echo "<html>\n";echo "<head>\n";echo "<title>Repositorio Central KX</title>\n";echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\"\n";echo "</head>\n";echo "<body style=\"background-color:#f0f0f0\">\n";echo "<div class=\"container\">\n";//echo "<select name=\"archivo\">\n";if(isset($_POST['save'])) {	//echo "/media/WebServer/tesis/data/".$_POST['file_name'];	//echo $_POST['content'];	file_put_contents("/media/WebServer/tesis/data/".$_POST['file_name'], $_POST['content']);} else if(isset($_POST['delete'])) {	if (file_exists("data/".$_POST['file_name'])) {		unlink("/media/WebServer/tesis/data/".$_POST['file_name']);	}}$DIR=opendir("$DOCUMENT_ROOT".$DIR_KB."/");//echo "<option>DIR_KB:".str_replace($basename,$DIR_KB,curPageURL())."/</option>\n";while ($file = readdir($DIR)){    if ($file!="." and $file!=".." and (endsWith($file,$EXT_KX))){        //echo "<option value=\"$file\">$file</option>\n";		$dirFiles[] = $file;    }}closedir($DIR);echo "<div class=\"col-sm-3 has-feedback\" style=\"background-color:#e5e5e5 ; height:100%\">\n";echo "<div style=\"margin-left:15px\" class=\"row\">\n";echo "<form method=\"post\" action=\"file_editor_kx.php\">";	echo "<button class=\"btn btn-primary\" style=\"width:90%; text-align:center\" type=\"submit\" name=\"new\" value=\"new\">Nuevo archivo</button>";echo "</form>";echo "</div>\n";	sort($dirFiles);	echo "<div style=\"margin-left:15px\" class=\"row\">\n";foreach($dirFiles as $f){    //echo "<li><a href=\"$f\" title=\"$f\">$f</a></li>\n";	//echo "<li><a href=\"?edit&file=data/$f\" title=\"$f\">$f</a></li>\n";	//echo "<div class=\"col-sm-3\">\n";	echo "<form method=\"post\" action=\"file_editor_kx.php\">";		echo "<input type=\"hidden\" name=\"edit\">";		echo "<input type=\"hidden\" name=\"file\" value=\"data/$f\">";		echo "<button type=\"submit\" class=\"btn btn-default\" style=\"width:90%; text-align:center\" name=\"file_name\" value=\"$f\">$f</button>";	echo "</form>\n";	//echo "</div>\n";}	echo "</div>\n";echo "</div>\n";//echo "</select>\n";if(isset($_POST['new'])) {	echo "<br>";	echo "<div class=\"col-sm-1\">\n";	echo "</div>\n";	echo "<div class=\"col-sm-8\">\n";	echo "<form class=\"form-horizontal\">";	echo "<div class=\"form-group form-group-sm has-feedback\">";	echo "<form method=\"post\">";		echo "<input type=\"hidden\" name=\"save\">";		echo "<input style=\"width:74.5%; margin-left:15px\" placeholder=\"Nombre del archivo (.kb para Bases de Conocimiento o .kx para Bases de Automatizacion)\" type=\"text\" name=\"file_name\" value=\"$_POST[file]\">";		echo "<br>";		echo "<textarea placeholder=\"Contenido del archivo\" style=\"height:75%; width:74.5%; margin-left:15px\" name=\"content\">";			echo file_get_contents($_POST['file']);		echo "</textarea >";		echo "<br>";		echo "<input class=\"btn btn-success\" type=\"submit\" style=\"width:35%;float:left; margin-left:15px\" value=\"Aceptar\">";	echo "</form>";	echo "<div style=\"padding:0 0 0 0\" class=\"col-sm-5\">\n";	echo "<form method=\"post\">";		echo "<input class=\"btn btn-warning\" type=\"submit\" style=\"width:95%;float:left\" value=\"Cancelar\">";	echo "</form>";	echo "</div>\n";	echo "</div>\n";	echo "</form>";	echo "</div>\n";		}else if(isset($_POST['edit'])) {	if(!isset($_POST['content'])) {		echo "<br>";		echo "<div class=\"col-sm-1\">\n";		echo "</div>\n";		echo "<div class=\"col-sm-8\">\n";		echo "<form class=\"form-horizontal\">";		echo "<div style=\"margin-left:1px\" class=\"form-group form-group-sm has-feedback\">";		echo "<form method=\"post\">";			echo "<input type=\"hidden\" name=\"save\">";			echo "<input type=\"hidden\" name=\"file\" value=\"$_POST[file]\">";			echo "<input type=\"hidden\" name=\"file_name\" value=\"$_POST[file_name]\">";			echo "<span>";			echo $_POST['file_name'];			echo "</span>";			echo "<br>";			echo "<textarea style=\"height:75%; width:75.5%\" name=\"content\">";				echo file_get_contents($_POST['file']);			echo "</textarea>";			echo "<br>";			echo "<input class=\"btn btn-success\" style=\"width:25%;float:left\" type=\"submit\" value=\"Modificar\">";		echo "</form>";		echo "<div style=\"padding:0 0 0 0\" class=\"col-sm-3\">\n";		echo "<form method=\"post\">";			echo "<input type=\"hidden\" name=\"delete\">";			echo "<input type=\"hidden\" name=\"file\" value=\"$_POST[file]\">";			echo "<input type=\"hidden\" name=\"file_name\" value=\"$_POST[file_name]\">";			echo "<input class=\"btn btn-danger\" type=\"submit\" style=\"width:100%;float:left\" value=\"Borrar\">";		echo "</form>";		echo "</div>\n";		echo "<div style=\"padding:0 0 0 0\" class=\"col-sm-3\">\n";		echo "<form method=\"post\">";			echo "<input class=\"btn btn-warning\" type=\"submit\" style=\"width:100%;float:right\" value=\"Cancelar\">";		echo "</form>";		echo "</div>\n";		echo "</div>\n";		echo "</form>";		echo "</div>\n";	}}echo "</div>\n";echo "</body>\n";echo "</html>";?>