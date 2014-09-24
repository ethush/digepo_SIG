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


	$sql = "select municipio from municipios where id=".$id;

	$result = $db->query($sql);
	$result = $result->fetchAll();
	//extrae el nombre del municipio para consultar los grupos de edades
	$nombre_municipio = $result[0][0];
	$sql = "select total_r1, total_hombres_r1, total_mujeres_r1, total_r2, total_hombres_r2, total_mujeres_r2 from educacion where id=". $id;

	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr align='center'><td><strong>Tasa de alfabetizaci&oacute;n por grupo de edad</strong></td>
								<td align='center'><strong>Total</strong></td>
								<td align='center'><strong>Hombres</strong></td>
								<td align='center'><strong>Mujeres</strong></td>
							</tr>";
		$datos["datos"] .= "<tr align='center'><td> 15-24 a&ntilde;os</td><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."<td></tr>";
		$datos["datos"] .= "<tr align='center'><td> 25 y m&aacute;s a&ntilde;os</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."<td></tr>";
		$datos["datos"] .= "</table><p align='justify'>De cada 100 personas entre 15 y 24 a&ntilde;os de edad, saben leer y escribir. De estos 100, el ".round(str_replace("%", "", $row[1]))."%  son hombres y ".round(str_replace("%", "", $row[2]))."% son mujeres. </p></body></html>";

	}


	/* Tabla de grandes grupos de edades */
	$datos["datos"] .= "<table width='100%'><tr align='center'><td width='40%'><strong>Asistencia escolar por grupo de edad</strong></td><td><strong>Total</strong></td><td><strong>Hombres</strong></td><td><strong>Mujeres</strong></td></tr>";
	

	$parametros[] = "total";
	$parametros[] = "total_asiste";
	$parametros[] = "hombres_asiste";
	$parametros[] = "mujeres_asiste";


	$rango_a[] = "03 años";
	$rango_a[] = "04 años";
	$rango_a[] = "05 años";

	$rango_b[] = "06 años";
	$rango_b[] = "07 años";
	$rango_b[] = "08 años";
	$rango_b[] = "09 años";
	$rango_b[] = "10 años";
	$rango_b[] = "11 años";

	$rango_c[] = "12 años";
	$rango_c[] = "13 años";
	$rango_c[] = "14 años";

	$rango_d[] = "15 años";
	$rango_d[] = "16 años";
	$rango_d[] = "17 años";
	$rango_d[] = "18 años";
	$rango_d[] = "19 años";
	$rango_d[] = "20-24 años";

	$total_habitantes = operacion($rango_a,$parametros[0],$nombre_municipio,$db);
	$total_asiste = operacion($rango_a,$parametros[1],$nombre_municipio,$db);
	$hombres_asiste = operacion($rango_a,$parametros[2],$nombre_municipio,$db);
	$mujeres_asiste = operacion($rango_a,$parametros[3],$nombre_municipio,$db);
	$total = ($total_asiste != 0 && $total_habitantes !=0) ? ($total_asiste/$total_habitantes)*100 : 0;
	$asiste_hombre = ($hombres_asiste != 0 && $total_asiste != 0) ? ($hombres_asiste/$total_asiste)*100 : 0;
	$asiste_mujer =  ($mujeres_asiste != 0 && $total_asiste != 0) ? ($mujeres_asiste/$total_asiste)*100 : 0;
	$datos["datos"] .= "<tr align='center'><td width='40%'>3 - 5 a&ntilde;os</td><td>" .round($total,2). "%</td><td>". round($asiste_hombre,2)."%</td><td>".round($asiste_mujer,2)."%</td></tr>";


	$total_habitantes = operacion($rango_b,$parametros[0],$nombre_municipio,$db);
	$total_asiste = operacion($rango_b,$parametros[1],$nombre_municipio,$db);
	$hombres_asiste = operacion($rango_b,$parametros[2],$nombre_municipio,$db);
	$mujeres_asiste = operacion($rango_b,$parametros[3],$nombre_municipio,$db);
	$total = ($total_asiste != 0 && $total_habitantes !=0) ? ($total_asiste/$total_habitantes)*100 : 0;
	$asiste_hombre = ($hombres_asiste != 0 && $total_asiste != 0) ? ($hombres_asiste/$total_asiste)*100 : 0;
	$asiste_mujer =  ($mujeres_asiste != 0 && $total_asiste != 0) ? ($mujeres_asiste/$total_asiste)*100 : 0;
	$datos["datos"] .= "<tr align='center'><td width='40%'>6 - 11 a&ntilde;os</td><td>" .round($total,2). "%</td><td>". round($asiste_hombre,2)."%</td><td>".round($asiste_mujer,2)."%</td></tr>";


	$total_habitantes = operacion($rango_c,$parametros[0],$nombre_municipio,$db);
	$total_asiste = operacion($rango_c,$parametros[1],$nombre_municipio,$db);
	$hombres_asiste = operacion($rango_c,$parametros[2],$nombre_municipio,$db);
	$mujeres_asiste = operacion($rango_c,$parametros[3],$nombre_municipio,$db);
	$total = ($total_asiste != 0 && $total_habitantes !=0) ? ($total_asiste/$total_habitantes)*100 : 0;
	$asiste_hombre = ($hombres_asiste != 0 && $total_asiste != 0) ? ($hombres_asiste/$total_asiste)*100 : 0;
	$asiste_mujer =  ($mujeres_asiste != 0 && $total_asiste != 0) ? ($mujeres_asiste/$total_asiste)*100 : 0;
	$datos["datos"] .= "<tr align='center'><td width='40%'>6 - 11 a&ntilde;os</td><td>" .round($total,2). "%</td><td>". round($asiste_hombre,2)."%</td><td>".round($asiste_mujer,2)."%</td></tr>";


	$total_habitantes = operacion($rango_d,$parametros[0],$nombre_municipio,$db);
	$total_asiste = operacion($rango_d,$parametros[1],$nombre_municipio,$db);
	$hombres_asiste = operacion($rango_d,$parametros[2],$nombre_municipio,$db);
	$mujeres_asiste = operacion($rango_d,$parametros[3],$nombre_municipio,$db);
	$total = ($total_asiste != 0 && $total_habitantes !=0) ? ($total_asiste/$total_habitantes)*100 : 0;
	$asiste_hombre = ($hombres_asiste != 0 && $total_asiste != 0) ? ($hombres_asiste/$total_asiste)*100 : 0;
	$asiste_mujer =  ($mujeres_asiste != 0 && $total_asiste != 0) ? ($mujeres_asiste/$total_asiste)*100 : 0;
	$datos["datos"] .= "<tr align='center'><td width='40%'>15 - 24 a&ntilde;os</td><td>" .round($total,2). "%</td><td>". round($asiste_hombre,2)."%</td><td>".round($asiste_mujer,2)."%</td></tr>";
	$datos["datos"] .= "</table>";
	$datos["datos"] .= "<p align='justify'>De cada 100 personas entre 15 y 24 a&ntilde;os, ".round($total,0)." asisten a la escuela.</p>";
	echo json_encode($datos);
}

function operacion($rango,$parametros,$municipio,$db) {
	$suma = 0;
	for($i=0;$i<count($rango);$i++) {
		$sql = 'select '.$parametros.' from educacion_edades where  edad like "%'.utf8_decode($rango[$i]).'%" and municipio like "%'.$municipio.'%"';
		//echo $sql;
		$result = $db->query($sql);
		$result = $result->fetchAll();
		//var_dump($result);
		$suma += $result[0][0];
	}
	
	return $suma;
}

?>