<?php
if ($_GET) {

	$id = $_GET['id'];
	$datos["datos"] = "Hola mundo! Municipio:".$id;
	echo json_encode($datos);
}
?>