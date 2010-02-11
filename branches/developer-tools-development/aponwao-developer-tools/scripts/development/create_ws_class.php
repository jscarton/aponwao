<?php
echo "Introduzca el nombre del proyecto:";
$in = fopen("php://stdin", "r");
$proyecto = fgets($in, 255);
fclose($in);

echo "Introduzca el nombre del package de ws destino:";
$in = fopen("php://stdin", "r");
$package = fgets($in, 255);
fclose($in);

$this_path = getcwd();
chdir("../");
$root=getcwd();
echo "\n";

$proyecto=trim($proyecto);
$package=trim($package);

//si el package es diferente de vacio
if($package!="")
{
	if(!is_dir($root."/".$proyecto."/classes/ws/".$package))
	{
		echo "Error: el paquete especificado no existe";
		exit;
	}
	else
	{
	//creo el archivo en la carpeta ws
	echo "Introduzca el nombre de la nueva clase de ws (si posee mas de una palabra separarlas con espacio en blanco):";
	$in = fopen("php://stdin", "r");
	$nueva_clase = fgets($in, 255);
	fclose($in);

	$nueva_clase=trim($nueva_clase);
	$nueva_clase=ucwords($nueva_clase);
	$nueva_clase=str_replace(" ","",$nueva_clase);
	if(is_file($root."/".$proyecto."/classes/ws/".$package."/".$nueva_clase."Service.class.php"))
	{
		echo "Error: ya existe una clase con el mismo nombreeeee";
		exit;
	}
	else
	{
		$contenido_archivo="<?php
		Esta clase ha sido generada usando aponwao-developer-tools (aponwaophp.org)

		/**	
 		* Escriba aqui la descripción de la clase de servicio
 		* @author 
 		* @version 
 		* @package CLASSES.WS
 		*/
		class ".$nueva_clase."Service
		{
					 
		}
		?>";
		$exito=file_put_contents($root."/".$proyecto."/classes/ws/".$package."/".$nueva_clase."Service.class.php",$contenido_archivo);
		if($exito)
			echo "\nClase Creada Exitosamente!!!\n";
		else
			echo "\nClase No Pudo ser Creada!!!\n";	
	}	
	}
	
}
else
{
	//creo el archivo en la carpeta ws
	echo "Introduzca el nombre de la nueva clase de ws (si posee mas de una palabra separarlas con espacio en blanco):";
	$in = fopen("php://stdin", "r");
	$nueva_clase = fgets($in, 255);
	fclose($in);

	$nueva_clase=trim($nueva_clase);
	$nueva_clase=ucwords($nueva_clase);
	$nueva_clase=str_replace(" ","",$nueva_clase);
	if(is_file($root."/".$proyecto."/classes/ws/".$nueva_clase."Service.class.php"))
	{
		echo "Error: ya existe una clase con el mismo nombre";
		exit;
	}
	else
	{
		$contenido_archivo="<?php
		Esta clase ha sido generada usando aponwao-developer-tools (aponwaophp.org)

		/**	
 		* Escriba aqui la descripción de la clase de servicio
 		* @author 
 		* @version 
 		* @package CLASSES.WS
 		*/
		class ".$nueva_clase."Service
		{
					 
		}
		?>";
		$exito=file_put_contents($root."/".$proyecto."/classes/ws/".$nueva_clase."Service.class.php",$contenido_archivo);
		if($exito)
			echo "\nClase Creada Exitosamente!!!\n";
		else
			echo "\nClase No Pudo ser Creada!!!\n";	
	}		
}






?>