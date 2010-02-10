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
 * Esta clase implementa un Request Handler básico que recibe sus variables tanto por POST como por GET. Internamente lee el arreglo $_REQUEST
 * @author Juan Scarton
 * @version 01/06/2009
 * @package ORG.APONWAO.APP
 */
class CVBasicRequestHandler extends CVObject implements CVRequestHandler{
	/**
	 * constructor de la clase, procesa las variables pasadas en el URL
	 * @return CVBasicRequestHandler
	 */
	public function __construct()
	{
		if (isset ($_GET['getstring']))
		{			
			$strings=explode(" ",$_GET['getstring']);
			$c=count($strings);
			$i=0;
			while ($i<$c)
			{
				$_REQUEST[$strings[$i]]=$strings[($i+1)];
				$i+=2;
			}
		}
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVRequestHandler#isDefined()
	 */	
	public static function isDefined($key)
	{
		if (isset($_REQUEST["$key"]))
			return true;
		else
			return false;
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVRequestHandler#getRequestVar()
	 */	
	public static function get($key)
	{
		if (self::isDefined($key))
			return $_REQUEST["$key"];
		else
			return false;
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVRequestHandler#getRequestVars()
	 */	
	public static function getAll($var_list=false)
	{
		$ret=array();
		if (!$var_list)
			$ret=$_REQUEST;
		else
		{
			foreach($var_list as $key=>$value)
				if (self::isDefined($value))
					$ret[$key]=$_REQUEST["$value"];
				else
					$ret[$key]=false;
		}							
		return $ret;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVRequestHandler#getController()
	 */
	public static function getController()
	{
		if (isset($_GET['controller']))
			return $_GET['controller'];
		else
			return false;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVRequestHandler#getAction()
	 */
	public static function getAction()
	{
		if (isset($_GET['action']))
			return $_GET['action'];
		else
			return false;
	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/app/CVRequestHandler#getMethod()
	 */
	public static function getMethod()
	{
		if (isset($_GET['method']))
			return $_GET['method'];
		else
			return false;
	}
}
?>