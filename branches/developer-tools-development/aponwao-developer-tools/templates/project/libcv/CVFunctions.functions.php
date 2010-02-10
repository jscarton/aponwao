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
 * Obtiene una instancia del objeto CVApplication 
 */ 
	function getApp()
	{
		global $app;
		return $app;
	}
/**
 * Obtiene una instancia del objeto que implementa la interfaz RequestHandler 
 */ 
	function getRequest()
	{
		global $app;
		return $app->getRequestHandler();
	}
/**
 * Obtiene una instancia del objeto que implementa la interfaz SessionHandler 
 */ 
	function getSession()
	{
		global $app;
		return $app->getSessionHandler();
	}
/**
 * Obtiene un string con el nombre del objeto CVActionHandler asociado a un controlador 
 */ 
	function getController($controller)
	{
		global $app;
		return $app->getControllerClass($controller);
	}
/**
 * Obtiene una referencia al objeto CVDataManager 
 */ 
	function getDataManager()
	{
		global $app;
		return $app->getDataManager();
	}
/**
 * retorna el titulo de la aplicación
 * @return string
 */
	function getAppTitle()
	{
		global $app;
		return $app->getAppTitle();
	}
/**
 * retorna el codename de la aplicación
 * @return string
 */
	function getAppCodeName()
	{
		global $app;
		return $app->getAppCodeName();
	}
/**
 * lee un archivo de recurso y coloca su contenido en una variable tipo string
 * @param $resourePath ruta del archivo relativa al directorio raiz de la aplicación
 * @return string retorna el contenido del archivo en una cadena de caracteres o false en caso de fallo
 */
	function addResource($resourcePath,$include=false)
	{	
		if (file_exists(APP_ROOT."/$resourcePath"))
		{
			if ($include)
				include_once(APP_ROOT."/$resourcePath");
			else
				require_once(APP_ROOT."/$resourcePath");
						
		}
		else
			return false;
	}
/**
 * Obtiene la APP_BASE_URL 
 * @return string retorna la direccion URL base de la aplicacion
 */
	function getAppURL()
	{	
		return str_replace("/index.php","",$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
		
	}
?>