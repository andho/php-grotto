<?php

namespace Andho\Grotto\Session;

class PHPSession
{

	private $_namespace;
	private $_user;

	public function __construct() {
		if (!isset($_SESSION)) {
			session_start();
		}

		$namespace = 'grotto-session';

		if (!isset($_SESSION[$namespace])) {
			$_SESSION[$namespace] = array();
		}

		if (isset($_SESSION[$namespace]['user'])) {
			$this->_user = $_SESSION[$namespace]['user'];
		}

		$this->_namespace = $namespace;
	}

	public function setUser(\Andho\Grotto\User $user) {
		$_SESSION[$this->_namespace]['user'] = $user;
		$this->_user = $user;
	}

	public function getUser() {
		return $this->_user;
	}

}
