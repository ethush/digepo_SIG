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

	$sql = "select total, total_hom, total_muj,
       		por_total, po_total_hom, por_total_muj,
       		catolico, por_catolico,
       		protestante, por_protestante,
       		diferente, por_diferente
			from religion where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] = "<html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'><table width='100%'>";
		$datos["datos"] .= "<tr><td></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n con alguna religi&oacute;n</strong></td><td align='center'>".$row[0]."</td><td align='center'>".$row[1]."</td><td align='center'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td>De cada 100 personas, ".round($row[3])." pertenecen a alguna religi&oacute;n, de los cuales; ".round($row[4])." son hombres y ".round($row[5])." son mujeres </td><td align='center'>".$row[3]."</td><td align='center'>".$row[4]."</td><td align='center'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td align='center'><strong>Religiones m&aacute;s frecuentes</strong></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td>Cat&oacute;lica</td><td>".$row[6]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='center'>".$row[7]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td>Protestantes y Evang&eacute;licas</td><td>".$row[8]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='center'>".$row[9]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td>B&iacute;blicas diferentes de Evang&eacute;licas.</td><td align='center'>".$row[10]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='center'>".$row[11]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p>De cada 100 personas, ".round($row[7])." son cat&oacute;licas.</p>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>