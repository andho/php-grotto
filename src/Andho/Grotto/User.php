<?php

namespace Andho\Grotto;

class User {

	private $_username;
	private $_password;

	public function __construct($username, $password) {
		$this->_username = $username;
		$this->_password = $password;
	}

    public function checkPassword($password)
    {
        if ($this->_password !== $password) {
        	throw new PasswordDoesNotMatch();
        }

        return true;
    }
}

class PasswordDoesNotMatch extends Exception {}