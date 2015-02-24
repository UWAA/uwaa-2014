<?php namespace UWAA\Memberchecker;


use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
class Memberchecker {

    public $isLoggedIn;
    public $hasActiveMembership;
    public $memberCheckSession;
    public $session;
    
    function __construct() {

        $this->isLoggedIn = false;
        $this->hasActiveMembership = false;
        // add_action('wp_ajax_callMemberChecker', array($this, 'callMemberChecker'));
        // add_action('wp_ajax_nopriv_callMemberChecker', array($this, 'callMemberChecker'));
        // add_action('wp_ajax_memberLogout', array($this, 'memberLogout'));
        // add_action('wp_ajax_nopriv_memberLogout', array($this, 'memberLogout'));
    }

    public function addAJAXActions() {
        
    }


    public function getSession() {
        $this->memberCheckSession = new NativeSessionStorage(array());
        $this->memberCheckSession->setOptions(array(
            'cookie_lifetime'=> 0,
            'cookie_httponly'=> 1,
            'use_strict_mode'=> 0,
            'use_only_cookies'=> 1,
            'cookie_secure'=> 0,
            'cookie_domain'  => 'washington.edu'
            )
        );

        $this->session = new Session($this->memberCheckSession);
        
        if ($this->session->isStarted() != true) {
            $this->session->setName('UWAAMEM');
            // $this->session->start();

            if ($this->session->get('active') == false) {
                $this->session->start();
            }
        }
    // $this->session->invalidate();


        $activeSession = $this->session->isStarted();


        if ($this->session->get('loggedIn')) {
            $this->isLoggedIn = true;
        }
        
        if ($this->session->get('memberStatus') == 'A') {
            $this->hasActiveMembership = true;
        }

    }

     public function memberLogout() {
        $session = new Session();
        $session->setName('UWAAMEM');
        $session->clear();
        $session->invalidate();        
        exit;   
    }

    

    public function callMemberChecker() {        
      

        

$memberID = filter_var($_GET["idNumber"], FILTER_SANITIZE_NUMBER_INT);
$lastName = ucfirst(strtolower(trim(filter_var($_GET["lastName"], FILTER_SANITIZE_STRING))));

if (empty($memberID)) {
     $payload = array (
        'error' => 'TRUE',
        'message' =>'Please enter a valid Member ID Number'
    );
    echo json_encode($payload);
    exit;    
}

if (empty($lastName)) {
     $payload = array (
        'error' => 'TRUE',
        'message' =>'Please enter your last name'
    );
    echo json_encode($payload);
    exit;    
}

if (!ctype_digit($memberID)) {
     $payload = array (
        'error' => 'TRUE',
        'message' =>'Please enter a valid Member ID Number'
    );
    echo json_encode($payload);
    exit;
}

$urlToHash = "?vendorID={$_ENV['vendorID']}&memberID={$memberID}";
$signature = "{$_ENV['privateKey']}{$urlToHash}";  //No plus between variables

$hashedSigniture = hash('sha512', "$signature");
$urlToCall = "{$_ENV['memberCheckerEndpoint']}{$_ENV['vendorID']}&memberID={$memberID}&signature={$hashedSigniture}";


try{
$memberPayload = file_get_contents($urlToCall);
}
catch (exception $e)
{
    $returnValue["exception"] = $e;
    $returnValue["err"] = "Provider server error.";
    $returnValue["status"] = "error";
    $returnValue["errCode"] = "400";
    $returnValue["success"] = false;
    echo json_encode($returnValue); 

    exit;
}

$memberDetails = json_decode($memberPayload);



$result = $memberDetails->UWAAMemberCheckResult;  //returns success or failure
$callSuccess = $result->Success;
$callError = $result->ErrorMessage;
$member = $result->ReturnedMember; 

if ($lastName != ucfirst(strtolower($member->MemberLName))) {  //is this even needed if the call is already made?
    $payload = array (
        'error' => 'TRUE',
        'message' =>'Please check your information and try again'
    );
    echo json_encode($payload);
    exit;

} elseif ($callSuccess === FALSE) {
    $payload = array (
        'error' => 'TRUE',
        'message' =>'There is a problem with our Member Login service.  Please contact the UWAA For assistance'
    );
    echo json_encode($payload);
    exit;   //refine error handling further...TODO - Need feedback system on page.
}

 else {
    
    //Power up a new session for the user    
    $this->session = new Session($this->memberCheckSession);
    // $this->session->regenerate();
    $this->session->setID(hash("sha512", "{$member->MemberLName}{$_ENV['sessionSalt']}"));
    $this->session->setName('UWAAMEM');
    $this->session->save();
    

    
    // //Set some key information we want to persist why they browse.
    if($member->MemberStatus == 'A') {
        $this->session->set('firstName', $member->MemberFName);
        $this->session->set('lastName', $member->MemberLName);
        $this->session->set('memberID', $member->MemberID);
        $this->session->set('memberStatus', $member->MemberStatus);
        $this->session->set('membershipExpiry', $member->MembershipExpiry);
        $this->session->set('membershipType', $member->MembershipType);
        $this->session->set('loggedIn', true);
        $this->session->set('active', true);
    }

    echo json_encode($callSuccess);

    }     

    exit;
    }

     public function renderDetails() {
        $details = $this->getSessionInformation();        
        
        echo '<strong>Name:</strong> ' . $details['firstName'] . ' ' . $details['lastName'] . '</br>'; 
        echo '<strong>Member Number:</strong> ' . $details['memberID'].'</br>';
        echo '<strong>Membership Type:</strong> ' . $details['membershipType'] . '</br>';
        echo '<strong>Status:</strong> ' . $details['memberStatus'].'</br>';
        if ($details['membershipType'] == 'Annual Member') {
            echo '<strong>Expires:</strong> ' . $details['membershipExpiry'].'</br>';
        }

    }

    public function renderCard() {
        $details = $this->getSessionInformation();
        $cardClass = strtolower(str_replace('Member', '', $details['membershipType']));

        if ($details['membershipType'] == 'Annual Member') {
            $renewal = '<p class="renewal">Renew: ' . $details['membershipExpiry'].'</p>';
        }

        $name = " " . $details['firstName'] . " " . $details['lastName'] . " ";
        $number = $details['memberID'];

        $content = <<<CONTENT
        <div class="membership-card $cardClass">
            <p class="member-name">$name</p>
            <p class="member-number">$number</p>
            $renewal
        </div>

CONTENT;

    echo $content;
    }

    public function getMemberIDNumber() {
        
        $details = $this->getSessionInformation();

        $memberNumber = $details['memberID'];

        return $memberNumber;
        
    }






    private function getSessionInformation()
    {
        $details = array(

        'firstName' => $this->session->get('firstName'),
        'lastName' => $this->session->get('lastName'),
        'memberID' => $this->session->get('memberID'),
        'memberStatus' => $this->getMembershipStatus($this->session->get('memberStatus')),
        'membershipExpiry' => date('F j, Y ' , strtotime($this->session->get('membershipExpiry'))),
        'membershipType' => $this->getMembershipType($this->session->get('membershipType')),

        );

        return $details;
    }

    private function getMembershipType($membershipTypeCode)
    {
        $annualCodes = array('AS', 'AJ');
        $lifeCodes = array('LS', 'LJ', 'LI', 'IS', 'IJ');

        if (in_array($membershipTypeCode, $annualCodes)) {
            return 'Annual Member';
        }

        if (in_array($membershipTypeCode, $lifeCodes)) {
            return 'Life Member';
        }
        return 'UWAA Member';
    }

    private function getMembershipStatus($membershipStatusCode)
    {
        if ($membershipStatusCode == 'A') {
            return "Active";
        }

        return $membershipStatusCode;

        //@TODO, Figure out the rest of the status codes
    }

    //
    //  #TODO- Move these into a subclass or over with other view-rendering function

   

    

    
}