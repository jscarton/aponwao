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
 * Interface que define los metodos necesarios para manipular la data obtenida a trav�s de una sentencia SQL
 * @author Sa�l Bautista
 * @version 19/06/2009
 * @package CORE::DATA
 */
interface CVRecordSet
{
	/**
     * Retorna el valor asociado a la columna especificada de la fila actual.
     * El nombre debe coincidir en mayusculas y minusculas
     * @param $colname el nombre de la columna donde se encuentra el valor deseado
     * @return string el valor de la columna
     */
	public function fetchField($colname);
	 
	/**
     * Retorna un array con la fila actual o false si ha llegado al final
     * @return array de la fila actual o false si es el fin 
     */
	public function fetchRow();
	
	/**
     * Retorna el numero de columnas que posee el recordset 
     * @return int cantidad de columnas
     */
	public function numFields();
	
	/**
     * Retorna el numero de filas que posee el recordset
     * @return int el numero de filas 
     */
	public function numRows();
	
	/**
     * Retorna un array con la fila del recordset
     * el puntero interno se mantiene
     * @return array con los datos de la fila o false si es el final
     */
	public function fetchCurrentRow();
	
	/**
     * Mueve el cursor interno al registro especificado 
     * 0 para la primera fila
     * @param $rownumber numero de la fila a la que se desea mover
     * @return boolean true en caso de exito false en otro caso
     */
	public function moveTo($rownumber);
	
	/**
     * mueve el cursor interno a la posicion siguiente
     * @return boolean true en caso de exito false en otro caso
     */
	public function moveNext();
	
	/**
     * mueve el cursor interno a la posicion anterior
     * @return boolean true en caso de exito false en otro caso
     */
	public function movePrev();
	
	/**
     * mueve el cursor interno al primer registro
     * @return boolean true en caso de exito false en otro caso
     */
	public function moveFirst();
	
	/**
     * mueve el cursor interno al ultimo registro
     * @return boolean true en caso de exito false en otro caso
     */
	public function moveLast();
	
	/**
     * retorna un array asociativo con el contenido del recordset 
     * @return array con el recordset completo
     */
	public function getArrayAssoc();
	
	/**
     * limpia el recordset 
     * 0 para la primera fila
     * @return boolean true en caso de exito false en otro caso
     */
	public function clean();
}
?>