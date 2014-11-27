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
		$datos["datos"] .= "<div align='center'> <h3>".str_replace("ñ", "&ntilde;", utf8_encode($row[0]))."</h3>";
		$nombre_municipio = str_replace("ñ", "&ntilde;", utf8_encode($row[1]));
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Distrito:".$utils->sanear_string($nombre_municipio)."</h4></p>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Regi&oacute;n: ".str_replace("ñ", "&ntilde;", utf8_encode($row[2]))."</h4></p>";
		$datos["datos"] .= "<p style='margin-top:-15px'><h4>Clave Geoestad&iacute;stica: ".$row[3]."</h4></p>";
		$datos["datos"] .= "</div><hr>";

		$nombre_municipio = $row[0];
	}


	$sql = "select con_limitacion, con_limitacion_hom, con_limitacion_muj,
       		caminar_moverse, caminar_moverse_hom, caminar_moverse_muj,
       		ver, ver_hom, ver_muj,
       		escuchar, escuchar_hom, escuchar_muj,
       		hablar_com, hablar_com_hom, hablar_com_muj,
       		atender_cuidado, atender_cuidado_hom, atender_cuidado_muj,
       		atencion_aprender, atencion_aprender_hom, atencion_aprender_muj,
       		mental, mental_hom, mental_muj
			from limitaciones where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n con alg&uacute;n tipo de limitaci&oacute;n</strong></td><td align='right'>".$row[0]."</td><td align='right'>".$row[1]."</td><td align='right'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Porcentaje de poblaci&oacute;n seg&uacute;n tipo de actividad</strong></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Caminar o moverse</strong></td><td align='right'>".$row[3]."</td><td align='right'>".$row[4]."</td><td align='right'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Ver</strong></td><td align='right'>".$row[6]."</td><td align='right'>".$row[7]."</td><td align='right'>".$row[8]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Escuchar</strong></td><td align='right'>".$row[9]."</td><td align='right'>".$row[10]."</td><td align='right'>".$row[11]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Hablar o comunicarse</strong></td><td align='right'>".$row[12]."</td><td align='right'>".$row[13]."</td><td align='right'>".$row[14]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Atender el cuidado personal</strong></td><td align='right'>".$row[15]."</td><td align='right'>".$row[16]."</td><td align='right'>".$row[17]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poner atenci&oacute;n o aprender</strong></td><td align='right'>".$row[18]."</td><td align='right'>".$row[19]."</td><td align='right'>".$row[20]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Mental</strong></td><td align='right'>".$row[21]."</td><td align='right'>".$row[22]."</td><td align='right'>".$row[23]."</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p align='justify'>De cada 100 personas ".round($row[0])." reportan alguna limitaci&oacute;n f&iacute;sica.</p>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>