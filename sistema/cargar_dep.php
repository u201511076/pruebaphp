<?php 
	include "../conexion.php";


function getListasDep(){

  $query = 'SELECT * FROM `departamento`';
  $result = $conection->query($query);
  $listas = '<option value="0">Elige una opción</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<option value='$row[iddepartamento]'>$row[departamento]</option>";
  }
  return $listas;
}

echo getListasDep();