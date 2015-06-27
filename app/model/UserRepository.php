<?php
namespace Forum;

class UserRepository extends \Forum\Repository {
    
    public function __construct(\Nette\Database\Context $connection) {
	parent::__construct($connection);
	$this->tableName = "users";
    }
  
    /**
     * @param int $id
     * @return string userName
     */
    public function getUserForId($id) {
        return $this->findBy(array('id' => $id))->fetch();
    }
    
    
    /*
     * @return string name for user id
     */
    public function getNameForId($id) {
        $data = $this->findBy(array('id' => $id))->fetch();
        return $data['name'];
    }
    
    /*
     * @return int id of user role
     */
    public function getRole($id) {
        $data = $this->findBy(array('id' => $id))->fetch();
        return $data['user_in_role'];
    }
    
    /**
     * Updates user profile
     * @param int $id
     */
    public function editProfile($id, $confirmation, $user_in_role, $name, $email,
            $username, $password, $about, $karma, $last_activity) {
        $this->findBy(array('id' => $id))->update(array("confirmation" => $confirmation, 'user_in_role' => $user_in_role,
            'name' => $name, 'email' => $email, 'username' => $username, 'password' => md5($password), 'about' => $about));
    }
    
    /**
     * Returns user id for username
     * @param String username
     */
    public function getUserIDForName($username) {
        $data = $this->findBy(array('username' => $username))->fetch();
        return $data['id'];
    }
    
    public function addUser($confirmation, $userRole, $name, $email, $username, $password, $about, $karma, $lastActivity) {
       	$this->findAll()->insert(array("confirmation" => $confirmation,
            'user_in_role' => $userRole,
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'about' => $about,
            'karma' => $karma,
            'last_activity' => $lastActivity));
    }
       
}