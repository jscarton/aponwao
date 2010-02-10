<?php
echo "\n Aponwao Developer Tools";
echo "\n-------------------------";
echo "\n 1.- Crear estructura base del proyecto";
echo "\n 2.- Salir\n";
echo "\n Introduzca la opción del menu: ";
$in = fopen("php://stdin", "r");
//set_timeout();
$in_string = fgets($in, 255);
//clear_timeout();
fclose($in);
switch($in_string)
{
	case 1: 
			include_once("development/create_project.php");
			break;
	case 2:
			exit; 
			break;
	default:
			exit;
			break;
}
?> 