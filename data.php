<?php
if($_GET){	
	if(isset($_GET["localidad"]) && $_GET["localidad"] != "")
		$get_localidad = $_GET["localidad"];
	if(isset($_GET["vecindario"]) && $_GET["vecindario"] != "")
		$get_vecindario = $_GET["vecindario"];
	
	/*Modulo de cifrado para obtener datos en texto plano*/
	$mcrypt = new MCrypt();
	if($get_localidad !="")
		$get_localidad = $mcrypt->decrypt($get_localidad);
	if($get_vecindario !="")
		$get_vecindario = $mcrypt->decrypt($get_vecindario);

	unset($mcrypt);
	
	/*Apertura y conexion a base de datos*/
	try{
		$db = new PDO("sqlite:localidades.s3db");
	}
	catch(PDOException $ex){
		die("Fatal: ".$ex->getMessage);
	}
	
	/*
		Verificamos si $get_localidad es diferente de vacio o si devuelve Dalvik en get_localidad
		Si en la primer opcion no se valida, intentara buscar po vecindario en caso contario devolvera error
	*/
	$get_localidad = utf8_decode($get_localidad);
	$get_vecindario = utf8_decode($get_vecindario);
	
	$get_localidad = sanear_string($get_localidad);
	$get_vecindario = sanear_string($get_vecindario);
	
	$get_localidad = strtolower($get_localidad);
	$get_vecindario = strtolower($get_vecindario);
	
	if($get_localidad != 'Dalvik' && $get_localidad != ""){
		$sql = 'SELECT municipio, region, ruta_datos FROM municipios WHERE municipio LIKE "%'.utf8_decode($get_localidad).'%"';
		$result = $db->query($sql);
		
		foreach($result as $row){
			$datos[] = $row[0];
			$datos[] = $row[1];
			$datos[] = $row[2];
		}
		
		if ($datos != null) addData($datos);
		else error();
	}
	else if ($get_vecindario != ""){
		$sql = 'SELECT municipio, region, ruta_datos FROM municipios WHERE municipio LIKE "%'.utf8_decode($get_vecindario).'%"'; 
		$result = $db->query($sql);

		foreach($result as $row){
			$datos[] = $row[0];
			$datos[] = $row[1];
			$datos[] = $row[2];
		}
		if ($datos) addData($datos);
		else error();
	}
	else error(); 
}
else{
	error();
}

/*****************************************************************************************************************************************/
/*****************************************************************************************************************************************/
function addData($datos){
	/* Las siguientes rutas estan en una carpeta con el nombre del municipio 
	 * el cual puede ser generado por una consulta. 
	 * Por hacer: Encriptar las rutas para regresarlas en el JSON
	 */
	$ruta_url = "http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/".$datos[2]."/grafico_pdf.pdf"; 
	$mcrypt = new MCrypt();
	
	$detalles["municipio"] = $mcrypt->encrypt($datos[0]);
	$detalles["region"] = $mcrypt->encrypt($datos[1]);
	/*URL con las graficas del municipio*/
	$detalles["doc1"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc2"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc3"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc4"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc5"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc6"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc7"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc8"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc9"] = $mcrypt->encrypt($ruta_url);
	$detalles["doc10"] = $mcrypt->encrypt($ruta_url);
	/*URL para regiones*/
	//path_regiones = http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/<archivo>.pdf
	//path_estatal = http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/estatal/oaxaca.pdf
	$detalles["pais_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/1.pdf");
	$detalles["pais_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/2.pdf");
	$detalles["pais_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/3.pdf");
	$detalles["pais_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/4.pdf");
	$detalles["pais_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/5.pdf");
	$detalles["pais_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/6.pdf");
	$detalles["pais_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/7.pdf");
	$detalles["pais_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/8.pdf");
	$detalles["pais_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/9.pdf");
	$detalles["pais_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/pais/10.pdf");

	$detalles["estado_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/1.pdf");
	$detalles["estado_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/2.pdf");
	$detalles["estado_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/3.pdf");
	$detalles["estado_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/4.pdf");
	$detalles["estado_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/5.pdf");
	$detalles["estado_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/6.pdf");
	$detalles["estado_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/7.pdf");
	$detalles["estado_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/8.pdf");
	$detalles["estado_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/9.pdf");
	$detalles["estado_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/estado/10.pdf");

	$detalles["canada_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/1.pdf");
	$detalles["canada_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/2.pdf");
	$detalles["canada_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/3.pdf");
	$detalles["canada_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/4.pdf");
	$detalles["canada_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/5.pdf");
	$detalles["canada_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/6.pdf");
	$detalles["canada_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/7.pdf");
	$detalles["canada_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/8.pdf");
	$detalles["canada_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/9.pdf");
	$detalles["canada_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/canada/10.pdf");

	$detalles["costa_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/1.pdf");
	$detalles["costa_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/2.pdf");
	$detalles["costa_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/3.pdf");
	$detalles["costa_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/4.pdf");
	$detalles["costa_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/5.pdf");
	$detalles["costa_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/6.pdf");
	$detalles["costa_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/7.pdf");
	$detalles["costa_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/8.pdf");
	$detalles["costa_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/9.pdf");
	$detalles["costa_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/costa/10.pdf");

	$detalles["istmo_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo_/1.pdf");
	$detalles["istmo_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/2.pdf");
	$detalles["istmo_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/3.pdf");
	$detalles["istmo_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/4.pdf");
	$detalles["istmo_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/5.pdf");
	$detalles["istmo_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/6.pdf");
	$detalles["istmo_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/7.pdf");
	$detalles["istmo_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/8.pdf");
	$detalles["istmo_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/9.pdf");
	$detalles["istmo_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/istmo/10.pdf");

	$detalles["mixteca_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/1.pdf");
	$detalles["mixteca_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/2.pdf");
	$detalles["mixteca_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/3.pdf");
	$detalles["mixteca_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/4.pdf");
	$detalles["mixteca_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/5.pdf");
	$detalles["mixteca_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/6.pdf");
	$detalles["mixteca_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/7.pdf");
	$detalles["mixteca_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/8.pdf");
	$detalles["mixteca_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/9.pdf");
	$detalles["mixteca_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/mixteca/10.pdf");

	$detalles["papaloapam_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/1.pdf");
	$detalles["papaloapam_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/2.pdf");
	$detalles["papaloapam_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/3.pdf");
	$detalles["papaloapam_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/4.pdf");
	$detalles["papaloapam_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/5.pdf");
	$detalles["papaloapam_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/6.pdf");
	$detalles["papaloapam_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/7.pdf");
	$detalles["papaloapam_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/8.pdf");
	$detalles["papaloapam_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/9.pdf");
	$detalles["papaloapam_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/papaloapam/10.pdf");

	$detalles["sierra_norte_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/1.pdf");
	$detalles["sierra_norte_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/2.pdf");
	$detalles["sierra_norte_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/3.pdf");
	$detalles["sierra_norte_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/4.pdf");
	$detalles["sierra_norte_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/5.pdf");
	$detalles["sierra_norte_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/6.pdf");
	$detalles["sierra_norte_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/7.pdf");
	$detalles["sierra_norte_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/8.pdf");
	$detalles["sierra_norte_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/9.pdf");
	$detalles["sierra_norte_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_norte/10.pdf");

	$detalles["sierra_sur_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/1.pdf");
	$detalles["sierra_sur_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/2.pdf");
	$detalles["sierra_sur_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/3.pdf");
	$detalles["sierra_sur_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/4.pdf");
	$detalles["sierra_sur_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/5.pdf");
	$detalles["sierra_sur_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/6.pdf");
	$detalles["sierra_sur_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/7.pdf");
	$detalles["sierra_sur_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/8.pdf");
	$detalles["sierra_sur_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/9.pdf");
	$detalles["sierra_sur_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/sierra_sur/10.pdf");

	$detalles["valles_centrales_doc1"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/1.pdf");
	$detalles["valles_centrales_doc2"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/2.pdf");
	$detalles["valles_centrales_doc3"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/3.pdf");
	$detalles["valles_centrales_doc4"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/4.pdf");
	$detalles["valles_centrales_doc5"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/5.pdf");
	$detalles["valles_centrales_doc6"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/6.pdf");
	$detalles["valles_centrales_doc7"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/7.pdf");
	$detalles["valles_centrales_doc8"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/8.pdf");
	$detalles["valles_centrales_doc9"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/9.pdf");
	$detalles["valles_centrales_doc10"] = $mcrypt->encrypt("http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/data/regiones/valles_centrales/10.pdf");

	$detalles["msg_error"] = "Datos cargados.";
	$detalles["result"] = "OK";

	//print_r($detalles);
	echo json_encode($detalles);

}

function error(){
	$detalles["result"] = "ERROR";
	$detalles["msg_error"] = "Localidad no encontrada o no se encuentra dentro de la zona urbana";

	echo json_encode($detalles);
}

class MCrypt
{
	private $iv = 'pr0y3ct0d1g3p0iv'; //Secret KEY
	private $key = 'pr0y3ct0d1g3p0ky'; //Secret KEY

	function __construct() { }

	function encrypt($str) {

		$iv = $this->iv;

		$td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

		mcrypt_generic_init($td, $this->key, $iv);
		$encrypted = mcrypt_generic($td, $str);

		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return bin2hex($encrypted);
	}

	function decrypt($code) {
		//$key = $this->hex2bin($key);
		$code = $this->hex2bin($code);
		$iv = $this->iv;

		$td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

		mcrypt_generic_init($td, $this->key, $iv);
		$decrypted = mdecrypt_generic($td, $code);

		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return utf8_encode(trim($decrypted));
	}

	protected function hex2bin($hexdata) {
	  $bindata = '';

		for ($i = 0; $i < strlen($hexdata); $i += 2) {
			$bindata .= chr(hexdec(substr($hexdata, $i, 2)));
		}

		return $bindata;
	}
}

function sanear_string($string)
{
	$string = str_replace(
		array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		$string
	);
	$string = str_replace(
		array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		$string
	);
	$string = str_replace(
		array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		$string
	);
	$string = str_replace(
		array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		$string
	);
	$string = str_replace(
		array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		$string
	);
	$string = str_replace(
		array('ç', 'Ç'),
		array('c', 'C',),
		$string
	);
	//Esta parte se encarga de eliminar cualquier caracter extraño
	/*$string = str_replace(
		array("\\", "¨", "º", "-", "~",
			 "#", "@", "|", "!", "\"",
			 "·", "$", "%", "&", "/",
			 "(", ")", "?", "'", "¡",
			 "¿", "[", "^", "`", "]",
			 "+", "}", "{", "¨", "´",
			 ">", "< ", ";", ",", ":",
			 ".", " "),
		'',
		$string
	);*/

	return $string;
}
?>