<?php 
	
	$host = '127.0.0.1';
	$user = 'azure';
	$password = '6#vWHD_$';
	$db = 'bdincendios';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>