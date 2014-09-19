<?php
	$getdata = http_build_query(
		array(
		    'id' => '85'
		 )
	);

	//$var =  file_get_contents("http://localhost/digepo_SIG/derechohabiencia.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/economia.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/educacion.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/lengua.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/limitaciones.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/migracion.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/natalidad_mortalidad.php?".$getdata);
	$var =  file_get_contents("http://localhost/digepo_SIG/poblacion.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/religion.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/situacion.php?".$getdata);
	//$var =  file_get_contents("http://localhost/digepo_SIG/vivienda.php?".$getdata);
	

	//$var =  file_get_contents("http://www.gioax.com.mx/digepo_SIG/poblacion.php?".$getdata);

	//var_dump($var);
	$var = json_decode($var);
	//var_dump($var);
	//echo $var;
	echo $var->datos;
?>