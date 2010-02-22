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
//incluye las principales rutas de inclusión
$includePaths=array(
						"/usr/share/php/propel",
						"/usr/share/php/propel/util",
						"/usr/share/php",
						APP_ROOT,
						APP_ROOT."/classes",
						APP_ROOT."/classes/app",
						APP_ROOT."/classes/data",
						APP_ROOT."/classes/view",						
						APP_ROOT."/lib",						
					);

foreach($includePaths as $indice => $valor) {
		set_include_path($valor.":".get_include_path());
   }
//incluye las funciones generales de aponwao framework
require_once('CVFunctions.functions.php');
 /** buscar archivos de clases recursivamente en un directorio
 * @param  string directorio de busqueda.
 * @param  string nombre de la clase a buscar
 **/
function buscarClase($ruta , $classname)
{
	if (is_dir($ruta))
   	{
   		if (file_exists($ruta."$classname.class.php"))
		{
			require_once($ruta."$classname.class.php");
			//echo "consegui a $classname<br>";
			return true;
		}
		if (file_exists($ruta."$classname.php"))
		{
			require_once($ruta."$classname.php");
			//echo "consegui a $classname<br>";
			return true;
		}
   		if (file_exists($ruta."$classname.iface.php"))
		{
			require_once($ruta."$classname.iface.php");
			//echo "consegui a $classname<br>";
			return true;
		}
      	if ($dh = opendir($ruta))
		{
        	while (($file = readdir($dh)) !== false)
			{
        		if (is_dir($ruta . $file) && $file!="." && $file!="..")
				{
        			if (buscarClase($ruta.$file ."/", $classname))
						return true;
            	}
         	}
      			closedir($dh);
      	}
   	}
}
/**
 * función de autocarga para las clases de Aponwao Framework
 * @param string $classname
 */
function autoCarga($classname)
 {
	//si el nombre de la clase comienza con CV busca en el directorio lib
	//sino busca recursivamente en el directorio classes
	if (strpos($classname,"CV")===0)
		buscarClase(APP_ROOT."/libcv/",$classname);
	else
		buscarClase(APP_ROOT."/classes/",$classname);
}
/**
 * función de autocarga para las clases declaradas por NuSOAP
 * @param string $classname
 */
function autoCargaNusoap($classname)
{
	if ($classname==='nusoap_base' || $classname==='soap_client' || $classname==='soap_fault'
	|| $classname==='soap_parser' || $classname==='soap_server' || $classname==='soap_transport_http'
	|| $classname==='soapval' || $classname==='wsdl' || $classname==='wsdlcache' || $classname==='XMLSchema')
	require_once "lib/nusoap/nusoap.php";
}

/**
 * función de autocarga para las clases de PHP y PEAR en Linux
 * @param string $classname
 */
function autoCargaPHPLinux($classname)
{	
		buscarClase("/usr/share/php/",$classname);
}

spl_autoload_extensions(".class.php,.php,.inc");
spl_autoload_register('autoCarga');
spl_autoload_register('autoCargaNusoap');
spl_autoload_register('autoCargaPHPLinux');

define("APP_BASE_URL",getAppURL());

  ?>