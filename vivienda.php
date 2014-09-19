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


	$sql = "select viv_habitadas, ocup_vivienda, piso_tierra from vivienda where id = ". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td><strong>Total de viviendas particulares habitadas:</strong></td><td align='right'><strong>".$row[0]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'>*Se consideran viviendas sin informaci&oacute;n de ocupantes.</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Promedio de ocupantes por vivienda:</strong></td><td align='right'><strong >".$row[1]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'>**Se excluyen las viendas sin informaci&oacute;n de ocupantes y su poblaci&oacute;n estimada.</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Viviendas con piso de tierra:</strong></td><td align='right'><strong>".$row[2]."%</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'>Por cada 100 viviendas, ".round($row[2])." tienen piso de tierra.</td></tr>";
		$datos["datos"] .= "</table></body></html>";
	}

	echo json_encode($datos);
}
?>