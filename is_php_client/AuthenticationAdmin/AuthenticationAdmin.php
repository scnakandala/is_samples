<?php

require_once './AuthenticationAdmin/AuthenticationAdminStub.php';

/**
 * @todo 
 * Implement authenticateWithRememberMe(authenticateWithRememberMe $parameters)
 * function.
 * 
 */

/**
 * AuthenticationAdmin class
 *
 */
class AuthenticationAdmin {

    /**
     * @var AuthenticationAdmin\AuthenticationAdminStub $serviceStub
     * @access private
     */
    private $serviceStub;

    public function __construct($server_url, $options) {
        $this->serviceStub = new AuthenticationAdminStub(
                $server_url . "AuthenticationAdmin?wsdl", $options
        );
    }

    /**
     * Function to logout the admin user
     */
    public function logout() {
        $parameters = new Logout();
        $this->serviceStub->logout($parameters);
    }

    /**
     * Function to login with the remember me cookie option
     * 
     * @param string $cookie
     * @return LoginWithRememberMeCookieResponse
     */
    public function loginWithRememberMeCookie($cookie) {
        $parameters = new LoginWithRememberMeCookie();
        $parameters->cookie = $cookie;

        return $this->serviceStub->loginWithRememberMeCookie($parameters);
    }

    /**
     * Function to get the authenticator name
     * 
     * @return string
     */
    public function getAuthenticatorName() {
        $parameters = new GetAuthenticatorName();
        return $this->serviceStub->getAuthenticatorName($parameters)->return;
    }

    /**
     * Function to login the admin user
     * 
     * @param string $username
     * @param string $password
     * @param string $remoteAddress
     * @return boolean
     */
    public function login($username, $password, $remoteAddress) {
        $parameters = new Login;
        $parameters->username = $username;
        $parameters->password = $password;
        $parameters->remoteAddress = $remoteAddress;

        return $this->serviceStub->login($parameters)->return;
    }

    /**
     * Function to login the admin with remember me option
     * 
     * @param string $username
     * @param string $password
     * @param string $remoteAddress
     * @return RememberMeData
     */
    public function loginWithRememberMeOption($username, $password, $remoteAddress) {
        $parameters = new LoginWithRememberMeOption();
        $parameters->username = $username;
        $parameters->password = $password;
        $parameters->remoteAddress = $remoteAddress;
        return $this->serviceStub->loginWithRememberMeOption($parameters)->return;
    }

    /**
     * Function to check the service is disabled
     * 
     * @return boolean
     */
    public function isDisabled() {
        $parameters = new IsDisabled();
        return $this->serviceStub->isDisabled($parameters)->return;
    }

    /**
     * Function to get the priority
     * 
     * @return boolean
     */
    public function getPriority() {
        $parameters = new GetPriority();
        return $this->serviceStub->getPriority($parameters)->return;
    }

}