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
class tagRegistration {
	public $namespace;
	public $tagName;
	public $function;
	public function __construct($namespace, $tagName, $function) {
		$this->namespace 	= $namespace;
		$this->tagName 		= $tagName;
		$this->function 	= $function;		
	}
	
	public function process($node) {
		$x = $node;
		eval($this->function);
	}
}


class IPXSLTemplate {
	//const NAMESPACE 	= "http://schema.jool.nl/xmltemplate/";
	public $dom 		= null;
	public $xsltproc 	= null;
	public $customTags 	= Array();
	
    public function __construct($file) {
    	$this->dom = new DOMDocument();
    	$this->dom->load($file);
   		$this->xsltproc = new XsltProcessor();
   		$this->xsltproc->registerPHPFunctions();
    }
    
    public function execute($model) {
		//process custom tags
		foreach($this->customTags as $reg) {
			$nodelist = $this->dom->getElementsByTagNameNS($reg->namespace, $reg->tagName);
			for($i = $nodelist->length; $i > 0; $i--){
				$reg->process($nodelist->item($i-1));
			}
		}

   		$this->xsltproc->importStyleSheet($this->dom);

		$modelDom = new DomDocument();   
		$modelDom->appendChild($modelDom->createElement("model")); 	//root node
		IPXSLTemplate::makeXML($model, $modelDom->documentElement);
		//echo $modelDom->saveXML();
 		return $this->xsltproc->transformToXml($modelDom);    	
    }
    
    /** Add a new custom tag registration */
    public function registerTag($namespace, $tagName, $function) {
    	$this->customTags[] = new tagRegistration($namespace, $tagName, $function);
    }
    
    /** Makes a XML node from an object/ array / text */
    static function makeXML($model, $parent, $addToParent = false) {
		if(is_array($model)){
			foreach($model as $name => $value){
				if(!is_numeric($name)) {
					$node = $parent->ownerDocument->createElement($name);
	    			$parent->appendChild($node);
					IPXSLTemplate::makeXml($value, $node, true);	
				} else {
					$node = $parent;
					IPXSLTemplate::makeXml($value, $node);	
				}
			}
		} elseif (is_object($model)) {
			if($addToParent)
				$node = $parent;
			else{
				$node = $parent->ownerDocument->createElement(get_class($model));
				$parent->appendChild($node);
			}
			foreach($model as $propertyName => $propertyValue){
				$property = $parent->ownerDocument->createElement($propertyName);
	    		$node->appendChild($property);
   				IPXSLTemplate::makeXml($propertyValue, $property);	
			}
		} else {
			$parent->appendChild($parent->ownerDocument->createTextNode($model));	
		}
    }
}
?>