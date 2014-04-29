<?php

require_once './AuthenticationAdmin/AuthenticationAdmin.php';
require_once './RemoteUserStoreManager/RemoteUserStoreManager.php';

/**
 * ISClientFacade class
 * 
 */
class ClientFacade {

    /**
     * @var AuthenticationAdmin
     * @access private
     */
    private $authenticationAdmin;

    /**
     * @var RemoteUserStoreManager
     * @access private
     */
    private $remoteUserStoreManager;

    /**
     * @var string
     * @access private
     */
    private $cookie_name;

    /**
     * @var string
     * @access private
     */
    private $cookie_value;
    
    /**
     * @var string
     * @access private
     */
    private $server;
    
    /**
     * @var string
     * @access private
     */
    private $service_url;

    public function __construct($service_url, $admin_username, $admin_password, $server) {
        //for production system should enable the peer verification.
        $context = stream_context_create(array(
            'ssl' => array(
                'verify_peer' => false,
                'allow_self_signed' => true
        )));

        $parameters = array(
            'login' => $admin_username,
            'password' => $admin_password,
            'stream_context' => $context,
            'trace' => 1,
            'features' => SOAP_WAIT_ONE_WAY_CALLS
        );

        $this->server = $server;
        $this->service_url = $service_url;
        
        try {
            $this->authenticationAdmin = new AuthenticationAdmin($service_url, $parameters);
            $this->remoteUserStoreManager = new RemoteUserStoreManager($service_url, $parameters);
        } catch (Exception $ex) {
            throw new Exception("Unable instantiate client", 0, $ex);
        }
    }

    public function login($username, $password, $remoteAddress) {
        try {
            $this->authenticationAdmin->login($username, $password, $remoteAddress);
        } catch (Exception $ex) {
            throw new Exception("Unable to login user", 0, $ex);
        }
    }

    public function addUser($userName, $password) {
        try {
            $this->remoteUserStoreManager->addUser($userName, $password);
        } catch (Exception $ex) {
            throw new Exception("Unable to add new user", 0, $ex);
        }
    }

    public function addRole($roleName) {
        try {
            $this->remoteUserStoreManager->addRole($roleName);
        } catch (Exception $ex) {
            throw new Exception("Unable to add role", 0, $ex);
        }
    }

}
