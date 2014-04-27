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
    
    
    public function __construct($server_url, $options) {
        try {
            $this->authenticationAdmin = new AuthenticationAdmin($server_url, $options);
            $this->remoteUserStoreManager = new RemoteUserStoreManager($server_url, $options);
        }  catch (Exception $ex) {
            throw new Exception("Unable instantiate client", 0, $ex);
        }
    }
    
    public function login($username, $password, $remoteAddress){
        try {
            $this->authenticationAdmin->login($username, $password, $remoteAddress);
            $this->cookie_name = key($this->authenticationAdmin->getSoapClient()->_cookies);
            $this->cookie_value = $this->authenticationAdmin->getSoapClient()->_cookies[$this->cookie_name][0];

            $this->remoteUserStoreManager->getSoapClient()->__setCookie($this->cookie_name, $this->cookie_value);
        } catch (Exception $ex) {
            throw new Exception("Unable to login user", 0, $ex);
        }
    }
    
    public function addUser($userName, $password){
        try {
            $this->remoteUserStoreManager->addUser($userName, $password);
        } catch (Exception $ex) {
            throw new Exception("Unable to add new user", 0, $ex);
        }
    }
    
    public function addRole($roleName){
        try {
            $this->remoteUserStoreManager->addRole($roleName);
        } catch (Exception $ex) {
            throw new Exception("Unable to add role", 0, $ex);
        }
    }
}