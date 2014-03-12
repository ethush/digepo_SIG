<?php
	ini_set('max_execution_time', 300);
	try{
		$db = new PDO("sqlite:localidades.s3db");
		$sql = "select id, municipio from municipios;";
		$result = $db->query($sql);

		foreach($result as $municipio){
			$m = str_replace(" ", "_", $municipio[1]);
			//$sql = "update municipios set ruta_datos='data/".$m."' where id=".$municipio[0].";";
			//echo $sql."</br>";
			$ruta ="data/".$m;
			if(!file_exists($ruta)){
				mkdir($ruta);
			//	$db->exec($sql);
			}
			else
				echo $ruta." existe. </br>";
		}
	}
	catch(PDOException $ex){
		die("Fatal: ".$ex->getMessage);
		echo "Error";
	}

?>