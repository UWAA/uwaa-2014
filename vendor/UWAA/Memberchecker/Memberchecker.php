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
        add_action('wp_ajax_callMemberChecker', array($this, 'callMemberChecker'));
        add_action('wp_ajax_nopriv_callMemberChecker', array($this, 'callMemberChecker'));
        add_action('wp_ajax_memberLogout', array($this, 'memberLogout'));
        add_action('wp_ajax_nopriv_memberLogout', array($this, 'memberLogout'));
    }

    public function addAJAXActions() {
        
    }


    public function getSession() {
        $this->memberCheckSession = new NativeSessionStorage(array());
        $this->memberCheckSession->setOptions(array(
            'cookie_lifetime'=> 0,
            'cookie_httponly'=> 1,
            'use_strict_mode'=> 1,
            'use_only_cookies'=> 1,
            'cookie_secure'=> 1  //Need to swap once cert is ready.
            )
        );

        $this->session = new Session($this->memberCheckSession);
        
        if ($this->session->isStarted() != true) {
            $this->session->setName('UWAAMEM');
            $this->session->start();
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

    public function callMemberChecker() {
      

        

$memberID = filter_var($_POST["idNumber"], FILTER_SANITIZE_NUMBER_INT);
$lastName = ucfirst(strtolower(trim(filter_var($_POST["lastName"], FILTER_SANITIZE_STRING))));

if (empty($memberID)) {
    die ('Please enter a valid Member ID Number');
}

if (empty($lastName)) {
    die ('Please enter your last name');
}

if (!ctype_digit($memberID)) {
    die ('Please enter a valid Member ID Number');
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

$memberYesOrNo = $memberDetails->UWAAMemberCheckResult;  //returns success or failure
$member = $memberYesOrNo->ReturnedMember; 

if ($lastName != $member->MemberLName) {
    die ('Please check your information and try again');
} else {
    
    //Power up a new session for the user
    $this->session = new Session($this->memberCheckSession);
    //$this->session->setID('UWAAMEM');
    $this->session->setID(md5("{$member->MemberLName}{$_ENV['sessionSalt']}"));
    $this->session->setName('UWAAMEM');
    

    
    // //Set some key information we want to persist why they browse.
    if($member->MemberStatus == 'A') {
        $this->session->set('firstName', $member->MemberFName);
        $this->session->set('lastName', $member->MemberLName);
        $this->session->set('memberID', $member->MemberID);
        $this->session->set('memberStatus', $member->MemberStatus);
        $this->session->set('membershipExpiry', $member->MembershipExpiry);
        $this->session->set('membershipType', $member->MembershipType);
        $this->session->set('loggedIn', true);
        
    }
    }
    echo "Welcome $member->MemberFName $member->MemberLName </br>";
    echo "Your UWAA Member Number is $member->MemberID </br>";
    echo "Your Member Status is $member->MemberStatus </br>";
    echo "You are a baddass. </br>";
    var_dump($member);
    var_dump($this->session->get('firstName'));

    exit;
    }


 public function memberLogout() {
        $session = new Session();
        $session->setName('UWAAMEM');
        $session->clear();
        $session->invalidate();        
        exit;   
    }

    private function getSessionInformation()
    {
        $details = array(

        'firstName' => $this->session->get('firstName'),
        'lastName' => $this->session->get('lastName'),
        'memberID' => $this->session->get('memberID'),
        'memberStatus' => $this->getMembershipStatus($this->session->get('memberStatus')),
        'membershipExpiry' => $this->session->get('membershipExpiry'),  //TODO Convert date from timestamp.
        'membershipType' => $this->getMembershipType($this->session->get('membershipType'))
        );

        return $details;
    }

    private function getMembershipType($membershipTypeCode)
    {
        $annualCodes = array('AS', 'AJ');
        $lifeCodes = array('LS', 'LJ', 'LI');

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

        //@TODO, Figure out the rest of the status codes
    }

    public function renderDetails() {
        $details = $this->getSessionInformation();        

        
        echo 'Name:' . $details['firstName'] . ' ' . $details['lastName'] . '</br>'; 
        echo 'Member Number: ' . $details['memberID'].'</br>';
        echo 'Membership Type: ' . $details['membershipType'] . '</br>';
        echo 'Status: ' . $details['memberStatus'].'</br>';
        if ($details['membershipType'] == 'Annual Member') {
            echo 'Expires: ' . $details['membershipExpiry'].'</br>';
        }
        

    }
}