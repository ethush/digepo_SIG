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

	$sql = "select soltera,casada,union_libre,separada,divorciada,viuda,no_especificada,poblacion,hombres,mujeres from situacion where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] = "<html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, target-densityDpi=device-dpi'></head><body style='background: #a9a46f;'><table width='100%'>";
		$datos["datos"] .= "<tr><td colspan='2' align='center'><strong>Poblaci&oacute;n de 12 a&ntilde;os y m&aacute;s seg&uacute;n situaci&oacute;n conyugal.</strong></td></tr>";
		$datos["datos"] .= "<tr><td> Soltera</td><td>".$row[0]."%</td></tr>";
		$datos["datos"] .= "<tr><td> Casada</td><td>".$row[1]."%</td></tr>";
		$datos["datos"] .= "<tr><td> En uni&oacute;n libre</td><td>".$row[2]."%</td></tr>";
		$datos["datos"] .= "<tr><td> Separada</td><td>".$row[3]."%</td></tr>";
		$datos["datos"] .= "<tr><td> Divorciada</td><td>".$row[4]."%</td></tr>";
		$datos["datos"] .= "<tr><td> Viuda</td><td>".$row[5]."%</td></tr>";
		$datos["datos"] .= "<tr><td> No especificado</td><td>".$row[6]."%</td></tr>";
		$datos["datos"] .= "</table></br><hr></br><table width='100%'>";
		$datos["datos"] .= "<tr align='center'><td></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
		$datos["datos"] .= "<tr><td><strong>Poblaci&oacute;n de 12 a&ntilde;os y m&aacute;s</strong></td><td align='center'>".$row[7]."</td><td align='center'>".$row[8]."</td><td align='center'>".$row[9]."</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "</body></html>";

	}

	echo json_encode($datos);
}
?>