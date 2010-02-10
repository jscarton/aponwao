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
/**
 * Esta clase implementa la interfaz CVDataConnection para el RDBMS PostgreSQL
 * @author Juan Scarton
 * @version 01/06/2009
 * @package ORG.APONWAO.DATA.PGSQL
 */
class CVPGSQLConnection extends CVObject implements CVDataConnection{

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
        	$host=(string) $conex->host;
        else
        	throw new CVException("No se ha definido el parametro host para la conexión".((string)$conex->getName()));
        //obtiene el parametro port como es opcional si no esta definido lo ignora
        if (isset($conex->port))
        	$port=(string) $conex->host;
 		//obtiene el parametro dbname      	        
        if (isset($conex->dbname))
        	$dbname=(string) $conex->dbname;
        else
        	throw new CVException("No se ha definido el parametro dbname para la conexión".((string)$conex->getName()));
        //obtiene el usuario de la conexión
		if (isset($conex->user))
        	$user=(string) $conex->user;
        else
        	throw new CVException("No se ha definido el parametro user para la conexión".((string)$conex->getName()));
        if (isset($conex->password))
        	$password=(string) $conex->password;
        else
        	throw new CVException("No se ha definido el parametro password para la conexión".((string)$conex->getName()));        	
        //creo el string de la conexión
        $strCon="host=$host";
        if (isset($port))
        	$strCon.=" port=$port";
        $strCon.=" dbname=$dbname";
        $strCon.=" user=$user";
        $strCon.=" password=$password";	
        $this->con=pg_connect($strCon);
        if (!$this->con)
        {
            throw new CVException("ha ocurrido un error al inicializar la conexión a la BD");
        }
    }
    /**
     * (non-PHPdoc)
     * @see libcv/core/data/CVDataConnection#doQuery($sql)
     */  
    public function doQuery($sql)
    {
        $res=pg_query($this->con,$sql);
        if (!pg_result_error($res))
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando consulta a la bd:".pg_result_error($res));
        return new CVPGSQLRecordSet ($this->lastResult);
    }
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVDataConnection#doInsert($table, $values)
	 */
    public function doInsert($table,$values)
    {
    if (!$table || !$values || !is_array($values))
			throw new CVException ("Error de formato en parametros en doInsert");
		$columns="";
		$values_list="";
		foreach($values as $field=>$value)
		{
			if ($columns=="")
				$columns=$field;
			else
				$columns.=",".$field;
			if ($value_list=="")
				$value_list="'$value'";
			else
				$value_list.=",'$value'";
		}
        $res=pg_query($this->con,"insert into $table ($columns) values ($value_list)");
        if (!pg_result_error($res))
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando insercion a la bd:".pg_result_error($res));
        if (pg_affected_rows($res)>0)
        	return true;
        else
        	return false;
    }
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVDataConnection#doUpdate($table, $values, $whereClause)
	 */
    public function doUpdate($table,$valuesList,$whereClause)
    {
    	if (!$table || !$values || !is_array($values))
			throw new CVException ("Error de formato en parametros en doUpdate");
		$values_list="";
		foreach($values as $field=>$value)
		{
			if ($value_list=="")
				$value_list="$field='$value'";
			else
				$value_list=",$field='$value'";
		}
        $res=pg_query($this->con,"update $table set $value_list where $whereClause");
        if (!pg_result_error($res))
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando actualizacion a la bd:".pg_result_error($res));
        if (pg_affected_rows($res)>0)
        	return true;
        else
        	return false;
    }
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVDataConnection#doDelete($table, $whereClause)
	 */
    public function doDelete($table,$whereClause)
    {
        $res=pg_query($this->con,"delete from $table where $whereClause");
        if (!pg_result_error($res))
        	$this->lastResult=$res;
        else
        	throw new CVException ("Error ejecutando eliminacion a la bd:".pg_result_error($res));
        if (pg_affected_rows($res)>0)
        	return true;
        else
        	return false;
    }
    /**
     * (non-PHPdoc)
     * @see libcv/core/data/CVDataConnection#lastId()
     */
    public function lastId()
    {
    	$query = 'SELECT LASTVAL() AS insert_id';
        $result = @pg_query($query); 
        $insert_id = @pg_fetch_array($result, NULL, PGSQL_ASSOC);
    	if (!pg_result_error($insert_id))
    	{
    		return $insert_id['insert_id'];
    	}
        else
        {
        	throw new CVException ("Error accediendo a la bd para ubicar el lastId:".pg_result_error($insert_id));
            return -1;
         }

    }  
}

?>