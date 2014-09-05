<?php
	$getdata = http_build_query(
		array(
		    'id' => '391'
		 )
	);

	$var =  file_get_contents("http://localhost/digepo_SIG/poblacion.php?".$getdata);

	//var_dump($var);
	$var = json_decode($var);
	//var_dump($var);
	//echo $var;
	echo $var->datos;
?>