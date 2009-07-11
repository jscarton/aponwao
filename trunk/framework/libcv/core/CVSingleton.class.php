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
 * Esta clase implementa el patron de diseño Singleton en Aponwao Framework
 * Provee una estructura de facil implementación.
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE
 */
class CVSingleton
{
	/**
	 * obtiene una instancia de una clase
	 * @param $class el nombre de la clase
	 * @return unknown_type
	 */
    public static function getInstance($class,$params=false,$alternateClass=false)
    {
        static $instances = array();
        
        if(!$alternateClass)
        	$className=$class;
        else
        	$className=(string)$alternateClass;
        if (!array_key_exists($class, $instances)) {
        	if (!$params)
        	{        		
            	$instances[$class] =& new $className;
        	}
            else
            {
            	$instances[$class] =& new $className($params);
            }
        }        
        $instance =& $instances[$class];
        return $instance;
    }
}
?>