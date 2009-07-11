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
$wsdl = "http://".$_SERVER['HTTP_HOST']."/wshelper/service.php?class=contactManager&wsdl";
echo "<strong>WSDL file:</strong> ".$wsdl."<br>\n";

$options = Array('actor' =>'http://schema.jool.nl',
				 'trace' => true);
$client = new SoapClient($wsdl,$options);
echo "<hr> <strong>Result from getContacts call:</strong><br>";

$res = $client->getContacts();
print_r($res);
echo "<hr><strong>Raw Soap response:</strong><br>";
echo htmlentities($client->__getLastResponse());
echo "<hr><strong>SoapFault asking for an unknown contact:</strong><br>";
$client->getContact(1);
?>