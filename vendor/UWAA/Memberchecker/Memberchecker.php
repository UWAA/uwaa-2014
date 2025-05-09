<?php namespace UWAA\Memberchecker;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;
class Memberchecker {

    public $isLoggedIn;
    public $hasActiveMembership;
    public $memberCheckerRequest;
    public $memberCheckerCookie;
    public $memberCheckerCookieValues;
    public $memberCheckerResponse;
    public $membershipType;



    private $memberValues;

    function __construct() {

        $this->isLoggedIn = false;
        $this->hasActiveMembership = false;
        $this->getMembershipType = null;

    }

    public function addAJAXActions() {

    }

    private function setMemberCheckCookie($values, $domain=null) {
        $this->memberCheckerCookie = new Cookie(
            'UWAAMEM',  //name
            $values,  //Put the values from the MemberChecker into the cookie.
            0,  //Session cookie, die with browser close
            '/',  //path
            $domain,  //Cookie Domain
            false, //HTTPS
            false //HTTPOnly
            );
        return $this->memberCheckerCookie;
    }


    public function getSession() {



        $this->memberCheckerRequest = Request::createFromGlobals();


        $this->memberCheckerCookieValues = json_decode(stripslashes($this->memberCheckerRequest->cookies->get('UWAAMEM')));

        if ($this->memberCheckerRequest->cookies->has('UWAAMEM') == false) {
            $this->memberCheckerResponse = new Response();
            $this->memberCheckerResponse->headers->setCookie($this->setMemberCheckCookie(hash('sha512', 'UWAAMEM')));
            $this->memberCheckerResponse->sendHeaders();
        }


// PHP 8 - October 2024 update added null-safe operators ?-> line 66, 70, 74, 75
        if ($this->memberCheckerCookieValues?->loggedIn) {
            $this->isLoggedIn = true;
        }

        if(preg_match('(A|G)', $this->memberCheckerCookieValues?->memberStatus) === 1) {
            $this->hasActiveMembership = true;
        }

        if($this->getMembershipType($this->memberCheckerCookieValues?->membershipType) != "") {
            $this->membershipType = $this->getMembershipType($this->memberCheckerCookieValues?->membershipType);
        }
        
        


    }

     public function memberLogout() {
        $this->memberCheckerResponse = new JsonResponse();
        $this->memberCheckerResponse->headers->clearCookie('UWAAMEM');
        $this->memberCheckerResponse->send();
        exit;
    }



    public function callMemberChecker() {


        $this->memberCheckerResponse = new JsonResponse();

$memberID = filter_var($_GET["idNumber"], FILTER_SANITIZE_NUMBER_INT);
$lastName = urldecode(stripslashes(ucfirst(strtolower(filter_var(trim($_GET["lastName"], FILTER_SANITIZE_STRING))))));


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
        'message' =>'Please enter your last name',
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



$result = $memberDetails;  //returns success or failure
$callSuccess = $result->Success;
$callError = $result->ErrorMessage;
$member = $result->ReturnedMember;

if ($callSuccess === FALSE) {
    $payload = array (
        'error' => 'TRUE',
        'message' =>'Hmmm. There seems to be something wrong. Why don&rsquo;t you try again or call us and we’ll help you get it straightened out – 1-800-289-2586',
        'errorMessage' => 'Technical Information: '. $callError
    );
    echo json_encode($payload);
    exit;   //refine error handling further...TODO - Need feedback system on page.
}

if ($callSuccess && remove_accents(ucfirst(strtolower(trim($lastName)))) != ucfirst(remove_accents(strtolower(trim($member->MemberLName))))) {

    $payload = array (
        'error' => 'TRUE',
        'message' =>'We\'re sorry, that doesn\'t match what we have in our database. Why don&rsquo;t you try again or call us and we’ll help you get it straightened out – 1-800-289-2586',
        // 'message' => $result,
        'errorMessage' => 'Technical Information: ' . $callError

    );
    echo json_encode($payload);
    exit;   //refine error handling further...TODO - Need feedback system on page.
}

 else {

    // //Set some key information we want to persist why they browse.
    if(preg_match('(A|G)', $member->MemberStatus) === 1) {
        $this->memberDetails = array(
            "firstName" => "$member->MemberFName",
            "lastName" => "$member->MemberLName",
            "memberID" => "$member->MemberID",
            "memberStatus" => "$member->MemberStatus",
            "membershipExpiry" => "$member->MembershipExpiry",
            "membershipType" => "$member->MembershipType",
            "loggedIn" => (bool) true,
            "active" => (bool) true
            );
    } else {
        $this->memberDetails = array();
    }


    $this->memberCheckerResponse->headers->setCookie($this->setMemberCheckCookie(json_encode($this->memberDetails)));
    $this->memberCheckerResponse->headers->set('Content-Type', 'application/json');
    $this->memberCheckerResponse->headers->set('Access-Control-Allow-Origin', '*.washington.edu');
    $this->memberCheckerResponse->setData($callSuccess);
    $this->memberCheckerResponse->setCharset('UTF-8');
    $this->memberCheckerResponse->send();
    }

    exit;



    }

     public function renderDetails() {
        $details = $this->getCookieInformation();

        echo '<strong>Name:</strong> ' . $details['firstName'] . ' ' . $details['lastName'] . '</br>';
        echo '<strong>Member Number:</strong> ' . $details['memberID'].'</br>';
        echo '<strong>Membership Type:</strong> ' . $details['membershipType'] . '</br>';
        if ($details['membershipType'] == 'Annual Member') {
            echo '<strong>Expires:</strong> ' . $details['membershipExpiry'].'</br>';
        }

    }

    public function renderCard() {
        $details = $this->getCookieInformation();
        $cardClass = strtolower(str_replace('Member', '', $details['membershipType']));

        if ($details['membershipType'] == 'Annual Member') {
            $renewal = '<p class="renewal">Renew: ' . $details['membershipExpiry'].'</p>';
        } else {
            $renewal = NULL;
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

        $details = $this->getCookieInformation();

        $memberNumber = $details['memberID'];
//
        return $memberNumber;

    }

    public function renderThankYouText()
    {
        $details = $this->getCookieInformation();

        $name = $details['firstName'];

        $content = <<<CONTENT
        <div id="join-renew-buttons" class="">
        $name, thank you for being a member!
        </div>
CONTENT;

    echo $content;

    }

    public function returnMembershipType() {
        return $this->getMembershipType($member->getMembershipType);
    }






    private function getCookieInformation()
    {

        $this->memberCheckerRequest = Request::createFromGlobals();

        $this->memberCheckerCookieValues = json_decode(stripslashes($this->memberCheckerRequest->cookies->get('UWAAMEM')));

        $details = array(

        'firstName' => $this->memberCheckerCookieValues->firstName,
        'lastName' => $this->memberCheckerCookieValues->lastName,
        'memberID' => $this->memberCheckerCookieValues->memberID,
        'memberStatus' => $this->getMembershipStatus($this->memberCheckerCookieValues->memberStatus),
        'membershipExpiry' => date('F j, Y ' , strtotime($this->memberCheckerCookieValues->membershipExpiry)),
        'membershipType' => $this->getMembershipType($this->memberCheckerCookieValues->membershipType),

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
        if(preg_match('(A|G)', $membershipStatusCode) === 1) {
            return "Active";
        }

        return $membershipStatusCode;

        //@TODO, Figure out the rest of the status codes
    }

    //
    //  #TODO- Move these into a subclass or over with other view-rendering function






}