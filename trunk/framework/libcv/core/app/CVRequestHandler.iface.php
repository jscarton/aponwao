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
 * Interface que define la funcionalidad requerida por un manejador de solicitudes HTTP
 * en Aponwao Framework.
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE.APP
 */
interface CVRequestHandler{
	/**
	 * devuelve true si key es una variable de request http definida, false en caso contrario
	 * @param $key
	 * @return boolean
	 */
	public static function isDefined($key);
	/**
	 * devuelve el valor de una variable de sesión dada su clave (key)
	 * @param $key el nombre de la variable en la solicitud HTTP
	 * @return var el valor de la variable key si esta definida si no existe key debe capturar una excepción de VARIABLE DE REQUEST HTTP NO DEFINIDA 
	 */
	public static function get($key);
	/**
	 * devuelve un array con todas las variables de una solicitud HTTP dada o no una lista de claves (keys)
	 * @return array devuelve todas las variables de la lista si no se especifica una lista devuelve todas las variables de la consulta. Si no existe alguna o algunas de las variables solicitadas debe capturar una excepción de VARIABLE DE REQUEST HTTP NO DEFINIDA
	 */
	public static function getAll($var_list=false);
	/**
	 * devuelve el nombre del controller a ejecutar
	 * @return string
	 */
	public static function getController();
	/**
	 * devuelve el nombre de la acción del controller a ejecutar
	 * @return string
	 */
	public static function getAction();
	/**
	 * devuelve el método de la acción del controller a ejecutar
	 * @return string
	 */
	public static function getMethod();	
}
?>