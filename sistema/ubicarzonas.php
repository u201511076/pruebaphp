<?php

include "../conexion.php";


function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


$query = "SELECT idzona,nombre,direccion,lat,lng,tipo FROM zonas";
$result = mysqli_query($conection,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

echo '<markers>';

while ($row = mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'idzona="' . $row['idzona'] . '" ';
  echo 'nombre="' . parseToXML($row['nombre']) . '" ';
  echo 'direccion="' . parseToXML($row['direccion']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'tipo="' . $row['tipo'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

echo '</markers>';