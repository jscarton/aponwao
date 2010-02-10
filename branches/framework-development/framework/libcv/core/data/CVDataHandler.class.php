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
 * Esta clase implementa la abstracción de acción en Aponwao Framework
 * @author Juan Scarton
 * @version 09/02/2010
 * @package CORE.DATA
 */
abstract class CVActionHandler extends CVObject
{
	public $request;
	public $session;
	public $datamanager;
	/**
	 * constructor por defecto modifique segun sea necesario
	 * @return CVActionHandler
	 */
	public function __construct()
	{			
		$this->request=getRequest();
		$this->session=getSession();
		$this->datamanager=getDataManager();
	}
}