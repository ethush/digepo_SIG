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

	//$get_localidad = $get_localidad;
	//$get_vecindario = $get_vecindario;
	
	$get_localidad = sanear_string($get_localidad);
	$get_vecindario = sanear_string($get_vecindario);
	
	$get_localidad = strtolower($get_localidad);
	$get_vecindario = strtolower($get_vecindario);
	
	if($get_localidad != 'Dalvik' && $get_localidad != ""){
		$sql = 'SELECT municipio, region, ruta_datos, id FROM municipios WHERE municipio LIKE "%'.utf8_decode($get_localidad).'%"';
		//echo $sql . "<br>";
		$result = $db->query($sql);
		
		foreach($result as $row){
			$datos[] = $row[0];
			$datos[] = $row[1];
			$datos[] = $row[2];
			$datos[] = $row[3];
		}
		
		if ($datos != null) addData($datos);
		else error();
	}
	else if ($get_vecindario != ""){
		$sql = 'SELECT municipio, region, ruta_datos, id FROM municipios WHERE municipio LIKE "%'.utf8_decode($get_vecindario).'%"'; 
		$result = $db->query($sql);
		//echo $sql."<br>";
		foreach($result as $row){
			$datos[] = $row[0]; //municipio
			$datos[] = $row[1]; //region
			$datos[] = $row[2]; //ruta_datos
			$datos[] = $row[3]; //id municipio
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
	// URL para parseo de pdf 
	$ruta_url = "http://docs.google.com/gview?embedded=true&url=http://www.gioax.com.mx/digepo_SIG/".$datos[2]; 
	$mcrypt = new MCrypt();
	$detalles["id_municipio"] =  $mcrypt->encrypt($datos[3]);
	$detalles["municipio"] = $mcrypt->encrypt($datos[0]);
	$detalles["region"] = $mcrypt->encrypt($datos[1]);
	/*URL con las graficas del municipio*/
	$detalles["doc1"] = $mcrypt->encrypt($ruta_url. "/1.pdf");
	$detalles["doc2"] = $mcrypt->encrypt($ruta_url. "/2.pdf");
	$detalles["doc3"] = $mcrypt->encrypt($ruta_url. "/3.pdf");
	$detalles["doc4"] = $mcrypt->encrypt($ruta_url. "/4.pdf");
	$detalles["doc5"] = $mcrypt->encrypt($ruta_url. "/5.pdf");
	$detalles["doc6"] = $mcrypt->encrypt($ruta_url. "/6.pdf");
	$detalles["doc7"] = $mcrypt->encrypt($ruta_url. "/7.pdf");
	$detalles["doc8"] = $mcrypt->encrypt($ruta_url. "/8.pdf");
	$detalles["doc9"] = $mcrypt->encrypt($ruta_url. "/9.pdf");
	$detalles["doc10"] = $mcrypt->encrypt($ruta_url. "10.pdf");
	$detalles["doc11"] = $mcrypt->encrypt($ruta_url. "/11.pdf");
	
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