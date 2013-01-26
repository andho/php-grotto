<?php

namespace Andho\Grotto;

class UserProvider
{

	private $_storage;

	public function __construct() {
		$this->_storage = new \stdClass();
	}

	public function setUserRetrievalFunction(callable $callable) {
		$this->_storage->getUser = $callable;
	}

    public function getUser($user)
    {
        $user = $this->_getUserFromStorage($user);

        if (is_null($user)) {
        	throw new UserNotFoundException("User could not be retrieved");
        }

        $user = new User($user['username'], $user['password']);

        return $user;
    }

    private function _getUserFromStorage($user) {
		if (!isset($this->_storage->getUser)) {
			throw new UserNotFoundException('User retrieval function is not provided');
		}

		$userRetrieval = $this->_storage->getUser;
		if (!is_callable($userRetrieval)) {
			throw new UserNotFoundException('User retrieval function is not provided');
		}

    	return $userRetrieval($user);
    }
}

class UserNotFoundException extends Exception {}
