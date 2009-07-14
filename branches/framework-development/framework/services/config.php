<?php
/*
APONWAO FRAMEWORK
Copyright (C) 2009 Coral Vision Systems

Developers:
Juan Scarton <jscarton@aponwaophp.org>
Rafael Vivas <rvivas@aponwaophp.org>
Saul Bautista <sbautista@aponwaophp.org>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
define("WEBSERVICEUSER", "test");
define("WEBSERVICEPASSWORD", "test");
define("AUTHENTICATE", false);

$app= getApp();
/* All the allowed webservice classes */
$WSClasses = array(
);


/*NOTA CORALVISION: para especificar las clases de servicios web especifique el  (o los) directorios correspondientes a sus archivos de clases en la variable $directorioServicios,
el sistema buscar� automaticamente y agregar� todas las clases ubicadas en ese  (esos) directorios, por defecto el valor de esta variable es el directorio "modelo" de la aplicaci�n*/

$directoriosServicios= $app->getWSPackages();
//procesa el contenido de packages en providers
for ($i=0;$i<sizeof($directoriosServicios);$i++)
{
	if ($dh = opendir($directoriosServicios[$i]))
	{
   			while (($file = readdir($dh)) !== false)
			{
				if (!is_dir($file))
				{
					if (strpos($file,".class.php")>0)
						array_push($WSClasses,str_replace(".class.php","",$file));
				}
   			}
			closedir($dh);
	}
}
/* The classmap associative array. When you want to allow objects as a parameter for
 * your webservice method. ie. saveObject($object). By default $object will now be
 * a stdClass, but when you add a classname defined in the type description in the @param
 * documentation tag and add your class to the classmap below, the object will be of the
 * given type. Requires PHP 5.0.3+
 */
$WSStructures = array();

/*NOTA CORALVISION: configure los directorios de clases asociadas a los servicios en el array llamado $directoriosClases, el sistema agregar� automaticamente cualquier clase contenida en esos directorios*/
//procesa el contenido de classes en providers
$directoriosClases= $app->getWSClasses();
for ($i=0;$i<sizeof($directoriosClases);$i++)
{
		if ($dh = opendir($directoriosClases[$i]))
			{
         		while (($file = readdir($dh)) !== false)
				{
						if (!is_dir($file))
						{
							if (strpos($file,".class.php")>0)
							{
								$class=str_replace(".class.php","",$file);
								$WSStructures[$class]=$class;
							}
							elseif (strpos($file,".php")>0)
							{
								$class=str_replace(".php","",$file);
								$WSStructures[$class]=$class;
							}
						}
         		}
      			closedir($dh);
      		}
}
?>
