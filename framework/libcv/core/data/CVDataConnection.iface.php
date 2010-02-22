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
 * Interfase que provee servicios de conexión, consultasy acceso a bases de datos    
 * relacionales
 * @author Rafael Vivas
 * @version 15/06/2009
 * @package CORE.DATA
 */
interface CVDataConnection {

     /**
     * Constructor de la Clase
     * @param $conex Nombre de la conexion a utilizar previamente definida en
     * archivo de configuracion.
     * @return void
     */
    public function __construct($conex);

    /**
     * Permite la realizacion de Consultas a la Base de Datos
     * @param $sql Consulta a ser realizada
     * @return array Devuelve el resultado de la Consulta
     */
    
    public function doQuery($sql);

    /**
     * Permite la realizacion de Inserts a la Base de Datos
     * @param $table tabla donde se va a realizar el insert
     * @param $values array asociativo del tipo 'campo'=>'valor'  
     * @return boolean true si tuvo exito o false en caso contrario.
     */
    
    public function doInsert($table=false,$values=false);

    /**
     * Permite la realizacion de Updates a la Base de Datos
     * @param $table nombre de la tabla a actualizar
     * @param $values array asociativo del tipo 'campo'=>'valor'
     * @param $whereClause clausulas a anexar  despues de where
     * @return boolean true si tuvo exito o false en caso contrario
     */
    public function doUpdate($table,$values,$whereClause);

    /**
     * Permite la realizacion de Deletes a la Base de Datos
     * @param $table nombre de la tabla de la cual se va a eliminar registros
     * @param $whereClause clausulas a anexar  despues de where
     * @return boolean true si tuvo exito o false en caso contrario
     */
    public function doDelete($table,$whereClause);

     /**
     * Permite la busqueda del id autonumerico de la ultima fila insertada
     * @param none
     * @return number El numero de la fila, o -1 en caso de algun error
     */
    public function lastId();

}
?>



