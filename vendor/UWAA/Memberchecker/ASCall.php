<?php

namespace UWAA\MemberChecker;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;

class ASCall {

function __construct() {

    $memberCheckSession = new NativeSessionStorage(array());
    $memberCheckSession->setOptions(array(
        'cookie_lifetime'=> 0,
        'cookie_httponly'=> 1,
        'use_strict_mode'=> 1,
        'cookie_secure'=> 1  //Need to swap once cert is ready.

        )
    );

}

private function callMemberChecker() {

    $memberID = filter_var($_GET["idNumber"], FILTER_SANITIZE_NUMBER_INT);
$lastName = ucfirst(strtolower(trim(filter_var($_GET["lastName"], FILTER_SANITIZE_STRING))));

if (!ctype_digit($memberID)) {
    die ('Please enter a valid Member ID Number');
}

$urlToHash = "?vendorID={$vendorID}&memberID={$memberID}";
$signature = "{$privateKey}{$urlToHash}";  //No plus between variables

$hashedSigniture = hash('sha512', "$signature");
$urlToCall = "{$ENV_['MemberCheckerEndpoint']}{$vendorID}&memberID={$memberID}&signature={$hashedSigniture}";


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
    $session = new Session($memberCheckSession);
    //$session->setID('UWAAMEM');
    $session->setID(md5("{$member->MemberLName}{$sessionSalt}"));
    $session->setName('UWAAMEM');
    

    
    // //Set some key information we want to persist why they browse.
    if($member->MemberStatus == 'A') {
        $session->set('firstName', $member->MemberFName);
        $session->set('lastName', $member->MemberLName);
        $session->set('memberID', $member->MemberID);
        $session->set('memberStatus', $member->MemberStatus);
        $session->set('loggedIn', true);
        
    }
}

    echo "Welcome $member->MemberFName $member->MemberLName </br>";
    echo "Your UWAA Member Number is $member->MemberID </br>";
    echo "Your Member Status is $member->MemberStatus </br>";
    echo "You are a baddass. </br>";
    var_dump($member);
    var_dump($session->get('firstName'));
}

}