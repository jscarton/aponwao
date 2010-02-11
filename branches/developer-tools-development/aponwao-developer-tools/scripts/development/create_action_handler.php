<?php
echo "Introduzca el nombre del proyecto:";
$in = fopen("php://stdin", "r");
$proyecto = fgets($in, 255);
fclose($in);

echo "Introduzca el nombre de la nueva clase (si posee mas de una palabra separarlas con espacio en blanco):";
$in = fopen("php://stdin", "r");
$nueva_clase = fgets($in, 255);
fclose($in);

$proyecto=trim($proyecto);
$nueva_clase=trim($nueva_clase);
$nueva_clase=ucwords($nueva_clase);
$nueva_clase=str_replace(" ","",$nueva_clase);


$this_path = getcwd();
chdir("../");
$root=getcwd();
echo "\n";
if(is_file($root."/".$proyecto."/classes/app/".$nueva_clase."Action.class.php"))
{
	echo "Error: ya existe una clase con el mismo nombre";
	exit;
}
else
{
	//creo el archivo
	$contenido_archivo="<?php
/*

Esta clase ha sido generada usando aponwao-developer-tools (aponwaophp.org)

*/

/**
 * Escriba aqui la descripción de la funcionalidad de la acción
 * @author 
 * @version 
 * @package CLASSES.APP
 */
class ".$nueva_clase."Action extends CVActionHandler
{
	/**
	 * Este metodo es el punto de inicio de la acción.
	 */
	public function doIt()
	{									
						
	}				 
}
?>";
	$exito=file_put_contents($root."/".$proyecto."/classes/app/".$nueva_clase."Action.class.php",$contenido_archivo);
	if($exito)
		echo "\nClase Creada Exitosamente!!!\n";
	else
		echo "\nClase No Pudo ser Creada!!!\n";	
}
?>