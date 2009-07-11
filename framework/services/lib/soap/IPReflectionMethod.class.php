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
 * An extended reflection/documentation class for class methods
 *
 * This class extends the reflectioMethod class by also parsing the
 * comment for javadoc compatible @tags and by providing help
 * functions to generate a WSDL file. The class might also
 * be used to generate a phpdoc on the fly
 *
 * @version 0.1
 * @author David Kingma
 * @extends reflectionMethod
 */

class IPReflectionMethod extends reflectionMethod{
	/** @var string class name */
	public $classname;

	/** @var string The return type for this method	 */
	public $return = "";

	/** @var IPReflectionParameter[] Associative array with reflectionParameter objects */
	public $parameters = array();

	/** @var string */
	public $fullDescription = "";

	/** @var string */
	public $smallDescription = "";
	
	/** @var string */
	public $throws="";

	/**
	 * Constructor which calls the parent constructor and makes sure the comment
	 * of the method is parsed
	 *
	 * @param string The class name
	 * @param string The method name
	 */
	public function __construct($class,$method){
		$this->classname = $class;
		parent::__construct($class,$method);
		$this->parseComment();
	}
	
	/**
	 * Returns the full function name, including arguments
	 * @return string
	 */
	public function getFullName(){
		$args = $this->getParameters();
		$argstr = "";

		foreach((array)$args as $arg){
			if($argstr!="")$argstr.=", ";
			$argstr.= $arg->type ." $".$arg->name;
		}
		return $this->return." ".$this->name."(".$argstr.")";
	}
	
	/**
	 * Returns an array with parameter objects, containing type info etc.
	 *
	 * @return ReflectionParameter[] Associative array with parameter objects
	 */
	public function getParameters(){
		$this->parameters = Array();
		$ar = parent::getParameters();
		$i = 0;

		foreach((array)$ar as $parameter){
			$parameter->type = $this->params[$i++]->type;
			$this->parameters[$parameter->name] = $parameter;
		}
		
		return $this->parameters;
	}

	/**
	 * 	
	 * @param $annotationName String the annotation name
	 * @param $annotationClass String the annotation class
	 * @return void
	 */
	public function getAnnotation($annotationName, $annotationClass = null){
		return IPPhpDoc::getAnnotation($this->comment, $annotationName, $annotationClass);
	}
	
	/**
	 * Parses the comment and adds found properties to this class
	 * @return void
	 */
	private function parseComment(){
		$this->comment = $this->getDocComment();
		new IPReflectionCommentParser($this->comment, $this);
	}
}
?>