<?php

class Logout {
    
}

class LoginWithRememberMeCookie {

    /**
     * @var string $cookie
     * @access public
     */
    public $cookie;

}

class LoginWithRememberMeCookieResponse {

    /**
     * @var boolean $return
     * @access public
     */
    public $return;

}

class GetAuthenticatorName {
    
}

class GetAuthenticatorNameResponse {

    /**
     * @var string $return
     * @access public
     */
    public $return;

}

class Login {

    /**
     * @var string $username
     * @access public
     */
    public $username;

    /**
     * @var string $password
     * @access public
     */
    public $password;

    /**
     * @var string $remoteAddress
     * @access public
     */
    public $remoteAddress;

}

class LoginResponse {

    /**
     * @var boolean $return
     * @access public
     */
    public $return;

}


class LoginWithRememberMeOption {

    /**
     * @var string username
     * @access public
     */
    public $username;

    /**
     * @var string $password
     * @access public
     */
    public $password;

    /**
     * @var string $remoteAddress
     * @access public
     */
    public $remoteAddress;

}

class LoginWithRememberMeOptionResponse {

    /**
     * @var RememberMeData $return
     * @access public
     */
    public $return;

}

class RememberMeData {

    /**
     * @var boolean $authenticated
     * @access public
     */
    public $authenticated;

    /**
     * @var int $maxAge
     * @access public
     */
    public $maxAge;

    /**
     * @var string $value
     * @access public
     */
    public $value;

}

class IsDisabled {
    
}

class IsDisabledResponse {

    /**
     * @var boolean $retuen
     * @access public
     */
    public $return;

}

class GetPriority {
    
}

class GetPriorityResponse {

    /**
     * @var int $return
     * @access public
     */
    public $return;

}

/**
 * AuthenticationAdminStub class
 * 
 */
class AuthenticationAdminStub extends SoapClient {

    private static $classmap = array(
        'loginWithRememberMeCookie' => 'LoginWithRememberMeCookie',
        'loginWithRememberMeCookieResponse' => 'LoginWithRememberMeCookieResponse',
        'getAuthenticatorName' => 'GetAuthenticatorName',
        'getAuthenticatorNameResponse' => 'GetAuthenticatorNameResponse',
        'login' => 'Login',
        'loginResponse' => 'LoginResponse',
        'loginWithRememberMeOption' => 'LoginWithRememberMeOption',
        'loginWithRememberMeOptionResponse' => 'LoginWithRememberMeOptionResponse',
        'RememberMeData' => 'RememberMeData',
        'logout' => 'Logout',
        'isDisabled' => 'IsDisabled',
        'isDisabledResponse' => 'IsDisabledResponse',
        'getPriority' => 'GetPriority',
        'getPriorityResponse' => 'GetPriorityResponse',
    );

    public function AuthenticationAdminStub($wsdl, $options = array()) {
        foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * Funtion to logout the admin user
     *
     * @param Logout $parameters
     * @return void
     */
    public function logout(Logout $parameters) {
        return $this->__soapCall('logout', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

    /**
     * Function to login with remembering the cookie
     *
     * @param LoginWithRememberMeCookie $parameters
     * @return LoginWithRememberMeCookieResponse
     */
    public function loginWithRememberMeCookie(LoginWithRememberMeCookie $parameters) {
        return $this->__soapCall('loginWithRememberMeCookie', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

    
    /**
     * Function to get authenticator name
     *
     * @param GetAuthenticatorName $parameters
     * @return GetAuthenticatorNameResponse
     */
    public function getAuthenticatorName(GetAuthenticatorName $parameters) {
        return $this->__soapCall('getAuthenticatorName', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

    /**
     * Function to login the admin user
     *
     * @param Login $parameters
     * @return LoginResponse
     */
    public function login(Login $parameters) {
        return $this->__soapCall('login', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

    /**
     * Function to login with remember me option
     *
     * @param LoginWithRememberMeOption $parameters
     * @return LoginWithRememberMeOptionResponse
     */
    public function loginWithRememberMeOption(LoginWithRememberMeOption $parameters) {
        return $this->__soapCall('loginWithRememberMeOption', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

    /**
     * Function to test the service is disabled
     *
     * @param IsDisabled $parameters
     * @return IsDisabledResponse
     */
    public function isDisabled(IsDisabled $parameters) {
        return $this->__soapCall('isDisabled', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

    /**
     * Function to get the priority
     *
     * @param GetPriority $parameters
     * @return GetPriorityResponse
     */
    public function getPriority(GetPriority $parameters) {
        return $this->__soapCall('getPriority', array($parameters), array(
                    'uri' => 'http://authentication.services.core.carbon.wso2.org',
                    'soapaction' => ''
        ));
    }

}

?>