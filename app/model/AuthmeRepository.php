<?php
namespace Forum;

class AuthmeRepository extends Repository {
    
    public function __construct(\Nette\Database\Context $connection) {
	parent::__construct($connection);
	$this->tableName = "users";
    }
    
    public function findByName($username){
	return $this->findBy(array('username' => $username))->fetch();
    }
    
}