<?
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
chdir("..");
include "common.php";

class DefaultController {
	const TYPE_PLAIN = 1;
	const TYPE_HTML = 2;
	public $type;
	public $length;
}
/**
 * @ann1('me'=>'you');
 */
class something{
	/**
	 * @var string
	 * @Controller(type => DefaultController::TYPE_PLAIN, length => 100)
	 */
	public $propertyA;
	
	/**
	 * @var string
	 * @Controller(type => DefaultController::TYPE_HTML, length => 100)
	 */
	public function methodB () {
		return "aap";
	}
}

/* Annotation example */
$rel = new IPReflectionClass("something");
$properties = $rel->getProperties();
$methods = $rel->getMethods();

var_dump($rel->getAnnotation("ann1", "stdClass"));

$property = $properties["propertyA"];
$ann = $property->getAnnotation("Controller", "DefaultController");
var_dump($ann);

$method = $methods["methodB"];
$ann = $method->getAnnotation("Controller", "DefaultController");
var_dump($ann);
?>