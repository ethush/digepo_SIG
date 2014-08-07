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
		$datos["datos"] = "<html><head><meta charset='utf-8'></head><body style='background: #a9a46f;'><table>";
		$datos["datos"] .= "<tr><td><strong>Total de viviendas particulares habitadas:</strong></td><td><strong>".$row[0]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'><small>*Se consideran viviendas sin informaci&oacute;n de ocupantes.</small></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Promedio de ocupantes por vivienda:</strong></td><td><strong>".$row[1]."</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'><small>**Se excluyen las viendas sin informaci&oacute;n de ocupantes y su poblaci&oacute;n estimada.</small></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Viviendas con piso de tierra:</strong></td><td><strong>".$row[2]."%</strong></td></tr>";
		$datos["datos"] .= "<tr><td colspan='2'><small>Por cada 100 viviendas, ".round($row[2])." tienen piso de tierra.</small></td></tr>";
		$datos["datos"] .= "</table></body></html>";
	}

	echo json_encode($datos);
}
?>