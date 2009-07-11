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
 * Esta clase implementa un Manejador de Instancias de Conexiones de Datos
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE::DATA
 */
class CVDataManager extends CVObject
{
	/**
	 * Objeto CVXMLElement que guarda la configuración de los parametros 
	 * de conexión a las bases de datos
	 * @var CVXMLElement
	 */
	private $dataBases;
	/**
	 * Objeto CVXMLElement que guarda la configuración de las clases
	 * que implementan la interfaz CVDataConnection para las diferentes
	 * Bases de Datos soportadas
	 * @var CXMLElement
	 */
	private $drivers;
	/**
	 * Array de conexiones a las BD's
	 * @var CVDataConnection
	 */
	private $instances;
	/**
	 * constructor por defecto modifique segun sea necesario
	 * @return CVActionHandler
	 */
	public function __construct($dataConf)
	{	
				$this->dataBases=$dataConf->databases;
				$this->drivers=$dataConf->drivers;
				$this->instances=array();
	}
	/**
	 * Este metodo es el punto de inicio de la acción.
	 */
	public function getConnection($alias)	
	{
		if(!array_key_exists($alias, $this->instances)) 
		{
			if (isset($this->dataBases->$alias))
			{
				$conDef=$this->dataBases->$alias;
				$type=(string)$conDef->type;
				if (isset($this->drivers->$type))
				{
					$className=(string)$this->drivers->$type;
					$this->instances[$alias]=& new $className($conDef);
				}
				else
					throw new CVException("No existe un manejador definido para el tipo de DB llamado $type");				
			}
			else
				throw new CVException("No existe un alias de Base de Datos configurado para $alias");
		}
		$instance=& $this->instances[$alias];
		return $instance;
	}	
	/**
	 * obtiene los parametros de configuración de una conexión a base de datos
	 * @param $alias
	 * @return unknown_type
	 */
	public function getConnectionParams($alias)
	{
		if (isset($this->dataBases->$alias))
			return $this->dataBases->$alias;
		else
			return false;
	}
	
}
?>