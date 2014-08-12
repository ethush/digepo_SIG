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

	$sql = "select viv_habitadas, ocup_vivienda, piso_tierra from vivienda where id = ". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] = "<html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'><table width='100%'>";
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