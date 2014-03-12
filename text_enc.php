<?php
class MCrypt
{
	private $iv = 'pr0y3ct0d1g3p0iv'; //Secret KEY
	private $key = 'pr0y3ct0d1g3p0ky'; //Secret KEY

	function __construct()
	{
	}

	function encrypt($str) {

		//$key = $this->hex2bin($key);    
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


if(isset($_GET["localidad"]) && $_GET["localidad"] != "") 
	$get_localidad = $_GET["localidad"];
	

if(isset($_GET["vecindario"]) && $_GET["vecindario"] != "")
	$get_vecindario = $_GET["vecindario"];


echo $get_localidad ."<br/>";
echo $get_vecindario ."<br/>";

$mcrypt = new MCrypt();
#Encrypt
$encrypted_loc = $mcrypt->encrypt($get_localidad);
$encrypted_vec = $mcrypt->encrypt($get_vecindario);
#Decrypt
$decrypted_loc = $mcrypt->decrypt($encrypted_loc);
$decrypted_vec = $mcrypt->decrypt($encrypted_vec);

echo $encrypted_loc." --> ".$decrypted_loc."<br/>";
echo $encrypted_vec." --> ".utf8_decode($decrypted_vec);

?>