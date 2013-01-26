<?php

namespace spec\Andho\Grotto;

use PHPSpec2\ObjectBehavior;

class User extends ObjectBehavior
{

	function let() {
		$this->beConstructedWith('andho', 'mysecret');
	}

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Andho\Grotto\User');
    }

    function it_checks_users_password() {
    	$this->checkPassword('mysecret')->shouldReturn(true);
    }

    function it_should_be_serializable() {
    	$serialized = serialize($this);

    	$this->shouldBeLike(unserialize($serialized));
    }
}
