<?php
echo "Introduzca el nombre del proyecto:";
$in = fopen("php://stdin", "r");
$proyecto = fgets($in, 255);
fclose($in);

echo "Introduzca el nombre del nuevo package de ws:";
$in = fopen("php://stdin", "r");
$nueva_carpeta = fgets($in, 255);
fclose($in);

$proyecto=trim($proyecto);
$nueva_carpeta=trim($nueva_carpeta);
$nueva_carpeta=strtolower($nueva_carpeta);


$this_path = getcwd();
chdir("../");
$root=getcwd();
echo "\n";
if(is_dir($root."/".$proyecto."/classes/ws/".$nueva_carpeta))
{
	echo "\nError: ya existe un package con el mismo nombre\n";
	exit;
}
else
{
	if(mkdir($root."/".$proyecto."/classes/ws/".$nueva_carpeta,0777))
		echo "\nPackage Creado Exitosamente!!!\n";
	else
		echo "\nPackage No pudo ser Creado\n";
}
?>