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
 * Esta clase implementa un Session Handler básico que codifica claves y el contenido de la sesion usando encoding base64
 * @author Juan Scarton
 * @version 01/06/2009
 * @package ORG.APONWAO.APP
 */
class CVEncodedSessionHandler extends CVObject implements CVSessionHandler{		
	/**
	 * codifica un valor dado utilizando la codificación base64
	 * @param $value el valor a codificar
	 * @return string el valor codificado
	 */
	private function encode($value)
	{
		return base64_encode($value);
	}
	/**
	 * decodifica un valor dado utilizando la codificación base64
	 * @param $value el valor a decodificar
	 * @return string el valor decodificado
	 */
	private function decode($value)
	{
		return base64_decode($value);
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVSessionHandler#retrieveIt()
	 */
	public function get($key)
	{
		if ($this->isDefined($key))
			return 	$this->decode($_SESSION[$this->encode($key)]);
		else
			return false;	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVSessionHandler#storeIt()
	 */
	public function set($key,$value)
	{
		$key=$this->encode($key);
		$value=$this->encode($value);
		$_SESSION[$key]=$value;
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVSessionHandler#isDefined()
	 */
	public function isDefined($key)
	{
		if (isset($_SESSION[$this->encode($key)]))
			return true;
		else
			return false;
	}	
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVSessionHandler#retriveAll()
	 */
	public function getAll()
	{
		$ret=false;
		foreach ($_SESSION as $key=>$value)
			$ret[$this->decode($key)]=$this->decode($value);
		return $ret;
	}
	
	public function _unset($key)
	{
		if ($this->isDefined($key))
		{
			unset($_SESSION[$this->encode($key)]);
			return 	true;
		}
		else
			return false;
	}
	public function _unsetAll()
	{
		return session_destroy();
	}
}

?>