<? namespace UWAA\Memberchecker;

use Symfony\Component\HttpFoundation\Session\Session;

class Logout{

    function __construct() {
        $session = new Session();
        $session->setName('UWAAMEM');
        $session->clear();
        $session->invalidate();        
        exit;   
    }

}