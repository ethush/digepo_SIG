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
		$datos["datos"] = "<html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'><table width='100%'>";
		$datos["datos"] .= "<tr align='center'><td><strong>Tasa de alfabetizaci&oacute;n por grupo de edad</strong></td>
								<td align='center'><strong>Total</strong></td>
								<td align='center'><strong>Hombres</strong></td>
								<td align='center'><strong>Mujeres</strong></td>
							</tr>";
		$datos["datos"] .= "<tr align='center'><td> 15-24 a&ntilde;os</td><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."<td></tr>";
		$datos["datos"] .= "<tr align='center'><td> 25 y m&aacute;s a&ntilde;os</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."<td></tr>";
		$datos["datos"] .= "</table><p>De cada 100 personas entre 15 y 24 a&ntilde;os de edad, saben leer y escribir. De estos 100, el ".round(str_replace("%", "", $row[1]))."%  son hombres y ".round(str_replace("%", "", $row[2]))."% son mujeres. </p></body></html>";

	}

	echo json_encode($datos);
}
?>