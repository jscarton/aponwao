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
  * The contact details for a person
  *
  * Stores the person's name, address and e-mail
  * This class is for example purposes only, just to
  * show how to create a webservice
  *
  */
class contact{
	/** @var int */
	public $id;
	
	/** @var string */
	public $name;

	/** @var address */
	public $address;

	/** @var string */
	public $email;
	
	/**
	  * saves a contact
	  *
	  * @return void
	  */
	public function save() {
		//save contact 2 db
	}
}
?>