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
 * constantes predefinidas
 */
define("WS_FAULT",0);
define("WS_ERROR",1);
define("WS_OK",2);
/**
 * Esta clase implementa un cliente para Webservices basados en SOAP
  * @author Juan Scarton
 * @version 01/07/2009
 * @package CORE.WS.CLIENT
 */
class CVSOAPClient extends CVObject{
	/**
	 * cliente soap_client definido por la libreria NUSOAP
	 * @var soap_client 
	 */
	private $nusoapClient;
	/**
	 * ultimo resultado recibido
	 * @var 
	 */
	private $lastResult=null;
	private $faultMessage=false;
	private $errorMessage=false;
	/**
	 * constructor de la clase recibe un objeto del tipo CVXMLElement con los parametros de conexion
	 * @param $params
	 * @return CVSOAPClient
	 */
	public function __construct($alias)
	{
		//obtiene los parametros de conexion
		$app=getApp();
		$params=$app->getWSAlias($alias);
		if (!$params)
			throw new CVException ("error: no se pudo inicializar el cliente, revise la configuración");
		if (isset($params->proxyHost))
			$proxy_host=(string)$params->proxyHost;
		else
			$proxy_host='';
		if (isset($params->proxyPort))
			$proxy_port=(string)$params->proxyPort;
		else
			$proxy_port='';
		if (isset($params->proxyUser))
			$proxy_username=(string)$params->proxyUser;
		else
			$proxy_username='';
		if (isset($params->proxyPassword))
			$proxy_password=(string)$params->proxyPassword;
		else
			$proxy_password='';
		if (isset($params->user))
			$user=(string)$params->user;
		if (isset($params->password))
			$password=(string)$params->password;
		if (isset($params->wsdl))
			$wsdl=str_replace('APP_BASE_URL',APP_BASE_URL,(string)$params->wsdl);
		else
			throw new CVException ("error no se puede crear un cliente SOAP sin especificar la URL del archivo WSDL");
		if (isset($params->protocol))
			$protocol=$params->protocol;		
		$uri="";
		if (isset($protocol))
			$uri.="$protocol://";
		else
			$uri.="http://";
		if (isset($user))
			$uri.="$user:$password@";
		$uri.=$wsdl;
		try{
		//sets
		$this->nusoapClient= new soap_client($uri, true,$proxy_host, $proxy_port, $proxy_username, $proxy_password);
		if (isset($user))
			$this->nusoapClient->setCredentials($user,$password);
		$err = $this->nusoapClient->getError();
		if ($err) {
			$this->errorMessage=$err;					
			}			
		}
		catch (Exception $ex)
		{
			throw $ex;
		}		
	}
	/**
	 * ejecuta una llamada al servicio dadas la operación y los parametros
	 * @param $method
	 * @param $params
	 * @param $dbg
	 * @return int 
	 */
	public function callIt($method=false, $params=false, $dbg=false)
	{
			$this->errorMessage=false;
			$this->faultMessage=false;
			if (!$method)
				throw new CVException("error: debe especificar la operación a ejecutar");
			else
			{
				if (!isset($this->nusoapClient->operations[$method]))
					throw new CVException("error: no existe la operación $method");
				else
				{
					//ejecuta la llamada
					try{						
						if (!$params)
							$params=array(null);
						$this->lastResult= $this->nusoapClient->call($method, $params, '', '', false, true);
						if ($this->nusoapClient->fault)
						{
							$this->faultMessage=$this->lastResult;
							if ($dbg)
							{
								echo '<h2>SOAP Fault (wsFault)</h2><pre>';
								print_r($this->faultMessage);
								echo '</pre>';
								echo '<h2>Request</h2><pre>' . htmlspecialchars($this->nusoapClient->request, ENT_QUOTES) . '</pre>';
								echo '<h2>Response</h2><pre>' . htmlspecialchars($this->nusoapClient->response, ENT_QUOTES) . '</pre>';
								echo '<h2>Traza</h2><pre>' . htmlspecialchars($this->nusoapClient->debug_str, ENT_QUOTES) . '</pre>';
							}
							$this->lastResult=null;
							return WS_FAULT;					
						}
						$err = $this->nusoapClient->getError();
						if ($err)
						{
							$this->errorMessage=$err;
						if ($dbg)
							{
								echo '<h2>SOAP ERROR (wsERROR)</h2><pre>';
								print_r($this->errorMessage=$err);
								echo '</pre>';
								echo '<h2>Request</h2><pre>' . htmlspecialchars($this->nusoapClient->request, ENT_QUOTES) . '</pre>';
								echo '<h2>Response</h2><pre>' . htmlspecialchars($this->nusoapClient->response, ENT_QUOTES) . '</pre>';
								echo '<h2>Traza</h2><pre>' . htmlspecialchars($this->nusoapClient->debug_str, ENT_QUOTES) . '</pre>';
							}
							$this->lastResult=null;
							return WS_ERROR;
						}
						//si llega aqui es que todo fue bien
						
						if ($dbg)
						{
							echo '<h2>Request</h2><pre>' . htmlspecialchars($this->nusoapClient->request, ENT_QUOTES) . '</pre>';
							echo '<h2>Response</h2><pre>' . htmlspecialchars($this->nusoapClient->response, ENT_QUOTES) . '</pre>';
							echo '<h2>Traza</h2><pre>' . htmlspecialchars($this->nusoapClient->debug_str, ENT_QUOTES) . '</pre>';
						}						
						return WS_OK;
					}
					catch (Exception $ex)
					{
						throw $ex;
					}
				}
			}			
		}
		
		/**
		 * retorna el mensaje de error
		 * @return unknown_type
		 */
		public function getError()
		{
			return $this->errorMessage;
		}
		
		/**
		 * retorna el mensaje de fault
		 * @return unknown_type
		 */
		public function getFault()
		{
			return $this->faultMessage;
		}
		
		/**
		 * retorna el resultado de la invocación
		 * @return unknown_type
		 */
		public function getResult()
		{
			return $this->lastResult;
		}
		public function test()
		{
			print_r($this->nusoapClient);	
		}
		public function getHTTPRequest()
		{
			return htmlspecialchars($this->nusoapClient->request, ENT_QUOTES); 
		}
		public function getHTTPResponse()
		{
			return htmlspecialchars($this->nusoapClient->response, ENT_QUOTES); 
		}
		public function getTrace()
		{
			return htmlspecialchars($this->nusoapClient->debug_str, ENT_QUOTES); 
		}
		
} 
?>