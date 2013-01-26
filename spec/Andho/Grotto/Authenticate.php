<?php

namespace spec\Andho\Grotto;

use PHPSpec2\ObjectBehavior;

class Authenticate extends ObjectBehavior
{

	function let($userProvider, $user, $session)
	{
		$user->beAMockOf('Andho\Grotto\User');

		$userProvider->beAMockOf('Andho\Grotto\UserProvider');
    	$userProvider->getUser('andho')->willReturn($user);

    	$session->beAMockOf('Andho\Grotto\SessionInterface');
    	$session->getUser()->willReturn(null);

		$this->beConstructedWith($userProvider, $session);
	}

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Andho\Grotto\Authenticate');
    }

    function it_authenticates_user($userProvider, $user)
    {

    	$this->authenticate('andho', 'mysecret')->shouldReturn(true);
    }

    function it_should_complain_if_user_does_not_exist($userProvider)
    {
    	$userProvider->getUser('nobody')->willThrow('Andho\Grotto\UserNotFoundException');

    	$this->shouldThrow('Andho\Grotto\UserNotFoundException')->duringAuthenticate('nobody', 'fakepass');
    }

    function it_should_complain_if_password_does_not_match($userProvider, $user)
    {
    	$user->checkPassword('invalidpass')->willThrow('Andho\Grotto\PasswordDoesNotMatch');

    	$this->shouldThrow('Andho\Grotto\PasswordDoesNotMatch')->duringAuthenticate('andho', 'invalidpass');
    }

    function it_should_provide_the_authenticated_user($userProvider, $user)
    {
    	$this->authenticate('andho', 'mysecret');

    	$this->getUser()->shouldReturn($user);
    }

    function it_retrieves_user_from_session_if_exists($session, $userProvider, $user)
    {
    	$session->getUser()->willReturn($user);
    	$this->beConstructedWith($userProvider, $session);

    	$this->getUser()->shouldReturn($user);
    }

    function it_complains_when_trying_to_get_user_without_authenticating() {
    	$this->shouldThrow('Andho\Grotto\NotAuthenticatedException')->duringGetUser();
    }
}
