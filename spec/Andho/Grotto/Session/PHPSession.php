<?php

namespace spec\Andho\Grotto\Session;

use PHPSpec2\ObjectBehavior;

class PHPSession extends ObjectBehavior
{

	function let($user) {
		$user->beAMockOf('Andho\Grotto\User');
	}

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Andho\Grotto\Session\PHPSession');
    }

    function it_can_store_user_in_php_session() {
    	$this->setUser($user);
    }
}
