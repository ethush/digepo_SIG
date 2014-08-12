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
	        imms, imms_hombres, imms_muj,
	        issste, issste_hom, issste_muj,
	        otros, otros_hom, otros_muj,
	        seguro_pop, seguro_pop_hom, seguro_pop_muj,
	        privada, privada_hom, privada_muj,
	        otra, otra_hom, otra_muj,
	        no_tiene, no_tiene_hom, no_tiene_muj,
	        no_especifica, no_especifica_hom, no_especifica_muj
			from derechohabiencia where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] = "<html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'><table width='100%'>";
		$datos["datos"] .= "<tr><td align='center'><strong>Poblaci&oacute;n</strong></td><td align='center'><strong>Total</strong></td><td align='center'><strong>Hombres</strong></td><td align='center'><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Derechohabiente</strong></td><td align='center'>".$row[0]."%</td><td align='center'>".$row[1]."</td><td align='center'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td>IMMS</td><td align='center'>".$row[3]."%</td><td align='center'>".$row[4]."</td><td align='center'>".$row[5]."</td></tr>";
		$datos["datos"] .= "<tr><td>ISSSTE</td><td align='center'>".$row[6]."%</td><td align='center'>".$row[7]."</td><td align='center'>".$row[8]."</td></tr>";
		$datos["datos"] .= "<tr><td>Pemex, Defensa o Marina</td><td align='center'>".$row[9]."%</td><td align='center'>".$row[10]."</td><td align='center'>".$row[11]."</td></tr>";
		$datos["datos"] .= "<tr><td>Seguro popular o para una nueva generaci&oacute;n</td><td align='center'>".$row[12]."%</td><td align='center'>".$row[13]."</td><td align='center'>".$row[14]."</td></tr>";
		$datos["datos"] .= "<tr><td>Instituci&oacute;n provada</td><td align='center'>".$row[15]."%</td><td align='center'>".$row[16]."</td><td align='center'>".$row[17]."</td></tr>";
		$datos["datos"] .= "<tr><td>Otra instituci&oacute;n</td><td align='center'>".$row[18]."%</td><td align='center'>".$row[19]."</td><td align='center'>".$row[20]."</td></tr>";
		$datos["datos"] .= "<tr><td>No derechohabiente</td><td align='center'>".$row[21]."%</td><td align='center'>".$row[22]."</td><td align='center'>".$row[23]."</td></tr>";
		$datos["datos"] .= "<tr><td>No especificado</td><td align='center'>".$row[24]."%</td><td align='center'>".$row[25]."</td><td align='center'>".$row[26]."</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p>De cada 100 personas ".round($row[0])." reportan alguna limitaci&oacute;n f&iacute;sica.</p>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>