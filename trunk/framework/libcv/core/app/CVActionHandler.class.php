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
 * @package CORE.APP
 */
abstract class CVActionHandler extends CVObject
{
	private $view;
	private $rendered;
	public $request;
	public $session;
	public $datamanager;
	private $context=array();
	private $useLayout=false;
	/**
	 * constructor por defecto modifique segun sea necesario
	 * @return CVActionHandler
	 */
	public function __construct()
	{			
		$this->view = new CVView('my_template_file.html');
		$this->request=getRequest();
		$this->session=getSession();
		$this->datamanager=getDataManager();
	}
	/**
	 * Este metodo es el punto de inicio de la acción.
	 */
	abstract public function doIt();
	/**
	 * esta accion crea y actualiza el repositorio de datos del motor de plantillas
	 */
	public function set($name,$value)
	{
		if ($this->view instanceof CVView)
		{
			$this->view->$name=$value;
			$this->context[$name]=$value;
		}
		else
			throw new CVException ("Error ATPL:motor de plantillas no inicializado");
	}
	/**
	 * esta accion renderiza la salida o vista asociada a una acción
	 * @param view
	 */
	public function show($view=false)
	{
		if ($this->view instanceof CVView)
		{
			
			if ($view)
			{
				if (file_exists(APP_ROOT."/resources/atpl/$view.html"))
					$this->view->setTemplate("$view.html");
				else
					throw new CVException ("Error ATPL:no existe el archivo ".APP_ROOT."/resources/atpl/$view.html");
			}
			else
			{
				$controller=$this->request->getController();
				if (!$controller)
					$controller="main";
				$action=$this->request->getAction();
				$method=$this->request->getMethod();
				if (!$action)
					$action="index";
				if (!$method || $method=="doIt")
					$file=APP_ROOT."/resources/atpl/$controller/$action.html";
				else
					$file=APP_ROOT."/resources/atpl/$controller/$action-$method.html";
				if (file_exists($file))
					$this->view->setTemplate($file);
				else
					throw new CVException ("Error ATPL:no existe el archivo ".$file);				
			}
			try{					
					$constants=get_defined_constants(true);
					foreach($constants['user'] as $key=>$value)
						$this->view->$key=$value;
					$this->rendered=$this->view->execute();		
					//echo $this->rendered;							
				}
				catch (Exception $ex)
				{
					throw new CVException("Excepcion:".$ex->getMessage()." en linea".$ex->getLine()." en ".$ex->getFile());
				}
		}
		else
			throw new CVException ("Error ATPL:motor de plantillas no inicializado");
	}
	/**
	 * esta accion renderiza la salida del resultado de la ejecucion de esta accion junto con el layout principal
	 * @param $direct si es verdadero se salta el imprimir el layout principal
	 * @return unknown_type
	 */
	public function render($direct=false)
	{
            
		$mlayout=($this->useLayout)?$this->useLayout : "main.html";                
		if (file_exists(APP_ROOT."/resources/atpl/$mlayout") && !$direct)
		{                        
			$output=null;
			$output=new CVView($mlayout);
			$output->setTemplate($mlayout);
			foreach ($this->context as $key=>$value)
				$output->$key=$value;	
			$output->main_content=$this->getRenderedContent();	
			echo $output->execute();
		}
		else
		{
			echo $this->getRenderedContent(true);

		}
	}	
	/**
	 * obtiene el contenido renderizado resultado de la ejecucion de una accion
         * @param clear si es verdadero limpia el buffer de contenido generado
	 * @return string
	 */
	public function getRenderedContent($clear=false)
	{
                if(!$clear)
                    return $this->rendered;
                else
                {
                    $ret=$this->rendered;
                    $this->rendered=false;
                    return $ret;
                }
	}
	/**
	 * crea una redireccion 301 para la peticion actual 
	 * @param $dest cadena de caracteres con el formato controlador/accion/metodo
	 * @return void
	 */
	public function redirects($dest)
	{
		header("location: http://".APP_BASE_URL."/$dest",false,301);
	}	
	/**
	 * obliga a usar un layout diferente a main.html
	 */
	public function setLayout($layout)
	{
		$this->useLayout=$layout;
	}
}
?>
