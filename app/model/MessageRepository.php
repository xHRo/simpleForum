<?php

namespace Forum;

class MessageRepository extends Repository {
    
    public function __construct(\Nette\Database\Context $connection) {
	parent::__construct($connection);
	$this->tableName = "messages";
    }

    public function getSentMessages($userID) {
        return $this->findBy(array('from_whom' => $userID));
    }

    public function getRecievedMessages($userID) {
        return $this->findBy(array('for_whom' => $userID));
    }    
    
    /**
     * Send message from one user to other
     * @param int $from
     * @param int $for
     * @param String $title
     * @param String $message
     */
    public function addMessage($from, $for, $title, $message) {
        $this->findAll()->insert(array("from_whom" => $from, 'for_whom' => $for, 'title' => $title, 'message' => $message));
    }
    

}