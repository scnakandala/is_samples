<?php

require_once './ClientFacade.php';

//for production system should enable the peer verification.
$context = stream_context_create(array(
    'ssl' => array(
        'verify_peer' => false,
        'allow_self_signed' => true
    )
));

$parameters = array(
    'stream_context' => $context,
    'trace'=>true
);

$isClientFacade;
$service_url = "https://localhost:9444/services/";
$admin_username = "admin";
$admin_password = "admin";
$remoter_server = "127.0.0.1";


try {
    $isClientFacade = new ClientFacade($service_url, $parameters);
    print 'Successfully create the Identity Server Client' . PHP_EOL;
} catch (Exception $ex) {
    print $ex->getMessage() . PHP_EOL;
    exit;
}

try {
    $loginResult = $isClientFacade->login($admin_username, $admin_password, $remoter_server);
    print 'Successfully logged to the system using admin credentials' . PHP_EOL;
} catch (Exception $ex) {
    print $ex->getMessage() . PHP_EOL;
    exit;
}

try {
    $isClientFacade->addUser("supun", "supun");
    print 'Successfully added new user' . PHP_EOL;
} catch (Exception $ex) {
    print $ex->getMessage() . PHP_EOL;
    exit;
}

try {
    $isClientFacade->addRole("engineering");
    print 'Successfully added new role' . PHP_EOL;
} catch (Exception $ex) {
    print $ex->getMessage() . PHP_EOL;
    exit;
}
?>
