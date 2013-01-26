<?php

namespace spec\Andho\Grotto;

use PHPSpec2\ObjectBehavior;

class UserProvider extends ObjectBehavior
{

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Andho\Grotto\UserProvider');
    }

    function it_should_complain_if_user_retrieval_function_does_not_exist() {
    	$this->shouldThrow('Andho\Grotto\UserNotFoundException')->duringGetUser(array('andho'));
    }

    function it_should_provide_user() {
    	$this->setUserRetrievalFunction(function($user) {
    		return array(
    			'username' => 'andho',
    			'password' => 'mysecret'
    		);
    	});

    	$this->getUser('andho')->shouldHaveType('Andho\Grotto\User');
    }

    function it_should_complain_if_user_does_not_exist() {
    	$this->shouldThrow('Andho\Grotto\UserNotFoundException')->duringGetUser(array('nobody'));
    }
}
