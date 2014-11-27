<?php
	$getdata = http_build_query(
		array(
		    'id' => '85'
		 )
	);

	$var =  file_get_contents("http://localhost/digepo_SIG/vivienda.php?".$getdata);

	//var_dump($var);
	$var = json_decode($var);
	//var_dump($var);
	echo $var->datos;
?>