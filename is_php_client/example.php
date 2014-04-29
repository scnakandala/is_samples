<?php

require_once './ClientFacade.php';

$admin_username = "admin";
$admin_password = "admin";
$server = "localhost";
$service_url = "https://localhost:9444/services/";


$isClientFacade;

try {
    $isClientFacade = new ClientFacade(
            $service_url, $admin_username, $admin_password, $server
    );
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
