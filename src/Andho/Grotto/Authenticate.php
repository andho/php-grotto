<?php

namespace Andho\Grotto;

class Authenticate
{

	private $_userProvider;
	private $_user;
	private $_session;

	public function __construct(UserProvider $userProvider, SessionInterface $session) {
		$this->_userProvider = $userProvider;

		$this->_user = $session->getUser();
		$this->_session = $session;
	}

    public function authenticate($user, $pass)
    {
        $user = $this->_userProvider->getUser($user);

        if (!$user->checkPassword($pass)) {
        	throw new Exception("Password does not match");
        }

        $this->_user = $user;

        return true;
    }

    public function getUser()
    {
    	var_dump($this->_user);
    	if (is_null($this->_user)) {
    		throw new NotAuthenticatedException();
    	}

        return $this->_user;
    }
}

class NotAuthenticatedException extends Exception {}