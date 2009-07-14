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
  * Keeps track of the people in our contact list.
  *
  * Starts with a standard contact list and can add
  * new people to our list or change existing contacts.
  * This class is for example purposes only, just to
  * show how to create a webservice
  */
class contactManager{

	/**
	 * Gets the current contact list.
	 * @return contact[]
	 */
	public function	getContacts() {
		$contact = new contact();
		$contact->address = new Address();
		$contact->address->city ="sesamcity";
		$contact->address->street ="sesamstreet";
		$contact->email = "me@you.com";
		$contact->id = 1;
		$contact->name ="me";
		
		$ret[] = $contact;
		//debugObject("contacten: ",$ret);
		return $ret;
	}
	
	/**
	  * Gets the contact with the given id.
	  * @param int The id
	  * @return contact
	  */
	public function	getContact($id) {
		//get contact from db
		//might wanna throw an exception when it does not exists
		throw new Exception("Contact '$id' not found");
	}
	/**
	  * Generates an new, empty contact template
	  * @return contact
	  */
	public function newContact() {
		return new contact();
	}
	
	/**
	  * Saves a given contact
	  * @param contact
	  * @return void
	  */
	public function saveContact(contact $contact) {
		$contact->save();
	}

}
?>