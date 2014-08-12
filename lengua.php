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

	$sql = "select hablantes, hablantes_hom, hablante_muj,
       		por_hablantes, por_hablantes_hom, por_hablante_muj,
       		por_hablante_esp, hablante_esp_hom, por_hablante_esp_muj
			from lengua where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] = "<!doctype html><html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'><table width='100%'>";
		$datos["datos"] .= "<tr><td></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n de 3 a&ntilde;os y m&aacute;s que habla lengua indigena</strong></td><td valign='top' align='center'>".$row[0]."</td><td valign='top' align='center'>".$row[1]."</td><td valign='top' align='center'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td><small>Hay ".$row[0]." personas mayores de 3 a&ntilde;os que hablan alguna lengua indigena, lo que representa el ".round(str_replace("%", "", $row[3]))."% de la poblaci&oacute;n de 3 a&ntilde;os y m&aacute;s.</small></td><td valign='bottom' align='center'>".$row[3]."</td><td valign='bottom' align='center'>".$row[4]."</td><td valign='bottom' align='center'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n de 3 a&ntilde;os y m&aacute;s que habla lengua indigena y espa&ntilde;ol</strong></td><td align='center'>".$row[6]."</td><td align='center'>".$row[7]."</td><td align='center'>".$row[8]."</td></tr>";
		
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p>De cada 100 personas mayores de 3 a&ntilde;os, el ".round(str_replace("%", "", $row[3]))."% hablan alguna lengua ind&iacute;gena; del 100% de estas personas, el ".round(str_replace("%", "", $row[6]))."% tambi&eacute;n habla espa&ntilde;ol.</p>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>