<?php
require_once './RemoteUserStoreManager/RemoteUserStoreManagerStub.php';

/**
 * RemoteUsersStoreManager class
 */
class RemoteUserStoreManager {
    /**
     * @var RemoteUserManagerStub $serviceStub
     * @access private
     */
    private $serviceStub;

    public function __construct($server_url, $options) {
        $this->serviceStub = new RemoteUserStoreManagerStub(
                $server_url . "RemoteUserStoreManagerService?wsdl", $options
        );
    }
    
    /**
     * Function to get the soap client
     * 
     * @return SoapClient
     */
    public function getSoapClient(){
        return $this->serviceStub;
    }
    
    /**
     * Function to authenticate the user with RemoteUserStoreManager Service
     * @param type $username
     * @param type $password
     */
    public function authenticate($username, $password){
        $parameters = new Authenticate();
        $parameters->userName = $username;
        $parameters->credential = $password;        
        return $this->serviceStub->authenticate($parameters);
    }
    
    /**
     * Function to add new user by providing username and password
     * 
     * @param type $userName
     * @param type $password
     */
    public function addUser($userName, $password){
        $parameters = new AddUser();
        $parameters->userName = $userName;
        $parameters->credential = $password;
        $parameters->claims = null;
        $parameters->profileName = null;
        $parameters->requirePasswordChange = true;
        $parameters->roleList = null;
        $this->serviceStub->addUser($parameters);
    }
    
    public function addRole($roleName){
        $paramerters = new AddRole();
        $paramerters->roleName=$roleName;
        $paramerters->userList=null;
        $paramerters->permissions=null;
        $this->serviceStub->addRole($paramerters);
    }
    
    /**
     * Function to get a list of users
     * 
     * @return username list
     */
    public function listUsers(){
        $parameters = new ListUsers();
        $parameters->filter = "*";
        $parameters->filter = -1;
        
        return $this->serviceStub->listUsers($parameters);
    }
    
    /**
     * Function to check whether the given username already exists
     * 
     * @param string $parameters
     * @return boolean
     */
    public function isExistingUser($parameters) {
        $parameters = new IsExistingUser();
        $parameters->userName = $username;
        
        return $this->serviceStub->isExistingUser($parameters)->return;
    }
    
}
