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


	$sql = "select total, total_hom, total_muj,
       		por_total, po_total_hom, por_total_muj,
       		catolico, por_catolico,
       		protestante, por_protestante,
       		diferente, por_diferente
			from religion where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n con alguna religi&oacute;n</strong></td><td align='right'>".$row[0]."</td><td align='right'>".$row[1]."</td><td align='right'>".$row[2]."</td></tr>";
		$datos["datos"] .= "<tr><td>De cada 100 personas, ".round($row[3])." pertenecen a alguna religi&oacute;n, de los cuales; ".round($row[4])." son hombres y ".round($row[5])." son mujeres </td><td align='right'>".$row[3]."</td><td align='right'>".$row[4]."</td><td align='right'>".$row[5]."</td></tr>";
		
		$datos["datos"] .= "<tr><td align='center'><strong>Religiones m&aacute;s frecuentes</strong></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
		
		$datos["datos"] .= "<tr><td>Cat&oacute;lica</td><td align='right'>".$row[6]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='right'>".$row[7]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td>Protestantes y Evang&eacute;licas</td><td align='right'>".$row[8]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='right'>".$row[9]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td>B&iacute;blicas diferentes de Evang&eacute;licas.</td><td align='right'>".$row[10]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		$datos["datos"] .= "<tr><td></td><td align='right'>".$row[11]."</td><td align='center'> - </td><td align='center'> - </td></tr>";
		
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p align='justify'>De cada 100 personas, ".round($row[7])." son cat&oacute;licas.</p>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>