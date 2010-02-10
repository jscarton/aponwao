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
 * An extended reflection/documentation class for class properties
 *
 * This class extends the reflectionProperty class by also parsing the
 * comment for javadoc compatible @tags and by providing help
 * functions to generate a WSDL file. The class might also
 * be used to generate a phpdoc on the fly
 *
 * @version 0.2
 * @author David Kingma
 * @extends reflectionProperty
 */
class IPReflectionProperty extends reflectionProperty {
	/** @var string Classname to whom this property belongs */
	public $classname;

	/** @var string Type description of the property */
	public $type = "";

	/** @var boolean Determens if the property is a private property */
	public $isPrivate = false;

	/** @var string */
	public $description;

	/** @var boolean */
	public $optional = false;
	
	/** @var boolean */
	public $autoincrement = false;

	/** @var string */
	public $fullDescription = "";

	/** @var string */
	public $smallDescription = "";
	
	/** @var string */
	public $name = null;

	/** @var string */
	private $comment = null;
	
	/**
	 * constructor. will initiate the commentParser
	 *
	 * @param string Class name
	 * @param string Property name
	 * @return void
	 */
	public function __construct($class, $property){
		$this->classname = $class;
		parent::__construct($class, $property);
		$this->parseComment();
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
	
	private function parseComment(){
		// No getDocComment available for properties in php 5.0.3 :(
		$this->comment = $this->getDocComment();
		new IPReflectionCommentParser($this->comment, $this);
	}
}
?>