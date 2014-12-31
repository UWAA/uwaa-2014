<?php namespace UWAA\Memberchecker;


use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
class Memberchecker {

    public $isLoggedIn;
    public $hasActiveMembership;
    
    function __construct() {

        $this->isLoggedIn = false;
        $this->hasActiveMembership = false;
    
    }

    public function getSession() {
        $memberCheckSession = new NativeSessionStorage(array());
        $memberCheckSession->setOptions(array(
            'cookie_lifetime'=> 0,
            'cookie_httponly'=> 1,
            'use_strict_mode'=> 1,
            'use_only_cookies'=> 1,
            'cookie_secure'=> 1  //Need to swap once cert is ready.
            )
        );

        $session = new Session($memberCheckSession);
        
        if ($session->isStarted() != true) {
            $session->setName('UWAAMEM');
            $session->start();
        }
    // $session->invalidate();


        $activeSession = $session->isStarted();


        if ($session->get('loggedIn')) {
            $this->isLoggedIn = true;
        }
        
        if ($session->get('memberStatus') == 'A') {
            $this->hasActiveMembership = true;
        }

    }
}