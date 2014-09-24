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


	$sql = "select r1,r2,r3,r4,r5,r6,r7,r8,r9,r10,r11,r12,r13,r14 from natalidad where id=". $id;
	//echo $sql ."<br>";
	$result = $db->query($sql);


	foreach($result as $row) {
		$datos["datos"] .= "<table width='100%'>";
		$datos["datos"] .= "<tr><td colspan='2'><strong>Promedio de hijos nacidos vivos por grupo de edad.</strong></td></tr>";
		$datos["datos"] .= "<tr><td>20-24 a&ntilde;os</td><td>".$row[0]."%</td></tr>";
		$datos["datos"] .= "<tr><td>25-29 a&ntilde;os</td><td>".$row[1]."%</td></tr>";
		$datos["datos"] .= "<tr><td>30-34 a&ntilde;os</td><td>".$row[2]."%</td></tr>";
		$datos["datos"] .= "<tr><td>35-39 a&ntilde;os</td><td>".$row[3]."%</td></tr>";
		$datos["datos"] .= "<tr><td>40-44 a&ntilde;os</td><td>".$row[4]."%</td></tr>";
		$datos["datos"] .= "<tr><td>45-49 a&ntilde;os</td><td>".$row[5]."%</td></tr>";
		$datos["datos"] .= "<tr><td>50-54 a&ntilde;os</td><td>".$row[6]."%</td></tr>";
		$datos["datos"] .= "<tr><td>55-59 a&ntilde;os</td><td>".$row[7]."%</td></tr>";
		$datos["datos"] .= "<tr><td>60-64 a&ntilde;os</td><td>".$row[8]."%</td></tr>";
		$datos["datos"] .= "<tr><td>65-69 a&ntilde;os</td><td>".$row[9]."%</td></tr>";
		$datos["datos"] .= "<tr><td>70-74 a&ntilde;os</td><td>".$row[10]."%</td></tr>";
		$datos["datos"] .= "<tr><td>75-79 a&ntilde;os</td><td>".$row[11]."%</td></tr>";
		$datos["datos"] .= "<tr><td>80-84 a&ntilde;os</td><td>".$row[12]."%</td></tr>";
		$datos["datos"] .= "<tr><td>85 a&ntilde;os y m&aacute;s</td><td>".$row[13]."%</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p align='justify'>Mujeres entre 25 y 29 a&ntilde;os de edad han tenido en promedio ".round($row[0])." hijo(s) nacido(s) vivo(s); mientras que este promedio es de ".round($row[9])." hijo(s) nacido(s) vivo(s) para mujeres entre 65 y 69 a&ntilde;os de edad.</p>";
		

	}

	$sql = "select r1,r2,r3,r4,r5,r6,r7,r8,r9,r10,r11,r12,r13,r14 from mortalidad where id=". $id;
	//echo $sql ."<br>";
	$result = $db->query($sql);

	foreach($result as $row) {
		$datos["datos"] .= "</br><hr/><br><table width='100%'>";
		$datos["datos"] .= "<tr><td colspan='2'><strong>Porcentaje de hijos fallecidos por grupo de edad.</strong></td></tr>";
		$datos["datos"] .= "<tr><td>20-24 a&ntilde;os</td><td>".$row[0]."%</td></tr>";
		$datos["datos"] .= "<tr><td>25-29 a&ntilde;os</td><td>".$row[1]."%</td></tr>";
		$datos["datos"] .= "<tr><td>30-34 a&ntilde;os</td><td>".$row[2]."%</td></tr>";
		$datos["datos"] .= "<tr><td>35-39 a&ntilde;os</td><td>".$row[3]."%</td></tr>";
		$datos["datos"] .= "<tr><td>40-44 a&ntilde;os</td><td>".$row[4]."%</td></tr>";
		$datos["datos"] .= "<tr><td>45-49 a&ntilde;os</td><td>".$row[5]."%</td></tr>";
		$datos["datos"] .= "<tr><td>50-54 a&ntilde;os</td><td>".$row[6]."%</td></tr>";
		$datos["datos"] .= "<tr><td>55-59 a&ntilde;os</td><td>".$row[7]."%</td></tr>";
		$datos["datos"] .= "<tr><td>60-64 a&ntilde;os</td><td>".$row[8]."%</td></tr>";
		$datos["datos"] .= "<tr><td>65-69 a&ntilde;os</td><td>".$row[9]."%</td></tr>";
		$datos["datos"] .= "<tr><td>70-74 a&ntilde;os</td><td>".$row[10]."%</td></tr>";
		$datos["datos"] .= "<tr><td>75-79 a&ntilde;os</td><td>".$row[11]."%</td></tr>";
		$datos["datos"] .= "<tr><td>80-84 a&ntilde;os</td><td>".$row[12]."%</td></tr>";
		$datos["datos"] .= "<tr><td>85 a&ntilde;os y m&aacute;s</td><td>".$row[13]."%</td></tr>";
		$datos["datos"] .= "</table>";
		$datos["datos"] .= "<p align='justify'>Por cada 100 ni&ntilde;os nacidos vivos, se registra(n) ".round($row[0])." fallecimiento(s) entre las mujeres de 20 a 24 a&ntilde;os de edad; mientras que las mujeres entre 75 y 79 a&ntilde;os, el porcentaje es de ".round($row[11])." fallecimiento(s) y para mujeres de 85 a&ntilde;os y m&aacute;s, se registran ".round($row[13])." fallecimiento(s).</p>";
	}
	$datos["datos"] .= "</body></html>";

	echo json_encode($datos);
}
?>