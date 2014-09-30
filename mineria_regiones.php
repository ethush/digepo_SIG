<?php

	/*Apertura y conexion a base de datos*/
	try{
		$db = new PDO("sqlite:localidades.s3db");
	}
	catch(PDOException $ex){
		die("Fatal: ".$ex->getMessage);
	}

	//$sql = utf8_decode('select municipio from municipios where region like "%Cañada%";');
	//$sql = utf8_decode('select municipio from municipios where region like "%Costa%";');
	//$sql = utf8_decode('select municipio from municipios where region like "%Istmo%";');
	//$sql = utf8_decode('select municipio from municipios where region like "%Mixteca%";');
	//$sql = utf8_decode('select municipio from municipios where region like "%Papaloapam%";');
	//$sql = utf8_decode('select municipio from municipios where region like "%Sierra Norte%";');
	//$sql = utf8_decode('select municipio from municipios where region like "%Sierra Sur%";');
	$sql = utf8_decode('select municipio from municipios where region like "%Valles Centrales%";');
	
	//echo $sql;
	$result = $db->query($sql);
	$total;
	
	//var_dump($result);
	foreach($result as $row) {
		echo $row[0]."<br>";
		$sql_aux[0] = 'select total from municipios_edades where sexo like "%Hombres%" and grupo like "%Total%" and municipio like "%'.$row[0].'%"';
		$sql_aux[1] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%00-04 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[2] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%05-09 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[3] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%10-14 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[4] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%15-19 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[5] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%20-24 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[6] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%25-29 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[7] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%30-34 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[8] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%35-39 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[9] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%40-44 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[10] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%45-49 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[11] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%50-54 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[12] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%55-59 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[13] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%60-64 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[14] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%65-69 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[15] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%70-74 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[16] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%75-79 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[17] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%80-84 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[18] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%85-89 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[19] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%90-94 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[20] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%95-99 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[21] = utf8_decode('select total from municipios_edades where sexo like "%Hombres%" and grupo like "%100 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[22] = 'select total from municipios_edades where sexo like "%Hombres%" and grupo like "%No especificado%" and municipio like "%'.$row[0].'%"';
		
		$sql_aux[23] = 'select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%Total%" and municipio like "%'.$row[0].'%"';
		$sql_aux[24] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%00-04 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[25] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%05-09 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[26] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%10-14 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[27] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%15-19 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[28] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%20-24 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[29] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%25-29 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[30] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%30-34 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[31] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%35-39 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[32] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%40-44 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[33] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%45-49 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[34] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%50-54 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[35] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%55-59 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[36] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%60-64 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[37] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%65-69 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[38] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%70-74 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[39] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%75-79 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[40] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%80-84 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[41] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%85-89 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[42] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%90-94 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[43] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%95-99 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[44] = utf8_decode('select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%100 años%" and municipio like "%'.$row[0].'%"');
		$sql_aux[45] = 'select total from municipios_edades where sexo like "%Mujeres%" and grupo like "%No especificado%" and municipio like "%'.$row[0].'%"';
		
		//var_dump($sql_aux);
		for($i=0;$i<count($sql_aux);$i++) {

			$municipios = $db->query($sql_aux[$i]);
			$municipios = $municipios->fetchAll();
					
			$total[$i] += $municipios[0][0];	
			
		}
		
		
		
			
	}
	foreach ($total as $key => $value) {
			echo $value."<br>";
		}
		
	
?>