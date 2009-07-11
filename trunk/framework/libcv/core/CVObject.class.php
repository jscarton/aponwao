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
/**
 * Clase base que implementa la funcionalidad requerida por las demas
 * clases de Aponwao Framework.
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE
 */
abstract class CVObject{
	/**
	 * Carga archivos de clases de Aponwao Framework
	 * este metodo es similar la función autoload definida en el archivo CVFramework
	 * @param $classPath ruta de paquetes de la clase a cargar
	 * @return boolean true si tuvo exito, falso en caso contrario
	 */
	public static function loadClass($classPath)
	{
		$translatedName=str_replace(".","/",$classPath);
		if (file_exists(APP_ROOT."/libcv/$translatedName.class.php"))
		{
			require_once(APP_ROOT."/libcv/$translatedName.class.php");
			return true;
		}
		elseif(file_exists(APP_ROOT."/classes/$translatedName.class.php"))
		{
			require_once(APP_ROOT."/classes/$translatedName.class.php");
			return true;
		}
		elseif(file_exists(APP_ROOT."/classes/$translatedName.php"))
		{
			require_once(APP_ROOT."/classes/$translatedName.php");
			return true;
		}
		return false;
	}
	/**
	 * Carga un paquete de clases de Aponwao Framework
	 * este metodo es similar la función autoload definida en el archivo CVFramework
	 * @param $classPath ruta de paquetes de la clase a cargar
	 * @return boolean true si tuvo exito, falso en caso contrario
	 */
	public static function loadClasses($classPath)
	{
		echo "<br/>Probando:$classPath";
		$translatedName=str_replace(".","/",$classPath);
		//prueba si carga al menos una clase
		$sw=false;
		if (is_dir(APP_ROOT."/libcv/$translatedName"))
		{
			$ruta=APP_ROOT."/libcv/$translatedName";			
			if ($dh = opendir($ruta))
			{				
        		while (($file = readdir($dh)) !== false)
				{
					//si es un directorio lo procesa recursivamente
					//caso contrario asume que es un archivo php y lo carga 
					//(regla de contenido de directorios de clases)
        			if (is_dir($ruta."/".$file) && $file!="." && $file!="..")
        			{
        				$subpath=$translatedName."/".$file;
        				$subpath=str_replace("/",".",$subpath);
						if (self::loadClasses($subpath))
							$sw=true;
        			}
        			elseif (file_exists($ruta."/".$file) && $file!="." && $file!="..")
        			{
        				echo "<br/>cargando archivo".$ruta."/".$file;
        				require_once($ruta."/".$file);
        			}
            		}
         	}
      			closedir($dh);
      	}
		elseif (is_dir(APP_ROOT."/classes/$translatedName"))
		{
			$ruta=APP_ROOT."/classes/$translatedName";
			if ($dh = opendir($ruta))
			{				
        		while (($file = readdir($dh)) !== false)
				{
					//si es un directorio lo procesa recursivamente
					//caso contrario asume que es un archivo php y lo carga 
					//(regla de contenido de directorios de clases)
        			if (is_dir($ruta."/".$file) && $file!="." && $file!="..")
        			{
						$subpath=$translatedName."/".$file;
        				$subpath=str_replace("/",".",$subpath);
						if (self::loadClasses($subpath))
							$sw=true;
        			}
        			elseif (file_exists($ruta."/".$file) && $file!="." && $file!="..")
        			{
        				echo "<br/>cargando archivo".$ruta."/".$file;
        				require_once($ruta."/".$file);
        			}
            	}
         	}
      			closedir($dh);
		}		
		return $sw;
	}
	/**
	 * lee un archivo de recurso y coloca su contenido en una variable tipo string
	 * @param $resourePath ruta del archivo relativa al directorio raiz de la aplicación
	 * @return string retorna el contenido del archivo en una cadena de caracteres o false en caso de fallo
	 */
	public static function loadResource($resourcePath)
	{	
		if (file_exists(APP_ROOT."/$resourcePath"))
		{
			$resourceContents=file_get_contents(APP_ROOT."/$resourcePath");
			if (!$resourceContents)
				return false;
			else
				return $resourceContents;			
		}
		else
			return false;
	}		
}
?>