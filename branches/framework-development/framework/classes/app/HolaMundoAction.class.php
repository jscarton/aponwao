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
 * Esta es una acción generica para propositos de pruebas
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CLASSES::APP
 */
class HolaMundoAction extends CVActionHandler
{
	/**
	 * Este metodo es el punto de inicio de la acción.
	 */
	public function doIt()
	{									
		try{			
			$this->set('title',"Bienvenido a Aponwao Framework");
			$serviceClient=new CVSOAPClient("holamundo");
			if (!$serviceClient->getError())
			{
				if($serviceClient->callIt("holaMundo")==WS_OK)
					$this->set('msg',$serviceClient->getResult());
				elseif ($serviceClient->getError())
					$this->set('err',"Error:".$serviceClient->getError());
				elseif ($serviceClient->getFault())
					$this->set('err',"Error:".$serviceClient->getFault());				
			}
			else
				$this->set('err',"Error:".$serviceClient->getError());
			//genera la salida HTML
			$this->show();					
		}
		catch (Exception  $ex)
		{
			throw $ex;
		}				
	}
}
?>