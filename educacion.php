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

	$sql = "select total_r1, total_hombres_r1, total_mujeres_r1, total_r2, total_hombres_r2, total_mujeres_r2 from educacion where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] = "<html><head><meta charset='utf-8'></head><body style='background: #a9a46f;'><table>";
		$datos["datos"] .= "<tr><td><strong>Grupo de Edad</strong></td><td><strong>Total</strong></td><strong>Hombres</strong><td></td><strong>Mujeres</strong></tr>";
		$datos["datos"] .= "<tr><td> 15-24 a&ntilde;os</td><td>".$row[0]."</td><td>".$row[1]."</td>".$row[2]."<td></tr>";
		$datos["datos"] .= "<tr><td> 25 y m&aacute;s a&ntilde;os</td><td>".$row[3]."</td><td>".$row[4]."</td>".$row[5]."<td></tr>";
		$datos["datos"] .= "</table></body></html>";
	}

	echo json_encode($datos);
}
?>