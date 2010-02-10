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
 * Clase que implementa la interfaz CVDataConnection para POSTGRESQL
 * @author Saul Bautista
 * @version 19/06/2009
 * @package ORG.APONWAO.DATA.PGSQL
 */
class CVPGSQLRecordSet extends CVObject implements CVRecordSet{
	
	/*
	 * valor del recordset retornado por la sentencia SQL ejecutada
	 * @var resource retornado por postgre
	 */
	private $recordSet;

	/*
	 * apuntador de la fila actual
	 * @var integer indice del registro actual en el recordset
	 */
	private $currentRow;
	
	/*
	 * array que almacena los resultados del recordSet 
	 * @var array array asociativo con los resultados de la consulta
	 */
	private $result;
	/**
	 * constructor de la clase procesa el resultado devuelto por postgresql
	 * @param $rs
	 * @return CVPGSQLRecordSet
	 */
	public function __construct($rs)
	{
		$this->recordSet=$rs;
		$this->currentRow=0;
		$i=0;
		try
		{
			while($row=pg_fetch_assoc($this->recordSet))
			{
				$this->result[$i]=$row;
				$i++;
			}
		}
		catch(Exception $e)
		{
			throw new Exception('Error al obtener datos del RecordSet'.mysql_error());
		}
		
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#fetchField()
	 */
	public function fetchField($colname)
	{
		if(isset($this->recordSet))
		{
			$cols=count($this->result[$this->currentRow]);
			$row=$this->result[$this->currentRow];
			foreach($row as $key=>$val)
			{
				if($key==$colname)
					return $val;
			}
			throw new CVException('Error no existe la columna en el RecordSet');
		}
		else
			throw new CVException('Error no se encuentra definido el RecordSet');
	} 
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#fetchRow()
	 */
	public function fetchRow()
	{
		if(isset($this->recordSet))
		{
			if($this->currentRow<$this->NumRows())
			{
				$ret=array();
				$row=$this->result[$this->currentRow];
				$i=0;
				foreach($row as $key=>$val)
				{
					$ret[$i]=$val;
					$i++;
				}
				$this->currentRow++;
				return $ret;	
			}
			else
				throw new CVException('No existen mas registros en el Recordset');
		}
		else
			throw new CVException('no se pudieron obtener registros del RecordSet');	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#numFields()
	 */
	public function numFields()
	{
		if(isset($this->recordSet))
			return count($this->result[$this->currentRow]);
		else
			throw new CVException('Error no se encuentra definido el RecordSet');	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#numRows()
	 */
	public function numRows()
	{
		if(isset($this->recordSet))
			return count($this->result);
		else
			throw new CVException('Error no se encuentra definido el RecordSet');	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#fetchCurrentRow()
	 */
	public function fetchCurrentRow()
	{
		if(isset($this->recordSet))
		{	
			if($this->currentRow<$this->numRows())
				return $this->result[$this->currentRow];
			else
				throw new CVException('Error se ha llegado al final del RecordSet');
		}		
		else
			throw new CVException('Error no se encuentra definido el RecordSet');	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#moveTo()
	 */
	public function moveTo($rownumber)
	{
		if(isset($this->recordSet))
		{
			if($rownumber>=0 && $rownumber<$this->numRows())
				$this->currentRow=$rownumber;
			else
				throw new CVException('Error no existe el registro especificado en el RecordSet');
		}	
		else
			throw new CVException('Error no se encuentra definido el RecordSet');	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#moveNext()
	 */
	public function moveNext()
	{
		if(isset($this->recordSet))
			if($this->currentRow<$this->numRows())
				$this->currentRow++;							
			else
				throw new CVException('Error no puede moverse el cursor');
		else
			throw new CVException('Error no se encuentra definido el RecordSet');		
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#movePrev()
	 */
	public function movePrev()
	{
		if(isset($this->recordSet))
			if($this->currentRow>0)
				$this->currentRow--;							
			else
				throw new CVException('Error no puede moverse el cursor');
		else
			throw new CVException('Error no se encuentra definido el RecordSet');
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#moveFirst()
	 */
	public function moveFirst()
	{
		$this->moveTo(0);	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#moveLast()
	 */
	public function moveLast()
	{
		$this->moveTo($this->numRows()-1);	
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#getArrayAssoc()
	 */
	public function getArrayAssoc()
	{
		if(isset($this->recordSet))
			return $this->result;
		else
			throw new CVException('Error no se encuentra definido el RecordSet');
	}
	/**
	 * (non-PHPdoc)
	 * @see libcv/core/data/CVRecordSet#clean()
	 */
	public function clean()
	{
		if(isset($this->recordSet))
		{
			unset($this->recordSet);
			unset($this->result);
			$this->currentRow=0;
		}
		else
			throw new CVException('Error no se encuentra definido el RecordSet');	
	}
}
?>