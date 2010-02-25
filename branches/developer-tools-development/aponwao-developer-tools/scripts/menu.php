<?php
echo "\n Aponwao Developer Tools";
echo "\n-------------------------";
echo "\n 1.- Crear estructura base del proyecto";
echo "\n 2.- Crear clase manejadora de acciones";
echo "\n 3.- Crear clase de data";
echo "\n 4.- Crear package de ws";
echo "\n 5.- Crear clase que provee servicios web";
echo "\n 6.- Salir\n";
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
			include_once("development/create_action_handler.php"); 
			break;
	case 3:
			include_once("development/create_data_handler.php"); 
			break;		
	case 4:
			include_once("development/create_ws_package.php"); 
			break;
	case 5:
			include_once("development/create_ws_class.php"); 
			break;		
	default:
			exit;
			break;
}
?> 