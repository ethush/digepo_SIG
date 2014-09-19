<?php
include_once 'utils.php';

if ($_GET) {
	$utils =new Utils();
	$id = $_GET['id'];

	/*Apertura y conexion a base de datos*/
	try{
		$db = new PDO("sqlite:localidades.s3db");
	}
	catch(PDOException $ex){
		die("Fatal: ".$ex->getMessage);
	}

	$datos["datos"] = "<!doctype html><html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'>";
	
	$sql = "select municipio,distrito, region,clave from municipios where id=".$id;

	$result = $db->query($sql);
	//extrae el nombre del municipio para consultar los grupos de edades
	$nombre_municipio = "";
	
	foreach($result as $row) {
		$datos["datos"] .= "<div align='center'> <h3>".$row[0]."</h3>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Distrito:".$utils->sanear_string(utf8_encode($row[1]))."</h4></p>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Regi&oacute;n: ".$row[2]."</h4></p>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Clave Geoestad&iacute;stica: ".$row[3]."</h4></p>";
		$datos["datos"] .= "</div><hr>";

		$nombre_municipio = $row[0];
	}


	$sql = "select por_nacida_entidad, por_nacido_hom, por_nacido_muj,
	        poblacion_nacida, total_nacido_hom, total_nacido_muj,
	        por_nacidos_otra_ent, por_nacido_otra_hom, por_nacido_otra_muj,
	        nacidos_otra_ent, total_nacido_otro_hom, total_nacido_otro_muj,
	        residente, residente_hom, residente_muj,
	        residente_otra_ent, residente_otra_ent_hom, residente_otra_ent_muj
			from migracion where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td></td><td>TOTAL</td><td>HOMBRES</td><td>MUJERES</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n nacida en la entidad</strong></td><td align='center'><strong>".$row[0]."</strong></td><td align='center'><strong>".$row[1]."</strong></td><td align='center'><strong>".$row[2]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='center'>".$row[3]."</td><td align='center'>".$row[4]."</td><td align='center'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n nacida en otra entidad.</strong></td><td align='center'><strong>".$row[6]."</strong></td><td align='center'><strong>".$row[7]."</strong></td><td align='center'><strong>".$row[8]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='center'>".$row[9]."</td><td align='center'>".$row[10]."</td><td align='center'>".$row[11]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n de 5 a&ntilde;os y m&aacute;s residentes en la entidad en junio de 2005.</strong></td><td align='center'>".$row[12]."</td><td align='center'>".$row[13]."</td><td align='center'>".$row[14]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n de 5 a&ntilde;os y m&aacute;s residente en otra entidad en junio de 2005.</strong></td><td align='center'>".$row[15]."</td><td align='center'>".$row[16]."</td><td align='center'>".$row[17]."</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p align='justify'>De cada 100 personas, ".round(str_replace("%", "", $row[0]))." son nacidas en la entidad, ".round(str_replace("%", "", $row[1]))." son hombres y ".round(str_replace("%", "", $row[2]))." son mujeres.</p>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>