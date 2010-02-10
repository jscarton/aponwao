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
 * Esta clase implementa la lógica para inicializar PROPEL
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE
 */
require_once "propel/Propel.php";
class CVPropelConnection extends CVObject
{
	/**
	 * instancia de la conexión con propel
	 * @var unknown_type
	 */
	private $con;
	/**
	 * constructor la clase
	 * @param $params CVXMLElement
	 * @return CVPropelConnection
	 */
	public function __construct($params)
	{
		try{
		$confFile=APP_ROOT."/setup/".((string)$params->getName()."-conf.php");
		Propel::init($confFile);
		$this->con=Propel::getConnection();
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}
	/**
	 * obtiene el enlace con PROPEL
	 * @return unknown_type
	 */
	public function getConnection()
	{
		return $this->con;	
	}		
}
?>