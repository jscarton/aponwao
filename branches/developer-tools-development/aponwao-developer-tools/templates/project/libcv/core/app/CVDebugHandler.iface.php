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
/*
 * definicion de constantes usadas por la clase
 */
/**
 * no se registra ningun evento
 * @var integer 
 */
define(LEVEL_NONE,-1,false);
/**
 * se registran todos los eventos incluyendo los de las clases del nucleo de Aponwao Framework
 * @var integer 
 */
define(LEVEL_CORE,0,false);
/**
 * se registran solos los eventos relacionados con el funcionamiento de la aplicación y el contenido de las variables de sesión y de la solicitud HTTP 
 * @var integer
 */
define(LEVEL_APP,1,false);
/**
 * se registran los eventos relacionados con la ejecución de la aplicación
 * @var integer
 */
define(LEVEL_USER,2,false);
/**
 * nivel de depuración especial que permite al programador generar trazas de eventos especificos
 * @var unknown_type
 */
define(LEVEL_SPECIAL,2,false);

/**
 * Interface que define la funcionalidad requerida por un manejador de depuración
 * en Aponwao Framework.
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE.APP
 */
interface CVDebugHandler{	 
	/**
	 * Asigna el nivel de depuración de la aplicación. el nivel debe ser definido en el archivo de configuración setup/app.xml 
	 * @param $level entero
	 * @return void 
	 */
	public function setDebugLevel($level);
	/**
	 * devuelve el valor del nivel de depuración de la aplicación
	 * @param $key el nombre de la variable de sesion
	 * @return integer con el valor actual del nivel de depuración
	 */
	public function getDebugLevel();
	/**
	 * agrega una traza de ejecución al registro de depuración
	 * @param $source fuente que registra el evento 
	 * @param $event evento que se registra
	 * @param $level nivel de ejecución
	 * @param $params arreglo de parametros adicionales a registrar
	 * @param $saveRequest si es true se guarda el contenido del RequestHandler
	 * @param $saveSession si es true se guarda el contenido del SessionHandler
	 * @return void no retorna nada
	 */
	public function addTrace($source, $event,$level,$params=false,$saveRequest=false,$saveSession=false);
	/**
	 * devuelve la traza de depuración en el formato especificado
	 * si no se especifica el formato se asume que es 'simple' el cual devuelve un arreglo de cadenas de caracteres con las trazas de ejecución de la aplicación
	 * si se especifica el formato HTML se devuelve un string con las trazas en formato HTML Simple
	 * si se especifica el formato XML se devuelve un string con las trazas en formato XML  
	 * @return var las trazas de depuración en el formato deseado.
	 */
	public function getDebugTrace($format="simple");
	/**
	 * devuelve la traza de depuración en formato HTML simple 
	 * @return string con las trazas de depuración en formato HTML
	 */
	public function getHTMLDebugTrace();
	/**
	 * devuelve la traza de depuración en formato XML 
	 * @return CVXMLELement con el contenido de las trazas de depuración
	 */
	public function getXMLDebugTrace();	
}
?>