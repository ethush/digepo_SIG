<?php 

if ($_GET) {

	$id = $_GET['id'];

	/*Apertura y conexion a base de datos*/
	try{
		$db = new PDO("sqlite:localidades.s3db");
	}
	catch(PDOException $ex){
		die("Fatal: ".$ex->getMessage);
	}

	$datos["datos"] = "<html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'>";
	
	$sql = "select municipio,distrito, region,clave from municipios where id=".$id;

	$result = $db->query($sql);

	foreach($result as $row) {
		$datos["datos"] .= "<div align='center'> <h3>".$row[0]."</h3>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Distrito:".sanear_string(utf8_encode($row[1]))."</h4></p>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Regi&oacute;n: ".$row[2]."</h4></p>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Clave Geoestad&iacute;stica: ".$row[3]."</h4></p>";
		$datos["datos"] .= "</div><hr>";
	}


	$sql = "select poblacion.p_total, poblacion.por_pob_estado, poblacion.r_dependencia, poblacion.mediana, poblacion.rel_h_m, 
			marginacion.ind_marginacion, marginacion.g_marginacion, marginacion.escala, marginacion.contexto_estatal, marginacion.contexto_nacional,
			marginacion.por_sal_min from poblacion inner join marginacion on poblacion.id = marginacion.id where poblacion.id =". $id.";";

	//echo $sql ."<br>";

	$result = $db->query($sql);


	foreach($result as $row) {
		
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td><strong>Poblacion total:</strong></td><td><strong> ".$row[0] ."</strong> </td></tr>";
		$datos["datos"] .= "<tr><td colspan='2' >Representa el ".$row[1] ." de la poblaci&oacute;n del estado.</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Relaci&oacute;n hombres-mujeres: </strong></td><td ><strong>" .$row[4]. "</strong</td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'>Por cada 100 mujeres hay ".round($row[4]). " hombres.</td></tr>" ;
		$datos["datos"] .= "<tr><td><strong>Edad mediana:</strong></td><td><strong>".$row[3] ."</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'>La mitad de la poblaci&oacute;n es menor de ".$row[3]. " a&ntilde;os.</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Raz&oacute;n de dependencia econ&oacute;mica: </strong></td><td><strong>".$row[2]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'>Por cada 100 personas hay ".round(str_replace("%","", $row[2])) ." en edad de dependencia (menores de 15 a&ntilde;os o mayores de 64 a&ntilde;os). </strong></td></tr>";
		// Seccion de idicadores de marginación

		$datos["datos"] .= "</table><br><hr><h3>&Iacute;ndices:</h3><h4><strong>-&Iacute;ndice de Marginaci&oacute;n</strong></h4><br><table width='100%'>";
		$datos["datos"] .= "<tr align='center'><td><strong>&Iacute;ndice de marginaci&oacute;n:</strong></td><td><strong>Grado de marginaci&oacute;n</strong></td><td><strong>&Iacute;ndice de marginaci&oacute;n escala 0 a 100</strong></td><td><strong>Lugar que ocupa en el contexto estatal</strong></td><td><strong>Lugar que ocupa en el contexto nacional:</strong></td></tr> ";
		$datos["datos"] .= "<tr align='center'><td>".$row[5]."</td><td>".$row[7]."</td><td>".$row[6]."</td><td>".$row[8]."</td><td>".$row[9]."</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p><strong>% Poblaci&oacute;n ocupada con ingreso de hasta 2 salarios m&iacute;nimos:</strong> ". $row[10]."</p><br>";
		
	}

	$sql = "select total_hogares,por_recibe_remesa,por_emigrantes_eu,por_migrantes_circulantes,por_migrantes_retorno,ind_int_mig,g_int_mig from intensidad_migratoria where id =".$id;
	$result = $db->query($sql);
		
	foreach($result as $row) {
		//Seccion de intensidad migratoria

		$datos["datos"] .= "<h4><strong>-&Iacute;ndice y grado de intensidad migratoria.</strong></h4>";
		$datos["datos"] .= "<table width='100%'><tr><td><strong>Total de hogares:</strong></td><td> ".$row[0]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>% Hogares que reciben remesas: </strong></td><td>".$row[1]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>% Hogares con emigrantes en Estados Unidos del quinquenio anterior:</strong></td><td>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>% Hogares con migrantes circulares del quinquenio anterior:</strong></td><td>".$row[3]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>% Hogares con migrantes de retorno del quinquenio anterior:</strong></td><td>".$row[4]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>&Iacute;ndice de intensidad migratoria:</strong></td><td>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Grado de intensidad migratoria:</strong></ul></td><td>".$row[6]."</td></tr>";
		
	}
//echo $datos["datos"];

	$datos["datos"] .= "</body></html>";
	//$datos["datos"] = utf8_encode($datos["datos"]);
	//echo $datos["datos"];
	//var_dump($datos);

	echo json_encode($datos);
}

function sanear_string($string)
{
	$string = str_replace(
		array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		$string
	);
	$string = str_replace(
		array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		$string
	);
	$string = str_replace(
		array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		$string
	);
	$string = str_replace(
		array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		$string
	);
	$string = str_replace(
		array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		$string
	);
	$string = str_replace(
		array('ç', 'Ç'),
		array('c', 'C',),
		$string
	);
	
	return $string;
}

 ?>