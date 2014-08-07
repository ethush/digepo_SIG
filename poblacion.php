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
	
	$sql = "select poblacion.p_total, poblacion.por_pob_estado, poblacion.r_dependencia, poblacion.mediana, poblacion.rel_h_m, 
			marginacion.ind_marginacion, marginacion.g_marginacion, marginacion.escala, marginacion.contexto_estatal, marginacion.contexto_nacional,
			marginacion.por_sal_min from poblacion inner join marginacion on poblacion.id = marginacion.id where poblacion.id =". $id.";";

	//echo $sql ."<br>";

	$result = $db->query($sql);


	foreach($result as $row) {
			$datos["datos"] = "<html><head><meta charset='utf-8'></head><body style='background: #a9a46f;'><table>";
			$datos["datos"] .= "<tr><td><strong>Poblacion total:</strong></td><td><strong> ".$row[0] ."</strong> </td></tr>";
			$datos["datos"] .= "<tr><td colspan='2'><small>Representa el ".$row[1] ." de la poblaci&oacute;n del estado.</small></td></tr>";
			$datos["datos"] .= "<tr><td><strong>Relaci&oacute;n hombres-mujeres: </strong></td><td><strong>" .$row[4]. "%</strong</td></tr>";
			$datos["datos"] .= "<tr><td colspan='2'><small>Por cada 100 mujeres hay ".round($row[4]). " hombres.</small></td></tr>" ;
			$datos["datos"] .= "<tr><td><strong>Edad mediana:</strong></td><td><strong>".$row[3] ."</strong></td></tr>";
			$datos["datos"] .= "<tr><td colspan='2'><small>La mitad de la poblaci&oacute;n es menor de ".$row[3]. " a&ntilde;os.</small></td></tr>";
			$datos["datos"] .= "<tr><td><strong>Raz&oacute;n de dependencia econ&oacute;mica: </strong></td><td><strong>".$row[2]."</strong></td></tr>";
			$datos["datos"] .= "<tr><td colspan='2'><small>Por cada 100 personas hay ".round(str_replace("%","", $row[2])) ." en edad de dependencia (menores de 15 a&ntilde;os o mayores de 64 a&ntilde;os). </strong></td></tr>";
			/*
			$datos["datos"] .= "\nÍndice de marginación: ".$row[5];
			$datos["datos"] .= "\nÍndice de marginación escala 0 a 100: ".$row[6];
			$datos["datos"] .= "\nGrado de marginación: ". $row[7];
			$datos["datos"] .= "\nLugar que ocupa en el contexto estatal: ". $row[8];
			$datos["datos"] .= "\nLugar que ocupa en el contexto nacional: ". $row[9];
			$datos["datos"] .= "\n% Población ocupada con ingreso de hasta 2 salarios mínimos: ". $row[10];*/
			$datos["datos"] .= "</table></body></html>";
	}

	echo json_encode($datos);
}

 ?>