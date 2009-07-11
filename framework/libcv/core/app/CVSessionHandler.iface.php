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
 * Interface que define la funcionalidad requerida por un manejador de sesión
 * en Aponwao Framework.
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE:APP
 */
interface CVSessionHandler{
	/**
	 * prueba la existencia o no de una variable de sesion. devuelve true si key es una variable de sesion definida, false en caso contrario.
	 * en caso de que se invoque el metodo sin definir key devolvera el valor devuelto por la funcion PHP isset($_SESSION)
	 * @param $key el nombre de la variable de sesion a probar
	 * @return boolean retorna true si esta definida, false en caso contrario
	 */
	public function isDefined($key);
	/**
	 * almacena una variable de sesión
	 * @param $key el nombre de la variable de sesion
	 * @param $value el valor de la variable de sesion
	 * @return void
	 */
	public function storeIt($key,$value);
	/**
	 * devuelve el valor de una variable de sesión
	 * @param $key el nombre de la variable de sesion
	 * @return var depende del valor almacenado en la sesión
	 */
	public function retrieveIt($key);
	/**
	 * devuelve un arreglo con todas las variables de sesion
	 * @return array si no existen variables de session almacenadas devuelve false
	 */
	public function retrieveAll();
}
?>