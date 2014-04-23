<?php

require_once './AuthenticationAdmin/AuthenticationAdmin.php';


//Basic admin login
//$authAdmin = new AuthenticationAdmin("https://localhost:9444/services/", array());
//
//$loginResult = $authAdmin->loginWithRememberMeOption("admin","admin","localhost");
//
//var_dump($authAdmin->loginWithRememberMeCookie($loginResult->value));
//
//
//var_dump($authAdmin->getPriority());
//var_dump($authAdmin->isDisabled());
//var_dump($authAdmin->getAuthenticatorName());

//Basic admin login with sever ssl verification
//$context = stream_context_create(array(
//    'ssl' => array(
//        'verify_peer' => true,
//        'allow_self_signed' => false
//    )
//));
//$authAdmin = new AuthenticationAdmin("https://localhost:9444/services/", array('stream_context' => $context));
//$loginResult = $authAdmin->login("admin", "admin", "localhost");
//var_dump($loginResult);
?>
