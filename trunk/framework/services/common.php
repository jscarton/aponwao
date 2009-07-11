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
//error_reporting(E_ALL);
ob_start("ob_gzhandler");
define("APP_ROOT","../");
require_once ("../libcv/CVFramework.php");
//inicializa el framework
global $app;
CVObject::loadClass("core.CVSingleton");
$app=CVSingleton::getInstance("CVApplication");
require_once ("config.php");
require_once ("propel/Propel.php");
set_include_path("../classes/ws".":".get_include_path());

if(!extension_loaded("soap"))
	die("Soap extension not loaded!");
session_start();
/** buscar archivos de clases recursivamente en un directorio*/
function wsbuscarClase($ruta , $classname)
{
   if (is_dir($ruta))
   {
   			if (file_exists($ruta."$classname.class.php") || file_exists($ruta."$classname.php") )
			{
					if (file_exists($ruta."$classname.class.php") )
					{
							include($ruta."$classname.class.php");
							return true;
					}
					else
					{
							include($ruta."$classname.php");
							return true;
					}
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
   else
   	   return false;
}


/** autoload functie voor PHP5 */
function wsautoload($classname) {
	if(file_exists("lib/data_objects/$classname.class.php"))
		include("lib/data_objects/$classname.class.php");
	elseif(file_exists("lib/soap/$classname.class.php"))
		include("lib/soap/$classname.class.php");
	elseif(file_exists("lib/$classname.class.php"))
		include("lib/$classname.class.php");	
	elseif (!wsbuscarClase("../classes/", $classname));
		elseif (!wsbuscarClase("../libcv/", $classname));
			
}
spl_autoload_register("wsautoload");
/** Schrijft de gegeven tekst naar de debug file */
function debug($txt,$file="debug.txt"){
	$fp = fopen($file, "a");
	fwrite($fp, str_replace("\n","\r\n","\r\n".$txt));
	fclose($fp);
}

/** Schrijft het gegeven object weg in de debug log */
function debugObject($txt,$obj){
	ob_start();
	print_r($obj);
	$data = ob_get_contents();
	ob_end_clean();
	debug($txt."\n".$data);
}
?>
