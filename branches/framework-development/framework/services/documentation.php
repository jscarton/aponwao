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
//need to manually include for the function 'get_declared_classes()'
include_once("lib/soap/IPPhpdoc.class.php");
include_once("lib/soap/IPReflectionClass.class.php");
include_once("lib/soap/IPReflectionCommentParser.class.php");
include_once("lib/soap/IPReflectionMethod.class.php");
include_once("lib/soap/IPReflectionProperty.class.php");
include_once("lib/soap/IPXMLSchema.class.php");
include_once("lib/soap/WSDLStruct.class.php");
include_once("lib/soap/WSHelper.class.php");
include_once("lib/IPXSLTemplate.class.php");

$phpdoc=new IPPhpdoc();
if(isset($_GET['class'])) $phpdoc->setClass($_GET['class']);
echo $phpdoc->getDocumentation();
?>