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
 * Define un manejador de trazas de ejecución en memoria
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE:APP
 */
class CVBasicDebugHandler extends CVObject implements CVDebugHandler{
	/**
	 * define el actual nivel de depuración
	 * @var integer
	 */
	private $currentLevel;
	/**
	 * define el formato actual que será devuelto por getDebugTrace()
	 * @var string
	 */
	private $currentFormat;
	/**
	 * arreglo que guarda las trazas de ejecución
	 * @var array
	MainAction */
	private $trace;
	/**
	 * inicializa el depurador
	 * @param $params CVXMLElement
	 * @return CVBasicDebugHandler
	 */
	public function __construct	($params)
	{
		$this->currentLevel=$params->defaultLevel;
		$this->currentFormat=$params->defaultFormat;
		$this->trace=array();
	} 
	/**
	 * Asigna el nivel de depuración de la aplicación. el nivel debe ser definido en el archivo de configuración setup/app.xml 
	 * @param $level entero
	 * @return void 
	 */
	public function setDebugLevel($level)
	{
		if (is_integer($level))
			$this->currentLevel=$level;
		else
			throw new CVException ("CONVERSION A ENTERO NO PERMITIDA");
	}
	/**
	 * devuelve el valor del nivel de depuración de la aplicación
	 * @param $key el nombre de la variable de sesion
	 * @return integer con el valor actual del nivel de depuración
	 */
	public function getDebugLevel()
	{
		return $this->currentLevel;
	}
	/**
	 * agrega una traza de ejecución al registro de depuración
	 * @param $source fuente que registra el evento 
	 * @param $event evento que se registra
	 * @param $level nivel de ejecución
	 * @param $params arreglo de parametros adicionales a registrar
	 * @param $saveRequest si es true se guarda el contenido del RequestHandler
	 * @param $saveSession si es true se guarda el contenido del SessionHandler
	 * @return void no retorna nada
	 */
	public function addTrace($source, $event,$level,$params=false,$saveRequest=false,$saveSession=false)
	{
		if ($this->getDebugLevel()>$level)
			return;					
		if ($params!==false)
			$p=$params;
		else
			$p="";
		if ($saveRequest!==false)
		{
			$rh=getRequest();
			$request=$rh->getRequestVars();
		}			
		else
			$request="";
		if ($saveSession!==false)
		{
			$sh=getSession();
			$session=$sh->retrieveAll();
		}			
		else
			$session="";
		$this->trace[]=array("source"=>$source,"event"=>$event,"level"=>$level,"params"=>$params,"request"=>$request,"session"=>$session);
	}
	/**
	 * devuelve la traza de depuración en el formato especificado
	 * si no se especifica el formato se asume que es 'array' el cual devuelve un arreglo de cadenas de caracteres con las trazas de ejecución de la aplicación
	 * si se especifica el formato HTML se devuelve un string con las trazas en formato HTML Simple
	 * si se especifica el formato XML se devuelve un string con las trazas en formato XML  
	 * @return var las trazas de depuración en el formato deseado.
	 */
	public function getDebugTrace($format="array")
	{
		switch ($format)
		{
			case 'array':	return $this->trace;
			case 'HTML'	:   return $this->getHTMLDebugTrace();
			case 'XML'  :	return $this->getXMLDebugTrace();
		};
	}
	/**
	 * devuelve la traza de depuración en formato HTML simple 
	 * @return string con las trazas de depuración en formato HTML
	 */
	public function getHTMLDebugTrace()
	{
		return "HTML";
	}
	/**
	 * devuelve la traza de depuración en formato XML 
	 * @return CVXMLELement con el contenido de las trazas de depuración
	 */
	public function getXMLDebugTrace()
	{
		return "XML";
	}	
}
?>