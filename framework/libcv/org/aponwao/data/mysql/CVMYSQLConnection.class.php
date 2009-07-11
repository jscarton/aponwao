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
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CVMYSQLConnection extends CVObject implements CVDataConnection{

	/**
	 * guarda la direccion o nombre del servidor
	 * @var unknown_type
	*/
	private $host;
    /**
	 * guarda el usuario de la bd
	 * @var unknown_type
	 */
    private $user;
   	/**
	 * guarda el password del usuario a BD
	 * @var unknown_type
	 */
    private $passwd;
    /**
	 * guarda el puerto a BD (opcional)
	 * @var unknown_type
	 */
    private $port;
     /**
	 * guarda el nombre de la BD
	 * @var unknown_type
	 */
    private $dbname;
	/**
	 * guarda la conexión a la bd
	 * @var unknown_type
	 */
	private $con;
	/**
	 * guarda el ultimo resultado del ultimo doQuery solicitado
	 * @var unknown_type
	 */
	private $lastResult;

	public function __construct($conex)
	{
			
		//observese que se accede a los tags como si fueran atributos del objeto CVXMLElement $conex
		//el cast a (string) es necesario ya que cada tag es en si mismo un objeto CVXMLElement  este cast nos da el valor del tag
		//obtiene el parametro host
		if (isset($conex->host))
			$this->host=(string) $conex->host;
		else
			throw new CVException("No se ha definido el parametro host para la conexión".((string)$conex->getName()));
		//obtiene el parametro port como es opcional si no esta definido lo ignora
		if (isset($conex->port))
			$this->port=(string) $conex->host;
		//obtiene el parametro dbname
		if (isset($conex->dbname))
			$this->dbname=(string) $conex->dbname;
		else
			throw new CVException("No se ha definido el parametro dbname para la conexión".((string)$conex->getName()));
		//obtiene el usuario de la conexión
		if (isset($conex->user))
			$this->user=(string) $conex->user;
		else
			throw new CVException("No se ha definido el parametro user para la conexión".((string)$conex->getName()));
		if (isset($conex->password))
			$this->passwd=(string) $conex->password;
		else
			throw new CVException("No se ha definido el parametro password para la conexión".((string)$conex->getName())); 
		//creo el string de la conexión
        $this->con=mysql_connect($this->host,$this->user,$this->passwd);
        if (!$this->con)
        {
            throw new CVException("Ha ocurrido un error al inicializar la conexión");
        }       
		else if (!mysql_select_db($this->dbname,$this->con))
		{
			throw new CVException("Ha ocurrido un error al inicializar la conexión a la BD");
		}
	}

	public function doQuery($sql)
	{
		$res=mysql_query($sql,$this->con);
        if (mysql_error($this->con)=="")
        {
			$this->lastResult=$res;	
        }
        else
        	throw new CVException ("Error ejecutando consulta a la bd:".mysql_error($this->con));		
        return new CVMYSQLRecordSet ($this->lastResult);
	}

	public function doInsert($table,$colnames,$values)
	{
        $res=mysql_query("insert into $table ($colnames) values ($values)",$this->con);
        if (mysql_error($this->con)=="")
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando insercion a la bd:".mysql_error($this->con));
        if (mysql_affected_rows($this->con)>0)
        	return true;
        else
        	return false;
	}

	public function doUpdate($table,$valuesList,$whereClause)
    {
        $res=mysql_query("update $table set $valuesList where $whereClause",$this->con);
        if (mysql_error($this->con)=="")
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando actualizacion a la bd:".mysql_error($this->con));
        if (mysql_affected_rows($this->con)>0)
        	return true;
        else
        	return false;
    }

	public function doDelete($table,$whereClause)
    {
        $res=mysql_query("delete from $table where $whereClause",$this->con);
        if (mysql_error($this->con)=="")
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando eliminacion a la bd:".mysql_error($this->con));
        if (mysql_affected_rows($this->con)>0)
        	return true;
        else
        	return false;
    }
    public function lastId()
    {
    	$res=mysql_insert_id($this->con);
    	if (mysql_error($this->con)=="")
    		return $res;
        else
        {
        	throw new CVException ("Error accediendo a la bd para ubicar el lastId:".mysql_error($this->con));
        	return -1;
        }

    }
}

?>