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
addResource('lib/phptal/PHPTAL.php');

/**
 * Clase que permite utilizar el motor de plantillas de PHPTAL
 * en Aponwao Framework.
 * @author Juan Scarton
 * @version 25/11/2009
 * @package CORE.VIEW
 */
class CVView extends PHPTAL{
	/**
	 * constructor por defecto, inicializa el repositorio de plantillas y el directorio de cache donde se almacenan los archivos generados
	 * @return CVView
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setTemplateRepository(APP_ROOT.'/resources/atpl');
		$this->setPhpCodeDestination(APP_ROOT.'/cache');
		//define algunas de las constantes para direccionamiento de recursos
		$this->RESOURCES=APP_ROOT.'/resources';
		$this->IMAGES="http://".APP_BASE_URL.'/resources/images';
		$this->CSS="http://".APP_BASE_URL.'/resources/css';
		$this->JAVASCRIPT="http://".APP_BASE_URL.'/resources/js';
		$this->OTHERS="http://".APP_BASE_URL.'/resources/others';
		$this->PHP=APP_ROOT.'/resources/php';
		
				
	}	
}

?>