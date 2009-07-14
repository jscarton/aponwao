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
 * Esta clase implementa la abstracción de acción en Aponwao Framework
 * @author Juan Scarton
 * @version 01/06/2009
 * @package CORE::APP
 */
class CVApplication extends CVObject
{
	/**
	 * Objeto CVXMLElement que guarda el contenido de app.xml
	 * @var CVXMLElement
	 */
	private $appConf;	
	/**
	 * Objeto CVXMLElement que guarda el contenido de security.xml
	 * @var CVXMLElement
	 */
	private $secConf;
	/**
	 * Objeto CVXMLElement que guarda el contenido de data.xml
	 * @var CVXMLElement
	 */
	private $datConf;
	/**
	 * Objeto CVXMLElement que guarda el contenido de service.xml
	 * @var CVXMLElement
	 */
	private $serviceConf;
	/**
	 * Objeto que implementa la interfaz CVRequestHandler
	 * @var CVRequestHandler
	 */
	private $__REQUEST;
	/**
	 * Objeto que implementa la interfaz CVSessionHandler
	 * @var CVSessionHandler
	 */
	private $__SESSION;
	/**
	 * Objeto que implementa la interfaz CVDebugHandler
	 * @var CVDebugHandler
	 */
	private $__DEBUG;
	/**
	 * Objeto CVDataManager
	 * @var CVDataManager
	 */
	private $__DATAMANAGER;
	/**
	 * Arreglo de clases para Webservices
	 * @var Array
	 */
	private $wsPackages;
	/**
	 * Arreglo de clases auxiliares de Webservices
	 * @var Array
	 */
	private $wsClasses;
	/**
	 * arreglo de objetos CVXMLElement cada uno especificando un webservice que puede ser invocado
	 * @var unknown_type
	 */
	private $wsClients;
	/**
	 * constructor de la clase
	 * @return CVApplication
	 */
	public function __construct()
	{
		$this->init();
	}
	/**
	 * inicializa una instancia de esta clase
	 * @return void
	 */
	private function init()
	{
		//carga el archivo app.xml
		$appxmlcontent=$this->loadResource("setup/app.xml");
		if ($appxmlcontent)
			$this->appConf=new CVXMLElement($appxmlcontent);
		else
			throw new CVException('no se pudo cargar los parametros de la configuraci&oacute;n');
		//inicializa el subsistema de seguridad si esta habilitado	
		/*if ($this->appConf->setup->security==true)														
		{
			//carga el archivo security.xml
			$secxmlcontent=$this->loadResource("setup/security.xml");
			if ($appxmlcontent)
				$this->secConf=new CVXMLElement($secxmlcontent);
			else
				throw new CVException('no se pudo cargar los parametros de la configuraci&oacute;n de seguridad');
		}*/
		//inicializa el subsistema de webservices si esta habilitado	
		if ($this->appConf->setup->webservices==true)														
		{
			$this->wsClasses=array();
			$this->wsPackages=array();
			if (isset ($this->appConf->webservices))
				if (isset ($this->appConf->webservices->providers))
				{
					if (isset ($this->appConf->webservices->providers->servicePackage))
						foreach ($this->appConf->webservices->providers->servicePackage as $key=>$package)
						{
							$translatedPath=APP_ROOT."/".str_replace(".","/",(string)$package);
							$this->wsPackages[]=$translatedPath;
							
						}
				if (isset ($this->appConf->webservices->providers->classPackage))
						foreach ($this->appConf->webservices->providers->classPackage as $key=>$package)
						{
							$translatedPath=APP_ROOT."/".str_replace(".","/",(string)$package);
							$this->wsClasses[]=$translatedPath;
						}
				$this->wsClients=array();
				if (isset ($this->appConf->webservices->clients))
						foreach ($this->appConf->webservices->clients->children() as $services)
							$this->wsClients[$services->getName()]=$services;							
				}
		}
		//inicializa el subsistema de datos si esta habilitado	
		if ($this->appConf->setup->data==true)														
		{	
			//carga el archivo data.xml
			$dataxmlcontent=$this->loadResource("setup/data.xml");
			if ($dataxmlcontent)
				$this->dataConf=new CVXMLElement($dataxmlcontent);
			else
				throw new CVException('no se pudo cargar los parametros de la configuraci&oacute;n de acceso a datos');
			$this->__DATAMANAGER=new CVDataManager($this->dataConf);
		}
		//inicializa los manejadores que esten activados
		if (isset($this->appConf->handlers->requestHandler))
		{
			$className=$this->appConf->handlers->requestHandler->className;			
			$params=false;
			if(isset($this->appConf->handlers->requestHandler->params))
				$params=$this->appConf->handlers->requestHandler->params;
			$this->__REQUEST=CVSingleton::getInstance("CVRequestHandler",$params,$className);				
		}
		/*if (isset($this->appConf->handlers->debugHandler))
		{
			$className=$this->appConf->handlers->debugHandler->className;
			$params=false;
			if(isset($this->appConf->handlers->debugHandler->params))
				$params=$this->appConf->handlers->debugHandler->params;
			if (!$params)
				$debugHandler=CVSingleton::getInstance("CVDebugHandler",false,$className);
			else
				$debugHandler=CVSingleton::getInstance("CVDebugHandler",$params,$className);			
		}*/
		if (isset($this->appConf->handlers->sessionHandler))
		{
			$className=$this->appConf->handlers->sessionHandler->className;			
			$params=false;
			if(isset($this->appConf->handlers->sessionHandler->params))
				$params=$this->appConf->handlers->sessionHandler->params;
			$this->__SESSION=CVSingleton::getInstance("CVSessionHandler",$params,$className);										
		}						
	}	
	/**
	 * inicia la ejecución de la aplicación
	 * @return void
	 */
	public function start()
	{	
		try{
				//punto de inicio de la ejecución de la aplicación
				$request=getRequest();
				$controller=$request->getController();
				$action=$request->getAction();
				$method=$request->getMethod();
				$className=$this->getControllerClass($controller,$action);
				if (!$className)
					throw new CVException("Error: No se puede mapear la clase Action para el controlador $controller, puede que el mismo no exista o este mal definido o que la accion que intenta ejecutar ($action) no este definida");
				else
				{
					$obj=new $className;
					if(!$method)
						$obj->doIt();
					else
					{
						try{
							$methodo = new ReflectionMethod($className, $method);
							if ($methodo->isPublic())
								$obj->$method();
							else
								throw new CVException("El m&eacute;todo $method no es p&uacute;blico o no esta definido para la clase $className");
						}
						catch (Exception $ex)
						{
							throw $ex;
						}
					} 
				}
		}		
		catch (Exception $ex)
		{
			throw $ex;
		}
	}
	/**
	 * retorna el objeto CVRequestHandler o false si no esta definido 
	 * @return CVRequestHandler
	 */
	public function getRequestHandler()
	{
		if (isset($this->__REQUEST))
			return $this->__REQUEST;
		else
			return false;
	}
	/**
	 * retorna el objeto CVSessionHandler o false si no esta definido 
	 * @return CVRequestHandler
	 */
	public function getSessionHandler()
	{
		if (isset($this->__SESSION))
			return $this->__SESSION;
		else
			return false;
	}
	/**
	 * retorna el objeto CVDataManager o false si no esta definido 
	 * @return CVDataManager
	 */
	public function getDataManager()
	{
		if (isset($this->__DATAMANAGER))
			return $this->__DATAMANAGER;
		else
			return false;
	}
	/**
	 * obtiene el nombre de la clase CVAction Asociada al controlador
	 * @param $controller
	 * @return CVActionHandler o false si no consigue la definición del controlador solicitado
	 */
	public function getControllerClass($controller,$action)
	{
		if (isset($this->appConf->controllers))
		{
			if (!$controller)
				$mainController=(string)$this->appConf->controllers->defaultController;
			else
				$mainController=$controller;
			if (isset($this->appConf->controllers->$mainController))
			{
				$mainController=$this->appConf->controllers->$mainController;
				if (!$action)
					$mainAction=(string)$mainController->defaultAction;
				else
					$mainAction=$action;
				if (isset($mainController->actions->$mainAction))
				{
					$className=(string)$mainController->actions->$mainAction;
					return $className;
				}	
			}
			else
				return false; //no existe el controlador solicitado
		}
		else
			return "AponwaoInfoAction";		 				
	}
	/**
	 * obtiene un array con los paquetes de clases a incluir en el arbol de clases de Webservices
	 * @return array
	 */
	public function getWSClasses()
	{
		if (isset($this->WSClasses))
		return $this->wsClasses;
	}
	/**
	 * obtiene un array con los paquetes de clases a incluir como clases de servicios de Webservices
	 * @return array
	 */
	public function getWSPackages()
	{
		if (isset($this->wsPackages))
		return $this->wsPackages;
	}
	/**
	 * obtiene los parametros de conexión de un alias de webservices
	 * @param $alias string
	 * @return CVXMLElement
	 */
	public function getWSAlias($alias=false)
	{
		if (!$alias)
			return false;
		else
			if (isset($this->wsClients[$alias]))
				return $this->wsClients[$alias];
			else
				return false;
	}
	/**
	 * Obtiene el titulo de la aplicación
	 * @return string
	 */
	public function getAppTitle()
	{
		return (string) $this->appConf->setup->title;
	}
	/**
	 * Obtiene el codename de la aplicación
	 * @return string
	 */
	public function getAppCodeName()
	{
		return (string) $this->appConf->setup->codeName;
	}
}
?>