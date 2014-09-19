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

	$sql = "select pea_total,pea_total_hombres, pea_total_mujeres, pea_ocupada,  pea_ocup_hom, pea_ocup_muj, pea_desocupada, pea_desocup_hom, pea_desoc_muj,
				  no_pea, no_pea_hombres, no_pea_muj,  no_especificada, no_especif_hom, no_esp_muj from economia where id=". $id;
	//echo $sql ."<br>";
	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr align='center'><td colspan='4'><strong>Poblaci&oacute;n de 12 a&ntilde;os y m&aacute;s.</strong></td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Econ&oacute;micamente activa</strong></td><td align='center'>".$row[0]."</td><td align='center'>".$row[1]."</td><td align='center'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td>Ocupada</td><td align='center'>".$row[3]."</td><td align='center'>".$row[4]."</td><td align='center'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td>Desocupada</td><td align='center'>".$row[6]."</td><td align='center'>".$row[7]."</td><td align='center'>".$row[8]."</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p align='justify'>De cada 100 personas de 12 a&ntilde;os y m&aacute;s, ".round($row[0])." participan en las actividades econ&oacute;micas, de cada 100 de estas personas ".round($row[3])." tienen alguna ocupaci&oacute;n.</p>";
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>No econ&oacute;micamente activa</strong></td><td align='center'>".$row[9]."</td><td align='center'>".$row[10]."</td><td align='center'>".$row[11]."</td>";
		$datos["datos"] .= "<tr><td></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Condici&oacute;n de actividad no especificada</strong></td><td align='center'>".$row[12]."</td><td align='center'>".$row[13]."</td><td align='center'>".$row[14]."</td>";
		$datos["datos"] .= "</table>";
		

	}

	$sql = "select pen_jub, pen_jub_hom, pen_muj, 
			estudiantes, estudiantes_hom, estudiantes_muj, 
			hogar, hogar_hom, hogar_muj,
			limitaciones ,limitaciones_hom, limitaciones_muj, 
			no_ecomicas, no_eco_hom, no_eco_muj
			from economia_distribucion where id=". $id;
	//echo $sql ."<br>";
	$result = $db->query($sql);

	foreach($result as $row) {
		$datos["datos"] .= "</br><hr/><br><table width='100%'>";
		$datos["datos"] .= "<tr><td align='center'><strong>Distribuci&oacute;n de la poblaci&oacute;n de 12 a&ntilde;os y m&aacute;s no econ&oacute;micamente activa.</strong></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td>Pensionados o jubilados</td><td align='center'>".$row[0]."</td><td align='center'>".$row[1]."</td><td align='center'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td>Estudiantes</td><td align='center'>".$row[3]."</td><td align='center'>".$row[4]."</td><td align='center'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td>Personas dedicadas al hogar</td><td align='center'>".$row[6]."</td><td align='center'>".$row[7]."</td><td align='center'>".$row[8]."</td></tr>";
		$datos["datos"] .= "<tr><td><small>Personas con alguna limitaci&oacute;n fisica o mental pernamente que les impide trabajar</small></td><td align='center'>".$row[9]."</td><td align='center'>".$row[10]."</td><td align='center'>".$row[11]."</td></tr>";
		$datos["datos"] .= "<tr><td>Personas en otras actividades econ&oacute;micas</td><td align='center'>".$row[12]."</td><td align='center'>".$row[13]."</td><td align='center'>".$row[14]."</td></tr>";
		$datos["datos"] .= "</table>";
	}
	$datos["datos"] .= "</body></html>";

	echo json_encode($datos);
}
?>