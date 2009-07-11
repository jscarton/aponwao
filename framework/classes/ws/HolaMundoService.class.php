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
 * Esta es una acción generica para propositos de pruebas de un webservice
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CLASSES::APP
 */
class HolaMundoService
{
	/**
	 * Este metodo devuelve un string hola mundo
	 * @return string
	 */
	public function holaMundo()
	{							
		return "Bienvenido a Aponwao Framework (estas usando la version 0.1.x)";					
	}
	/**
	 * devuelve el texto que le es pasado como parametro
	 * @param string $msg
	 * @return string
	 */
	public function echoing($msg)
	{
		return $msg;
	}				 
}
?>