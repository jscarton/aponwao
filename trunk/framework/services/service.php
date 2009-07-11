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
require_once "common.php";
if (AUTHENTICATE && !(isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] == WEBSERVICEUSER && $_SERVER['PHP_AUTH_PW'] ==WEBSERVICEPASSWORD)) {
 	header("WWW-Authenticate: Basic realm=\"Servicios Web\"");
	header("HTTP/1.0 401 Unauthorized");
	die("No access!");
}

if($_GET['class'] && (in_array($_GET['class'], $WSClasses) || in_array($_GET['class'], $WSStructures))) {
	$WSHelper = new WSHelper("http://schema.example.com", $_GET['class']);
	$WSHelper->actor = "http://schema.example.com";
	$WSHelper->use = SOAP_ENCODED;
	$WSHelper->classNameArr = $WSClasses;
	$WSHelper->structureMap = $WSStructures;
	$WSHelper->setPersistence(SOAP_PERSISTENCE_REQUEST);
	$WSHelper->setWSDLCacheFolder('../cache/'); //trailing slash mandatory. Default is 'wsdl/'
	try {
		$WSHelper->handle();
		//possible db transaction commit
	}catch(Exception $e) {
		//possible db transaction rollback
		$WSHelper->fault("SERVER", $e->getMessage(),"", $e->__toString());
	}
} else {
	die("No valid class selected");
}
?>
